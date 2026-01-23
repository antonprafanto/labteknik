<?php

namespace App\Http\Controllers;

use App\Models\BorrowingItem;
use App\Models\DamageReport;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;
use App\Models\Laboratory;
// use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function exportPdf()
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
            ->take(10) // Take more for the report
            ->get();
            
        // 5. Lab Stats
        $labStats = Laboratory::withCount(['inventoryItems as items_count'])->get();

        $data = [
            'itemsByCategory' => $itemsByCategory,
            'itemStatus' => $itemStatus,
            'topBorrowedItems' => $topBorrowedItems,
            'recentDamageReports' => $recentDamageReports,
            'labStats' => $labStats,
            'date' => now()->format('d F Y'),
        ];

        // PDF Generation is temporarily disabled due to server environment restrictions
        // $pdf = Pdf::loadView('reports.pdf', $data);
        // return $pdf->download('laboratory-report-' . now()->format('Y-m-d') . '.pdf');
        
        return response()->view('reports.pdf', $data); // Fallback: Show HTML view
    }
}
