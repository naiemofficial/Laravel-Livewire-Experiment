<?php

namespace App\Livewire\Todo;

use App\Helpers\Response;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\GuestAuth;
use App\Http\Requests\TodoRequest;
use App\Models\Guest;
use App\Models\Todo;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Form extends Component
{
    public $form = 'add';
    public $Todo = null;

    public $title = '';
    public $description = '';

    public function submit()
    {
        $Todo = $this->Todo; // For edit purpose

        // Suggestion from Middleware [Yes]
        request()->attributes->set('suggestion', true);

        $response = app(GuestAuth::class)->handle(request(), function($request) use ($Todo){
            // Merge data into the request
            $request->merge([
                'title' => $this->title,
                'description' => $this->description,
                'guest_id' => Guest::current()?->id
            ]);

            // Call the controller's store/update method with the current request
            $TodoController = app(TodoController::class);
            if($this->form == 'edit'){
                $response = $TodoController->update($request, $Todo);
            } else {
                $response = $TodoController->store($request);
            }
            return $response;
        });

        if($response->isSuccessful()){
            $this->reset();
        }

        Response::visualize($this::class, $response, ['session-flash' => true]);

        $this->dispatch('refresh-todos'); // Todo  Created
    }

    #[On('edit-todo')]
    public function edit(int $id)
    {
        $this->form = 'edit';
        $this->Todo = Todo::find($id);
        $this->title = $this->Todo->title;
        $this->description = $this->Todo->description;
    }
    public function cancel(){
        $this->form = 'add';
        $this->reset();
    }

    public function render()
    {
        return view('livewire.todo.form', [
            'className' => $this::class
        ]);
    }
}
