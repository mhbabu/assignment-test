<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoomBooking extends Model
{
    use HasFactory;

    protected $table = 'hotel_room_bookings';
    protected $fillable = [
        'id',
        'user_id',
        'booked_at',
        'booked_status',
        'created_at',
        'updated_at'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
