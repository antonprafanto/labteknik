<div>
    <!-- Background Effects -->
    <div class="fixed inset-0 z-[-1] bg-slate-950">
        <div class="absolute top-0 -left-4 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-purple-600/30 rounded-full blur-3xl"></div>
    </div>

    <!-- Navbar -->
    <nav class="bg-slate-950/80 backdrop-blur-lg border-b border-white/5 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg shadow-indigo-500/25">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">LabTeknik</span>
                </a>
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="text-sm text-slate-400 hover:text-white transition-colors">Beranda</a>
                    <a href="{{ route('kegiatan-lab.gallery') }}" class="text-sm text-slate-400 hover:text-white transition-colors">Galeri Kegiatan</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 rounded-full transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 rounded-full transition-all">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-16 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($rule)
                <!-- Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-white mb-4">{{ $rule->title }}</h1>
                    <p class="text-slate-400">Fakultas Teknik - Universitas Mulawarman</p>
                </div>

                <!-- Content Card -->
                <div class="bg-slate-900/50 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden">
                    <div class="p-8 md:p-12">
                        <div class="prose prose-lg prose-invert max-w-none 
                            prose-headings:text-white prose-headings:font-bold
                            prose-h2:text-2xl prose-h2:mt-8 prose-h2:mb-4 prose-h2:border-b prose-h2:border-slate-700 prose-h2:pb-2
                            prose-h3:text-xl prose-h3:mt-6 prose-h3:mb-3 prose-h3:text-indigo-400
                            prose-p:text-slate-300 prose-p:leading-relaxed
                            prose-ol:text-slate-300 prose-ul:text-slate-300
                            prose-li:my-2">
                            {!! $rule->content !!}
                        </div>
                    </div>
                    <div class="px-8 pb-8 md:px-12 md:pb-12">
                        <p class="text-sm text-slate-500">
                            Terakhir diperbarui: {{ $rule->updated_at->format('d F Y') }}
                        </p>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-24">
                    <svg class="mx-auto h-16 w-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h2 class="mt-6 text-2xl font-bold text-white">Tata Tertib Belum Tersedia</h2>
                    <p class="mt-2 text-slate-400">Silakan hubungi administrator untuk informasi lebih lanjut.</p>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-slate-600">
            &copy; {{ date('Y') }} LabTeknik - Fakultas Teknik Universitas Mulawarman
        </div>
    </footer>
</div>
