<x-layout>
    <x-slot:headerRight>
        <livewire:file.filter />
    </x-slot:headerRight>

    <div class="h-full bg-white bg-white border-1 border-solid rounded-md border-gray-200 mx-auto flex">
        <div class="p-8 w-1/3 border-r-1 border-r-solid border-r-inherit flex flex-col bg-gray-100 relative">
            <livewire:file.uploader />
        </div>
        <div class="w-2/3 h-full flex flex-col relative">
            <livewire:file.items />
        </div>
    </div>
</x-layout>

