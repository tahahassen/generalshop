<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table='countries';

    protected $primaryKey='id';

    public function cities(){
        return $this->hasMany(City::class ,$foreignKey='country_id',$localKey='id');
    }

    public function states(){
        return $this->hasMany(State::class ,$foreignKey='country_id',$localKey='id');
    }
}
