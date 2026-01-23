<?php

namespace Tests\Feature;

use App\Livewire\Users\Create;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_creation_flow()
    {
        // 1. Setup Data
        $admin = User::factory()->create(['role' => 'super_admin']);

        // 2. Admin Creates User
        Livewire::actingAs($admin)
            ->test(Create::class)
            ->set('name', 'New User')
            ->set('email', 'newuser@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->set('role', 'student')
            ->set('nip_nim', '12345678')
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect(route('users.index'));

        // 3. Verify User Created
        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
            'role' => 'student',
        ]);
    }
}
