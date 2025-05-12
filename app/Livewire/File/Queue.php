<?php

namespace App\Livewire\File;

use Livewire\Attributes\On;
use Livewire\Component;

class Queue extends Component
{
    public $files = [];


    public function formatFileSize($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function render()
    {
        return view('livewire.file.queue');
    }
}
