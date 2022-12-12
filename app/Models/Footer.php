<?php

namespace App\Models;
use App\Models\BaseModel;

class Footer extends BaseModel
{
    protected $fillable = ['id','type','name','descriptions','slug','content','hide_show','title','keywords','description','img'];
}
