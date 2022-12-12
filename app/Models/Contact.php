<?php

namespace App\Models;
use App\Models\BaseModel;

class Contact extends BaseModel
{
    protected $fillable = ['id','type','view_count','name','descriptions','content','hide_show','title','keywords','description','img'];
}
