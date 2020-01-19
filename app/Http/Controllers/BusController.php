<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Employee;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = Bus::find($request->id);

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
        $date = Bus::create([
            'Brand_Bus' => $request->Brand_Bus,
            'State_Registration_Number' => $request->State_Registration_Number,
            'Year_Issue' => date('Y-m-d H:i', strtotime($request->Year_Issue)),
            'employee_id' => $request->employee_id,
            'Diagnostic_card' => $request->Diagnostic_card,
            'Validity_Date' => date('Y-m-d H:i', strtotime($request->Validity_Date)),
            'Amount_Place_Bus' => $request->Amount_Place_Bus,
            'Tachograph' => $request->Tachograph,
            'Glonas_GPS' => $request->Glonas_GPS,
        ]);

        $date['String'] = $date->Amount_Place_Bus . 'м ' . $date->Brand_Bus . ' ' .  date('d.m.Y', strtotime($date->Year_Issue)) . ' ' . $date->employee->Surname . ' ' . mb_substr($date->employee->Name, 0, 1)  . '. ' . mb_substr($date->employee->Middle_Name, 0, 1) . ($date->employee->Middle_Name != '' ? '.' : '');

        return $date;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Bus::find($request->id)->update([
            'Brand_Bus' => $request->Brand_Bus,
            'State_Registration_Number' => $request->State_Registration_Number,
            'Year_Issue' => date('Y-m-d H:i', strtotime($request->Year_Issue)),
            'employee_id' => $request->employee_id,
            'Diagnostic_card' => $request->Diagnostic_card,
            'Validity_Date' => date('Y-m-d H:i', strtotime($request->Validity_Date)),
            'Amount_Place_Bus' => $request->Amount_Place_Bus,
            'Tachograph' => $request->Tachograph,
            'Glonas_GPS' => $request->Glonas_GPS,
        ]);

        $date = Bus::find($request->id);

        $date['String'] = $date->Amount_Place_Bus . 'м ' . $date->Brand_Bus . ' ' .  date('d.m.Y', strtotime($date->Year_Issue)) . ' ' . $date->employee->Surname . ' ' . mb_substr($date->employee->Name, 0, 1)  . '. ' . mb_substr($date->employee->Middle_Name, 0, 1) . ($date->employee->Middle_Name != '' ? '.' : '');

        return $date;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Bus::find($request->id)->delete();

        return 1;
    }
}
