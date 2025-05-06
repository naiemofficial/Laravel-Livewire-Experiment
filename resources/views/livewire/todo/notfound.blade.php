<div class="h-full flex justify-center items-center">
    <div class="text-center">
        @if($trash)
            <i class="fa-solid fa-trash text-4xl text-gray-400"></i>
            <p class="text-lg text-gray-400"> No todos found in the trash</p>
        @else
            <p class="text-lg text-gray-600">No todos found</p>
            <p class="text-sm text-gray-400">Please add a new todo to get started.</p>
        @endif
    </div>
</div>
