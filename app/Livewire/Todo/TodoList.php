<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Guest;

class TodoList extends Component
{
    public $todos;
    public $currentGuest;
    public $isValidGuest = false;
    protected $listeners = ['todoAdded' => 'refreshTodos'];
    public $action = null;


    public function mount()
    {
        $this->currentGuest = Guest::current();
        $this->isValidGuest = $this->currentGuest?->validity() ?? false;
        if($this->isValidGuest){
            $this->todos = $this->currentGuest->todos()->orderByDesc('created_at')->get();
        } else {
            $this->todos = collect();
        }
        $this->action = 'mount';
    }




    #[On('todo-created')]
    public function refreshTodos(){
        $this->currentGuest = Guest::current();
        $this->todos = $this->currentGuest?->todos()->orderByDesc('created_at')->get() ?? collect();
        $this->action = 'added';
    }



    public function render()
    {
        return view('livewire.todo.list', ['action' => $this->action]);
    }
}
