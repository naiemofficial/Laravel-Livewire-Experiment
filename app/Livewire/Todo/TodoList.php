<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Guest;

class TodoList extends Component
{
    public $todos;
    public function mount()
    {
        $CurrentGuest = Guest::current();
        if($CurrentGuest){
            $this->todos = $CurrentGuest->todos()->orderByDesc('created_at')->get();
        } else {
            $this->todos = collect();
        }
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
