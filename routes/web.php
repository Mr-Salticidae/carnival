<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationsController;
use App\Models\Reservation;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $reservations = DB::update('update reservations set status = "Passed" where user_id = ? and status = "Valid" and reservation_date < ?', [Auth::id(), env("CURRENT_DAY")]);
    $reservations = DB::select('select * from reservations where user_id = ? order by reservation_date', [Auth::id()]);
    $reservations = array($reservations)[0];
    return view('dashboard', ['reservations' => $reservations]);
})->middleware(['auth'])->name('dashboard');

Route::get('/create', [ReservationsController::class, 'create']);

Route::delete('/delete', [ReservationsController::class, 'destroy']);

Route::get('/checkin', [ReservationsController::class, 'checkin'])->name('checkin');

Route::post('/store', [ReservationsController::class, 'store']);

Route::post('/verify', [ReservationsController::class, 'verify']);

Route::get('/success', [ReservationsController::class, 'success']);

require __DIR__ . '/auth.php';
