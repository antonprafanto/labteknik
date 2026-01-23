<div class="min-h-screen flex bg-white dark:bg-gray-900">
    <!-- Left Side: Form -->
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 w-full lg:w-1/2 bg-white dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div class="mb-10 text-center lg:text-left">
                <div class="flex justify-center lg:justify-start">
                    {{ $logo }}
                </div>
                <h2 class="mt-8 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Sistem Manajemen Lab
                </h2>
                <p class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Silakan masuk untuk melanjutkan
                </p>
            </div>

            {{ $slot }}
        </div>
    </div>

    <!-- Right Side: Decorative -->
    <div class="hidden lg:block relative w-0 flex-1 bg-slate-900">
        <div class="absolute inset-0 h-full w-full bg-slate-900 overflow-hidden">
             <!-- Abstract Patterns -->
             <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-indigo-500 blur-3xl opacity-20"></div>
             <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-600 blur-3xl opacity-20"></div>
             
             <!-- Mesh Grid (Optional CSS) -->
             <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
             
             <div class="absolute inset-0 flex items-center justify-center">
                 <div class="text-center p-10">
                     <h2 class="text-3xl font-bold text-white mb-4">Lab Teknik 2026</h2>
                     <p class="text-indigo-200 text-lg">Inovasi, Integritas, dan Keunggulan.</p>
                 </div>
             </div>
        </div>
    </div>
</div>
