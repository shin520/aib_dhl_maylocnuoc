<?php

namespace App\Models;

use App\Models\BaseModel;

class Orderdetail extends BaseModel
{
    protected $fillable = ['order_id','product_id','name','img','price','quantity','total_item'];
    public function order()
    {
        return $this->belongsToMany('App\Models\Order');
    }
    public function product(){
      	return $this->belongsTo('App\Models\Product');
    }
}
