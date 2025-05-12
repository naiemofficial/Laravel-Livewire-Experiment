<?php

namespace App\Livewire\Todo;

use Livewire\Attributes\On;
use Livewire\Component;

class Notfound extends Component
{
    public $trash;
    public function render()
    {
        return view('livewire.todo.notfound');
    }
}
