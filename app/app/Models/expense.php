<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $fillable=['amount','description','user_id','categorie_id'];

    public function users(){
        return $this->belongsToMany(User::class,'dettes');
    }

    public function categories(){
        return $this->hasMany(User::class);
    }
}
