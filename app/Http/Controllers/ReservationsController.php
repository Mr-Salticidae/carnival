<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservations.create')->with('');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error_message = null;
        $reservation_exists = Reservation::where([
            ['user_id', '=', $request->user()->id],
            ['reservation_date', '=', $request->input('date')]
        ])->exists();

        $reservation_per_user_count = Reservation::where('user_id', $request->user()->id)->count();
        $reservation_per_day_count = Reservation::where('reservation_date', $request->input('date'))->count();
        if ($reservation_exists) {
            //
        } elseif ($reservation_per_user_count >= 3) {
            //
        } elseif ($reservation_per_day_count >= 10) {
            //
        } else {
            $code_seed = $request->user()->id . $request->input('date') . date('Y-m-d H:i:s');
            Reservation::create([
                'user_id' => $request->user()->id,
                'reservation_date' => $request->input('date'),
                'reservation_code' => substr(md5($code_seed), 0, 6)
            ]);
        }
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
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
}
