<?php

namespace App\Models;
use App\Models\BaseModel;

class Price extends BaseModel
{
	public $table = "prices";
    protected $fillable = ['id','type','stt','name','address','phone','email','subject','price','note','read'];
}
