<div class="min-h-screen bg-slate-950 text-slate-200">
    <!-- Background Effects -->
    <div class="fixed inset-0 z-[-1]">
        <div class="absolute top-0 -left-4 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-purple-600/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-teal-600/20 rounded-full blur-3xl"></div>
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
                    <a href="{{ route('lab-rules.public') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Tata Tertib</a>
                    <a href="{{ route('kegiatan-lab.gallery') }}" class="text-sm font-medium text-white transition-colors">Galeri</a>
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
                <button onclick="document.getElementById('mobileMenuGaleri').classList.toggle('hidden')" class="md:hidden p-2 text-slate-300 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenuGaleri" class="hidden md:hidden bg-slate-950/95 backdrop-blur-lg border-t border-white/5">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ url('/') }}#fitur" class="block text-slate-300 hover:text-white font-medium">Fitur</a>
                <a href="{{ route('schedules.public') }}" class="block text-slate-300 hover:text-white font-medium">Jadwal Praktikum</a>
                <a href="{{ route('lab-rules.public') }}" class="block text-slate-300 hover:text-white font-medium">Tata Tertib</a>
                <a href="{{ route('kegiatan-lab.gallery') }}" class="block text-white font-medium">Galeri Kegiatan</a>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-white mb-4">Galeri Kegiatan Laboratorium</h1>
                <p class="text-slate-400 max-w-2xl mx-auto">Dokumentasi berbagai kegiatan yang berlangsung di laboratorium Fakultas Teknik</p>
            </div>

            <!-- Filters -->
            <div class="mb-10 flex flex-wrap justify-center gap-4">
                <select wire:model.live="categoryFilter" class="px-4 py-2 bg-slate-900/50 border border-white/10 rounded-xl text-white text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <select wire:model.live="laboratoryFilter" class="px-4 py-2 bg-slate-900/50 border border-white/10 rounded-xl text-white text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">Semua Laboratorium</option>
                    @foreach($laboratories as $lab)
                        <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Gallery Grid -->
            @if($activities->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($activities as $activity)
                        <div wire:click="viewActivity({{ $activity->id }})" class="group cursor-pointer bg-slate-900/50 backdrop-blur-xl rounded-2xl border border-white/10 overflow-hidden hover:border-indigo-500/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-indigo-500/10">
                            <!-- Image -->
                            <div class="aspect-[4/3] relative overflow-hidden">
                                @if($activity->photo_path)
                                    <img src="{{ Storage::url($activity->photo_path) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-60"></div>
                                @else
                                    <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <!-- Category Badge -->
                                @if($activity->category)
                                    <div class="absolute top-3 left-3">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full text-white shadow-lg" style="background-color: {{ $activity->category->color }}">
                                            {{ $activity->category->name }}
                                        </span>
                                    </div>
                                @endif
                                <!-- View Icon -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <!-- Content -->
                            <div class="p-4">
                                <h3 class="font-semibold text-white line-clamp-1">{{ $activity->title }}</h3>
                                @if($activity->laboratory)
                                    <p class="text-sm text-slate-400 mt-1">{{ $activity->laboratory->name }}</p>
                                @endif
                                <p class="text-xs text-slate-500 mt-1">{{ $activity->activity_date->format('d F Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $activities->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-24">
                    <svg class="mx-auto h-16 w-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h2 class="mt-6 text-2xl font-bold text-white">Belum Ada Kegiatan</h2>
                    <p class="mt-2 text-slate-400">Dokumentasi kegiatan laboratorium akan ditampilkan di sini.</p>
                </div>
            @endif
        </div>
    </main>

    <!-- Image Modal / Lightbox -->
    @if($showModal && $selectedActivity)
        <div class="fixed inset-0 z-50 overflow-hidden">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-slate-950/95 backdrop-blur-sm" wire:click="closeModal"></div>
            
            <!-- Modal Content -->
            <div class="absolute inset-0 flex items-center justify-center p-4">
                <div class="relative max-w-4xl w-full bg-slate-900 rounded-2xl border border-white/10 overflow-hidden shadow-2xl">
                    <!-- Close Button -->
                    <button wire:click="closeModal" class="absolute top-4 right-4 z-10 w-10 h-10 bg-slate-800/80 backdrop-blur-md hover:bg-slate-700 text-white rounded-full flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    
                    <!-- Image -->
                    @if($selectedActivity->photo_path)
                        <img src="{{ Storage::url($selectedActivity->photo_path) }}" alt="{{ $selectedActivity->title }}" class="w-full max-h-[60vh] object-contain bg-slate-950">
                    @endif
                    
                    <!-- Info -->
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-xl font-bold text-white">{{ $selectedActivity->title }}</h2>
                                @if($selectedActivity->laboratory)
                                    <p class="text-slate-400 mt-1">{{ $selectedActivity->laboratory->name }}</p>
                                @endif
                            </div>
                            @if($selectedActivity->category)
                                <span class="px-3 py-1 text-sm font-medium rounded-full text-white shrink-0" style="background-color: {{ $selectedActivity->category->color }}">
                                    {{ $selectedActivity->category->name }}
                                </span>
                            @endif
                        </div>
                        @if($selectedActivity->description)
                            <p class="text-slate-300 mt-4">{{ $selectedActivity->description }}</p>
                        @endif
                        <p class="text-sm text-slate-500 mt-4">{{ $selectedActivity->activity_date->format('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
