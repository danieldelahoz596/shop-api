<?php

namespace Database\Seeders;

use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserAddress::create([
            'user_id' => 3,
            'street' => 'Somewhere St.',
            'city' => 'Altavas',
            'province' => 'Aklan',
            'region' => 'VI',
            'zip_code' => 5616,
            'is_default' => 1
        ]);
    }
}
