<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dette extends Model
{
    /** @use HasFactory<\Database\Factories\DetteFactory> */
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function expense(){
        return $this->belongsTo(Expense::class);
    }
}
