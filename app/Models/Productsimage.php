<?php

namespace App\Models;
use App\Models\BaseModel;
class Productsimage extends BaseModel
{
    protected $fillable = ['id','product_id','name','imgs'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
