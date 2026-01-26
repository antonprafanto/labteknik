@php
    use App\Models\InventoryItem;
    use App\Models\BorrowingRequest;
    use App\Models\DamageReport;
    use App\Models\User;
    use App\Models\ActivityLog;

    // Get real stats from database
    $totalInventory = InventoryItem::sum('quantity') ?? 0;
    $activeBorrowings = BorrowingRequest::whereIn('status', ['approved', 'borrowed'])->count();
    $damageReports = DamageReport::whereIn('status', ['reported', 'in_progress'])->count();
    $activeUsers = User::where('is_active', true)->count();
    
    // Get recent activities
    $recentActivities = ActivityLog::with('user')
        ->latest()
        ->take(5)
        ->get();
@endphp

<div class="p-6 lg:p-8 bg-slate-50 dark:bg-gray-900 min-h-screen">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ __('Dashboard Overview') }}
        </h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            {{ __('Welcome back, :name. Here is the summary of laboratory activities today.', ['name' => Auth::user()->name]) }}
        </p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Inventory -->
        <x-stat-card title="{{ __('Total Inventory') }}" count="{{ number_format($totalInventory) }}" color="blue" href="{{ route('admin.inventory.items.index') }}">
            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
        </x-stat-card>

        <!-- Active Borrowings -->
        <x-stat-card title="{{ __('Active Borrowings') }}" count="{{ $activeBorrowings }}" color="amber" href="{{ route('borrowings.index') }}">
            <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </x-stat-card>

        <!-- Pending Reports -->
        <x-stat-card title="{{ __('Damage Reports') }}" count="{{ $damageReports }}" color="red" href="{{ route('damage-reports.index') }}">
            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </x-stat-card>

        <!-- Users -->
        <x-stat-card title="{{ __('Active Users') }}" count="{{ $activeUsers }}" color="emerald" href="{{ route('users.index') }}">
            <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </x-stat-card>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quick Actions -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Quick Actions') }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <a href="{{ route('borrowings.create') }}" class="flex flex-col items-center justify-center p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/30 transition-colors group">
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-full shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <span class="mt-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Create Borrowing') }}</span>
                </a>
                
                <a href="{{ route('admin.inventory.items.scan') }}" class="flex flex-col items-center justify-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors group">
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-full shadow-sm group-hover:scale-110 transition-transform">
                         <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 14.5V12m6 3.5V12m-9.78 2.155b.096.096 0 00-.063.1.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5.5.5 0 00-.437-.495l-3.32-.519c-.438-.069-.646-.576-.395-.92L5.5 8.783a.5.5 0 00.11-.295V5a.5.5 0 01.5-.5h5a.5.5 0 01.5.5v2.536a.5.5 0 00.288.458l.78.39c.394.197.625.545.625.99v4.125z"/>
                        </svg>
                    </div>
                    <span class="mt-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Scan QR') }}</span>
                </a>

                <a href="{{ route('damage-reports.create') }}" class="flex flex-col items-center justify-center p-4 bg-red-50 dark:bg-red-900/20 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors group">
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-full shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <span class="mt-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Report Damage') }}</span>
                </a>

                <a href="{{ route('schedules.calendar') }}" class="flex flex-col items-center justify-center p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg hover:bg-teal-100 dark:hover:bg-teal-900/30 transition-colors group">
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-full shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="mt-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('View Schedule') }}</span>
                </a>

                <a href="{{ route('schedules.public') }}" class="flex flex-col items-center justify-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors group">
                    <div class="p-3 bg-white dark:bg-gray-800 rounded-full shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <span class="mt-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Jadwal Praktikum') }}</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('Recent Activity') }}</h2>
            <div class="space-y-4">
                @forelse($recentActivities as $activity)
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            @php
                                $bgColor = match($activity->action) {
                                    'create', 'approved' => 'bg-green-100 dark:bg-green-900',
                                    'update' => 'bg-blue-100 dark:bg-blue-900',
                                    'delete', 'rejected' => 'bg-red-100 dark:bg-red-900',
                                    default => 'bg-gray-100 dark:bg-gray-700'
                                };
                                $iconColor = match($activity->action) {
                                    'create', 'approved' => 'text-green-600 dark:text-green-400',
                                    'update' => 'text-blue-600 dark:text-blue-400',
                                    'delete', 'rejected' => 'text-red-600 dark:text-red-400',
                                    default => 'text-gray-600 dark:text-gray-400'
                                };
                            @endphp
                            <div class="w-8 h-8 rounded-full {{ $bgColor }} flex items-center justify-center">
                                @if($activity->action === 'create' || $activity->action === 'approved')
                                    <svg class="w-4 h-4 {{ $iconColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                @elseif($activity->action === 'update')
                                    <svg class="w-4 h-4 {{ $iconColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 {{ $iconColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $activity->description }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('by') }} {{ $activity->user->name ?? __('System') }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('No recent activity') }}</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('activity-logs.index') }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">{{ __('View All Activity') }} &rarr;</a>
            </div>
        </div>
    </div>
</div>
