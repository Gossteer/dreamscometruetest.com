<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = Route::find($request->id);
        $date->Time_Sending_From_Initial_Pop = date('H:i', strtotime($date->Time_Sending_From_Initial_Pop));
        $date->Time_Sending_From_End_Point = date('H:i', strtotime($date->Time_Sending_From_End_Point));

        return $date;
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
        $date = Route::create([
            'Map' => '123',
            'Itinerary' => $request->Itinerary,
            'Time_Sending_From_Initial_Pop' => date('H:i', strtotime($request->Time_Sending_From_Initial_Pop)),
            'Distination_From_Initial_Pop' => $request->Distination_From_Initial_Pop,
            'Distination_From_End_Point' => $request->Distination_From_End_Point,
            'Time_Sending_From_End_Point' => date('H:i', strtotime($request->Time_Sending_From_End_Point)),
            'Name_Car_Dorough_Dorog_Report_Transportation' => $request->Name_Car_Dorough_Dorog_Report_Transportation,
        ]);

        return $date;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {
         Route::find($request->id)->update([
            'Map' => '123',
            'Itinerary' => $request->Itinerary,
            'Time_Sending_From_Initial_Pop' => date('H:i', strtotime($request->Time_Sending_From_Initial_Pop)),
            'Distination_From_Initial_Pop' => $request->Distination_From_Initial_Pop,
            'Distination_From_End_Point' => $request->Distination_From_End_Point,
            'Time_Sending_From_End_Point' => date('H:i', strtotime($request->Time_Sending_From_End_Point)),
            'Name_Car_Dorough_Dorog_Report_Transportation' => $request->Name_Car_Dorough_Dorog_Report_Transportation,
        ]);

        $date = Route::find($request->id);

        return $date;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        //
    }
}
