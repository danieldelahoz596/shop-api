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
        'style_id',
        'category_id',
        'item_id',
        'otp_code',
        'otp_sent_time',
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
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->hasOne(UserRole::class, 'role_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function userAddress()
    {
        return $this->hasMany(UserAddress::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function styles()
    {
        return $this->hasMany(Style::class, 'style_id');
    }
    public function category()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function offers()
    {
        return $this->hasMany(MakeOffer::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
