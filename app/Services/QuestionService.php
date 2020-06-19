<?php


namespace App\Services;


use App\question;

class QuestionService
{
    public function __construct()
    {

    }

    public function findById($id) {
        return question::find($id);
    }

}
