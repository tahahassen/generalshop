<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $fillable=['unit_code','unit_name'];

    public function products(){
        return $this->hasMany(Product::class , $foreignKey= 'unit', $localKey='id');
    }

    public function formatted(){
        return $this->unit_name.' - '.$this->unit_code;
    }


}
