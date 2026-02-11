<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-yellow-500 to-orange-600 rounded-2xl shadow-2xl mb-4">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Survey Kepuasan Lab</h1>
            <p class="text-gray-300">Berikan penilaian Anda untuk {{ $laboratory->name }}</p>
        </div>

        @if($showSuccess)
            <!-- Success State -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 text-center">
                <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Terima Kasih!</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Masukan Anda sangat berharga untuk peningkatan kualitas laboratorium.</p>
                
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    
                    <a href="{{ route('surveys.selector') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-semibold rounded-xl transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Isi Survey Lab Lain
                    </a>
                </div>
            </div>
        @else
            <!-- Survey Form -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <div class="h-1 bg-gradient-to-r from-yellow-500 to-orange-600"></div>
                
                <form wire:submit.prevent="submit" class="p-8 space-y-8">
                    <!-- Anonymous Toggle -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                        <div>
                            <h3 class="font-medium text-gray-900 dark:text-white">Isi sebagai Anonim</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Identitas Anda tidak akan dicatat</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="is_anonymous" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>

                    <!-- Rating Sections -->
                    <div class="space-y-6">
                        @php
                            $ratingFields = [
                                'rating_cleanliness' => ['label' => 'Kebersihan', 'icon' => '🧹', 'desc' => 'Seberapa bersih laboratorium?'],
                                'rating_service' => ['label' => 'Pelayanan', 'icon' => '👋', 'desc' => 'Bagaimana pelayanan petugas?'],
                                'rating_facilities' => ['label' => 'Fasilitas', 'icon' => '🔧', 'desc' => 'Kelengkapan fasilitas lab?'],
                                'rating_equipment' => ['label' => 'Peralatan', 'icon' => '⚙️', 'desc' => 'Kondisi peralatan lab?'],
                                'rating_comfort' => ['label' => 'Kenyamanan', 'icon' => '🛋️', 'desc' => 'Seberapa nyaman ruangan?'],
                                'rating_safety' => ['label' => 'Keamanan', 'icon' => '🔒', 'desc' => 'Tingkat keamanan lab?'],
                                'rating_overall' => ['label' => 'Keseluruhan', 'icon' => '⭐', 'desc' => 'Rating keseluruhan?'],
                            ];
                        @endphp

                        @foreach($ratingFields as $field => $info)
                            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <div class="flex items-center mb-3">
                                    <span class="text-2xl mr-2">{{ $info['icon'] }}</span>
                                    <div>
                                        <h3 class="font-bold text-gray-900 dark:text-white">{{ $info['label'] }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $info['desc'] }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button" wire:click="setRating('{{ $field }}', {{ $i }})" 
                                            class="w-12 h-12 rounded-xl transition-all duration-200 flex items-center justify-center text-2xl
                                                @if($this->$field >= $i) bg-yellow-400 text-yellow-900 scale-110 @else bg-gray-200 dark:bg-gray-600 text-gray-400 hover:bg-yellow-100 @endif">
                                            @if($this->$field >= $i)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        </button>
                                    @endfor
                                </div>
                                @error($field) <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        @endforeach
                    </div>

                    <!-- Suggestions -->
                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                            💬 Kritik & Saran (Opsional)
                        </label>
                        <textarea wire:model="suggestions" rows="4" 
                            class="w-full px-4 py-3 bg-white dark:bg-gray-900 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500" 
                            placeholder="Tuliskan kritik dan saran Anda untuk peningkatan kualitas laboratorium..."></textarea>
                        @error('suggestions') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center">
                        <svg wire:loading.remove wire:target="submit" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <svg wire:loading wire:target="submit" class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        <span wire:loading.remove wire:target="submit">Kirim Survey</span>
                        <span wire:loading wire:target="submit">Mengirim...</span>
                    </button>
                </form>
            </div>
        @endif

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-gray-400 text-sm">Lab Teknik Unmul © {{ date('Y') }}</p>
        </div>
    </div>
</div>
