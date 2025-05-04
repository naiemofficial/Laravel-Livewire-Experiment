<div class="h-full">
    <div class="w-full text-center">
        <livewire:todo.message />
        <span wire:loading class="fixed h-[25px] w-[25px] inline-flex items-center justify-center bg-white border-gray-200 border-1 border-solid rounded-[50%] z-1" style="transform: translateY(-50%)">
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
                        wire:key="{{ $todo->id }}"
                        x-data="{ show: false }"
                        x-init="setTimeout(() => show = true, {{ $index * 80 }})"
                        x-show="show"
                        x-transition.duration.300ms
                        class="flex justify-between gap-x-6 py-5 transition-[0.3s] {{($action == 'added' && $index == 0) ? 'opacity-0 opacity-100' : '' }}"
                        style="transition: 0.3s"
                    >
                        <div class="flex min-w-0 gap-x-4">
                            <span class="inline-flex items-center justify-center h-[48px] w-[48px] border border-double border-gray-200 rounded-sm text-gray-300 bg-gray-100 text-xl">
                                <i class="fa-duotone fa-solid fa-user"></i>
                            </span>
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-gray-900">{{ $todo->title }}</p>
                                <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $todo->description }}</p>
                            </div>
                        </div>

                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <p class="text-xs/5 text-gray-500">{{ $todo->created_at->diffForHumans() }}</p>
                            <livewire:todo.actions :todo="$todo" key="{{ $todo->id }}" />
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <x-pagination :data="$todos" class="inner-col-pagination"/>
</div>
