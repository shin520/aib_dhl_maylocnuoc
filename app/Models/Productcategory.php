<?php

namespace App\Models;

use App\Models\BaseModel;

class Productcategory extends BaseModel

{
    protected $fillable = ['id','parent_id','type','view_count','name','img','stt','descriptions','hide_show','show_nav','is_featured','slug','title','keywords','description','status','products_id'];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
    // public function submenu()
    // {
    //     return $this->hasMany('App\Models\Productcategory','parent_id');
    // }
    public function chils()
    {
        return $this->hasMany(Productcategory::class,'parent_id','id');
    }
    public function child()
    {
        return $this->hasMany(self::class,'parent_id')->with('child');
    }

    public function product() {
        return $this->belongsToMany(Product::class);
    }
}