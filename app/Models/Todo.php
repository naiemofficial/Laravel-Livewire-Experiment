<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guest;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'description', 'user_id', 'guest_id', 'status'];

    public function guest(){
        return $this->belongsTo(Guest::class);
    }
}
