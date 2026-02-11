<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="text-center mb-16 relative">
            <div class="absolute top-0 left-0">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white/50 backdrop-blur-sm border border-gray-200 text-sm font-medium text-gray-600 hover:text-indigo-600 hover:bg-white transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
            
            <div class="inline-flex items-center justify-center p-3 bg-white rounded-2xl shadow-lg shadow-indigo-100 mb-6 relative z-10">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                </div>
            </div>
            
            <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white mb-4 tracking-tight">
                Survey Kepuasan Lab
            </h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                Pilih laboratorium untuk memberikan penilaian Anda. Feedback Anda anonim dan sangat berharga bagi kami.
            </p>
        </div>

        {{-- Loading State --}}
        @if($isLoading)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for($i = 0; $i < 6; $i++)
                    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm animate-pulse">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-slate-200 rounded-xl"></div>
                            <div class="flex-1">
                                <div class="h-5 bg-slate-200 rounded w-3/4 mb-3"></div>
                                <div class="h-4 bg-slate-100 rounded w-full mb-2"></div>
                                <div class="h-4 bg-slate-100 rounded w-2/3"></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        @else
            {{-- Laboratories Grid --}}
            @if($laboratories->isNotEmpty())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach($laboratories as $lab)
                        <button 
                            wire:click="selectLaboratory({{ $lab->id }})"
                            class="group relative bg-white dark:bg-slate-800 rounded-2xl p-1 text-left transition-all duration-300 hover:-translate-y-1 hover:shadow-xl shadow-sm border border-slate-200 dark:border-slate-700/50"
                        >
                            {{-- Card Hover Gradient Border --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="margin: -1px;"></div>
                            
                            <div class="relative bg-white dark:bg-slate-800 rounded-xl p-6 h-full flex flex-col">
                                <div class="flex items-start gap-4">
                                    {{-- Icon --}}
                                    <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                        </svg>
                                    </div>
                                    
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors line-clamp-1">
                                            {{ $lab->name }}
                                        </h3>
                                        <p class="text-sm text-slate-500 dark:text-slate-400 line-clamp-2 mb-4">
                                            {{ $lab->description ?? 'Laboratorium Teknik Universitas Mulawarman' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-auto pt-4 flex items-center justify-between border-t border-slate-100 dark:border-slate-700/50">
                                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Mulai Survey</span>
                                    <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>

                {{-- Info Box - Redesigned for better contrast --}}
                <div class="bg-gradient-to-r from-slate-900 to-indigo-900 rounded-2xl p-8 text-white shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-10">
                        <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row gap-6 items-center md:items-start text-center md:text-left">
                        <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center shrink-0 backdrop-blur-sm border border-white/10">
                            <svg class="w-8 h-8 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-2xl font-bold mb-2">Mengapa feedback Anda penting?</h4>
                            <p class="text-indigo-100 leading-relaxed max-w-2xl">
                                Feedback Anda membantu kami memahami apa yang sudah baik dan apa yang perlu ditingkatkan. Semua masukan akan digunakan secara rahasia untuk meningkatkan kualitas layanan laboratorium.
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
