<?php

namespace App\Livewire\Todo;

use App\Http\Controllers\TodoController;
use App\Models\Guest;
use Livewire\Component;

class Form extends Component
{
    public $title;
    public $description;
    public function store()
    {

        $guestId = Guest::current() ? Guest::current()->id : null;

        $requestData = [
            'title' => $this->title,
            'description' => $this->description,
            'guest_id' => $guestId
        ];

        // Merge data into the request
        request()->merge($requestData);


        // Call the controller's store method with the current request
        $response = app(TodoController::class)->store(request());
        session()->flash($response->getData()->key, $response->getData()->message);

        $this->dispatch('todo-created');
    }
    public function render()
    {
        return view('livewire.todo.form');
    }
}
