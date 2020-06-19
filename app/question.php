<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{

    protected $fillable = ['question','cat_id','ans','explanation','hint','status','search_id'];

    function question_ans(){
        return $this->hasMany(answer::class,'ques_id','id');
    }

    function question_comment(){
        return $this->hasMany(comment::class,'question_id','id');
    }

    function question_revision(){
        return $this->hasOne(revision::class,'ques_id','id');
    }
    function question_revisions(){
        return $this->hasMany(revision::class,'ques_id','id');
    }

    function question_flag(){
        return $this->hasMany(flag::class,'ques_id','id');
    }

    /**
     * Get all of the Question's Assets.
     */
    public function assets()
    {
        return $this->morphMany('App\Asset', 'assetable');
    }
}
