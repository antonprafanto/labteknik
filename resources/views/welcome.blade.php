<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LabTeknik') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-display { font-family: 'Outfit', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }
        .dark .glass {
            background: rgba(15, 23, 42, 0.7);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .blob {
            position: absolute;
            filter: blur(80px);
            z-index: 0;
            opacity: 0.6;
            animation: float 10s infinite alternate;
        }
        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(20px, -20px) scale(1.1); }
        }
    </style>
</head>
<body class="antialiased font-sans text-slate-800 bg-slate-50 dark:bg-slate-900 dark:text-slate-200 overflow-x-hidden">

    <!-- Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="blob bg-indigo-500/30 w-96 h-96 rounded-full top-0 left-0 mix-blend-multiply dark:mix-blend-screen dark:bg-indigo-900/40"></div>
        <div class="blob bg-purple-500/30 w-96 h-96 rounded-full bottom-0 right-0 animation-delay-2000 mix-blend-multiply dark:mix-blend-screen dark:bg-purple-900/40"></div>
        <div class="blob bg-pink-500/30 w-80 h-80 rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 animation-delay-4000 mix-blend-multiply dark:mix-blend-screen dark:bg-pink-900/40"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3 relative z-10">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                        <div class="relative w-10 h-10 flex items-center justify-center bg-gradient-to-br from-indigo-600 to-violet-600 rounded-xl shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <span class="font-display font-bold text-xl tracking-tight text-slate-900 dark:text-white">Lab<span class="text-indigo-600 dark:text-indigo-400">Teknik</span></span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8 relative z-10">
                    <a href="#features" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">{{ __('Features') }}</a>
                    <a href="#about" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">{{ __('About') }}</a>
                    <a href="#contact" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">{{ __('Contact') }}</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4 relative z-10">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition">{{ __('Dashboard') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-full bg-slate-900 dark:bg-indigo-600 text-white text-sm font-semibold shadow-lg shadow-indigo-500/20 hover:bg-slate-800 dark:hover:bg-indigo-500 hover:shadow-indigo-500/40 transition-all duration-300 transform hover:-translate-y-0.5">{{ __('Register') }}</a>
                            @endif
                        @endauth
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden relative z-10">
                    <button class="text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white focus:outline-none p-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                <div class="text-center lg:text-left lg:col-span-6">
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full border border-indigo-100 dark:border-indigo-900/50 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm text-indigo-600 dark:text-indigo-400 text-sm font-medium mb-8 shadow-sm">
                        <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse mr-2"></span>
                        {{ __('Version 2.0 Now Available') }}
                    </div>
                    
                    <h1 class="text-4xl tracking-tight font-display font-extrabold text-slate-900 dark:text-white sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl leading-tight">
                        <span class="block">{{ __('Smart Laboratory') }}</span>
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 dark:from-indigo-400 dark:via-purple-400 dark:to-pink-400">
                            {{ __('Management System') }}
                        </span>
                    </h1>
                    
                    <p class="mt-6 text-lg text-slate-600 dark:text-slate-300 sm:text-lg sm:max-w-xl sm:mx-auto lg:mx-0 leading-relaxed">
                        {{ __('Streamline your engineering laboratory operations with our comprehensive platform. Manage inventory, scheduling, and equipment lending in one unified workspace.') }}
                    </p>
                    
                    <div class="mt-10 sm:flex sm:justify-center lg:justify-start gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto flex items-center justify-center px-8 py-4 border border-transparent text-base font-semibold rounded-2xl text-white bg-slate-900 dark:bg-indigo-600 hover:bg-slate-800 dark:hover:bg-indigo-500 shadow-xl shadow-indigo-500/20 transition-all duration-300 transform hover:-translate-y-1">
                                {{ __('Go to Dashboard') }}
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="w-full sm:w-auto flex items-center justify-center px-8 py-4 border border-transparent text-base font-semibold rounded-2xl text-white bg-slate-900 dark:bg-indigo-600 hover:bg-slate-800 dark:hover:bg-indigo-500 shadow-xl shadow-indigo-500/20 transition-all duration-300 transform hover:-translate-y-1">
                                {{ __('Get Started') }}
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                            <a href="#features" class="w-full sm:w-auto flex items-center justify-center px-8 py-4 border border-slate-200 dark:border-slate-700 text-base font-semibold rounded-2xl text-slate-700 dark:text-slate-200 bg-white/50 dark:bg-slate-800/50 hover:bg-white dark:hover:bg-slate-800 backdrop-blur-sm shadow-sm transition-all duration-300 mt-4 sm:mt-0">
                                {{ __('Learn More') }}
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- 3D/Image Illustration -->
                <div class="mt-16 lg:mt-0 lg:col-span-6 perspective-1000">
                    <div class="relative transform rotate-y-12 hover:rotate-y-6 transition-transform duration-700 ease-out">
                        <div class="absolute -inset-4 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl blur-lg opacity-30 animate-pulse"></div>
                        <div class="relative rounded-2xl bg-white dark:bg-slate-800 shadow-2xl overflow-hidden border border-slate-200 dark:border-slate-700/50">
                            <!-- Abstract UI Mockup -->
                            <div class="h-10 bg-slate-50 dark:bg-slate-900 border-b border-slate-100 dark:border-slate-700 flex items-center px-4 space-x-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                            <div class="p-8 h-[400px] bg-white dark:bg-slate-800">
                                <div class="flex gap-6 mb-8">
                                    <div class="w-1/3 h-32 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl border border-indigo-100 dark:border-indigo-500/10 p-4">
                                        <div class="w-8 h-8 rounded-lg bg-indigo-100 dark:bg-indigo-500/20 mb-3 text-indigo-600 dark:text-indigo-400">
                                            <svg class="w-full h-full p-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                        </div>
                                        <div class="h-2 w-12 bg-indigo-200 dark:bg-indigo-500/30 rounded mb-2"></div>
                                        <div class="h-4 w-8 bg-indigo-200 dark:bg-indigo-500/30 rounded"></div>
                                    </div>
                                    <div class="w-1/3 h-32 bg-purple-50 dark:bg-purple-900/20 rounded-xl border border-purple-100 dark:border-purple-500/10 p-4">
                                         <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-500/20 mb-3 text-purple-600 dark:text-purple-400">
                                            <svg class="w-full h-full p-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div class="h-2 w-12 bg-purple-200 dark:bg-purple-500/30 rounded mb-2"></div>
                                        <div class="h-4 w-8 bg-purple-200 dark:bg-purple-500/30 rounded"></div>
                                    </div>
                                    <div class="w-1/3 h-32 bg-pink-50 dark:bg-pink-900/20 rounded-xl border border-pink-100 dark:border-pink-500/10 p-4">
                                        <div class="w-8 h-8 rounded-lg bg-pink-100 dark:bg-pink-500/20 mb-3 text-pink-600 dark:text-pink-400">
                                            <svg class="w-full h-full p-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        </div>
                                        <div class="h-2 w-12 bg-pink-200 dark:bg-pink-500/30 rounded mb-2"></div>
                                        <div class="h-4 w-8 bg-pink-200 dark:bg-pink-500/30 rounded"></div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div class="h-16 w-full bg-slate-50 dark:bg-slate-700/30 rounded-xl border border-slate-100 dark:border-slate-700 flex items-center px-4">
                                        <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-600 mr-4"></div>
                                        <div class="flex-1">
                                            <div class="h-3 w-32 bg-slate-200 dark:bg-slate-600 rounded mb-2"></div>
                                            <div class="h-2 w-24 bg-slate-100 dark:bg-slate-700 rounded"></div>
                                        </div>
                                    </div>
                                    <div class="h-16 w-full bg-slate-50 dark:bg-slate-700/30 rounded-xl border border-slate-100 dark:border-slate-700 flex items-center px-4">
                                        <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-600 mr-4"></div>
                                        <div class="flex-1">
                                            <div class="h-3 w-32 bg-slate-200 dark:bg-slate-600 rounded mb-2"></div>
                                            <div class="h-2 w-24 bg-slate-100 dark:bg-slate-700 rounded"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="relative bg-white/50 dark:bg-slate-800/50 backdrop-blur-md border-y border-slate-200 dark:border-slate-700">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-4 text-center">
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl font-display font-bold text-indigo-600 dark:text-indigo-400">500+</div>
                    <div class="mt-2 text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">{{ __('Equipment') }}</div>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl font-display font-bold text-purple-600 dark:text-purple-400">1.2k</div>
                    <div class="mt-2 text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">{{ __('Borrowings') }}</div>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl font-display font-bold text-pink-600 dark:text-pink-400">50+</div>
                    <div class="mt-2 text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">{{ __('Schedules') }}</div>
                </div>
                <div class="p-6 rounded-2xl bg-white dark:bg-slate-800 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl font-display font-bold text-emerald-600 dark:text-emerald-400">99%</div>
                    <div class="mt-2 text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">{{ __('Satisfaction') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="relative py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-sm font-bold text-indigo-600 dark:text-indigo-400 tracking-widest uppercase mb-3">{{ __('Why Choose Us') }}</h2>
                <p class="text-3xl font-display font-bold text-slate-900 dark:text-white sm:text-4xl">
                    {{ __('Engineered for Excellence') }}
                </p>
                <p class="mt-4 text-xl text-slate-500 dark:text-slate-400">
                    {{ __('Everything you need to manage your laboratory efficiently, all in one place.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="group relative bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-lg border border-slate-100 dark:border-slate-700/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-transparent dark:from-indigo-900/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <span class="inline-flex p-4 rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-500/30 mb-6">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </span>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                            {{ __('Smart Inventory') }}
                        </h3>
                        <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                            {{ __('Track every piece of equipment with precision. Real-time status updates, location tracking, and condition monitoring.') }}
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group relative bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-lg border border-slate-100 dark:border-slate-700/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-transparent dark:from-purple-900/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <span class="inline-flex p-4 rounded-2xl bg-purple-600 text-white shadow-lg shadow-purple-500/30 mb-6">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                            {{ __('Auto Scheduling') }}
                        </h3>
                        <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                            {{ __('Intelligent conflict detection for practicum schedules. Seamlessly syncs with the academic calendar.') }}
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group relative bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-lg border border-slate-100 dark:border-slate-700/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-pink-50 to-transparent dark:from-pink-900/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative">
                        <span class="inline-flex p-4 rounded-2xl bg-pink-600 text-white shadow-lg shadow-pink-500/30 mb-6">
                             <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </span>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                            {{ __('Digital Loans') }}
                        </h3>
                        <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                            {{ __('Completely paperless borrowing workflow. Digital approvals, automated reminders, and history tracking.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="relative py-24">
        <div class="absolute inset-0 bg-slate-900 dark:bg-black">
             <div class="absolute inset-0 bg-gradient-to-r from-indigo-900 to-purple-900 opacity-50"></div>
             <img src="https://images.unsplash.com/photo-1581093450021-4a7360e9a6b5?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80" alt="Lab background" class="w-full h-full object-cover opacity-10 mix-blend-overlay">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-3xl font-display font-bold text-white sm:text-4xl mb-6">
                {{ __('Ready to transform your laboratory?') }}
            </h2>
            <p class="text-xl text-indigo-100 max-w-2xl mx-auto mb-10">
                {{ __('Join hundreds of students and lecturers who are already enjoying a more organized laboratory experience.') }}
            </p>
             @auth
                 <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-2xl text-indigo-900 bg-white hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105">
                    {{ __('Access Dashboard') }}
                </a>
            @else
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-2xl text-indigo-900 bg-white hover:bg-indigo-50 transition-all duration-300 transform hover:scale-105">
                    {{ __('Register Now') }}
                </a>
            @endauth
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                     <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 flex items-center justify-center bg-indigo-600 rounded-xl shadow-lg shadow-indigo-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <span class="font-display font-bold text-xl text-slate-900 dark:text-white">Lab<span class="text-indigo-600 dark:text-indigo-400">Teknik</span></span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed max-w-sm">
                        {{ __('The most advanced laboratory information system for educational institutions. Designed for efficiency, reliability, and ease of use.') }}
                    </p>
                </div>
                
                <div>
                     <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4">{{ __('Quick Links') }}</h3>
                     <ul class="space-y-3">
                         <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">{{ __('Features') }}</a></li>
                         <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">{{ __('About Us') }}</a></li>
                         <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">{{ __('Help Center') }}</a></li>
                         <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">{{ __('Contact') }}</a></li>
                     </ul>
                </div>
                
                <div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4">{{ __('Contact') }}</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start text-slate-500 dark:text-slate-400">
                             <svg class="h-5 w-5 mr-3 text-indigo-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                             </svg>
                             lab.teknik@unmul.ac.id
                        </li>
                        <li class="flex items-start text-slate-500 dark:text-slate-400">
                             <svg class="h-5 w-5 mr-3 text-indigo-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                             </svg>
                             Samarinda, Kalimantan Timur
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-100 dark:border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-slate-400">&copy; {{ date('Y') }} Lab Teknik. {{ __('All rights reserved') }}</p>
                <p class="text-sm text-slate-400 flex items-center">
                    {{ __('Made with') }} <span class="text-rose-500 mx-1 animate-pulse">&hearts;</span> {{ __('by TI 2026') }}
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
