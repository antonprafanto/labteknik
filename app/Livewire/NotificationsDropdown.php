<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationsDropdown extends Component
{
    public function getNotificationsProperty()
    {
        return auth()->user()->unreadNotifications()->take(5)->get();
    }

    public function getUnreadCountProperty()
    {
        return auth()->user()->unreadNotifications()->count();
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
            
            if (isset($notification->data['action_url'])) {
                return redirect($notification->data['action_url']);
            }
        }
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->dispatch('notifications-cleared');
    }

    public function render()
    {
        return view('livewire.notifications-dropdown');
    }
}
