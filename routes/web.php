<?php

use App\Http\Controllers\dashboard\MemberController;
use App\Http\Controllers\dashboard\MyOrderController;
use App\Http\Controllers\dashboard\ProfileController;
use App\Http\Controllers\dashboard\RequestController;
use App\Http\Controllers\dashboard\ServiceController;
use App\Http\Controllers\landing\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// di taro sebelum Route::resourece agar function tersebut bisa di panggil
Route::get('explore', LandingController::class, 'explore')->name('explore.landing');
Route::get('booking/{id}', LandingController::class, 'booking')->name('booking.landing');
Route::get('detail/{id}', LandingController::class, 'detail')->name('detail.landing');
Route::get('detail_booking/{id}', LandingController::class, 'detail_booking')->name('detail_booking.landing');

Route::resource('/', LandingController::class);

Route::group(['prefix' => 'member', 'as' => 'member.','middleware' => ['auth:sanctum', 'verified']],function(){

    Route::resource('dashboard',MemberController::class);

    Route::resource('service',ServiceController::class);

    Route::get('approve_request/{id}',RequestController::class, 'approve')->name('approve.request');

    Route::resource('request', RequestController::class);

    Route::get('accept/order/{id}', MyOrderController::class, 'accepted')->name('accept.order');
    Route::get('reject/order/{id}', MyOrderController::class, 'rejected')->name('reject.order');

    Route::resource('order', MyOrderController::class);

    Route::get('delete_photo', ProfileController::class, 'delete')->name('delete.photo.profile');
    Route::resource('profile', ProfileController::class);
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
