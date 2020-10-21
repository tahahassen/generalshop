<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Constraint\Count;

class City extends Model
{
    protected $table='cities';

    protected $primaryKey='id';

    public function country(){
        return $this->belongsTo(Country::class , $foreignKey='country_id' , $ownerKey='id');
    }

    public function state(){
        return $this->belongsTo(State::class , $foreignKey='state_id' , $ownerKey='id');
    }
}
