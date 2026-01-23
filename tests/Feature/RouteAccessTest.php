<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_access_dashboard()
    {
        $user = User::factory()->create([
            'role' => 'super_admin',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_super_admin_can_access_laboratories_index()
    {
        $user = User::factory()->create([
            'role' => 'super_admin',
        ]);

        $response = $this->actingAs($user)->get(route('admin.laboratories.index'));

        $response->assertStatus(200);
    }

    public function test_super_admin_can_access_inventory_items_index()
    {
        $user = User::factory()->create([
            'role' => 'super_admin',
        ]);

        $response = $this->actingAs($user)->get(route('admin.inventory.items.index'));

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_access_damage_reports_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('damage-reports.index'));

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_access_borrowings_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('borrowings.index'));

        $response->assertStatus(200);
    }
}
