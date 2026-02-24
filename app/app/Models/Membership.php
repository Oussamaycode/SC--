<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    /** @use HasFactory<\Database\Factories\MembershipFactory> */
    use HasFactory;

    public function colocation(){
       return $this->belongsTo(Colocation::class) ;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
