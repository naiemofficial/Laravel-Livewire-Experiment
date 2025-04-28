<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guest;

class Todo extends Model
{
    //
    protected $fillable = ['title', 'description', 'user_id', 'guest_id'];

    public function guest(){
        return $this->belongsTo(Guest::class);
    }
}
