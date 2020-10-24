<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable=[
        'user_id','product_id','stars',
        'review',
    ];

    public function customer(){
        return $this->belongsTo(User::class, $foreignKey='user_id', $localKey='id');
    }

    public function product(){
        return $this->belongsTo(Product::class,$foreignKey='product_id', $localKey='id');
    }

    public function humanFormattedDate(){
        return Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
    }
}
