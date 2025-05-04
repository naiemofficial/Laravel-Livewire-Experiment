<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Guest;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

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




    #[On('refresh-todos')]
    public function render()
    {
        $todos = Guest::current()?->todos()->orderByDesc('created_at')->paginate(10) ?? collect();
        return view('livewire.todo.list', [
            'todos' => $todos,
            'className' => $this::class
        ]);
    }
}
