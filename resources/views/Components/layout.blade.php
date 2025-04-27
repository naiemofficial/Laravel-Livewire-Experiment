<x-body class="flex flex-col h-screen">
    <x-header />
    <main class="flex-1 overflow-hidden">
        <div class="h-full mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</x-body>
