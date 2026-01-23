<?php

namespace Tests\Feature;

use App\Livewire\DamageReports\Create;
use App\Livewire\DamageReports\Show;
use App\Models\DamageReport;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class DamageReportFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_damage_report_flow()
    {
        // 1. Setup Data
        Storage::fake('public');
        $labAdmin = User::factory()->create(['role' => 'lab_assistant']);
        $user = User::factory()->create(['role' => 'student']);
        
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

        // 2. User Submits Report
        Livewire::actingAs($user)
            ->test(Create::class)
            ->set('inventory_item_id', $item->id)
            ->set('damage_type', 'ringan')
            ->set('description', 'Something is broken')
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect(route('damage-reports.index'));

        $report = DamageReport::first();
        $this->assertNotNull($report);
        $this->assertEquals('reported', $report->status);
        $this->assertEquals('ringan', $report->damage_type);

        // 3. Admin Updates Status (In Progress)
        Livewire::actingAs($labAdmin)
            ->test(Show::class, ['report' => $report])
            ->set('status', 'in_progress')
            ->set('repair_notes', 'Starting repair')
            ->call('updateStatus')
            ->assertHasNoErrors();

        $this->assertEquals('in_progress', $report->fresh()->status);
        $this->assertEquals('maintenance', $item->fresh()->status);

        // 4. Admin Updates Status (Completed)
        Livewire::actingAs($labAdmin)
            ->test(Show::class, ['report' => $report])
            ->set('status', 'completed')
            ->set('repair_cost', 100000)
            ->call('updateStatus')
            ->assertHasNoErrors();

        $this->assertEquals('completed', $report->fresh()->status);
        $this->assertEquals('available', $item->fresh()->status);
        $this->assertEquals('good', $item->fresh()->condition);
    }
}
