<?php

namespace App\Actions\Jetstream;

use App\Models\Laboratory;
use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        // Clear head_lab_id if this user was a head of lab
        // Note: DB has nullOnDelete but we do this explicitly for consistency
        Laboratory::where('head_lab_id', $user->id)->update(['head_lab_id' => null]);

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}

