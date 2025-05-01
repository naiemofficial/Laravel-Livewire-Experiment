<div class="inline-flex items-center mt-2">
    <span wire:loading wire:target="mark({{ $todo->id }}" class="inline-flex mr-2">
        <i class="inline-flex fas fa-circle-notch fa-spin"></i>
    </span>
    <div class="inline-flex rounded-md">
        <div class="dropdown inline-flex relative group">
            <span type="button" class="current-status inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 rounded-l-sm text-green-600 hover:bg-green-600 hover:text-white hover:border-green-600 focus:outline-none transition ease-in-out duration-150 cursor-pointer capitalize">
                {{ $todo->status }}
                <i class="fas fa-caret-down ml-2"></i>
            </span>
            <!-- Dropdown menu -->
            <div class="hidden pt-[2px] absolute top-[100%] z-10 group-hover:block">
                <div class="bg-white border border-gray-200 rounded shadow-lg">
                    <button type="button" wire:click="mark({{ $todo->id }}, 'pending')" class="flex items-center w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">
                        <i class="fas fa-hourglass-start mr-2"></i> Pending
                    </button>
                    <button type="button" wire:click="mark({{ $todo->id }}, 'complete')" class="flex items-center w-full px-4 py-2 text-left text-sm text-green-600 hover:bg-green-600 hover:text-white focus:outline-none">
                        <i class="fa-regular fa-circle-check mr-2"></i> Complete
                    </button>
                </div>
            </div>
        </div>
        <button type="button" wire:click="edit({{--{{ $todo->id }}--}})" class="inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 text-yellow-600 hover:bg-yellow-600 hover:text-white hover:border-yellow-600 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer">
            <i class="fas fa-edit mr-2"></i> Edit
        </button>
        <button type="button" wire:click="delete({{--{{ $todo->id }}--}})" class="inline-flex items-center px-2 py-[2px] text-[12px] border border-gray-300 rounded-r-sm text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 focus:outline-none transition ease-in-out duration-150 -ml-px cursor-pointer">
            <i class="fas fa-trash mr-2"></i> Delete
        </button>
    </div>
</div>

