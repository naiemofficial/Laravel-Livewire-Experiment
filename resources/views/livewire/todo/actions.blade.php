<div class="inline-flex items-center mt-2">
    <span wire:loading wire:target="mark, delete, restore" class="inline-flex mr-2">
        <i class="inline-flex fas fa-circle-notch fa-spin"></i>
    </span>
    <div class="inline-flex rounded-md">
        @if(!$todo->trashed())
            <div x-data="{ open: false }" class="dropdown inline-flex relative">
                <span
                    @click="open = !open"
                    class="current-status inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 rounded-l-sm focus:outline-none transition ease-in-out duration-150 cursor-pointer capitalize
                           {{ $todo->status === 'pending' ? 'text-yellow-600 hover:bg-yellow-600 hover:text-white hover:border-yellow-600' : '' }}
                           {{ $todo->status === 'completed' ? 'text-green-600 hover:bg-green-600 hover:text-white hover:border-green-600' : '' }}">
                    <i class="{{ $todo->status === 'pending' ? 'fa-light fa-hourglass-start mr-1' : ($todo->status === 'completed' ? 'fa-solid fa-check-circle mr-1' : 'fas fa-caret-down ml-2') }}"></i>
                    {{ $todo->status }}
                </span>

                <!-- Dropdown menu with fade and zoom transitions -->
                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition transform duration-300 ease-out"
                    x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition-opacity transform duration-300 ease-in"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="pt-[2px] absolute top-[100%] z-10"
                    x-cloak>
                    <div class="bg-white border border-gray-200 rounded shadow-lg">
                        <button
                            type="button"
                            wire:click="mark({{ $todo->id }}, 'pending')"
                            @click="open = false"
                            class="flex items-center w-full px-4 py-2 text-left text-xs text-yellow-600 hover:bg-yellow-600 hover:text-white hover:border-yellow-600 focus:outline-none cursor-pointer">
                            <i class="fas fa-hourglass-start mr-2"></i> Pending
                        </button>
                        <button
                            type="button"
                            wire:click="mark({{ $todo->id }}, 'completed')"
                            @click="open = false"
                            class="flex items-center w-full px-4 py-2 text-left text-xs text-green-600 hover:bg-green-600 hover:text-white hover:border-green-600 focus:outline-none cursor-pointer">
                            <i class="fa-regular fa-circle-check mr-2"></i> Complete
                        </button>
                    </div>
                </div>
            </div>



            <button type="button" wire:click="edit({{ $todo->id }})" class="inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 text-blue-500 hover:bg-blue-500 hover:text-white hover:border-blue-500 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer">
                <i class="fas fa-edit mr-2"></i> Edit
            </button>
            <button type="button" wire:click="delete({{ $todo->id }})" class="inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 rounded-r-sm text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer">
                <i class="fas fa-trash mr-2"></i> Delete
            </button>
        @else
            <button type="button" wire:click="restore({{ $todo->id }})" class="inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 rounded-l-sm text-blue-500 hover:bg-blue-500 hover:text-white hover:border-blue-500 focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                <i class="fas fa-trash-restore mr-2"></i> Restore
            </button>
            <button type="button" wire:click="delete({{ $todo->id }}, 'trash')" class="inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 rounded-r-sm text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer">
                <i class="fas fa-trash mr-2"></i> Delete Permanently
            </button>
        @endif
    </div>
</div>

