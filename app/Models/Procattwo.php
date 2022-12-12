<?php

namespace App\Models;

use App\Models\BaseModel;

class Procattwo extends BaseModel

{
    protected $fillable = ['id','parent_id','type','view_count','name','img','stt','descriptions','hide_show','show_nav','is_featured','slug','title','keywords','description','status','products_id','procatone_id'];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
    // public function submenu()
    // {
    //     return $this->hasMany('App\Models\Procattwo','parent_id');
    // }
    public function chils()
    {
        return $this->hasMany(Procattwo::class,'parent_id','id');
    }
    public function child()
    {
        return $this->hasMany(self::class,'parent_id')->with('child');
    }

    public function product() {
        return $this->belongsToMany(Product::class, 'product_productcategory');
    }
    public function procatones()
    {
        return $this->belongsToMany('App\Models\Procatone');
    }
    public function procatone()
    {
        return $this->belongsTo('App\Models\Procatone');
    }
    public function procatthrees()
    {
        return $this->hasMany('App\Models\Procatthree');
    }
}