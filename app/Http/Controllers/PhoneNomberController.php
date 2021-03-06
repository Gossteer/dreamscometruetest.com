<?php

namespace App\Http\Controllers;

use App\Phone_nomber;
use Illuminate\Http\Request;

class PhoneNomberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Phone_nomber::find($request->id);
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
        return Phone_nomber::create([
            'Phone_Number' => $request->Phone_Number,
            'Representative' => $request->Representative,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phone_nomber  $phone_nomber
     * @return \Illuminate\Http\Response
     */
    public function show(Phone_nomber $phone_nomber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phone_nomber  $phone_nomber
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone_nomber $phone_nomber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phone_nomber  $phone_nomber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Phone_nomber::find($request->id)->update([
            'Phone_Number' => $request->Phone_Number,
            'Representative' => $request->Representative,
        ]);

        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phone_nomber  $phone_nomber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Phone_nomber::find($request->id)->delete();

        return 1;
    }
}
