<?php

namespace App\Livewire\Todo;

use App\Helpers\Response;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\GuestAuth;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Ramsey\Uuid\Type\Time;

class Actions extends Component
{
    public $todo;
    public function mark(int $id, string $status)
    {
        $response = app(GuestAuth::class)->handle(request(), function ($request) use ($id, $status) {
            $request->merge(['status' => $status]);
            return app(TodoController::class)->update($request, Todo::find($id));
        });

        // Re-render Message
        $this->dispatch('refresh-message', response: $response);

        if($response->isSuccessful()){
            $this->todo = Todo::find($id);
            $this->dispatch('refresh-todos');
        }
    }

    public function edit(int $id){
        $this->dispatch('edit-todo', id: $id);
    }

    public function delete(int $id, $action = null){
        $response = app(GuestAuth::class)->handle(request(), function () use ($id, $action) {
            $Todo = ($action == 'trash') ? Todo::onlyTrashed()->find($id) : Todo::find($id);
            return app(TodoController::class)->destroy($Todo);
        });

        if($response->isSuccessful()){
            $this->dispatch('refresh-message', response: $response);
            $this->dispatch('refresh-todo-count');
            $this->dispatch('refresh-todos');
        }
    }

    public function restore(int $id){
        $response = app(GuestAuth::class)->handle(request(), function () use ($id) {
            return app(TodoController::class)->restore(Todo::onlyTrashed()->find($id));
        });

        if($response->isSuccessful()){
            $this->dispatch('refresh-message', response: $response);
            $this->dispatch('refresh-trash-count');
            $this->dispatch('refresh-todos');
        }
    }

    public function render()
    {
        return view('livewire.todo.actions');
    }
}
