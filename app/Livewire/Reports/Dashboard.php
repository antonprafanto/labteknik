<?php

namespace App\Livewire\Reports;

use App\Models\BorrowingItem;
use App\Models\BorrowingRequest;
use App\Models\DamageReport;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\Laboratory;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        // 1. Inventory by Category
        $itemsByCategory = InventoryCategory::withCount('items')->get();

        // 2. Item Status Distribution
        $itemStatus = InventoryItem::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Ensure all statuses are present
        $allStatuses = ['available', 'borrowed', 'maintenance', 'damaged', 'lost'];
        foreach ($allStatuses as $status) {
            if (!isset($itemStatus[$status])) {
                $itemStatus[$status] = 0;
            }
        }

        // 3. Top Borrowed Items
        $topBorrowedItems = BorrowingItem::selectRaw('inventory_item_id, sum(quantity) as total_borrowed')
            ->groupBy('inventory_item_id')
            ->orderByDesc('total_borrowed')
            ->take(5)
            ->with('inventoryItem')
            ->get();

        // 4. Recent Damage Reports
        $recentDamageReports = DamageReport::with(['inventoryItem', 'reporter'])
            ->latest()
            ->take(5)
            ->get();
            
        // 5. Lab Stats
        $labStats = Laboratory::withCount(['inventoryItems as items_count'])->get();

        // Chart Data Preparation
        $chartData = [
            'status' => [
                'labels' => array_map('ucfirst', array_keys($itemStatus)),
                'data' => array_values($itemStatus),
                'colors' => ['#10B981', '#F59E0B', '#F97316', '#EF4444', '#6B7280'], // Green, Yellow, Orange, Red, Gray
            ],
            'category' => [
                'labels' => $itemsByCategory->pluck('name')->toArray(),
                'data' => $itemsByCategory->pluck('items_count')->toArray(),
                'colors' => $itemsByCategory->pluck('color')->toArray(),
            ]
        ];

        return view('livewire.reports.dashboard', [
            'itemsByCategory' => $itemsByCategory,
            'itemStatus' => $itemStatus,
            'topBorrowedItems' => $topBorrowedItems,
            'recentDamageReports' => $recentDamageReports,
            'labStats' => $labStats,
            'chartData' => $chartData,
        ]);
    }
}
