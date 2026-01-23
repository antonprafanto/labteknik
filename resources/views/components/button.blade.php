<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
