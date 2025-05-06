<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Guest;
use Livewire\WithPagination;
use App\Helpers\Filter;

class TodoList extends Component
{
    use WithPagination;
    protected $listeners = [
        'todoAdded' => 'refreshTodos',
    ];

    public $filter = [];

    #[On('filterTodo')]
    public function filterTodo($data)
    {
        $this->filter = Filter::prepare($data);
        $trash = $this->filter['trash'];
        if($trash === true || $trash === false){
            $this->resetPage();
        }
    }


    #[On('refresh-todos')]
    public function render()
    {
        // Todos
        $todos = Guest::current()?->todos() ?? Todo::query();

        extract(empty($this->filter) ? Filter::prepare([]) : $this->filter);
        if($trash) $todos->onlyTrashed();
        $todos = $todos->orderBy($order_column, $order_direction)->paginate($per_page);


        return view('livewire.todo.list', [
            'todos' => $todos,
            'className' => $this::class,
            'trash' => true
        ]);
    }
}
