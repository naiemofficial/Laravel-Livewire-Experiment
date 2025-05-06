<div x-data="{
    orderBy: { name: null, value: null },
    sort: { direction: null, value: null },
    isOrderByOpen: false,
    isSortOpen: false,
    isOrderByFocused: false,
    isSortFocused: false
}" class="flex flex-col md:flex-row md:items-center space-x-3">
    <!-- Search Input -->
    <input
        id="search"
        type="text"
        placeholder="Search..."
        class="border border-gray-300 rounded-sm px-3 py-[6px] text-xs w-full md:w-60 focus:ring-2 focus:ring-blue-600 focus:outline-none transition-all duration-200"
    />

    <!-- Order By Dropdown -->
    <div class="relative">
        <div
            @click="isOrderByOpen = !isOrderByOpen"
            @focus="isOrderByFocused = true"
            @blur="isOrderByFocused = false"
            tabindex="0"
            :class="isOrderByFocused ? 'focus:ring-2 focus:ring-blue-600 transition-all duration-200' : ''"
            class="border border-gray-300 rounded-sm pr-7 px-3 py-[6px] text-xs w-auto flex items-center cursor-pointer space-x-1 min-w-[140px]"
        >
            <span x-html="orderBy.value ? orderBy.value : 'Order By'"></span>
            <i class="fas fa-caret-down text-xs"></i>
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
            <div @click="orderBy = { name: 'name', value: '<i class=\'fas fa-user\'></i> Name' }; isOrderByOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fas fa-user"></i>
                <span>Name</span>
            </div>
            <div @click="orderBy = { name: 'date', value: '<i class=\'fas fa-calendar-alt\'></i> Date' }; isOrderByOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fas fa-calendar-alt"></i>
                <span>Date</span>
            </div>
            <div @click="orderBy = { name: 'status', value: '<i class=\'fas fa-info-circle\'></i> Status' }; isOrderByOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fas fa-info-circle"></i>
                <span>Status</span>
            </div>
        </div>

        <button
            x-show="orderBy.value"
            @click="orderBy = { name: null, value: null }"
            class="clear-select"
        >
            <i class="fas fa-times"></i>
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
            <span x-html="sort.value ? sort.value : 'Sort'"></span>
            <i class="fas fa-caret-down text-xs"></i>
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
            <div @click="sort = { direction: 'asc', value: '<i class=\'fas fa-sort-amount-up\'></i> Ascending' }; isSortOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fas fa-sort-amount-up"></i>
                <span>Ascending</span>
            </div>
            <div @click="sort = { direction: 'desc', value: '<i class=\'fas fa-sort-amount-down\'></i> Descending' }; isSortOpen = false"
                 class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-xs hover:text-white flex items-center space-x-2">
                <i class="fas fa-sort-amount-down"></i>
                <span>Descending</span>
            </div>
        </div>

        <button
            x-show="sort.value"
            @click="sort = { direction: null, value: null }"
            class="clear-select"
        >
            <i class="fas fa-times"></i>
        </button>
    </div>

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
