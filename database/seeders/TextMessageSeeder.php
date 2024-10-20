<?php

namespace Database\Seeders;

use App\Models\TextMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TextMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = TextMessage::updateOrCreate(
            [
                'valid_message' => 'Your code is valid',
                'in_valid_message' => 'Your code is invalid',
                'verified_message' => 'This code is already verified by',
            ],
            [
                'valid_message' => 'Your code is valid',
                'in_valid_message' => 'Your code is invalid',
                'verified_message' => 'This code is already verified by',


            ]);
    }
}
