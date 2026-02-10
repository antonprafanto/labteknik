<?php

namespace Tests\Feature;

use App\Models\BorrowingRequest;
use App\Models\InventoryItem;
use App\Models\Laboratory;
use App\Models\PracticumSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LaboratorySystemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    #[Test]
    public function super_admin_can_access_dashboard()
    {
        $admin = User::factory()->create(['role' => 'super_admin']);

        $this->actingAs($admin);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    #[Test]
    public function student_cannot_access_admin_dashboard()
    {
        $student = User::factory()->create(['role' => 'student']);

        $this->actingAs($student);

        // Assuming /admin/laboratories is an admin route
        $response = $this->get('/admin/laboratories');
        $response->assertStatus(403);
    }

    #[Test]
    public function inventory_item_can_be_created()
    {
        $admin = User::factory()->create(['role' => 'super_admin']);
        
        $lab = Laboratory::factory()->create();
        $category = \App\Models\InventoryCategory::factory()->create();

        Livewire::actingAs($admin)
            ->test(\App\Livewire\Inventory\Items\Create::class)
            ->set('laboratory_id', $lab->id)
            ->set('category_id', $category->id)
            ->set('name', 'Test Item')
            ->set('brand', 'Test Brand')
            ->set('model', 'Test Model')
            ->set('purchase_year', 2024)
            ->set('condition', 'good')
            ->set('quantity', 10)
            ->set('status', 'available')
            ->call('save');

        $this->assertDatabaseHas('inventory_items', [
            'name' => 'Test Item',
            'quantity' => 10,
        ]);
    }

    #[Test]
    public function borrowing_request_flow()
    {
        // 1. Setup Data
        $student = User::factory()->create(['role' => 'student']);
        
        $headOfLab = User::factory()->create(['role' => 'head_of_lab']);

        $item = InventoryItem::factory()->create(['quantity' => 5, 'status' => 'available']);
        $item->update(['available_quantity' => 5]); // Force update

        // 2. Student Requests Item
        Livewire::actingAs($student)
            ->test(\App\Livewire\Borrowings\Create::class)
            ->set('borrow_date', Carbon::now()->addDay()->format('Y-m-d'))
            ->set('return_date', Carbon::now()->addDays(2)->format('Y-m-d'))
            ->set('purpose', 'Testing Project')
            ->set('participants', 5) // Added participants
            ->set('selectedItems', [
                [
                    'id' => $item->id, 
                    'name' => $item->name, 
                    'available' => $item->quantity, 
                    'quantity' => 2
                ]
            ])
            ->call('save')
            ->assertHasNoErrors();

        $request = BorrowingRequest::first();
        $this->assertNotNull($request);
        $this->assertEquals('pending', $request->status);
        $this->assertEquals(2, $request->items->first()->quantity);

        // 3. Head of Lab Approves
        Livewire::actingAs($headOfLab)
            ->test(\App\Livewire\Borrowings\Approval::class)
            ->call('approve', $request->id);

        $request->refresh();
        $item->refresh();

        // 4. Verify Status and Stock Deduction
        $this->assertEquals('approved', $request->status);
        $this->assertEquals(3, $item->available_quantity); // 5 - 2 = 3
    }

    #[Test]
    public function borrowing_stock_validation()
    {
        $student = User::factory()->create(['role' => 'student']);
        
        $item = InventoryItem::factory()->create(['quantity' => 5, 'available_quantity' => 5]);

        // Try to borrow more than available
        Livewire::actingAs($student)
            ->test(\App\Livewire\Borrowings\Create::class)
            ->set('borrow_date', Carbon::now()->addDay()->format('Y-m-d'))
            ->set('return_date', Carbon::now()->addDays(2)->format('Y-m-d'))
            ->set('purpose', 'Testing Project')
            ->set('selectedItems', [
                [
                    'id' => $item->id, 
                    'name' => $item->name, 
                    'available' => $item->quantity, 
                    'quantity' => 10
                ]
            ])
            ->call('save') // Changed from submit to save
            ->assertHasErrors('selectedItems');
    }

    #[Test]
    public function practicum_schedule_conflict_detection()
    {
        $admin = User::factory()->create(['role' => 'super_admin']);
        
        $lab = Laboratory::factory()->create();
        $lecturer = User::factory()->create(['role' => 'lecturer']);
        
        // Create initial schedule
        PracticumSchedule::create([
            'laboratory_id' => $lab->id,
            'lecturer_id' => $lecturer->id,
            'course_name' => 'Physics 101',
            'class_name' => 'A',
            'year_batch' => '2024',
            'day_of_week' => 1,
            'schedule_date' => Carbon::now()->addDay()->format('Y-m-d'),
            'start_time' => '08:00:00',
            'end_time' => '10:00:00',
            'participants' => 30,
            'created_by' => $admin->id,
            'status' => 'scheduled'
        ]);

        $this->assertDatabaseCount('practicum_schedules', 1);

        // Try to create overlapping schedule (Exact same time)
        Livewire::actingAs($admin)
            ->test(\App\Livewire\Schedules\Create::class)
            ->set('laboratory_id', $lab->id)
            ->set('lecturer_id', $lecturer->id)
            ->set('course_name', 'Chemistry 101')
            ->set('class_name', 'B')
            ->set('year_batch', '2025')
            ->set('day_of_week', 1)
            ->set('schedule_date', Carbon::now()->addDay()->format('Y-m-d'))
            ->set('start_time', '08:00') // Exact overlap
            ->set('end_time', '10:00')
            ->set('participants', 25)
            ->call('save')
            ->assertHasErrors('start_time'); // Should fail
    }
}