<?php

namespace App\Livewire\Guest;

use App\Http\Controllers\GuestController;
use App\Http\Middleware\GuestCookie;
use App\Models\Guest;
use Livewire\Component;

class Form extends Component
{
    public $name;
    public $isValidGuest;
    public $currentGuest;
    public function store(){
        $this->isValidGuest = Guest::isValid();
        if($this->isValidGuest){
            // Update
            request()->merge(['name' => $this->name]);
            app(GuestController::class)->update(request(), Guest::current());
        } else {
            // Add as new
            request()->merge(['guest' => $this->name]);
            $GuestCookie = new GuestCookie();
            $response = $GuestCookie->handle(request(), fn($request) => $request);
        }
    }
    public function render()
    {
        $this->currentGuest = Guest::current();

        if($this->currentGuest instanceof Guest){
            $this->name = $this->currentGuest->name;
        }
        return view('livewire.guest.form');
    }
}
