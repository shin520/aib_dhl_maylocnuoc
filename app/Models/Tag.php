<?php

namespace App\Models;
use App\Models\BaseModel;
class Tag extends BaseModel
{
    protected $fillable = ['id','name','descriptions','hide_show','slug','title','keywords','description','status','article_id'];
    public function articles()
    {
        return $this->belongsToMany('App\Models\Article');
    }
}
