<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'last_time_message'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id')->select('id', 'firstname', 'lastname', 'name', 'username', 'profile_picture');
    }

    public function receiver()
    {
        return $this->hasOne(User::class, 'id', 'receiver_id')->select('id', 'firstname', 'lastname', 'name', 'username', 'profile_picture');
    }


}
