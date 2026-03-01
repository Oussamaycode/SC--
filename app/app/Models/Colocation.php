<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Colocation extends Model
{
    /** @use HasFactory<\Database\Factories\ColocationFactory> */
    use HasFactory;

    use HasUuids;

    protected $fillable=['name'];

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

    public function expenses(){
        return $this->hasMany(Colocation::class);
    }

    public function owner(){
        return $this->hasOne(User::class)->where('is_owner',true);
    }

}
