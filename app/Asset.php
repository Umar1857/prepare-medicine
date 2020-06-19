<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public function assetable()
    {
        return $this->morphTo();
    }
}
