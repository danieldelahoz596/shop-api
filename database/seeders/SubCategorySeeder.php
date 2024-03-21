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
        $menWomenSubCats = [
            'Tops',
            'Bottoms',
            'Dresses',
            'Rompers and Bodysuits',
            'Outerwear',
            'Activewear',
            'Casual',
            'Formal',
            'Swimwear',
            'Undergarments',
            'Sleepwear',
            'Accessories'
        ];

        $kidsSubCats = [
            'Infants',
            'Toddlers',
            'Girls',
            'Boys'
        ];

        $menCategoryId = Category::where('slug', 'men')->first()->id;
        $womenCategoryId = Category::where('slug', 'women')->first()->id;
        $kidsCategoryId = Category::where('slug', 'kids')->first()->id;

        foreach ($menWomenSubCats as $subCategory) {
            $slug = strtolower(str_replace(' ', '-', $subCategory));
            SubCategory::create([
                'category_id' => $menCategoryId,
                'name' => $subCategory,
                'slug' => $slug,
                'status' => true
            ]);
            SubCategory::create([
                'category_id' => $womenCategoryId,
                'name' => $subCategory,
                'slug' => $slug,
                'status' => true
            ]);
        }

        foreach ($kidsSubCats as $subCategory) {
            $slug = strtolower(str_replace(' ', '-', $subCategory));
            SubCategory::create([
                'category_id' => $kidsCategoryId,
                'name' => $subCategory,
                'slug' => $slug,
                'status' => true
            ]);
        }
    }
}
