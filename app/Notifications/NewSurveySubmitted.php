<?php

namespace App\Notifications;

use App\Models\LabSatisfactionSurvey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSurveySubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    protected LabSatisfactionSurvey $survey;
    protected bool $isLowRating;

    public function __construct(LabSatisfactionSurvey $survey)
    {
        $this->survey = $survey;
        $this->isLowRating = $survey->rating_overall <= 3;
    }

    public function via(object $notifiable): array
    {
        // Send email for low ratings, otherwise just database
        if ($this->isLowRating) {
            return ['database', 'mail'];
        }
        return ['database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $labName = $this->survey->laboratory->name ?? 'Unknown Lab';
        
        return (new MailMessage)
            ->subject('⚠️ Survey Rating Rendah - ' . $labName)
            ->greeting('Perhatian!')
            ->line("Terdapat survey dengan rating rendah untuk {$labName}.")
            ->line("Rating Keseluruhan: {$this->survey->rating_overall}/5")
            ->line("Rata-rata: {$this->survey->average_rating}/5")
            ->when($this->survey->suggestions, function ($mail) {
                return $mail->line("Kritik/Saran: {$this->survey->suggestions}");
            })
            ->action('Lihat Dashboard Survey', route('surveys.dashboard'))
            ->line('Mohon segera ditindaklanjuti.');
    }

    public function toArray(object $notifiable): array
    {
        $labName = $this->survey->laboratory->name ?? 'Lab';
        
        return [
            'type' => 'survey_submitted',
            'title' => $this->isLowRating 
                ? '⚠️ Survey Rating Rendah'
                : '📋 Survey Baru',
            'survey_id' => $this->survey->id,
            'laboratory_id' => $this->survey->laboratory_id,
            'laboratory_name' => $labName,
            'rating_overall' => $this->survey->rating_overall,
            'average_rating' => $this->survey->average_rating,
            'is_low_rating' => $this->isLowRating,
            'message' => $this->isLowRating 
                ? "Rating {$this->survey->rating_overall}/5 untuk {$labName}"
                : "Survey baru diterima untuk {$labName}",
        ];
    }
}
