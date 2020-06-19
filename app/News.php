<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * Get all of the News's Assets.
     */
    public function assets()
    {
        return $this->morphMany('App\Asset', 'assetable');
    }
}
