<?php

namespace App\Livewire\Surveys;

use App\Models\Laboratory;
use App\Models\LabSatisfactionSurvey;
use App\Models\BorrowingRequest;
use App\Models\RoomBorrowing;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public ?Laboratory $laboratory = null;
    public $token = null;
    public $borrowingRequest = null;
    public $roomBorrowing = null;

    public $is_anonymous = false;
    public $rating_cleanliness = 0;
    public $rating_service = 0;
    public $rating_facilities = 0;
    public $rating_equipment = 0;
    public $rating_comfort = 0;
    public $rating_safety = 0;
    public $rating_overall = 0;
    public $suggestions = '';

    public $showSuccess = false;

    protected $rules = [
        'rating_cleanliness' => 'required|integer|min:1|max:5',
        'rating_service' => 'required|integer|min:1|max:5',
        'rating_facilities' => 'required|integer|min:1|max:5',
        'rating_equipment' => 'required|integer|min:1|max:5',
        'rating_comfort' => 'required|integer|min:1|max:5',
        'rating_safety' => 'required|integer|min:1|max:5',
        'rating_overall' => 'required|integer|min:1|max:5',
        'suggestions' => 'nullable|string|max:2000',
    ];

    protected $messages = [
        'rating_cleanliness.required' => 'Silakan beri rating kebersihan.',
        'rating_cleanliness.min' => 'Silakan beri rating kebersihan.',
        'rating_service.required' => 'Silakan beri rating pelayanan.',
        'rating_service.min' => 'Silakan beri rating pelayanan.',
        'rating_facilities.required' => 'Silakan beri rating fasilitas.',
        'rating_facilities.min' => 'Silakan beri rating fasilitas.',
        'rating_equipment.required' => 'Silakan beri rating peralatan.',
        'rating_equipment.min' => 'Silakan beri rating peralatan.',
        'rating_comfort.required' => 'Silakan beri rating kenyamanan.',
        'rating_comfort.min' => 'Silakan beri rating kenyamanan.',
        'rating_safety.required' => 'Silakan beri rating keamanan.',
        'rating_safety.min' => 'Silakan beri rating keamanan.',
        'rating_overall.required' => 'Silakan beri rating keseluruhan.',
        'rating_overall.min' => 'Silakan beri rating keseluruhan.',
    ];

    public function mount(Laboratory $laboratory, ?string $token = null)
    {
        $this->laboratory = $laboratory;
        $this->token = $token;

        // Check if coming from a borrowing
        if ($token) {
            // Try to find borrowing request
            $this->borrowingRequest = BorrowingRequest::where('id', $token)->first();
            if (!$this->borrowingRequest) {
                $this->roomBorrowing = RoomBorrowing::where('id', $token)->first();
            }
        }
    }

    public function setRating($field, $value)
    {
        $this->$field = $value;
    }

    public function submit()
    {
        $this->validate();

        $survey = LabSatisfactionSurvey::create([
            'user_id' => $this->is_anonymous ? null : auth()->id(),
            'laboratory_id' => $this->laboratory->id,
            'borrowing_request_id' => $this->borrowingRequest?->id,
            'room_borrowing_id' => $this->roomBorrowing?->id,
            'survey_token' => Str::random(64),
            'is_anonymous' => $this->is_anonymous,
            'rating_cleanliness' => $this->rating_cleanliness,
            'rating_service' => $this->rating_service,
            'rating_facilities' => $this->rating_facilities,
            'rating_equipment' => $this->rating_equipment,
            'rating_comfort' => $this->rating_comfort,
            'rating_safety' => $this->rating_safety,
            'rating_overall' => $this->rating_overall,
            'suggestions' => $this->suggestions,
        ]);

        // Notify lab head
        $this->notifyLabHead($survey);

        $this->showSuccess = true;
    }

    protected function notifyLabHead(LabSatisfactionSurvey $survey)
    {
        // Find head of lab for this laboratory
        $labHead = \App\Models\User::where('role', 'head_of_lab')
            ->where('laboratory_id', $this->laboratory->id)
            ->first();

        if ($labHead) {
            $labHead->notify(new \App\Notifications\NewSurveySubmitted($survey));
        }

        // Also notify super admins for low ratings
        if ($survey->rating_overall <= 3) {
            $superAdmins = \App\Models\User::where('role', 'super_admin')->get();
            foreach ($superAdmins as $admin) {
                $admin->notify(new \App\Notifications\NewSurveySubmitted($survey));
            }
        }
    }

    public function render()
    {
        return view('livewire.surveys.create')
            ->layout('layouts.guest', ['title' => 'Survey Kepuasan Lab']);
    }
}
