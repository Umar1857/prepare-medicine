<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'f_name', 's_name','school','country', 'email', 'password','gender','expeir_date', 'free_user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function get_country(){
        return $this->belongsTo('\App\country', 'country', 'id');
    }

    public function contact() {
        return $this->hasMany('App\Contact');
    }

    public function ticket() {
        return $this->hasMany('App\Ticket');
    }

    public function plabcourse() {
        return $this->hasMany('App\PlabCourse');
    }

}
