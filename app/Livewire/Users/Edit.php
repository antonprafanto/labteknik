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

    // Store original values for comparison
    private $originalRole;
    private $originalLabId;

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

        // Store originals
        $this->originalRole = $user->role;
        $this->originalLabId = $user->laboratory_id;
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
            'laboratory_id' => [
                'nullable',
                'exists:laboratories,id',
                function ($attribute, $value, $fail) {
                    // Validate: only one head of lab per laboratory (ignore current user)
                    if ($this->role === 'head_of_lab' && $value) {
                        $existingLab = Laboratory::where('id', $value)
                            ->whereNotNull('head_lab_id')
                            ->where('head_lab_id', '!=', $this->user->id)
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

        // Store old values before update
        $wasHead = $this->user->role === 'head_of_lab';
        $oldLabId = $this->user->laboratory_id;

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

        // Sync head_lab_id in laboratories table
        $newLabId = ($this->role === 'head_of_lab' || $this->role === 'lab_assistant') ? $this->laboratory_id : null;

        // Clear old head assignment if:
        // 1. User was head_of_lab AND had a lab assigned
        // 2. AND (role changed from head_of_lab OR lab changed)
        if ($wasHead && $oldLabId && ($this->role !== 'head_of_lab' || $oldLabId != $this->laboratory_id)) {
            Laboratory::where('id', $oldLabId)
                ->where('head_lab_id', $this->user->id)
                ->update(['head_lab_id' => null]);
        }

        // Set new head assignment if user is now head_of_lab with a lab
        if ($this->role === 'head_of_lab' && $this->laboratory_id) {
            Laboratory::where('id', $this->laboratory_id)->update(['head_lab_id' => $this->user->id]);
        }

        session()->flash('message', 'User berhasil diperbarui.');

        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.users.edit', [
            'laboratories' => Laboratory::all(),
        ]);
    }
}

