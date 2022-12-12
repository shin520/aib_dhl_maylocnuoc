<?php

namespace App\Models;
use App\Models\BaseModel;

class Author extends BaseModel
{
    protected $fillable = ['id','type','view_count','name','content','hide_show','img','link_group','link_author','namebuttonone','namebuttontwo'];
}
