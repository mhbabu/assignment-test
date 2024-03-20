<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HotelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::create([
            'name'          => 'Radisson',
            'slug'          => Str::slug('Radisson'),
            'address'       => 'Kurmitola, Dhaka'
        ]);

        Hotel::create([
            'name'          => 'Sheraton',
            'slug'          => Str::slug('Sheraton'),
            'address'       => 'Banani, Dhaka'
        ]);

        Hotel::create([
            'name'          => 'Serena',
            'slug'          => Str::slug('Serena'),
            'address'       => 'Banani, Dhaka'
        ]);

        Hotel::create([
            'name'          => 'Westin',
            'slug'          => Str::slug('Westin'),
            'address'       => 'Gulshan, Dhaka'
        ]);
    }
}
