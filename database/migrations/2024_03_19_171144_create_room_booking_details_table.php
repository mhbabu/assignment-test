<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('room_booking_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_room_booking_id')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->date('check_in_date')->nullable();
            $table->date('check_out_date')->nullable();
            $table->foreign('hotel_room_booking_id')->references('id')->on('hotel_room_bookings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_booking_details');
    }
};
