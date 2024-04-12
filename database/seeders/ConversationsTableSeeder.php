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
            'sender_id' => 1,
            'receiver_id' => 2
        ]);
        Conversation::create([
            'sender_id' => 1,
            'receiver_id' => 3
        ]);
    }
}
