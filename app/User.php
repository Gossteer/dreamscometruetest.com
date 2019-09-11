<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\InvoicePaid as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password', 'Processing_Personal_Data', 'Notifications', 'Type_User'
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

    public function customer()
    {
        return $this->hasOne('App\Customer', 'users_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'users_id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'roles_id' );
    }

}
