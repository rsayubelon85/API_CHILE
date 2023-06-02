<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    //Relacion uno a muchos una categoria puede estar en varios articulos
    public function Articles(){
        return $this->hasMany('\App\Models\Article');
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
