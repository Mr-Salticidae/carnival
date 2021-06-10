<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ReservationsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->user() == null) {
            return redirect('login');
        }
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reservation_exists = Reservation::where([
            ['user_id', '=', $request->user()->id],
            ['reservation_date', '=', $request->input('date')]
        ])->exists();

        $reservation_per_user_count = Reservation::where('user_id', $request->user()->id)->count();
        $reservation_per_day_count = Reservation::where('reservation_date', $request->input('date'))->count();
        if ($reservation_exists) {
            $error_message = 'You have already reserved this day.';
        } elseif ($reservation_per_user_count >= 3) {
            $error_message = 'The number of reservations of you has reached the limit (3).';
        } elseif ($reservation_per_day_count >= 10) {
            $error_message = 'The number of reservations on this day has reached the limit (10).';
        } else {
            $code_seed = $request->user()->id . $request->input('date') . date('Y-m-d H:i:s');
            Reservation::create([
                'user_id' => $request->user()->id,
                'reservation_date' => $request->input('date'),
                'reservation_code' => substr(md5($code_seed), 0, 6)
            ]);
            $error_message = null;
        }
        if ($error_message != null) {
            return redirect('/dashboard')->with('error_message', $error_message);
        } else {
            return redirect('/dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $reservation = Reservation::find($request->input('reservation_id'))->first();
        $reservation->delete();

        return redirect('/dashboard');
    }

    public function checkin()
    {
        return view('reservations.verify');
    }

    public function verify(Request $request)
    {
        $reservation_code = $request->input('reservation_code');
        $password = $request->input('password');
        $reservation_exists = Reservation::where('reservation_code', $reservation_code)->exists();
        if (!$reservation_exists) {
            $error_message = 'Reservation does not exist.';
        } else {
            $target_user_id = Reservation::where('reservation_code', $reservation_code)->pluck('user_id')->toArray()[0];
            $target_password = User::where('id', $target_user_id)->pluck('password')->toArray()[0];
            $password_verified = Hash::check($password, $target_password);
            if (!$password_verified) {
                $error_message = 'Password is not correct.';
            } else {
                $status = Reservation::where('reservation_code', $reservation_code)->pluck('status')->toArray()[0];
                if ($status != 'Valid') {
                    $error_message = 'Reservation is ' . $status;
                } else {
                    Reservation::where('reservation_code', $reservation_code)->update(['status' => 'Verified']);
                    $username = User::where('id', $target_user_id)->pluck('username')->toArray()[0];
                    $error_message = null;
                }
            }
        }

        if ($error_message != null) {
            return redirect('/checkin')->with('error_message', $error_message);
        } else {
            return redirect('/success')->with('username', $username);
        }
    }

    public function success()
    {
        return view('successToCheckin');
    }
}
