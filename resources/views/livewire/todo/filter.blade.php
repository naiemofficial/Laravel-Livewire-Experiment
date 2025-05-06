<div x-data="{
    orderBy: { name: null, value: null },
    sort: { direction: null, value: null },
    isOrderByOpen: false,
    isSortOpen: false,
    isOrderByFocused: false,
    isSortFocused: false
}" class="flex flex-col md:flex-row md:items-center space-x-3">

    @if($todo_count > 0 || $deleted > 0)
    <!-- Search Input -->
    <input
        wire:model.live.debounce.250ms="searchText"
        value="{{ old('searchText') }}"
        type="text"
        placeholder="Search..."
        class="border border-gray-300 rounded-sm px-3 py-[6px] text-xs w-full md:w-60 focus:ring-2 focus:ring-blue-600 focus:outline-none transition-all duration-200"
    />

    <!-- Status Dropdown -->
    <div x-data="{ isStatusOpen: false, isStatusFocused: false, status: { name: null, value: null } }" class="relative">
        <div
            @click="isStatusOpen = !isStatusOpen"
            @focus="isStatusFocused = true"
            @blur="isStatusFocused = false"
            tabindex="0"
            :class="isStatusFocused ? 'focus:ring-2 focus:ring-blue-600 transition-all duration-200' : ''"
            class="border border-gray-300 rounded-sm pr-7 px-3 py-[6px] text-xs w-auto flex items-center cursor-pointer space-x-1 min-w-[130px]"
        >
            <span :class="status.value ? '' : 'opacity-60'" x-html="status.value ? status.value : 'Status'"></span>
            <i :class="status.value ? '' : 'opacity-60'" class="fas fa-caret-down text-xs"></i>
        </div>

        <div
            x-show="isStatusOpen"
            @click.away="isStatusOpen = false"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute mt-1 w-auto bg-white border border-gray-300 rounded-sm shadow-md z-10 w-full min-w-[130px] overflow-hidden"
        >
            <div wire:click="searchStatus('pending')" @click="status = { name: 'pending', value: '<i class=\'fa-light fa-hourglass-half\'></i> Pending' }; isStatusOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fa-light fa-hourglass-half"></i>
                <span>Pending</span>
            </div>
            <div wire:click="searchStatus('completed')" @click="status = { name: 'completed', value: '<i class=\'fa-light fa-check-circle\'></i> Completed' }; isStatusOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fa-light fa-check-circle"></i>
                <span>Completed</span>
            </div>
        </div>

        <button wire:click="searchStatus(null)"
            x-show="status.value"
            @click="status = { name: null, value: null }"
            class="clear-select"
        >
            <i class="fas fa-times"></i>
        </button>
    </div>


    <!-- Order By Dropdown -->
    <div class="relative">
        <div
            @click="isOrderByOpen = !isOrderByOpen"
            @focus="isOrderByFocused = true"
            @blur="isOrderByFocused = false"
            tabindex="0"
            :class="isOrderByFocused ? 'focus:ring-2 focus:ring-blue-600 transition-all duration-200' : ''"
            class="border border-gray-300 rounded-sm pr-7 px-3 py-[6px] text-xs w-auto flex items-center cursor-pointer space-x-1 min-w-[150px]"
        >
            <span :class="status.value ? '' : 'opacity-60'" x-html="orderBy.value ? orderBy.value : 'Order By'"></span>
            <i :class="status.value ? '' : 'opacity-60'" class="fas fa-caret-down text-xs"></i>
        </div>

        <div x-show="isOrderByOpen" @click.away="isOrderByOpen = false"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute mt-1 w-auto bg-white border border-gray-300 rounded-sm shadow-md z-10 w-full min-w-[140px] overflow-hidden"
        >
            <div wire:click="orderBy('title')"
                 @click="orderBy = { name: 'title', value: '<i class=\'fa-regular fa-text\'></i> Title' }; isOrderByOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fa-regular fa-text"></i>
                <span>Title</span>
            </div>
            <div wire:click="orderBy('created_at')"
                 @click="orderBy = { name: 'created_at', value: '<i class=\'fa-light fa-calendar-plus\'></i> Creation Date' }; isOrderByOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fa-light fa-calendar-plus"></i>
                <span>Creation Date</span>
            </div>
            <div wire:click="orderBy('updated_at')"
                 @click="orderBy = { name: 'updated_at', value: '<i class=\'fa-light fa-calendar-pen\'></i> Update Date' }; isOrderByOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fa-light fa-calendar-pen"></i>
                <span>Update Date</span>
            </div>
        </div>

        <button wire:click="orderBy(null)"
            x-show="orderBy.value"
            @click="orderBy = { name: null, value: null }"
            class="clear-select"
        >
            <i wire:model class="fas fa-times"></i>
        </button>
    </div>

    <!-- Sort Dropdown -->
    <div class="relative">
        <div
            @click="isSortOpen = !isSortOpen"
            @focus="isSortFocused = true"
            @blur="isSortFocused = false"
            tabindex="0"
            :class="isSortFocused ? 'focus:ring-2 focus:ring-blue-600 transition-all duration-200' : ''"
            class="border border-gray-300 rounded-sm pr-7 px-3 py-[6px] text-xs w-auto flex items-center cursor-pointer space-x-1 min-w-[140px]"
        >
            <span :class="status.value ? '' : 'opacity-60'" x-html="sort.value ? sort.value : 'Sort'"></span>
            <i :class="status.value ? '' : 'opacity-60'" class="fas fa-caret-down text-xs"></i>
        </div>

        <div x-show="isSortOpen" @click.away="isSortOpen = false"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute mt-1 w-auto bg-white border border-gray-300 rounded-sm shadow-md z-10 w-full min-w-[140px] overflow-hidden"
        >
            <div wire:click="orderDirection('asc')" @click="sort = { direction: 'asc', value: '<i class=\'fa-light fa-arrow-up-wide-short\'></i> Ascending' }; isSortOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fa-light fa-arrow-up-wide-short"></i>
                <span>Ascending</span>
            </div>
            <div wire:click="orderDirection('desc')" @click="sort = { direction: 'desc', value: '<i class=\'fa-light fa-arrow-down-short-wide\'></i> Descending' }; isSortOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fa-light fa-arrow-down-short-wide"></i>
                <span>Descending</span>
            </div>
        </div>

        <button wire:click="orderDirection(null)"
            x-show="sort.value"
            @click="sort = { direction: null, value: null }"
            class="clear-select"
        >
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif


    <!-- Trash -->
    @if($deleted > -1)
    <button
            type="submit"
            wire:click="filterTrash"
            wire:loading.attr="disabled"
            class="group {{ $trash ? 'bg-red-600 text-white hover:bg-red-600 hover:text-white' : '' }} w-[110px] border border-red-600 text-red-600 px-3 py-[6px] rounded-sm hover:bg-[#ffeef5] focus:outline-none focus:ring-2 focus:ring-red-500 text-xs cursor-pointer disabled:cursor-not-allowed transition-all duration-200 relative"
        >
        <i class="fas fa-trash-alt"></i> Trash
        <span class="{{ $deleted >= 10 ? 'rounded-sm px-[5px]' : 'rounded-full' }} top-[-5px] right-[-5px] inline-flex items-center justify-center bg-[#ffd3e5] text-red-600 h-[18px] min-w-[18px] transition-colors duration-200">
            {{ $deleted }}
        </span>
    </button>
    @endif

</div>
