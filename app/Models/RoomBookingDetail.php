<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBookingDetail extends Model
{
    use HasFactory;

    protected $table = 'room_booking_details';
    protected $fillable = [
        'id',
        'hotel_room_booking_id',
        'room_id',
        'check_in_date',
        'check_out_date',
        'created_at',
        'updated_at'
    ];
}
