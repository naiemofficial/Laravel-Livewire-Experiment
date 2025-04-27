<?php

namespace App\Livewire\Todo;

use App\Http\Middleware\GuestCookie;
use App\Models\Todo;
use Livewire\Component;

class Form extends Component
{
    public function store()
    {
        $GuestCookie = new GuestCookie();

        Todo::create([
            'title' => 'Test Title',
            'description' => 'Test Description',
        ]);

        session()->flash('success', 'Todo added successfully!');

        $this->dispatch('todo-created');
    }
    public function render()
    {
        return view('livewire.todo.form');
    }
}
