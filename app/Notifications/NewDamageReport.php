<?php

namespace App\Notifications;

use App\Models\DamageReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDamageReport extends Notification
{
    use Queueable;

    public $damageReport;

    /**
     * Create a new notification instance.
     */
    public function __construct(DamageReport $damageReport)
    {
        $this->damageReport = $damageReport;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Laporan Kerusakan Baru',
            'message' => 'Laporan kerusakan baru dari ' . $this->damageReport->reporter->name . ' untuk barang: ' . $this->damageReport->inventoryItem->name,
            'action_url' => route('damage-reports.show', $this->damageReport->id),
            'type' => 'damage_report',
        ];
    }
}
