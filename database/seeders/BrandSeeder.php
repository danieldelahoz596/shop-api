<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Coach', 'brand_logo' => 'brand1.svg'],
            ['name' => 'Balenciaga', 'brand_logo' => 'brand2.svg'],
            ['name' => 'YSL', 'brand_logo' => 'brand3.svg'],
            ['name' => 'Nike', 'brand_logo' => 'brand4.svg']
        ];

        foreach ($brands as $brand) {
            $slug = strtolower(str_replace(' ', '-', $brand['name']));
            Brand::create([
                'name' => $brand['name'],
                'slug' => $slug,
                'brand_logo' => $brand['brand_logo'],
                'status' => true
            ]);
        }
    }
}
