

<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img class="size-8" src="{{ url("/livewire.png") }}" alt="Your Company">
                </div>
                <div class="">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        @foreach($menus as $link => $name)
                            <x-nav-item href="{{ $link }}">{{ $name }}</x-nav-item>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="">
                <div class="ml-4 flex items-center md:ml-6">

                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div class="flex items-center border rounded-lg px-3 py-1 bg-gray-900 border-gray-900">
                            <i class="fas fa-user text-gray-400 mr-2"></i>
                            <input type="text" class="flex-1 bg-transparent text-white placeholder-gray-500 focus:outline-none focus:ring-0 py-1 text-sm" placeholder="Your Name">
                            <button type="submit" class="ml-2 bg-blue-600 text-white px-4 py-1 rounded-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                Submit
                            </button>
                        </div>
                        {{--<div>
                            <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Abdullah Al Naiem</span>
                                <img class="size-8 rounded-full" src="https://avatars.githubusercontent.com/u/34242279" alt="Naiem">
                            </button>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
