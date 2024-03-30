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
            ],
            [
                'name' => 'Classic',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Girly Girl',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Androgynous',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Girl Next Door',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Sporty',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Artsy',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Business Casual',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Goth Fashion',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Black Tie',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Grunge',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Vintage Clothing',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Casual',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Formal',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Street',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Elegant',
                'description' => 'lorem ipsum',
            ],
            [
                'name' => 'Preppy',
                'description' => 'lorem ipsum',
            ],
        ];

        foreach ($styles as $value) {
            Style::create($value);
        }
    }
}
