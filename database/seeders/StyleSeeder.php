<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Style;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $styles = [
            [
                'name' => 'Boho-Chic',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_1.png'
            ],
            [
                'name' => 'Classic',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_2.png'
            ],
            [
                'name' => 'Girly Girl',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_3.png'
            ],
            [
                'name' => 'Androgynous',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_4.png'
            ],
            [
                'name' => 'Girl Next Door',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_5.png'
            ],
            [
                'name' => 'Sporty',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_6.png'
            ],
            [
                'name' => 'Artsy',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_7.png'
            ],
            [
                'name' => 'Business Casual',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_8.png'
            ],
            [
                'name' => 'Goth Fashion',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_9.png'
            ],
            [
                'name' => 'Black Tie',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_10.png'
            ],
            [
                'name' => 'Grunge',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_11.png'
            ],
            [
                'name' => 'Vintage Clothing',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_12.png'
            ],
            [
                'name' => 'Casual',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_13.png'
            ],
            [
                'name' => 'Formal',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_14.png'
            ],
            [
                'name' => 'Street',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_15.png'
            ],
            [
                'name' => 'Elegant',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_16.png'
            ],
            [
                'name' => 'Preppy',
                'description' => 'lorem ipsum',
                'image_url' => '/storage/styles_images/style_17.png'
            ],
        ];

        foreach ($styles as $value) {
            Style::create($value);
        }
    }
}
