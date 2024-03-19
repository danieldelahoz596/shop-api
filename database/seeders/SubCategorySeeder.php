<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::all()->pluck('id')->toArray();

        $subCategories = [
            ['name' => 'T-Shirt', 'category_id' => Arr::random($categoryIds)],
            ['name' => 'Pants', 'category_id' => Arr::random($categoryIds)],
            ['name' => 'Underwears', 'category_id' => Arr::random($categoryIds)],
            ['name' => 'Hats', 'category_id' => Arr::random($categoryIds)]
        ];

        foreach ($subCategories as $subCategory) {
            $slug = strtolower(str_replace(' ', '-', $subCategory['name']));
            SubCategory::create([
                'category_id' => $subCategory['category_id'],
                'name' => $subCategory['name'],
                'slug' => $slug,
                'status' => true
            ]);
        }
    }
}
