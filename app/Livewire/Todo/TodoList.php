<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;

class TodoList extends Component
{
    public $todos;
    public function mount()
    {
        $this->todos = Todo::all()->sortByDesc('created_at');
    }

    protected $listeners = ['todoAdded' => 'refreshTodos'];

    #[On('todo-created')]
    public function refreshTodos(){
        $this->todos = Todo::all()->sortByDesc('created_at');
    }
    public function render()
    {
        return view('livewire.todo.list');
    }
}
