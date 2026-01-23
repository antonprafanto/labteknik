<?php

namespace App\Livewire\Users;

use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role = 'student';
    public $nip_nim;
    public $phone;
    public $study_program;
    public $laboratory_id;
    public $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:super_admin,head_of_lab,lab_assistant,lecturer,student',
        'nip_nim' => 'nullable|string|max:20|unique:users',
        'phone' => 'nullable|string|max:20',
        'study_program' => 'nullable|string|max:100',
        'laboratory_id' => 'nullable|exists:laboratories,id',
        'is_active' => 'boolean',
    ];

    public function save()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'nip_nim' => $this->nip_nim,
            'phone' => $this->phone,
            'study_program' => $this->study_program,
            'laboratory_id' => ($this->role === 'head_of_lab' || $this->role === 'lab_assistant') ? $this->laboratory_id : null,
            'is_active' => $this->is_active,
        ]);

        session()->flash('message', 'User created successfully.');

        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.users.create', [
            'laboratories' => Laboratory::all(),
        ]);
    }
}
