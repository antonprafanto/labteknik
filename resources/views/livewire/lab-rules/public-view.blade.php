<div class="min-h-screen bg-slate-950 text-slate-200">
    <!-- Background Effects -->
    <div class="fixed inset-0 z-[-1]">
        <div class="absolute top-0 -left-4 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-purple-600/30 rounded-full blur-3xl"></div>
    </div>

    <!-- Navbar (Same as Landing Page) -->
    <nav class="fixed w-full z-50 bg-slate-950/80 backdrop-blur-lg border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="relative w-10 h-10 flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-indigo-500/25">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold text-white tracking-tight leading-none group-hover:text-indigo-300 transition-colors">LabTeknik</span>
                        <span class="text-[10px] uppercase tracking-wider text-slate-400 font-semibold">FT Unmul</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ url('/') }}#fitur" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Fitur</a>
                    <a href="{{ route('schedules.public') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Jadwal</a>
                    <a href="{{ route('lab-rules.public') }}" class="text-sm font-medium text-white transition-colors">Tata Tertib</a>
                    <a href="{{ route('kegiatan-lab.gallery') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Galeri</a>
                    <div class="w-px h-6 bg-slate-700 mx-2"></div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 rounded-full transition-all shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:-translate-y-0.5">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-white hover:text-indigo-300 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-900 bg-white hover:bg-slate-50 rounded-full transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button onclick="document.getElementById('mobileMenuTatatertib').classList.toggle('hidden')" class="md:hidden p-2 text-slate-300 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenuTatatertib" class="hidden md:hidden bg-slate-950/95 backdrop-blur-lg border-t border-white/5">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ url('/') }}#fitur" class="block text-slate-300 hover:text-white font-medium">Fitur</a>
                <a href="{{ route('schedules.public') }}" class="block text-slate-300 hover:text-white font-medium">Jadwal Praktikum</a>
                <a href="{{ route('lab-rules.public') }}" class="block text-white font-medium">Tata Tertib</a>
                <a href="{{ route('kegiatan-lab.gallery') }}" class="block text-slate-300 hover:text-white font-medium">Galeri Kegiatan</a>
                <div class="border-t border-white/10 pt-4 mt-4 grid grid-cols-2 gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="col-span-2 text-center py-2.5 bg-indigo-600 text-white rounded-lg font-semibold">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-center py-2.5 text-slate-300 hover:text-white font-semibold">Masuk</a>
                        <a href="{{ route('register') }}" class="text-center py-2.5 bg-white text-slate-900 rounded-lg font-semibold">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="pt-36 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($rule)
                <!-- Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-white mb-4 drop-shadow-lg">{{ $rule->title }}</h1>
                    <p class="text-slate-300 font-medium tracking-wide">Fakultas Teknik - Universitas Mulawarman</p>
                </div>

                <!-- Content Card -->
                <div class="bg-slate-900/80 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden shadow-2xl ring-1 ring-white/5">
                    <div class="p-8 md:p-12">
                        <div class="tata-tertib-content text-slate-200 text-lg leading-relaxed
                            [&_h1]:text-3xl [&_h1]:font-bold [&_h1]:text-white!important [&_h1]:mb-6
                            [&_h2]:text-2xl [&_h2]:font-bold [&_h2]:text-white!important [&_h2]:mt-8 [&_h2]:mb-4 [&_h2]:border-b [&_h2]:border-slate-600 [&_h2]:pb-3
                            [&_h3]:text-xl [&_h3]:font-semibold [&_h3]:text-indigo-300!important [&_h3]:mt-6 [&_h3]:mb-3
                            [&_p]:text-slate-200!important [&_p]:my-4 [&_p]:leading-relaxed
                            [&_ol]:text-slate-200!important [&_ol]:pl-6 [&_ol]:my-4 [&_ol]:list-decimal
                            [&_ul]:text-slate-200!important [&_ul]:pl-6 [&_ul]:my-4 [&_ul]:list-disc
                            [&_li]:my-2 [&_li]:text-slate-200!important
                            [&_strong]:text-white!important [&_strong]:font-semibold
                            [&_a]:text-indigo-400 [&_a]:underline">
                            {!! $rule->content !!}
                        </div>
                    </div>
                    <div class="px-8 pb-8 md:px-12 md:pb-12 border-t border-white/5 pt-6">
                        <p class="text-sm text-slate-400">
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
