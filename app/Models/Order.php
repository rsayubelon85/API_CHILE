<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['article_id','user_id','cantidad'];

    protected $hidden = [
        'created_at',
    ];
    
    //Relacion uno a muchos una orden tiene solo una articulo
    public function Article(){
        return $this->belongsTo('\App\Models\Article');
    }

    //Relacion uno a muchos una orden tiene solo un usuario
    public function User(){
        return $this->belongsTo('\App\Models\User');
    } 
}
