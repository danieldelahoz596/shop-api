<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'log_user_id',
        'log_device_name',
        'log_browser',
        'log_ipaddress',
        'log_page_visit',
        'log_country',
        'log_city',
        'log_state',
        'log_postal_code',
        'log_type',
        'log_description',
        'log_name',
        'is_deleted',
        'log_latitude',
        'log_longitude'
    ];
}
