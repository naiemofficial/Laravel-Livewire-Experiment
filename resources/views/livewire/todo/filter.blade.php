<div x-data="{ orderBy: '', sort: '', isOrderByOpen: false, isSortOpen: false, isOrderByFocused: false, isSortFocused: false }" class="flex flex-col md:flex-row md:items-center space-x-3">
    <!-- Search Input -->
    <input
        id="search"
        type="text"
        placeholder="Search..."
        class="border border-gray-300 rounded-sm px-3 py-[6px] text-sm w-full md:w-60 focus:ring-2 focus:ring-blue-600 focus:outline-none transition-all duration-200"
    />

    <!-- Order By Dropdown -->
    <div class="relative">
        <!-- Custom Order By Dropdown -->
        <div
            @click="isOrderByOpen = !isOrderByOpen"
            @focus="isOrderByFocused = true"
            @blur="isOrderByFocused = false"
            tabindex="0"
            :class="isOrderByFocused ? 'focus:ring-2 focus:ring-blue-600 transition-all duration-200' : ''"
            class="border border-gray-300 rounded-sm pr-6 px-3 py-[6px] text-sm w-auto flex items-center cursor-pointer space-x-1 min-w-[120px]"
        >
            <span x-text="orderBy ? orderBy.charAt(0).toUpperCase() + orderBy.slice(1) : 'Order By'"></span>
            <i class="fas fa-caret-down text-xs"></i> <!-- Caret icon -->
        </div>

        <!-- Custom Dropdown Options -->
        <div x-show="isOrderByOpen" @click.away="isOrderByOpen = false"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute mt-1 w-auto bg-white border border-gray-300 rounded-sm shadow-md z-10 w-full min-w-[120px] overflow-hidden"
        >
            <div @click="orderBy = 'name'; isOrderByOpen = false" class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-sm hover:text-white">Name</div>
            <div @click="orderBy = 'date'; isOrderByOpen = false" class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-sm hover:text-white">Date</div>
            <div @click="orderBy = 'status'; isOrderByOpen = false" class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-sm hover:text-white">Status</div>
        </div>

        <!-- Clear X Button inside the dropdown (optional for now) -->
        <button
            x-show="orderBy"
            @click="orderBy = ''"
            class="clear-select"
        >
            <i class="fas fa-times"></i> <!-- X button to clear selection -->
        </button>
    </div>

    <!-- Sort Dropdown -->
    <div class="relative">
        <!-- Custom Sort Dropdown -->
        <div
            @click="isSortOpen = !isSortOpen"
            @focus="isSortFocused = true"
            @blur="isSortFocused = false"
            tabindex="0"
            :class="isSortFocused ? 'focus:ring-2 focus:ring-blue-600 transition-all duration-200' : ''"
            class="border border-gray-300 rounded-sm pr-6 px-3 py-[6px] text-sm w-auto flex items-center cursor-pointer space-x-1 min-w-[120px]"
        >
            <span x-text="sort ? sort.charAt(0).toUpperCase() + sort.slice(1) : 'Sort'"></span>
            <i class="fas fa-caret-down text-xs"></i> <!-- Caret icon -->
        </div>

        <!-- Custom Dropdown Options -->
        <div x-show="isSortOpen" @click.away="isSortOpen = false"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute mt-1 w-auto bg-white border border-gray-300 rounded-sm shadow-md z-10 w-full min-w-[120px] overflow-hidden"
        >
            <div @click="sort = 'asc'; isSortOpen = false" class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-sm hover:text-white">Ascending</div>
            <div @click="sort = 'desc'; isSortOpen = false" class="px-3 py-[6px] cursor-pointer hover:bg-blue-600 text-sm hover:text-white">Descending</div>
        </div>

        <!-- Clear X Button inside the dropdown (optional for now) -->
        <button
            x-show="sort"
            @click="sort = ''"
            class="clear-select"
        >
            <i class="fas fa-times"></i> <!-- X button to clear selection -->
        </button>
    </div>

    <!-- Trash Button with FontAwesome Icon -->
    <button
        type="submit"
        wire:click="submit"
        wire:loading.attr="disabled"
        class="min-w-[80px] border border-red-600 text-red-600 px-3 py-[6px] rounded-sm hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-500 text-sm cursor-pointer disabled:cursor-not-allowed transition-all duration-200"
    >
        <i class="fas fa-trash-alt"></i> Trash
    </button>

</div>
