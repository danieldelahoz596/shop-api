<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $users = [
            [
                'role_id' => 1,
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'phone_area_code' => '63',
                'phone_number' => '9984863306',
                'name' => 'Super Admin',
                'email' => 'super.admin@buudl.com',
                'username' => 'superadmin',
                'ftl' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt('@dm1n18tR@t0r$'),
            ],
            [
                'role_id' => 2,
                'firstname' => 'Normal',
                'lastname' => 'Admin',
                'phone_area_code' => '63',
                'phone_number' => '09984863307',
                'name' => 'Normal Admin',
                'email' => 'admin@buudl.com',
                'username' => 'admin',
                'ftl' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt('@dm1n18tR@t0r$'),
            ],
            [
                'role_id' => 1,
                'firstname' => 'Paul Christian',
                'lastname' => 'De Guzman',
                'name' => 'Paul Christian De Guzman',
                'phone_area_code' => '63',
                'phone_number' => '09984863309',
                'email' => 'paul@buudl.com',
                'username' => 'nyorpablo',
                'ftl' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt('@dm1n18tR@t0r$'),
            ],
        ];

        foreach ($users as $value) {
            User::create($value);
        }
    }
}
