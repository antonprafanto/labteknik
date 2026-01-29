<?php

namespace App\Livewire\Users;

use App\Models\Laboratory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'roleFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting self
        if ($user->id === auth()->id()) {
            session()->flash('error', 'You cannot delete yourself.');
            return;
        }

        // Clear head_lab_id if this user was a head of lab
        // Note: DB has nullOnDelete but we do this explicitly for clarity
        Laboratory::where('head_lab_id', $user->id)->update(['head_lab_id' => null]);

        $user->delete();
        session()->flash('message', 'User berhasil dihapus.');
    }

    public function render()
    {
        $users = User::with('laboratory')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('nip_nim', 'like', '%' . $this->search . '%');
            })
            ->when($this->roleFilter, function ($query) {
                $query->where('role', $this->roleFilter);
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.users.index', [
            'users' => $users,
        ]);
    }
}
