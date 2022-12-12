<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Customer extends BaseModel
{
    protected $fillable = ['id','type','name','work','descriptions','stt','hide_show','content','status','img','img_resize'];
}
