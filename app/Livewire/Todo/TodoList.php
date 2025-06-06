<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Guest;
use Livewire\WithPagination;
use App\Helpers\Filter;
use Illuminate\Database\Eloquent\Collection;

class TodoList extends Component
{
    use WithPagination;
    protected $listeners = [
        'todoAdded' => 'refreshTodos',
    ];

    public $filter = [];
    public $search = [];



    #[On('filterTodo')]
    public function filterTodo($data)
    {

        $this->search = $data['search'] ?? [];

        $this->filter = Filter::prepare($data);

        $trash = $this->filter['trash'];
        if($trash === true || $trash === false){ // Not NULL
            $this->resetPage();
        }
    }


    #[On('refresh-todos')]
    public function render()
    {
        // Todos
        $todos = Guest::current()?->todos() ?? new Collection();

        extract(empty($this->filter) ? Filter::prepare([]) : $this->filter);

        // Filter: trash
        if($trash) $todos->onlyTrashed();

        // Search Term
        if(!empty($this->search)){
            $todos = Filter::search($todos, $this->search);
        }

        $todos = ($todos->count() > 0) ? $todos->orderBy($order_column, $order_direction)->paginate($per_page) : $todos;


        return view('livewire.todo.list', [
            'todos' => $todos,
            'className' => $this::class,
            'trash' => $trash
        ]);
    }
}
