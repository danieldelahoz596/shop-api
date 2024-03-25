<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Condition;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conditions = [
            ['name' => 'Like New'],
            ['name' => 'Used - Excellent'],
            ['name' => 'Used - Good'],
            ['name' => 'Used - Fair'],
        ];

        foreach ($conditions as $conditions) {
            Condition::create([
                'name' => $conditions['name']
            ]);
        }
    }
}
