<?php


namespace App\Services;


use App\News;

class NewsService
{
    public function findById($id) {
        return News::find($id);
    }

}
