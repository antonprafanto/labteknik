<?php

namespace Tests\Feature;

use App\Livewire\Schedules\Create;
use App\Models\Laboratory;
use App\Models\PracticumSchedule;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ScheduleManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_schedule_creation_flow()
    {
        // 1. Setup Data
        $admin = User::factory()->create(['role' => 'super_admin']);
        $lecturer = User::factory()->create(['role' => 'lecturer']);
        
        $lab = Laboratory::create([
            'name' => 'Lab Test',
            'location' => 'Loc Test',
            'room_number' => '101',
            'capacity' => 20,
            'status' => 'aktif',
        ]);

        // 2. Admin Creates Schedule
        Livewire::actingAs($admin)
            ->test(Create::class)
            ->set('laboratory_id', $lab->id)
            ->set('lecturer_id', $lecturer->id)
            ->set('course_name', 'Test Course')
            ->set('class_name', 'Test Class')
            ->set('year_batch', '2024')
            ->set('day_of_week', 1)
            ->set('schedule_date', now()->addDay()->format('Y-m-d'))
            ->set('start_time', '08:00')
            ->set('end_time', '10:00')
            ->set('participants', 20)
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect(route('schedules.index'));

        // 3. Verify Schedule Created
        $this->assertDatabaseHas('practicum_schedules', [
            'laboratory_id' => $lab->id,
            'lecturer_id' => $lecturer->id,
            'course_name' => 'Test Course',
        ]);
    }

    public function test_schedule_conflict_detection()
    {
        // 1. Setup Data
        $admin = User::factory()->create(['role' => 'super_admin']);
        $lecturer = User::factory()->create(['role' => 'lecturer']);
        
        $lab = Laboratory::create([
            'name' => 'Lab Test',
            'location' => 'Loc Test',
            'room_number' => '101',
            'capacity' => 20,
            'status' => 'aktif',
        ]);

        $date = now()->addDay()->format('Y-m-d');

        // Create initial schedule
        PracticumSchedule::create([
            'laboratory_id' => $lab->id,
            'lecturer_id' => $lecturer->id,
            'course_name' => 'Existing Course',
            'class_name' => 'A',
            'year_batch' => '2024',
            'day_of_week' => 1,
            'schedule_date' => $date,
            'start_time' => '08:00',
            'end_time' => '10:00',
            'participants' => 20,
            'status' => 'scheduled',
            'created_by' => $admin->id,
        ]);

        // 2. Attempt to create conflicting schedule
        Livewire::actingAs($admin)
            ->test(Create::class)
            ->set('laboratory_id', $lab->id)
            ->set('lecturer_id', $lecturer->id)
            ->set('course_name', 'New Course')
            ->set('class_name', 'B')
            ->set('year_batch', '2025')
            ->set('day_of_week', 1)
            ->set('schedule_date', $date)
            ->set('start_time', '09:00') // Overlaps
            ->set('end_time' , '11:00')
            ->set('participants', 20)
            ->call('save')
            ->assertHasErrors(['start_time']);
    }
}
