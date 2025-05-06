<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;

class Filter extends Component
{
    public $deleted = 0;
    public $trash = false;


    #[On('refresh-trash-count')]
    public function mount(){
        $this->deleted = Todo::onlyTrashed()->count();
    }

    public function filterTrash(){
        $this->trash = !$this->trash;
        $this->dispatch('filterTodo', data: ['filter' => ['trash' => $this->trash]]);
    }
    public function render()
    {
        return view('livewire.todo.filter');
    }
}
