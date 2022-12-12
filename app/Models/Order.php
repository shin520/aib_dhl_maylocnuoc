<?php

namespace App\Models;

use App\Models\BaseModel;

class Order extends BaseModel
{
    protected $fillable = ['status','account_id','order_date','order_note','name','address','phone','email','order_total','status'];
    public function orderdetails()
    {
        return $this->hasMany('App\Models\Orderdetail');
    }
}
