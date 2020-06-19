<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mockinformation extends Model
{
    protected $fillable = ['wrong_ans','right_ans','time','status', 'position'];
    function mockinfo_mockques(){
        return $this->hasMany(mockquestion::class,'exam_id','exam_id');
    }

    function mockinfo_recall(){
        return $this->hasOne(recallmodel::class,'id','recall_id');
    }
}
