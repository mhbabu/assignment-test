<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomType::create([
            'name' => 'One Bed'
        ]);

        RoomType::create([
            'name' => 'Two Bed'
        ]);

        RoomType::create([
            'name' => 'Three Bed'
        ]);

        RoomType::create([
            'name' => 'Four Bed'
        ]);

    }
}
