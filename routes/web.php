<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

// Help
Route::get('/help', function () {
    return view('help');
})->name('help');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        Session::put('locale', $locale);
        Session::save();
        
        // Also set a cookie for 1 year
        return back()->withCookie(cookie('lang', $locale, 60 * 24 * 365));
    }
    return back();
})->name('lang.switch');

Route::get('/', function () {
    $labsCount = \App\Models\Laboratory::count();
    $itemsCount = \App\Models\InventoryItem::count();
    $studentsCount = \App\Models\User::where('role', 'student')->count();
    $activeSchedulesCount = \App\Models\PracticumSchedule::where('status', '!=', 'cancelled')->count();

    return view('welcome', compact('labsCount', 'itemsCount', 'studentsCount', 'activeSchedulesCount'));
});

// Public Schedule Table
Route::get('/jadwal-praktikum', \App\Livewire\Schedules\PublicTable::class)->name('schedules.public');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/laboratories', \App\Livewire\Laboratories\Index::class)->name('laboratories.index');
        Route::get('/laboratories/create', \App\Livewire\Laboratories\Create::class)->name('laboratories.create');
        Route::get('/laboratories/{laboratory}/edit', \App\Livewire\Laboratories\Edit::class)->name('laboratories.edit');

        // Inventory Categories
        Route::get('/inventory/categories', \App\Livewire\Inventory\Categories\Index::class)->name('inventory.categories.index');
        Route::get('/inventory/categories/create', \App\Livewire\Inventory\Categories\Create::class)->name('inventory.categories.create');
        Route::get('/inventory/categories/{category}/edit', \App\Livewire\Inventory\Categories\Edit::class)->name('inventory.categories.edit');

        // Inventory Items
        Route::get('/inventory/items/scan', \App\Livewire\Inventory\Scan::class)->name('inventory.items.scan');
        Route::get('/inventory/items', \App\Livewire\Inventory\Items\Index::class)->name('inventory.items.index');
        Route::get('/inventory/items/create', \App\Livewire\Inventory\Items\Create::class)->name('inventory.items.create');
        Route::get('/inventory/items/{item}', \App\Livewire\Inventory\Items\Show::class)->name('inventory.items.show');
        Route::get('/inventory/items/{item}/edit', \App\Livewire\Inventory\Items\Edit::class)->name('inventory.items.edit');
    });

    // General User Routes (Authenticated)
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
        Route::get('/borrowings', \App\Livewire\Borrowings\Index::class)->name('borrowings.index');
        Route::get('/borrowings/create', \App\Livewire\Borrowings\Create::class)->name('borrowings.create');

        // Borrowing Approvals
        Route::get('/borrowings/approvals', \App\Livewire\Borrowings\Approval::class)->name('borrowings.approval');

        Route::get('/borrowings/{item}', \App\Livewire\Borrowings\Show::class)->name('borrowings.show');

        // Print Borrowing Letter
        Route::get('/borrowings/{borrowingRequest}/print', function (\App\Models\BorrowingRequest $borrowingRequest) {
            // Ensure user is authorized to view this
            if (auth()->user()->id !== $borrowingRequest->user_id && !auth()->user()->hasRole(['super_admin', 'head_of_lab', 'lab_assistant'])) {
                abort(403);
            }
            return view('borrowings.print', ['request' => $borrowingRequest]);
        })->name('borrowings.print');

        // Download/View Borrowing Proof Document
        Route::get('/borrowings/{borrowingRequest}/document', function (\App\Models\BorrowingRequest $borrowingRequest) {
            // Ensure user is authorized to view this
            if (auth()->user()->id !== $borrowingRequest->user_id && !auth()->user()->hasRole(['super_admin', 'head_of_lab', 'lab_assistant'])) {
                abort(403);
            }
            
            if (!$borrowingRequest->proof_document) {
                abort(404, 'Document not found');
            }
            
            $path = storage_path('app/public/' . $borrowingRequest->proof_document);
            
            if (!file_exists($path)) {
                abort(404, 'File not found');
            }
            
            return response()->file($path);
        })->name('borrowings.document');

        // Schedules
        Route::get('/schedules', \App\Livewire\Schedules\Index::class)->name('schedules.index');
        Route::get('/schedules/calendar', \App\Livewire\Schedules\Calendar::class)->name('schedules.calendar');
        Route::get('/schedules/create', \App\Livewire\Schedules\Create::class)->name('schedules.create');
    });

    // Schedule Management (Admin, Head of Lab, Lecturer)
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:super_admin,head_of_lab,lecturer'])->group(function () {
        Route::get('/schedules/create', \App\Livewire\Schedules\Create::class)->name('schedules.create');
        Route::get('/schedules/{schedule}/edit', \App\Livewire\Schedules\Edit::class)->name('schedules.edit');
    });

    // Time Slot Management (Super Admin, Head of Lab)
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:super_admin,head_of_lab'])->group(function () {
        Route::get('/admin/time-slots', \App\Livewire\Admin\TimeSlotManager::class)->name('admin.time-slots.index');
    });

    // Reports & Statistics (Admin, Head of Lab)
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:super_admin,head_of_lab'])->group(function () {
        Route::get('/reports', \App\Livewire\Reports\Dashboard::class)->name('reports.dashboard');
        Route::get('/reports/export', [\App\Http\Controllers\ReportController::class, 'exportPdf'])->name('reports.export');
    });

    // User Management (Super Admin)
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:super_admin'])->group(function () {
        Route::get('/users', \App\Livewire\Users\Index::class)->name('users.index');
        Route::get('/users/create', \App\Livewire\Users\Create::class)->name('users.create');
        Route::get('/users/{user}/edit', \App\Livewire\Users\Edit::class)->name('users.edit');
        
        // Activity Logs
        Route::get('/activity-logs', \App\Livewire\ActivityLogs\Index::class)->name('activity-logs.index');
    });

    // Damage Reports (General Access)
    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
        Route::get('/damage-reports', \App\Livewire\DamageReports\Index::class)->name('damage-reports.index');
        Route::get('/damage-reports/create', \App\Livewire\DamageReports\Create::class)->name('damage-reports.create');
        Route::get('/damage-reports/{report}', \App\Livewire\DamageReports\Show::class)->name('damage-reports.show');
    });
});
