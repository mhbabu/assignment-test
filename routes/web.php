<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomBookingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('hotel/{slug}', [HomeController::class, 'details'])->name('hotel-details');
Route::get('hotel/{slug}/room-{roomNumber}/bookings', [HomeController::class, 'roomBooking']);
Route::get('available-hotel-rooms', [HomeController::class, 'getAvailableRooms'])->name('available-hotel-rooms'); // ajax request route

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('room-bookings/store', [RoomBookingController::class, 'roomBooking'])->name('room-bookings.store');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('approve-room-booking/{roomId}', [RoomBookingController::class, 'approvedRequest'])->name('approve-booking-request');
    Route::get('reject-room-booking/{roomId}', [RoomBookingController::class, 'rejectRequest'])->name('reject-booking-request');
});
