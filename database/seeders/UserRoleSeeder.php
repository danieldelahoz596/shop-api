<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'role_name' => 'Super Admin',
            ],
            [
                'role_name' => 'Admin',
            ],
            [
                'role_name' => 'User',
            ],
        ];
        foreach ($roles as $value) {
            UserRole::create($value);
        }
    }
}
