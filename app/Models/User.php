<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'firstname',
        'lastname',
        'name',
        'gender',
        'birthday',
        'phone_area_code',
        'phone_number',
        'email',
        'address',
        'is_deleted',
        'email_verified_at',
        'username',
        'ftl',
        'profile_picture',
        'lastlogin',
        'password',
        'is_online',
        'email_verify_token',
        'forgot_password_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verify_token',
        'forgot_password_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'lastlogin' => 'datetime',
        'password' => 'hashed',
        'email_verify_token' => 'hashed',
        'forgot_password_token' => 'hashed',
    ];
}
