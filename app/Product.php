<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable=[
        'title','description','unit','price',
        'total',
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function category(){
        return $this->belongsTo(category::class); 
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function has_unit(){
        return $this->belongsTo(Unit::class , $foreignKey = 'unit' , $ownerKey='id');
    }

    public function jsonOptions(){
        return json_decode($this->options);
    }
}
