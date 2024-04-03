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
            [
                'role_id' => 4,
                'firstname' => 'Seller',
                'lastname' => 'Seller 1',
                'name' => 'Seller Seller 1',
                'phone_area_code' => '63',
                'phone_number' => '4',
                'email' => 'seller_1@gmail.com',
                'username' => 'seller1234',
                'ftl' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt('seller1234'),
                'profile_picture' => '/storage/user_profile_picture/seller_1.png'
            ],
            [
                'role_id' => 4,
                'firstname' => 'Seller',
                'lastname' => 'Seller 2',
                'name' => 'Seller Seller 2',
                'phone_area_code' => '63',
                'phone_number' => '3',
                'email' => 'seller_2@gmail.com',
                'username' => 'seller1234',
                'ftl' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt('seller1234'),
                'profile_picture' => '/storage/user_profile_picture/seller_2.png'
            ],
            [
                'role_id' => 4,
                'firstname' => 'Seller',
                'lastname' => 'Seller 3',
                'name' => 'Seller Seller 3',
                'phone_area_code' => '63',
                'phone_number' => '1',
                'email' => 'seller_3@gmail.com',
                'username' => 'seller1234',
                'ftl' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt('seller1234'),
                'profile_picture' => '/storage/user_profile_picture/seller_3.png'
            ],
            [
                'role_id' => 4,
                'firstname' => 'Seller',
                'lastname' => 'Seller 4',
                'name' => 'Seller Seller 4',
                'phone_area_code' => '63',
                'phone_number' => '2',
                'email' => 'seller_4@gmail.com',
                'username' => 'seller1234',
                'ftl' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt('seller1234'),
                'profile_picture' => '/storage/user_profile_picture/seller_4.png'
            ],
        ];

        foreach ($users as $value) {
            User::create($value);
        }
    }
}
