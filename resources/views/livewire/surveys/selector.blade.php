<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="text-center mb-12">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 mb-6 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
            
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl mb-6 shadow-lg shadow-indigo-500/30">
                <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            </div>
            
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Survey Kepuasan Laboratorium
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Pilih laboratorium yang ingin Anda beri feedback. Masukan Anda sangat berharga untuk meningkatkan layanan kami.
            </p>
        </div>

        {{-- Loading State --}}
        @if($isLoading)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for($i = 0; $i < 6; $i++)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-200 dark:border-gray-700 animate-pulse">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-gray-200 dark:bg-gray-700 rounded-xl"></div>
                            <div class="flex-1">
                                <div class="h-5 bg-gray-200 dark:bg-gray-700 rounded w-3/4 mb-3"></div>
                                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-full mb-2"></div>
                                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-2/3"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        @else
            {{-- Laboratories Grid --}}
            @if($laboratories->isNotEmpty())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($laboratories as $lab)
                        <button 
                            wire:click="selectLaboratory({{ $lab->id }})"
                            class="group bg-white dark:bg-gray-800 rounded-2xl p-6 border-2 border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 text-left"
                        >
                            <div class="flex items-start gap-4">
                                {{-- Icon --}}
                                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform shadow-lg shadow-indigo-500/30">
                                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                </div>
                                
                                {{-- Content --}}
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                        {{ $lab->name }}
                                    </h3>
                                    
                                    @if($lab->description)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2 mb-3">
                                            {{ $lab->description }}
                                        </p>
                                    @endif
                                    
                                    {{-- Call to Action --}}
                                    <div class="flex items-center gap-2 text-indigo-600 dark:text-indigo-400 font-medium text-sm">
                                        <span>Isi Survey</span>
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>

                {{-- Info Box --}}
                <div class="mt-12 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800 rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-indigo-900 dark:text-indigo-200 mb-2">Mengapa feedback Anda penting?</h4>
                            <p class="text-sm text-indigo-700 dark:text-indigo-300">
                                Feedback Anda membantu kami memahami apa yang sudah baik dan apa yang perlu ditingkatkan. Semua masukan akan digunakan untuk meningkatkan kualitas layanan laboratorium.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                        Tidak Ada Laboratorium
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Saat ini belum ada laboratorium yang tersedia untuk survey.
                    </p>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            @endif
        @endif
    </div>
</div>
