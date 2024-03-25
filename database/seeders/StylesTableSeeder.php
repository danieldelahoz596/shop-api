<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Style;

class StylesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $styles = [
            ['name' => 'Retro'],
            ['name' => 'Vintage'],
            ['name' => 'Y2K'],
            ['name' => 'Streetwear'],
            ['name' => 'Athleisure'],
            ['name' => 'Casual'],
            ['name' => 'Formal'],
            ['name' => 'Glam'],
            ['name' => 'Cottage'],
            ['name' => 'Punk'],
            ['name' => 'Preppy & Chic'],
            ['name' => 'Utility'],
        ];

        foreach ($styles as $styles) {
            Style::create([
                'name' => $styles['name']
            ]);
        }
    }
}
