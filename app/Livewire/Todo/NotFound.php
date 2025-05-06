<?php

namespace App\Livewire\Todo;

use Livewire\Component;

class NotFound extends Component
{
    public $trash;
    public function render()
    {
        return view('livewire.todo.notfound');
    }
}
