<?php

namespace App\Livewire\Todo;

use App\Models\Guest;
use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Component;

class Filter extends Component
{
    public $deleted = 0;
    public $todo_count;
    public $trash = false;
    public $data = ['filter' => [], 'order' => [], 'search' => []];
    public $searchText;

    public function mount(){
        $this->todo_count = Todo::count();
        $this->deleted = Todo::onlyTrashed()->count();
    }

    #[On('refresh-todo-count')]
    public function refreshTodoCount(){
        $todos = Guest::current()?->todos() ?? Todo::query();
        $this->todo_count = $todos->count();
        $this->deleted = $todos->onlyTrashed()->count();

        if($this->todo_count == 0 && $this->deleted == 0){
            $this->data['filter']['trash'] = false;
            $this->filterTrash();
        }
    }

    public function updatedSearchText(){
        if(empty($this->searchText)){
            unset($this->data['search']['text']);
        } else {
            $this->data['search']['text'] = [
                [
                    'column'    => 'title',
                    'value'     => "%$this->searchText%",
                    'operator'  => 'LIKE',
                    'boolean'   => 'OR'
                ],
                [
                    'column'    => 'description',
                    'value'     => "%$this->searchText%",
                    'operator'  => 'LIKE',
                    'boolean'   => 'OR'
                ],
            ];
        }
        $this->dispatch('filterTodo', data: $this->data);
    }


    public function searchStatus($status){
        if(empty($status)){
            unset($this->data['search']['status']);
        } else {
            $this->data['search']['status'] = [
                'column'    => 'status',
                'value'     => $status,
                'operator'  => '=',
                'boolean'   => 'AND'
            ];
        }
        $this->dispatch('filterTodo', data: $this->data);
    }

    public function orderBy($column){
        $this->data['order']['column'] = $column;
        $this->dispatch('filterTodo', data: $this->data);
    }

    public function orderDirection($direction){
        $this->data['order']['direction'] = $direction;
        $this->dispatch('filterTodo', data: $this->data);
    }

    public function filterTrash(){
        $this->data['filter']['trash'] = $this->trash = !$this->trash;
        $this->dispatch('filterTodo', data: $this->data);
    }
    public function render()
    {
        return view('livewire.todo.filter');
    }
}
