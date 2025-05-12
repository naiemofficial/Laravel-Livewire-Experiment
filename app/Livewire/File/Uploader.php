<?php

namespace App\Livewire\File;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Http\Controllers\FileController;
use App\Http\Middleware\GuestAuth;

class Uploader extends Component
{
    use WithFileUploads;

    public $files = [];
    public $selectFiles = [];

    public function updatedSelectFiles()
    {
        $this->files = array_merge($this->files, $this->selectFiles);
    }

    function uploadFile()
    {
        $files = $this->files;
        $response = app(GuestAuth::class)->handle(request(), function($request) use ($files)
        {
            $FileController = app(FileController::class);
            foreach($files as $file){
                $FileController->store();
            }

        });
    }

    public function render()
    {
        return view('livewire.file.uploader');
    }
}
