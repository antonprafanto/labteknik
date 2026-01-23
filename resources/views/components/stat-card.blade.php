@props(['title', 'count', 'icon', 'color' => 'indigo', 'href' => '#'])

<a href="{{ $href }}" class="block p-6 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $title }}</p>
            <h3 class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $count }}</h3>
        </div>
        <div class="p-3 bg-{{ $color }}-50 dark:bg-{{ $color }}-900/20 rounded-lg">
            {{ $slot }}
        </div>
    </div>
</a>
