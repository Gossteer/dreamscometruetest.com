<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Employee;
use App\Transort;
use Carbon\Carbon;
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
        $date->Year_Issue = date('d-m-Y', strtotime($date->Year_Issue));
        $date->Validity_Date = date('d-m-Y', strtotime($date->Validity_Date));

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
        // $attribute = $request->all();
        // $attribute['date'] = Carbon::today();

        // \Validator::make($attribute, [
        //     'Year_Issue' => ['before_or_equal:date'],
        //     'Validity_Date' => ['after_or_equal:date']
        // ],[
        //     'Year_Issue.before_or_equal' => 'Дата выпуска не может быть позже нынешней даты!',
        //     'Validity_Date.after_or_equal' => 'Срок годности истёк!',
        //     'date' => 'Укажите поажалуйста правильную дату!',
        // ])->validate();

        $date = Bus::firstOrCreate([
            'Title_Transport' => $request->Title_Transport,
            'Description' => $request->Description,
            'Company' => $request->Company,
            'Classes' => $request->Classes,
            'Type_Transport' => $request->Type_Transport,
            'State_Registration_Number' => $request->State_Registration_Number,
            'Year_Issue' => date('Y-m-d', strtotime($request->Year_Issue)) ?? null,
            'employee_id' => $request->employee_id,
            'Diagnostic_card' => $request->Diagnostic_card,
            'Validity_Date' => date('Y-m-d', strtotime($request->Validity_Date)) ?? null,
            'Amount_Place_Bus' => $request->Amount_Place_Bus,
            'Tachograph' => $request->Tachograph ?? 0,
            'Glonas_GPS' => $request->Glonas_GPS ?? 0,
        ]);

        $date->update([
            'LogicalDelete' => 0,
        ]);

        $date['String'] = $request->Type_Transport . ' ' . $date->Title_Transport . ' ' . $date->Amount_Place_Bus . 'м ';
        if(($request->Type_Transport == 'Автобус' or $request->Type_Transport == 'Микроавтобус') and ($date->employee != null))
            $date['String'] .= date('d.m.Y', strtotime($date->Year_Issue)) . ' ' . $date->employee->Surname . ' ' . mb_substr($date->employee->Name, 0, 1)  . '. ' . mb_substr($date->employee->Middle_Name, 0, 1) . ($date->employee->Middle_Name != '' ? '.' : '');
        

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
        // $attribute = $request->all();
        // $attribute['date'] = Carbon::today();

        // \Validator::make($attribute, [
        //     'Year_Issue' => ['date','before_or_equal:date'],
        //     'Validity_Date' => ['date']
        // ],[
        //     'Year_Issue.before_or_equal' => 'Дата выпуска не может быть позже нынешней даты!',
        //     'date' => 'Укажите поажалуйста правильную дату!',
        // ])->validate();

        Bus::find($request->id)->update([
            'Title_Transport' => $request->Title_Transport,
            'Description' => $request->Description,
            'Company' => $request->Company,
            'Classes' => $request->Classes,
            'Type_Transport' => $request->Type_Transport,
            'State_Registration_Number' => $request->State_Registration_Number,
            'Year_Issue' => date('Y-m-d', strtotime($request->Year_Issue)) ?? null,
            'employee_id' => $request->employee_id,
            'Diagnostic_card' => $request->Diagnostic_card,
            'Validity_Date' => date('Y-m-d', strtotime($request->Validity_Date)) ?? null,
            'Amount_Place_Bus' => $request->Amount_Place_Bus,
            'Tachograph' => $request->Tachograph ?? 0,
            'Glonas_GPS' => $request->Glonas_GPS ?? 0,
        ]);

        $date = Bus::find($request->id);
        $date['Main_Transort'] = $request->Main_Transort;

        $date['String'] = $request->Type_Transport . ' ' . $date->Title_Transport . ' ' . $date->Amount_Place_Bus . 'м ';
        if(($request->Type_Transport == 'Автобус' or $request->Type_Transport == 'Микроавтобус') and ($date->employee != null))
            $date['String'] .= date('d.m.Y', strtotime($date->Year_Issue)) . ' ' . $date->employee->Surname . ' ' . mb_substr($date->employee->Name, 0, 1)  . '. ' . mb_substr($date->employee->Middle_Name, 0, 1) . ($date->employee->Middle_Name != '' ? '.' : '');

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
        Bus::find($request->id)->update([
            'LogicalDelete' => 1,
        ]);

        if(Transort::whereRaw('buses_id = ? and tour_id = ?', [$request->id, $request->tour_id])->exists()){
            Transort::whereRaw('buses_id = ? and tour_id = ?', [$request->id, $request->tour_id])->delete();
        }

        return $request->buses_id;
    }
}
