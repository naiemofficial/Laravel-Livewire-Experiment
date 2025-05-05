@php
    $menus = [
        '/' => 'Home',
        'todo' => 'Todo'
    ];
@endphp



<header class="bg-white shadow-sm">
    <x-navlinks :menus="$menus" />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="py-6 flex justify-between">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                @php
                    if (request()->segment(1) && array_key_exists(request()->segment(1), $menus)){
                        $page = $menus[request()->segment(1)];
                    } else {
                        $page = $menus['/'];
                    }
                @endphp
                {{ $page }}
            </h1>
            <div class="header-right inline-flex items-center">
                {{ $headerRight ?? '' }}
            </div>
        </div>
    </div>
</header>
