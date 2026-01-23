<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <style>
        @media print {
            nav, header, footer, aside, .no-print { display: none !important; }
            body, .min-h-screen { background-color: white !important; }
            .bg-white, .dark\:bg-gray-800 { background-color: white !important; color: black !important; box-shadow: none !important; border: 1px solid #e5e7eb !important; }
            .text-white, .dark\:text-white { color: black !important; }
            .shadow-xl, .shadow-2xl { box-shadow: none !important; }
        }
    </style>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 mb-8 border border-gray-200 dark:border-gray-700 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 relative z-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Laporan & Statistik') }}</h2>
                    <p class="text-base text-gray-600 dark:text-gray-300 mt-1 font-medium">{{ __('Overview of laboratory inventory and activities.') }}</p>
                </div>
                <div class="flex gap-2 no-print">
                <a href="{{ route('reports.export') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    {{ __('Cetak / Export PDF') }}
                </a>
            </div>
            </div>
        </div>

        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 rounded-2xl border border-gray-100 dark:border-gray-700 group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">{{ __('Total Barang') }}</div>
                            <div class="mt-2 text-3xl font-black text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ array_sum($itemStatus) }}</div>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-500 h-1 w-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 rounded-2xl border border-gray-100 dark:border-gray-700 group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">{{ __('Tersedia') }}</div>
                            <div class="mt-2 text-3xl font-black text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $itemStatus['available'] ?? 0 }}</div>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-emerald-500 h-1 w-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 rounded-2xl border border-gray-100 dark:border-gray-700 group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">{{ __('Dipinjam') }}</div>
                            <div class="mt-2 text-3xl font-black text-gray-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">{{ $itemStatus['borrowed'] ?? 0 }}</div>
                        </div>
                        <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-amber-500 h-1 w-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 rounded-2xl border border-gray-100 dark:border-gray-700 group">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">{{ __('Damaged/Maintenance') }}</div>
                            <div class="mt-2 text-3xl font-black text-gray-900 dark:text-white group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">{{ ($itemStatus['damaged'] ?? 0) + ($itemStatus['maintenance'] ?? 0) }}</div>
                        </div>
                        <div class="w-12 h-12 bg-rose-100 dark:bg-rose-900/30 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-rose-500 h-1 w-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Items by Category Chart -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl rounded-2xl p-6 border border-gray-100 dark:border-gray-700 relative">
                <div class="absolute top-0 left-0 w-1 h-full bg-indigo-500"></div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    {{ __('Inventaris per Kategori') }}
                </h3>
                <div class="h-80 relative">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            <!-- Item Status Chart -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl rounded-2xl p-6 border border-gray-100 dark:border-gray-700 relative">
                 <div class="absolute top-0 left-0 w-1 h-full bg-purple-500"></div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                    {{ __('Item Status Distribution') }}
                </h3>
                <div class="h-80 flex justify-center relative">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Top Borrowed Items -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        {{ __('Top Borrowed Items') }}
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Item') }}</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Times Borrowed') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            @forelse($topBorrowedItems as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $item->inventoryItem->name ?? 'Unknown Item' }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ $item->total_borrowed }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400 italic">{{ __('No data available') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Damage Reports -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        {{ __('Recent Damage Reports') }}
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    @forelse($recentDamageReports as $report)
                        <div class="flex items-start p-4 bg-rose-50 dark:bg-rose-900/10 rounded-xl border border-rose-100 dark:border-rose-800/30 hover:shadow-md transition-shadow">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-rose-100 dark:bg-rose-900/30 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-rose-600 dark:text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 w-full">
                                <p class="text-sm font-bold text-rose-800 dark:text-rose-200">
                                    {{ $report->inventoryItem->name ?? 'Unknown Item' }}
                                </p>
                                <div class="flex justify-between mt-1 items-center">
                                    <p class="text-xs text-rose-700 dark:text-rose-300 font-medium bg-rose-200 dark:bg-rose-800 px-2 py-0.5 rounded-full">
                                        {{ ucfirst($report->damage_type) }}
                                    </p>
                                    <span class="text-xs text-rose-500 dark:text-rose-400 font-medium">{{ $report->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2 line-clamp-1">
                                    {{ Str::limit($report->description, 60) }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6">
                            <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">{{ __('No recent damage reports.') }}</p>
                        </div>
                    @endforelse
                    
                    @if(count($recentDamageReports) > 0)
                    <div class="pt-4 text-right border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('damage-reports.index') }}" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-bold transition-colors">
                            {{ __('View All Reports') }} <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 mb-8">
            <!-- Lab Utilization (Items count per lab) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    {{ __('Items per Laboratory') }}
                </h3>
                <div class="space-y-6">
                    @foreach($labStats as $lab)
                        <div class="group">
                            <div class="flex justify-between text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <span>{{ $lab->name }}</span>
                                <span class="bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded text-gray-800 dark:text-gray-200">{{ $lab->items_count }} {{ __('items') }}</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden shadow-inner">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-3 rounded-full transition-all duration-1000 ease-out group-hover:scale-x-105 origin-left" style="width: {{ $labStats->max('items_count') > 0 ? ($lab->items_count / $labStats->max('items_count')) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            const chartData = @json($chartData);

            // Chart Defaults for Dark Mode
            Chart.defaults.color = '#9CA3AF';
            Chart.defaults.borderColor = '#374151';

            // Category Chart (Bar)
            const ctxCategory = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctxCategory, {
                type: 'bar',
                data: {
                    labels: chartData.category.labels,
                    datasets: [{
                        label: '{{ __("Number of Items") }}',
                        data: chartData.category.data,
                        backgroundColor: chartData.category.colors,
                        borderRadius: 6,
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255, 255, 255, 0.05)' }
                        },
                        x: {
                            grid: { display: false }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });

            // Status Chart (Pie)
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: chartData.status.labels,
                    datasets: [{
                        data: chartData.status.data,
                        backgroundColor: chartData.status.colors,
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        }
                    }
                }
            });
        });
    </script>
</div>
