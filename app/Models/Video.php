<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
class Video extends BaseModel
{
    protected $fillable = ['id','type','name','url_code','link','stt','is_featured','hide_show','status'];
}
