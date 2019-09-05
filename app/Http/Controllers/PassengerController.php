<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Passenger;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PassengerController extends Controller
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
    public function create(Request $request)
    {
        $aa = Customer::find(Auth::user()->id);
        $Preferential_Terms = '';
        $dtr = $aa->Date_Birth_Customer;
        $diff = Carbon::parse($dtr)->diff(Carbon::parse(Carbon::today()->toDateString()));
        if($diff->y < 18)
            $Preferential_Terms = 1;
        else
            $Preferential_Terms = 0;
        $user = Auth::user()->id;
        $attribute = [
            'tours_id' => $request->tours_id,
            'customers_id' => $user,
            'Preferential_Terms' => $Preferential_Terms,
        ];
        Passenger::create($attribute);
        return redirect()->route('/packages');
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
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passenger $passenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passenger $passenger)
    {
        //
    }
}
