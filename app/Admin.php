<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin  extends Authenticatable implements MustVerifyEmail 
{
    use Notifiable;
    use HasRoles;

    const REDIRECT_TO = 'admin/dashboard';
    
    protected $table = 'admins';

    protected $fillable = [
        'name', 'email', 'password', 'roles'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
