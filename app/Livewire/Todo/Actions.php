<?php

namespace App\Livewire\Todo;

use Livewire\Component;

class Actions extends Component
{
    public $todo;
    public function mark(int $id, string $status){

    }
    public function edit(int $id){

    }
    public function delete(int $id){

    }
    public function render()
    {
        return view('livewire.todo.actions');
    }
}
