<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
class Product extends BaseModel
{
    protected $fillable = ['id','type','hide_show','name','product_code','memory','color','stt','descriptions','is_featured','is_new','content','slug','title','keywords','description','status','published','user_id','img','imgs','img_resize','view_count','price','selling_price','discount','old_price','prices','procatone_id','procattwo_id','procatthree_id','thumb'];

    public function productcategories()
    {
        return $this->belongsToMany('App\Models\Productcategory');
    }
    // public function images()
    // {
    //     return $this->belongsToMany('App\Models\Image');
    // }
    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function product_category () {
        return $this->belongsToMany(Productcategory::class);
    }
    public function orderdetails(){
        return $this->hasMany('App\Models\Orderdetail');
    }

    public function categorythree () {
        return $this->belongsTo(Procatthree::class, 'procatthree_id', 'id');
    }

    public function categoryone () {
        return $this->belongsTo(Procatone::class, 'procatone_id', 'id');
    }
}
