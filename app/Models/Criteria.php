<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    public $table = "criterias";
    protected $fillable = ['id','stt','name','content','img','hide_show'];
}