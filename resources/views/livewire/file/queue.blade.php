<div class="h-full mt-3 overflow-auto" id="queue-container">
    @if($files && count($files) > 0)
        <ul class="space-y-4">
            @foreach($files as $index => $file)
                <li
                    wire:key="{{ $index }}"
                    wire:ignore
                    class="flex items-center justify-between p-4 border border-gray-200 rounded shadow transition-opacity"
                >
                    <div class="flex items-center space-x-4 max-w-[100%] w-full">
                        <div class="inline-flex">
                            <img
                                src="{{ $file->temporaryUrl() }}"
                                alt="File Preview"
                                class="w-12 min-w-12 h-12 rounded object-cover"
                            >
                        </div>

                        <div class="flex flex-col flex-1 w-full min-w-0">
                            <div class="flex flex-1 items-center min-w-0">
                                <span
                                    class="font-semibold text-gray-700 flex-1 truncate"
                                    style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; word-break: break-all;"
                                    title="{{ $file->getClientOriginalName() }}"
                                >
                                    {{ $file->getClientOriginalName() }}
                                </span>
                                <span class="text-sm text-gray-500 flex-shrink-0 ml-2">{{ $this->formatFileSize($file->getSize()) }}</span>
                            </div>
                            <div class="text-xs text-yellow-500">Pending for upload</div>
                        </div>
                    </div>



                </li>
            @endforeach
        </ul>
    @endif
</div>

@script
    <script>
        $js('scrollToBottom', () => {
            const container = document.getElementById('queue-container');
            const ul = container?.querySelector('ul');
            if(ul){
                container.scrollTo({
                    top: ul.scrollHeight
                });
            }
        });
    </script>
@endscript
