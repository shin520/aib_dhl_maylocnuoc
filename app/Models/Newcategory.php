<?php

namespace App\Models;

use App\Models\BaseModel;

class Newcategory extends BaseModel

{
    protected $fillable = ['id','type','view_count','name','img','stt','descriptions','hide_show','show_nav','slug','title','keywords','description','status','articles_id'];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }
    public function submenu()
    {
        return $this->hasMany('App\Models\Category','parent_id');
    }
    public function post() {
        return $this->belongsToMany(Post::class);
    }
}