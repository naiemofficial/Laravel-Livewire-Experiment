<div class="">
    <div class="ml-4 flex items-center md:ml-6">
        <div class="relative ml-3">
            <div class="flex items-center border rounded-lg px-3 py-1 bg-gray-900 border-gray-900">
                <i class="fas fa-user text-gray-400 mr-2"></i>
                <input wire:model="name" type="text" class="flex-1 bg-transparent text-white placeholder-gray-500 focus:outline-none focus:ring-0 py-1 text-sm" placeholder="Your Name">
                <button
                    type="submit"
                    wire:click="store"
                    class="ml-2 bg-blue-600 text-white px-4 py-1 rounded-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm cursor-pointer"
                >
                    {{ ($isValidGuest ? 'Update' : 'Submit') }}
                </button>
            </div>
        </div>
    </div>
</div>
