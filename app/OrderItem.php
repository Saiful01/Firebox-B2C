<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    public $timestamps=true;
    protected $guarded=[];


/*    public function statuses()
    {
       $this->hasMany('order_item_id','order_item_id');
    }*/
}
