<?php

namespace Tests\Feature;

use App\Livewire\Borrowings\Approval;
use App\Models\BorrowingItem;
use App\Models\BorrowingRequest;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BorrowingFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_borrowing_flow_approval()
    {
        // 1. Setup Data
        $headOfLab = User::factory()->create(['role' => 'head_of_lab']);
        $student = User::factory()->create(['role' => 'student']);
        
        $lab = Laboratory::create([
            'name' => 'Lab Test',
            'location' => 'Loc Test',
            'room_number' => '101',
            'capacity' => 20,
            'status' => 'aktif',
        ]);

        $category = InventoryCategory::create([
            'name' => 'Cat Test',
            'icon' => 'test',
            'color' => '#000000',
        ]);

        $item = InventoryItem::create([
            'laboratory_id' => $lab->id,
            'category_id' => $category->id,
            'code' => 'TEST-001',
            'name' => 'Test Item',
            'brand' => 'Test Brand',
            'model' => 'Test Model',
            'quantity' => 10,
            'available_quantity' => 10,
            'status' => 'available',
        ]);

        // 2. User Requests Borrowing
        $request = BorrowingRequest::create([
            'request_number' => 'REQ-001',
            'user_id' => $student->id,
            'borrow_date' => now()->addDay(),
            'return_date' => now()->addDays(2),
            'purpose' => 'Testing',
            'status' => 'pending',
        ]);

        BorrowingItem::create([
            'borrowing_request_id' => $request->id,
            'inventory_item_id' => $item->id,
            'quantity' => 2,
        ]);

        // 3. Approve
        Livewire::actingAs($headOfLab)
            ->test(Approval::class)
            ->call('approve', $request->id)
            ->assertHasNoErrors();

        // 4. Assertions
        $this->assertEquals('approved', $request->fresh()->status);
        $this->assertEquals(8, $item->fresh()->available_quantity);
    }
}
