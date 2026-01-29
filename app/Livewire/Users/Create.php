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

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:super_admin,head_of_lab,lab_assistant,lecturer,student',
            'nip_nim' => 'nullable|string|max:20|unique:users',
            'phone' => 'nullable|string|max:20',
            'study_program' => 'nullable|string|max:100',
            'laboratory_id' => [
                'nullable',
                'exists:laboratories,id',
                function ($attribute, $value, $fail) {
                    // Validate: only one head of lab per laboratory
                    if ($this->role === 'head_of_lab' && $value) {
                        $existingLab = Laboratory::where('id', $value)
                            ->whereNotNull('head_lab_id')
                            ->with('head')
                            ->first();
                        if ($existingLab) {
                            $fail('Laboratorium ini sudah memiliki kepala lab: ' . $existingLab->head->name);
                        }
                    }
                },
            ],
            'is_active' => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
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

        // Sync: Update head_lab_id in laboratories table
        if ($this->role === 'head_of_lab' && $this->laboratory_id) {
            Laboratory::where('id', $this->laboratory_id)->update(['head_lab_id' => $user->id]);
        }

        session()->flash('message', 'User berhasil dibuat.');

        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.users.create', [
            'laboratories' => Laboratory::all(),
        ]);
    }
}
