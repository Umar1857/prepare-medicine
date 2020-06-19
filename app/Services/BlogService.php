<?php


namespace App\Services;


use App\Blog;

class BlogService
{
    public function findById($id) {
        return Blog::find($id);
    }

}
