<?php

namespace App\Http\Controllers;

use App\Type_Tour;
use App\Type_Tour_Many;
use Illuminate\Http\Request;

class TypeTourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = Type_Tour::find($request->typetourid);
        $data = ['id' => $res->id, 'Name_Type_Tours' => $res->Name_Type_Tours];

        return $data;
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
            'Name_Type_Tours' => ['required', 'max:191','min:2'],
        ],[
            'Name_Type_Tours.unique' => 'Данный тип уже существует',
        ])->validate();

        $res = Type_Tour::firstOrCreate([
            'Name_Type_Tours' => $request->Name_Type_Tours,
        ]);

        $res->update([
            'LogicalDelete' => 0
        ]);

        $data = ['id' => $res->id, 'Name_Type_Tours' => $request->Name_Type_Tours];

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Type_Tour  $type_Tour
     * @return \Illuminate\Http\Response
     */
    public function show(Type_Tour $type_Tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Type_Tour  $type_Tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type_Tour  $type_Tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if(Type_Tour::where('Name_Type_Tours',$request->Name_Type_Tours)->exists()){
            Type_Tour::where('Name_Type_Tours',$request->Name_Type_Tours)->update([
                'LogicalDelete' => 0,
            ]);
            Type_Tour::find($request->typetourid)->update([
                'LogicalDelete' => 1,
            ]);
        }else{
            Type_Tour::find($request->typetourid)->update([
                'Name_Type_Tours' => $request->Name_Type_Tours,
            ]);
        }

        $data = Type_Tour::where('Name_Type_Tours',$request->Name_Type_Tours)->first();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Type_Tour  $type_Tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Type_Tour::find($request->typetourid)->update([
            'LogicalDelete' => 1,
        ]);

        if(Type_Tour_Many::whereRaw('type_tours_id = ? and tour_id = ?', [$request->typetourid, $request->tour_id])->exists()){
            Type_Tour_Many::whereRaw('type_tours_id = ? and tour_id = ?', [$request->typetourid, $request->tour_id])->delete();
        }

        $datas = '1';
        return $datas;
    }
}
