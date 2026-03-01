<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $fillable=['amount','description','user_id','categorie_id','date'];

    public function users(){
        return $this->belongsToMany(User::class,'dettes')->withPivot('amount','is_payed');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }
}
