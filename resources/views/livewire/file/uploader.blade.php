<div class="flex flex-col h-full">
    <h2 class="font-bold text-center mb-3">Drag & Drop Files</h2>


    <div class="flex flex-col items-center justify-center w-full">
        <div class="flex items-center justify-center w-full">
            <label
                for="dropzone-file"
                id="dropzone"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-white hover:border-blue-300 transition-colors">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <i class="fas fa-upload w-8 h-8 mb-4 text-gray-500"></i>
                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                </div>
                <input wire:model.change="selectFiles" id="dropzone-file" type="file" class="hidden" multiple />
            </label>
        </div>

        @if(count($files) > 0)
            <div class="w-full flex space-x-3 mt-3">
                <button
                    type="button"
                    wire:click="cancel"
                    class="w-full justify-center rounded-md bg-gray-300 py-2 px-4 border border-gray-300 text-center text-sm text-gray-700 transition-all focus:bg-gray-400 focus:text-white active:bg-gray-500 disabled:pointer-events-none disabled:opacity-50 cursor-pointer inline-flex items-center gap-x-1 duration-200"
                >
                    <i class="fas fa-times"></i> Clear
                </button>
                <button
                    type="button"
                    wire:click="submit"
                    wire:loading.attr="disabled"
                    class="w-full justify-center rounded-md bg-gradient-to-tr from-slate-800 to-slate-700 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none cursor-pointer inline-flex items-center gap-x-1 duration-200"
                >
                    <i wire:loading class="fas fa-circle-notch fa-spin"></i>
                    <i wire:loading.remove class="fa-solid fa-upload"></i>
                    Upload
                </button>
            </div>
        @endif
    </div>

    <livewire:file.queue :$files wire:key="{{ rand(1, 10000) }}" />


    <script>
        const dropzone = document.getElementById('dropzone');
        const inputFile = document.getElementById('dropzone-file');

        // Add drag-and-drop event listeners
        dropzone.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropzone.classList.add('bg-white', 'border-blue-300');
            dropzone.classList.remove('bg-gray-50', 'border-gray-300');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('bg-white', 'border-blue-300');
            dropzone.classList.add('bg-gray-50', 'border-gray-300');
        });

        dropzone.addEventListener('drop', (event) => {
            event.preventDefault();
            dropzone.classList.remove('bg-white', 'border-blue-300');
            dropzone.classList.add('bg-gray-50', 'border-gray-300');

            // Get the dropped files
            const files = event.dataTransfer.files;

            // Assign the files to the input element
            if (files.length) {
                inputFile.files = files;

                // Trigger a change event to handle the files as if selected normally
                const eventChange = new Event('change', { bubbles: true });
                inputFile.dispatchEvent(eventChange);
            }
        });
    </script>
</div>



