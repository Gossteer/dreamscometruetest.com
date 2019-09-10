<?php

namespace App\Http\Controllers;

use App\Partner;
use App\Type_Activity;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.partner', ['partners' => Partner::where('LogicalDelete',0)->paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partner.create', ['type_activities' => Type_Activity::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Partner::where('Name_Partners', '=', $request->Name_Partners, 'and', 'LogicalDelete', '=', 1)->exists())
            Partner::findOrFail(Partner::where('Name_Partners', '=', $request->Name_Partners, 'and', 'LogicalDelete', '=', 1)->first()->id)->update([
                'type_activities_id' => $request->type_activities_id,
                    'Phone_Number' => $request->Phone_Number, 'Address' => $request->Address, 'LogicalDelete' => 0,
            ]);
        else
            Partner::create(['type_activities_id' => $request->type_activities_id,
                'Name_Partners' => $request->Name_Partners, 'Phone_Number' => $request->Phone_Number, 'Address' => $request->Address, ]);

        return redirect()->route('partners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        return view('admin.partner.update', ['partner' => $partner, 'type_activities' => Type_Activity::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $partner->update(['type_activities_id' => $request->type_activities_id,
            'Name_Partners' => $request->Name_Partners, 'Phone_Number' => $request->Phone_Number, 'Address' => ($request->Address === null) ? 'Нет' : $request->Address,]);

        return redirect()->route('partners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->update(['LogicalDelete' => 1]);

        return redirect()->route('partners.index');
    }
}
