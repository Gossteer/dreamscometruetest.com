<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Partner;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tour)
    {
        return view('admin.tours_partner', ['partner_for_tour' => Contract::where('tours_id',$tour)->paginate(12),
            'tour' => $tour,'partners' => Partner::all()]);
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
    public function store(Request $request, $tour)
    {
        Contract::firstOrCreate([
            'partners_id' => $request->partners_id,
            'tours_id' => $tour,
            'Document_Contract' => "Меня здесь нет!",
        ]);

        return redirect()->route('contractsindex', $tour);
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
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contranct  $contranct
     * @return \Illuminate\Http\Response
     */
    public function destroy($tour, $contract)
    {
        Contract::findOrFail($contract)->delete();

        return redirect()->route('contractsindex', $tour);
    }
}
