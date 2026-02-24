<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    /** @use HasFactory<\Database\Factories\ColocationFactory> */
    use HasFactory;

    use HasUuids;

    public function uniqueIds(): array
    {
        return ['token'];
    }

    public function memberships(){
       return  $this->hasMany(Membership::class);
    }

    public function users(){
       return $this->belongsToMany(User::class,'memberships');
    }
}
