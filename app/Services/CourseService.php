<?php


namespace App\Services;


use App\Course;
use App\question;

class CourseService
{
    public function __construct()
    {

    }

    public function findById($id) {
        return Course::find($id);
    }

}
