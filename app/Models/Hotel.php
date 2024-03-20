<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'status',
        'created_at',
        'updated_at'
    ];

    public function hotelRooms(){
        return $this->hasMany(HotelRoom::class, 'hotel_id', 'id');
    }

    
}
