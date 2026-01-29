<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard Survey</h1>
                <p class="text-gray-600 dark:text-gray-400">Analisis kepuasan pengguna laboratorium</p>
            </div>
            <a href="{{ route('surveys.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-xl transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                Lihat Semua Survey
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Laboratorium</label>
                    <select wire:model.live="laboratoryFilter" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white text-sm">
                        <option value="">Semua Lab</option>
                        @foreach($laboratories as $lab)
                            <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Dari Tanggal</label>
                    <input wire:model.live="dateFrom" type="date" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Sampai Tanggal</label>
                    <input wire:model.live="dateTo" type="date" class="w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white text-sm">
                </div>
            </div>
        </div>

        <!-- Overall Rating -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl p-8 text-white mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-200 text-sm font-medium">Rating Keseluruhan</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-6xl font-bold">{{ $overallStats['avg_overall'] }}</span>
                        <span class="text-2xl">/5</span>
                    </div>
                    <p class="text-indigo-200 mt-2">Dari {{ number_format($overallStats['total_surveys']) }} survey</p>
                </div>
                <div class="text-8xl opacity-20">⭐</div>
            </div>
        </div>

        <!-- Category Ratings -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
            @php
                $categories = [
                    ['key' => 'avg_cleanliness', 'label' => 'Kebersihan', 'icon' => '🧹', 'color' => 'blue'],
                    ['key' => 'avg_service', 'label' => 'Pelayanan', 'icon' => '👋', 'color' => 'purple'],
                    ['key' => 'avg_facilities', 'label' => 'Fasilitas', 'icon' => '🔧', 'color' => 'teal'],
                    ['key' => 'avg_equipment', 'label' => 'Peralatan', 'icon' => '⚙️', 'color' => 'indigo'],
                    ['key' => 'avg_comfort', 'label' => 'Kenyamanan', 'icon' => '🛋️', 'color' => 'green'],
                    ['key' => 'avg_safety', 'label' => 'Keamanan', 'icon' => '🔒', 'color' => 'orange'],
                ];
            @endphp

            @foreach($categories as $cat)
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-2xl">{{ $cat['icon'] }}</span>
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">{{ $cat['label'] }}</span>
                    </div>
                    <p class="text-3xl font-bold text-{{ $cat['color'] }}-600 dark:text-{{ $cat['color'] }}-400">{{ $overallStats[$cat['key']] }}</p>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Rating Distribution -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="font-bold text-gray-900 dark:text-white mb-4">Distribusi Rating</h3>
                <div class="space-y-3">
                    @php $total = array_sum($ratingDistribution) ?: 1; @endphp
                    @for($i = 5; $i >= 1; $i--)
                        @php $count = $ratingDistribution[$i] ?? 0; $percent = ($count / $total) * 100; @endphp
                        <div class="flex items-center gap-3">
                            <span class="w-8 text-sm font-medium text-gray-900 dark:text-white">{{ $i }}⭐</span>
                            <div class="flex-1 h-4 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-yellow-500 rounded-full" style="width: {{ $percent }}%"></div>
                            </div>
                            <span class="w-16 text-sm text-gray-600 dark:text-gray-400 text-right">{{ $count }} ({{ round($percent) }}%)</span>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Lab Rankings -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="font-bold text-gray-900 dark:text-white mb-4">Ranking Laboratorium</h3>
                <div class="space-y-3">
                    @forelse($labRatings as $index => $lab)
                        @if($lab->total_surveys > 0)
                            <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                                <span class="w-8 h-8 flex items-center justify-center rounded-full 
                                    @if($index === 0) bg-yellow-500 text-white
                                    @elseif($index === 1) bg-gray-400 text-white
                                    @elseif($index === 2) bg-orange-600 text-white
                                    @else bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-400
                                    @endif font-bold text-sm">
                                    {{ $index + 1 }}
                                </span>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $lab->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $lab->total_surveys }} survey</p>
                                </div>
                                <span class="text-xl font-bold @if($lab->avg_rating >= 4) text-green-600 @elseif($lab->avg_rating >= 3) text-yellow-600 @else text-red-600 @endif">
                                    {{ $lab->avg_rating ?? '-' }}
                                </span>
                            </div>
                        @endif
                    @empty
                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">Belum ada data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Suggestions -->
        <div class="mt-8 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="font-bold text-gray-900 dark:text-white mb-4">💬 Kritik & Saran Terbaru</h3>
            <div class="space-y-4">
                @forelse($recentSuggestions as $survey)
                    <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 border-l-4 
                        @if($survey->rating_overall >= 4) border-green-500 @elseif($survey->rating_overall >= 3) border-yellow-500 @else border-red-500 @endif">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-medium text-gray-900 dark:text-white">{{ $survey->laboratory->name }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $survey->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">{{ $survey->suggestions }}</p>
                        <div class="mt-2 text-sm">
                            <span class="text-yellow-500">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < $survey->rating_overall)★@else☆@endif
                                @endfor
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">Belum ada saran</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
