<?php

namespace Database\Seeders;

use App\Models\HotelRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HotelRoom::create([
            'room_number'   => '101',
            'hotel_id'      => 1,
            'room_type_id'  => 1
        
        ]);

        HotelRoom::create([
            'room_number'   => '102',
            'hotel_id'      => 1,
            'room_type_id'  => 2
        
        ]);

        HotelRoom::create([
            'room_number'   => '103',
            'hotel_id'      => 1,
            'room_type_id'  => 3
        
        ]);


        HotelRoom::create([
            'room_number'   => '110',
            'hotel_id'      => 2,
            'room_type_id'  => 1
        
        ]);

        HotelRoom::create([
            'room_number'   => '111',
            'hotel_id'      => 2,
            'room_type_id'  => 2
        
        ]);

        HotelRoom::create([
            'room_number'   => '112',
            'hotel_id'      => 2,
            'room_type_id'  => 3
        
        ]);


        HotelRoom::create([
            'room_number'   => '130',
            'hotel_id'      => 3,
            'room_type_id'  => 1
        
        ]);

        HotelRoom::create([
            'room_number'   => '131',
            'hotel_id'      => 3,
            'room_type_id'  => 2
        
        ]);

        HotelRoom::create([
            'room_number'   => '132',
            'hotel_id'      => 3,
            'room_type_id'  => 3
        ]);
    }
}
