<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user_subscriptions = DB::table('subscriptions')->get();
        $number = DB::table('subscriptions')->where('stripe_id', Auth::user()->id)->count();

        $count = $user_subscriptions->count();

        $count += 1;
        $number += 1;

        $price_total = 0;
        $qty_total = 0;

        foreach ($cart as $c) {
            $price_total += $c->qty * $c->price;
            $qty_total += $c->qty;
        }

        Cart::stripe_id(Auth::user()->id)->store($count);

        DB::table('shoppingcart')->where('stripe_id', Auth::user()->id)
             ->where('number', null)
             ->update(
                 [
                     'number' => $number,
                     'price_total' => $price_total,
                     'updated_at' => date("Y/m/d H:i:s")
                 ]
             );
    }
}
