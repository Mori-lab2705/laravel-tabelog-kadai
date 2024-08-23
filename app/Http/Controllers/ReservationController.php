<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Shop;

class ReservationController extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number'  => 'required',
            'date' => 'required'
        ]);

        $reservation = new Reservation();
        $reservation->date = $request->input('date');
        $reservation->number =$request->input('number');
        $reservation->shop_id = $request->input('shop');
        $reservation->user_id = Auth::user()->id;
        $reservation->save();

        return back();
    }

    public function index($user_id)
    {
        $user = Auth::user();
        $reservations = $user->reservations;
        

        return view('reservations.index', compact('user', 'reservations', )); 
        
    }

    public function edit($id)
    { 
        $reservation = Reservation::findOrFail($id);

        return view('reservations.edit', compact('reservation'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect('/users/userID/reservations')->with('success', '予約がキャンセルされました。');
    }
    

      
}
