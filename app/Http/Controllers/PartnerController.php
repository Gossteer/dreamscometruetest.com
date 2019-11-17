<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;
use App\Email;
use App\Partner;
use App\Phone_nomber;
use App\Type_Activity;
use App\Website;
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
        if(Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1', [$request->Name_Partners])->exists()){
            Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1', [$request->Name_Partners])->update([
                'type_activities_id' =>1,
                'Name_Partners' => $request->Name_Partners,
                'INN' => $request->Address,
                'LogicalDelete' => 0,
            ]);
            return redirect()->route('partners.index');
        }

        else
            \Validator::make($request->all(), [
                'Name_Partners' => ['required', 'unique:partners', 'string'],
            ],[
                'Name_Partners.unique' => 'Данный партнёр уже существует!',
                'Name_Partners.required' => 'Обязательно к заполнению!',
            ])->validate();

        $partner = Partner::create([
            'type_activities_id' => 1,
            'Name_Partners' => $request->Name_Partners,
            'INN' => $request->INN ]);

            for ($i = 0; $i != count($request->Address); $i++){
                Address::create([
                    'partners_id' => $partner->id,
                    'Address' => $request->Address[$i],
                ]);
            }

            //Customer::
//            Website::created([
//
//            ]);
//            Phone_nomber::created([
//
//            ]);
//
//            Email::created([
//
//            ]);

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
        if(Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1', [$request->Name_Partners])->exists()){
            Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1', [$request->Name_Partners])->update([
                'type_activities_id' => $request->type_activities_id,
                'Phone_Number' => $request->Phone_Number,
                'Address' => $request->Address,
                'LogicalDelete' => 0,
            ]);
            return redirect()->route('partners.index');
        }

        else
            \Validator::make($request->all(), [
                'Name_Partners' => ['required', 'unique:partners', 'string'],
            ],[
                'Name_Partners.unique' => 'Данный партнёр уже существует!',
                'Name_Partners.required' => 'Обязательно к заполнению!',
            ])->validate();

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
