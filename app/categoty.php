<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoty extends Model
{
    protected $fillable = ['name','status','cat_img','cat_color','cat_id'];

    function cat_subcat(){
        return $this->hasMany(subcategory::class,'category_id','id');
    }

    function ibank(){
        return $this->hasMany(Ibank::class,'category_id','id');
    }
}
