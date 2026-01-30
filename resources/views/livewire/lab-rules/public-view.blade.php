<div class="min-h-screen bg-slate-950 text-slate-200">
    <!-- Background Effects -->
    <div class="fixed inset-0 z-[-1]">
        <div class="absolute top-0 -left-4 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-purple-600/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/2 left-1/2 w-96 h-96 bg-cyan-600/20 rounded-full blur-3xl"></div>
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
    <main style="padding-top: 120px; padding-bottom: 64px;">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($rule)
                <!-- Hero Header -->
                <div class="text-center mb-16">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 mb-6">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="text-sm font-semibold text-indigo-300">Peraturan Resmi</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                        {{ $rule->title }}
                    </h1>
                    <p class="text-lg text-slate-400 max-w-2xl mx-auto">
                        Panduan dan ketentuan yang wajib dipatuhi oleh seluruh pengguna laboratorium
                    </p>
                    <div class="mt-6 flex items-center justify-center gap-4 text-sm text-slate-500">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Fakultas Teknik UNMUL
                        </span>
                        <span class="w-1 h-1 rounded-full bg-slate-600"></span>
                        <span>Diperbarui {{ $rule->updated_at->format('d M Y') }}</span>
                    </div>
                </div>

                <!-- Rules Content -->
                <div class="grid gap-8">
                    <!-- Section A: Ketentuan Umum -->
                    <div class="group relative bg-gradient-to-br from-slate-900/80 to-slate-800/50 backdrop-blur-xl rounded-3xl border border-white/10 overflow-hidden hover:border-indigo-500/30 transition-all duration-300">
                        <!-- Section Header -->
                        <div class="bg-gradient-to-r from-indigo-600/20 to-purple-600/20 px-8 py-6 border-b border-white/5">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/25">
                                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-widest text-indigo-400">Bagian A</span>
                                    <h2 class="text-2xl font-bold text-white">Ketentuan Umum</h2>
                                </div>
                            </div>
                        </div>
                        <!-- Section Content -->
                        <div class="p-8">
                            <div class="space-y-4">
                                <div class="flex gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-500/20 text-indigo-400 font-bold text-sm">1</div>
                                    <p class="text-slate-300 leading-relaxed">Setiap pengguna laboratorium wajib mematuhi peraturan yang berlaku.</p>
                                </div>
                                <div class="flex gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-500/20 text-indigo-400 font-bold text-sm">2</div>
                                    <p class="text-slate-300 leading-relaxed">Pengguna wajib mengisi buku kunjungan/absensi sebelum menggunakan laboratorium.</p>
                                </div>
                                <div class="flex gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-500/20 text-indigo-400 font-bold text-sm">3</div>
                                    <p class="text-slate-300 leading-relaxed">Dilarang membawa makanan dan minuman ke dalam laboratorium.</p>
                                </div>
                                <div class="flex gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-500/20 text-indigo-400 font-bold text-sm">4</div>
                                    <p class="text-slate-300 leading-relaxed">Dilarang merokok di dalam dan sekitar area laboratorium.</p>
                                </div>
                                <div class="flex gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-500/20 text-indigo-400 font-bold text-sm">5</div>
                                    <p class="text-slate-300 leading-relaxed">Menjaga kebersihan dan kerapian laboratorium.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section B: Ketentuan Khusus -->
                    <div class="group relative bg-gradient-to-br from-slate-900/80 to-slate-800/50 backdrop-blur-xl rounded-3xl border border-white/10 overflow-hidden hover:border-amber-500/30 transition-all duration-300">
                        <!-- Section Header -->
                        <div class="bg-gradient-to-r from-amber-600/20 to-orange-600/20 px-8 py-6 border-b border-white/5">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 shadow-lg shadow-amber-500/25">
                                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Bagian B</span>
                                    <h2 class="text-2xl font-bold text-white">Ketentuan Khusus</h2>
                                </div>
                            </div>
                        </div>
                        <!-- Section Content -->
                        <div class="p-8">
                            <div class="space-y-4">
                                <div class="flex gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-amber-500/20 text-amber-400 font-bold text-sm">1</div>
                                    <p class="text-slate-300 leading-relaxed">Pengguna wajib menggunakan peralatan sesuai prosedur yang telah ditetapkan.</p>
                                </div>
                                <div class="flex gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-amber-500/20 text-amber-400 font-bold text-sm">2</div>
                                    <p class="text-slate-300 leading-relaxed">Segala kerusakan yang disebabkan oleh kelalaian pengguna menjadi tanggung jawab pengguna.</p>
                                </div>
                                <div class="flex gap-4 p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-colors">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-amber-500/20 text-amber-400 font-bold text-sm">3</div>
                                    <p class="text-slate-300 leading-relaxed">Peralatan yang dipinjam harus dikembalikan dalam kondisi baik.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section C: Sanksi -->
                    <div class="group relative bg-gradient-to-br from-slate-900/80 to-slate-800/50 backdrop-blur-xl rounded-3xl border border-white/10 overflow-hidden hover:border-rose-500/30 transition-all duration-300">
                        <!-- Section Header -->
                        <div class="bg-gradient-to-r from-rose-600/20 to-pink-600/20 px-8 py-6 border-b border-white/5">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-br from-rose-500 to-pink-600 shadow-lg shadow-rose-500/25">
                                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-widest text-rose-400">Bagian C</span>
                                    <h2 class="text-2xl font-bold text-white">Sanksi Pelanggaran</h2>
                                </div>
                            </div>
                        </div>
                        <!-- Section Content -->
                        <div class="p-8">
                            <div class="space-y-4">
                                <div class="flex gap-4 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-rose-500/20 text-rose-400 font-bold text-sm">!</div>
                                    <p class="text-slate-300 leading-relaxed">Pelanggaran ringan akan diberikan peringatan lisan.</p>
                                </div>
                                <div class="flex gap-4 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-rose-500/20 text-rose-400 font-bold text-sm">!!</div>
                                    <p class="text-slate-300 leading-relaxed">Pelanggaran berulang akan diberikan peringatan tertulis.</p>
                                </div>
                                <div class="flex gap-4 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20">
                                    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg bg-rose-500/20 text-rose-400 font-bold text-sm">!!!</div>
                                    <p class="text-slate-300 leading-relaxed">Pelanggaran berat dapat dikenakan sanksi pencabutan hak akses laboratorium.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Note -->
                <div class="mt-12 text-center">
                    <div class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-emerald-300 font-medium">Dengan menggunakan laboratorium, Anda dianggap telah menyetujui seluruh ketentuan di atas.</p>
                    </div>
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-24">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-3xl bg-slate-800/50 flex items-center justify-center">
                        <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Tata Tertib Belum Tersedia</h2>
                    <p class="text-slate-400">Silakan hubungi administrator untuk informasi lebih lanjut.</p>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 text-center space-y-3">
            <p class="text-sm text-slate-600">&copy; {{ date('Y') }} LabTeknik - Fakultas Teknik Universitas Mulawarman</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-4 text-xs text-slate-500">
                <p>Dikembangkan oleh <span class="text-indigo-400 font-medium">Anton & Jack</span> — Informatika UNMUL</p>
                <span class="hidden sm:inline text-slate-700">|</span>
                <div class="flex items-center gap-3">
                    <a href="mailto:anton.prafanto@unmul.ac.id" class="flex items-center gap-1.5 text-indigo-400 hover:text-indigo-300 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Email
                    </a>
                    <a href="https://wa.me/62811553393" target="_blank" class="flex items-center gap-1.5 text-emerald-400 hover:text-emerald-300 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>
