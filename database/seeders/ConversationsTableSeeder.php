<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Conversation::create([
            'user_one' => 1,
            'user_two' => 2
        ]);
        Conversation::create([
            'user_one' => 1,
            'user_two' => 3
        ]);
    }
}
