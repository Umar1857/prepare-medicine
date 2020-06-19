<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * Get all of the Blog's Assets.
     */
    public function assets()
    {
        return $this->morphMany('App\Asset', 'assetable');
    }
}
