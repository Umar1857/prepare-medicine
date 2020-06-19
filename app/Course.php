<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * Get all of the Course's Assets.
     */
    public function assets()
    {
        return $this->morphMany('App\Asset', 'assetable');
    }
}
