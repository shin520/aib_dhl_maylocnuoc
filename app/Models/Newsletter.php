<?php

namespace App\Models;
use App\Models\BaseModel;

class Newsletter extends BaseModel
{
    protected $fillable = ['id','stt','email','read','note'];
}
