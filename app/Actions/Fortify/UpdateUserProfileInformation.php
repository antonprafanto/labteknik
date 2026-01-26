<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'phone' => ['nullable', 'string', 'max:20'],
            'study_program' => ['nullable', 'string', 'max:100'],
        ];

        // Super admin can update NIP/NIM
        if (Auth::user() && Auth::user()->role === 'super_admin') {
            $rules['nip_nim'] = ['nullable', 'string', 'max:50', Rule::unique('users')->ignore($user->id)];
        }

        Validator::make($input, $rules)->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        $updateData = [
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'] ?? $user->phone,
            'study_program' => $input['study_program'] ?? $user->study_program,
        ];

        // Super admin can update NIP/NIM
        if (Auth::user() && Auth::user()->role === 'super_admin' && isset($input['nip_nim'])) {
            $updateData['nip_nim'] = $input['nip_nim'];
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input, $updateData);
        } else {
            $user->forceFill($updateData)->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     * @param  array<string, mixed>  $updateData
     */
    protected function updateVerifiedUser(User $user, array $input, array $updateData = []): void
    {
        $data = array_merge($updateData, [
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ]);

        $user->forceFill($data)->save();

        $user->sendEmailVerificationNotification();
    }
}
