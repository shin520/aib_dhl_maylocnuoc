<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class About extends BaseModel
{
	// protected $table = 'About';
    protected $fillable = ['id','type','name','name_en','descriptions','descriptions_en','slug','content','content_en','hide_show','title','title_en','keywords','keywords_en','description','description_en','img','view_count'];
}
