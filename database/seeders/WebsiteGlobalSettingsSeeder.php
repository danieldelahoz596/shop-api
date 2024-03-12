<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebsiteGlobalSettings;

class WebsiteGlobalSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'name' => 'site_name',
                'val' => 'Buudl',
            ],
        ];

        foreach($settings as $value){
            WebsiteGlobalSettings::create($value);
        }
    }
}
