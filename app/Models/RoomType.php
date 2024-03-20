<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $table = 'room_types';
    protected $fillable = [
        'id',
        'name',
        'status',
        'created_at',
        'updated_at'
    ];
}
