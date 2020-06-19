<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'status', 'user_id', 'created_at', 'updated_at'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
