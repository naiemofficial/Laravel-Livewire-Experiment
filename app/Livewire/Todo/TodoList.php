<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Guest;

class TodoList extends Component
{
    public $currentGuest;
    public $isValidGuest = false;
    protected $listeners = ['todoAdded' => 'refreshTodos'];
    public $action = null;


    public function mount()
    {
        $this->currentGuest = Guest::current();
        $this->isValidGuest = $this->currentGuest?->validity() ?? false;
        $this->action = 'mount';
    }




    #[On('todo-created')]
    public function refreshTodos(){
        $this->currentGuest = Guest::current();
        $this->action = 'added';
    }



    public function render()
    {
        $todos = $this->currentGuest?->todos()->orderByDesc('created_at')->paginate(10) ?? collect();
        return view('livewire.todo.list', compact('todos'));
    }
}
