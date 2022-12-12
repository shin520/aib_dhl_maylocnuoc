<?php

namespace App\Models;
use App\Models\BaseModel;

class Slider extends BaseModel
{
    protected $fillable = ['id','type','title','url','stt','hide_show','published','status','img','icon'];
}
