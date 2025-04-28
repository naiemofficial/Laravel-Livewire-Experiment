<div>
    <form class="space-y-6 w-full">
        <!-- Title Field -->
        <input type="text" wire:model="title" class="w-full text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#fb70a9] text-sm bg-white border rounded-sm border-gray-300 px-4 py-3" placeholder="Title"/>


        <!-- Description Field -->
        <textarea wire:model="description" class="w-full h-[100px] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#fb70a9] text-sm bg-white border rounded-sm border-gray-300 px-4 py-3" placeholder="Description"></textarea>

        <!-- Submit Button -->
        <div class="w-full">
            <button
                type="button"
                wire:click="store"
                class="w-full justify-center rounded-md bg-gradient-to-tr from-slate-800 to-slate-700 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none cursor-pointer inline-flex items-center gap-x-1"
            >
                <i class="fas fa-plus-circle"></i> Add another one
            </button>
        </div>
    </form>


    @foreach(session()->all() as $key => $message)
        @if(in_array($key, ['success', 'error', 'info', 'warning']))
            @include("message.$key", ['message' => $message])
        @endif
    @endforeach


</div>
