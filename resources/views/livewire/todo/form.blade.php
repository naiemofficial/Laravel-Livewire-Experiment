<div>
    <h2 class="font-bold text-center mb-3">{{ $form == 'edit' ? 'Edit' : 'Add' }} Todo</h2>
    <form class="space-y-6 w-full" wire:submit.prevent="submit">
        <!-- Title Field -->
        <input type="text" wire:model="title" wire:loading.attr="disabled" class="w-full text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm bg-white border rounded-sm border-gray-300 px-4 py-3 duration-200" placeholder="Title"/>


        <!-- Description Field -->
        <textarea wire:model="description" wire:loading.attr="disabled" class="w-full h-[100px] text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm bg-white border rounded-sm border-gray-300 px-4 py-3 duration-200" placeholder="Description"></textarea>

        <!-- Submit Button -->
        <div class="w-full flex space-x-3">
            @if($form == 'edit')
                <button
                    type="button"
                    wire:click="cancel"
                    class="w-full justify-center rounded-md bg-gray-300 py-2 px-4 border border-gray-300 text-center text-sm text-gray-700 transition-all focus:bg-gray-400 focus:text-white active:bg-gray-500 disabled:pointer-events-none disabled:opacity-50 cursor-pointer inline-flex items-center gap-x-1 duration-200"
                >
                    <i class="fas fa-times"></i> Cancel
                </button>
            @endif
            <button
                type="button"
                wire:click="submit"
                wire:loading.attr="disabled"
                class="w-full justify-center rounded-md bg-gradient-to-tr from-slate-800 to-slate-700 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none cursor-pointer inline-flex items-center gap-x-1 duration-200"
            >
                <i wire:loading class="fas fa-circle-notch fa-spin"></i>
                <i wire:loading.remove class="fas {{ $form == 'edit' ? 'fa-arrows-rotate' : 'fa-plus-circle' }}"></i>
                {{ $form == 'edit' ? 'Update' : 'Submit' }}
            </button>
        </div>
    </form>


    @include('message.index', compact('className'))

</div>
