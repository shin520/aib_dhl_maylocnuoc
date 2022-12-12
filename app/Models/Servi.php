<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
class Servi extends BaseModel
{
    protected $fillable = ['id','type','view_count','name','stt','descriptions','is_featured','is_new','hide_show','content','slug','title','keywords','description','status','published','user_id','img','img_resize','price','prices'];

    public function newcategories()
    {
        return $this->belongsToMany('App\Models\Newcategory');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function post_newcategory() {
        return $this->belongsToMany(Newcategory::class);
    }
}
