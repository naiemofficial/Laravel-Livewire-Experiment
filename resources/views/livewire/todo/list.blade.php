<div class="h-full">
    <div class="w-full text-center">
        <span wire:loading class="fixed h-[25px] w-[25px] inline-flex items-center justify-center bg-white border-gray-200 border-1 border-solid rounded-[50%] z-1 -mt-8" style="transform: translateY(-50%)">
            <i class="inline-flex fas fa-circle-notch fa-spin text-blue-600"></i>
        </span>
    </div>
    <div class="h-full flex flex-col relative p-8 overflow-auto">
        @if($todos->isEmpty())
            @include('todo.notfound')
        @else
            <ul role="list" class="divide-y divide-gray-100 [&>li:first-child]:pt-0">
                @foreach($todos as $index => $todo)
                    <li
                        x-data="{ show: false }"
                        x-init="setTimeout(() => show = true, {{ $index * 80 }})"
                        x-show="show"
                        x-transition.duration.300ms
                        class="flex justify-between gap-x-6 py-5 transition-[0.3s] {{($action == 'added' && $index == 0) ? 'opacity-0 opacity-100' : '' }}"
                        style="transition: 0.3s"
                    >
                        <div class="flex min-w-0 gap-x-4">
                            <img class="size-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-gray-900">{{ $todo->title }}</p>
                                <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $todo->description }}</p>
                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-sm/6 text-gray-900">{{ $todo?->guest?->name ?? 'N/A' }}</p>
                            <p class="mt-1 text-xs/5 text-gray-500">{{ $todo->created_at->diffForHumans() }}</time></p>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <x-pagination :data="$todos" class="inner-col-pagination"/>
</div>
