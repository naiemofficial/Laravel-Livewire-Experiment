<?php

namespace App\Livewire\Todo;

use App\Helpers\Response;
use Illuminate\Http\JsonResponse;
use Livewire\Attributes\On;
use Livewire\Component;

class Message extends Component
{
    #[On('refresh-message')]
    public function refreshMessage($response){
        // Visualize the response
        Response::visualize(TodoList::class, $response, [
            'session-flash' => true,
            'template' => [
                'key' => 'textOnly',
                'wrapper' => true,
                'key-based-color' => true,
                'class' => 'line-clamp-1 px-2 py-0.5 border-1 border-solid rounded-[20px]'
            ]
        ]);
    }
    public function render()
    {
        return view('livewire.todo.message', [
            'className' => TodoList::class
        ]);
    }
}
