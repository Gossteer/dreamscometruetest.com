<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Partner;
use App\Tour;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tour_Contract = Contract::find($request->id);

        $date = [
            'Name_Contract_doc' =>  $tour_Contract->Name_Contract_doc,
            'Salary' =>  $tour_Contract->Salary ?? 0,
            'Document_Contract' =>  $tour_Contract->Document_Contract,
            'partners_id' =>  $tour_Contract->partners_id,
        ];

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
        tour::find($request->tours_id)->increment('Expenses', $request->Salary);
        $tour_Contract = Contract::Create([
            'Name_Contract_doc' =>  $request->Name_Contract_doc,
            'Salary' =>  $request->Salary ?? 0,
            'tours_id' => $request->tours_id,
            'Document_Contract' =>  'Я ещё не сделан',
            'partners_id' =>  $request->partners_id,
        ]);

        $date = [
            'id' => $tour_Contract->id,
            'Name_Contract_doc' =>  $tour_Contract->Name_Contract_doc,
            'Salary' =>  $tour_Contract->Salary,
            'tours_id' => $request->tours_id,
            'Document_Contract' =>  'Я ещё не сделан',
            'partners_id' =>  $tour_Contract->partners_id,
            'Name_Partners' =>  $tour_Contract->partner->Name_Partners,
            'title' =>  $tour_Contract->partner->INN . ' ' . $tour_Contract->partner->type_activity->Name_Type_Activity,
        ];

        return $date;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contranct  $contranct
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contranct  $contranct
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contranct  $contranct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tour_Contract =Contract::find($request->id);
        tour::find($request->tours_id)->increment('Expenses', $request->Salary);
        tour::find($request->tours_id)->decrement('Expenses', $tour_Contract->Salary);
        
        $tour_Contract->update([
            'Name_Contract_doc' =>  $request->Name_Contract_doc,
            'Salary' =>  $request->Salary ?? 0,
            'Document_Contract' =>  'Я ещё не сделан',
            'partners_id' =>  $request->partners_id,
        ]);

        $date = [
            'id' => $tour_Contract->id,
            'Name_Contract_doc' =>  $tour_Contract->Name_Contract_doc,
            'Salary' =>  $tour_Contract->Salary,
            'tours_id' => $request->tours_id,
            'Document_Contract' =>  'Я ещё не сделан',
            'partners_id' =>  $tour_Contract->partners_id,
            'Name_Partners' =>  $tour_Contract->partner->Name_Partners,
            'title' =>  $tour_Contract->partner->INN . ' ' . $tour_Contract->partner->type_activity->Name_Type_Activity,
        ];

        return $date;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contranct  $contranct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contract =Contract::find($request->id);
        tour::find($request->tours_id)->decrement('Expenses', $contract->Salary);
        $contract->delete();

        $date = 1;

        return $date;
    }
}
