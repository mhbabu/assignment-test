<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;
    protected $table = 'hotel_rooms';
    protected $fillable = [
        'id',
        'hotel_id',
        'room_type_id',
        'room_number',
        'status',
        'created_at',
        'updated_at'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }
}
