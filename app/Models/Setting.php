<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
class Setting extends BaseModel
{
    protected $fillable = ['id','type','title','nameindex','keywords','description','logoindex','header','img','faviconindex','faviconadmin','copyright','facebook','twitter','youtube','uidfbadmin','appidfb','codehead','codebody','idanalytics','googlesiteverification','latitude','longitude','titleadmin','logoadmin','email','website','web','address','hotline_1','hotline_2','hotline_3','href_1','href_2','href_3','lang','locale','author','robots','maps','maps_1'];
}
