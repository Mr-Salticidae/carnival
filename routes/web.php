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
    $reservations = DB::select('select * from reservations where user_id = ? order by reservation_date', [Auth::id()]);
    $reservations = array($reservations)[0];
    return view('dashboard', ['reservations' => $reservations]);
})->middleware(['auth'])->name('dashboard');

Route::resource('reservations', ReservationsController::class);

Route::get('/checkin', [ReservationsController::class, 'checkin'])->name('checkin');

Route::post('/reservations/verify', [ReservationsController::class, 'verify']);

require __DIR__ . '/auth.php';
