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
    public function index(Request $request)
    {
        $Type_Activity = Type_Activity::find($request->id);

        return $Type_Activity;
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
        // \Validator::make($request->all(), [
        //     'Name_Type_Activity' => ['required', 'unique:type_activities', 'min:2', 'max:191'],
        // ],[
        //     'Name_Type_Activity.unique' => 'Уже существует!',
        //     'Name_Type_Activity.required' => 'Обязательно к заполнению!',
        // ])->validate();

       $res = Type_Activity::firstOrCreate([
         'Name_Type_Activity' => $request->Name_Type_Activity,
       ]);

       $res->update([
            'LogicalDelete' => 0,
       ]);

        return $res;
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
    public function update(Request $request)
    {
        $res = Type_Activity::where('Name_Type_Activity', $request->Name_Type_Activity);
        if($res->exists() and $res->first()->id != $request->id){
            $res = $res->first();
            $res->update([
                'LogicalDelete' => 0,
            ]);
            Type_Activity::find($request->id)->update([
                'LogicalDelete' => 1,
            ]);
        } else{
            Type_Activity::find($request->id)->update([
                'Name_Type_Activity' => $request->Name_Type_Activity,
            ]);

            $res = Type_Activity::find($request->id);
        }
        // $res = Type_Activity::where('Name_Type_Activity', $request->Name_Type_Activity)->firstOr(function (Request $request) {
        //     Type_Activity::find($request->id)->update([
        //         'Name_Type_Activity' => $request->Name_Type_Activity,
        //     ]);

        //     return Type_Activity::find($request->id);
        // });

        

        

        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type_Activity  $type_Activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Type_Activity::find($request->typeactivity)->update([
            'LogicalDelete' => 1,
        ]);

        $datas = Partner::where('LogicalDelete',0)->where('type_activities_id', $request->typeactivity)->get();

        return $datas;
    }
}
