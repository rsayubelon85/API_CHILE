<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name','price','availability','description','tags','add_information','sku','categorie_id','star_rating'
    ];

    //Relacion uno a muchos un article tiene solo una categorie
    public function Categorie(){
        return $this->belongsTo('\App\Models\Categorie');
    }

    //Relacion uno a muchos un producto puede estar en varias ordenes
    public function Orders(){
        return $this->hasMany('\App\Models\Order');
    }    

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(150)
              ->height(150)
              ->sharpen(10);
    }
}
