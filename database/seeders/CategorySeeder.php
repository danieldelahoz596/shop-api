<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Men'],
            ['name' => 'Women'],
            ['name' => 'Kids'],
            ['name' => 'Tops'],
            ['name' => 'Bottoms'],
            ['name' => 'Shoes'],
            ['name' => 'Shorts'],
        ];

        foreach ($categories as $category) {
            $slug = strtolower(str_replace(' ', '-', $category['name']));
            Category::create([
                'name' => $category['name'],
                'slug' => $slug,
                'status' => true
            ]);
        }
    }
}
