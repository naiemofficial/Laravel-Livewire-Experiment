<?php

namespace App\Livewire\Todo;

use App\Helpers\Response;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\GuestAuth;
use App\Http\Requests\TodoRequest;
use App\Models\Guest;
use Livewire\Component;

class Form extends Component
{

    public $title;
    public $description;
    public function store()
    {
        // Suggestion from Middleware [Yes]
        request()->attributes->set('suggestion', true);

        $response = app(GuestAuth::class)->handle(request(), function($request){
            // Merge data into the request
            $request->merge([
                'title' => $this->title,
                'description' => $this->description,
                'guest_id' => Guest::current() ? Guest::current()->id : null
            ]);

            // Call the controller's store method with the current request
            return app(TodoController::class)->store($request);
        });


        Response::visualize(__CLASS__, $response, ['session-flash' => true]);

        $this->dispatch('todo-created');
    }
    public function render()
    {
        return view('livewire.todo.form', ['__CLASS__' => __CLASS__]);
    }
}
