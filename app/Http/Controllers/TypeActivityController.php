<?php

namespace App\Http\Controllers;

use App\Partner;
use App\Type_Activity;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;

class TypeActivityController extends Controller
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
        \Validator::make($request->all(), [
            'Name_Type_Activity' => ['required', 'unique:type_activities', 'min:2', 'max:191'],
        ],[
            'Name_Type_Activity.unique' => 'Уже существует!',
            'Name_Type_Activity.required' => 'Обязательно к заполнению!',
        ])->validate();

       $res = Type_Activity::Create([
         'Name_Type_Activity' => $request->Name_Type_Activity,
       ]);

       $data = ['id' => $res->id, 'Name_Type_Activity' => $request->Name_Type_Activity];

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type_Activity  $type_Activity
     * @return \Illuminate\Http\Response
     */
    public function partnerupdate(Request $request)
    {
        Partner::find($request->partner_id)->update([
            'type_activities_id' => $request->type_activities_id,
        ]);

        $data = ['id' => $request->type_activities_id];

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type_Activity  $type_Activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Type_Activity $type_Activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type_Activity  $type_Activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_Activity $type_Activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type_Activity  $type_Activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Type_Activity::find($request->typeactivity)->delete();

        $datas = Type_Activity::all();
        return $datas;
    }
}
