<?php

namespace App\Livewire\Users;

use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public User $user;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;
    public $nip_nim;
    public $phone;
    public $study_program;
    public $laboratory_id;
    public $is_active;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->nip_nim = $user->nip_nim;
        $this->phone = $user->phone;
        $this->study_program = $user->study_program;
        $this->laboratory_id = $user->laboratory_id;
        $this->is_active = $user->is_active;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:super_admin,head_of_lab,lab_assistant,lecturer,student',
            'nip_nim' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($this->user->id)],
            'phone' => 'nullable|string|max:20',
            'study_program' => 'nullable|string|max:100',
            'laboratory_id' => 'nullable|exists:laboratories,id',
            'is_active' => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'nip_nim' => $this->nip_nim,
            'phone' => $this->phone,
            'study_program' => $this->study_program,
            'laboratory_id' => ($this->role === 'head_of_lab' || $this->role === 'lab_assistant') ? $this->laboratory_id : null,
            'is_active' => $this->is_active,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $this->user->update($data);

        session()->flash('message', 'User updated successfully.');

        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.users.edit', [
            'laboratories' => Laboratory::all(),
        ]);
    }
}
