<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;
use App\Email;
use App\Partner;
use App\Phone_nomber;
use App\Type_Activity;
use App\Website;
use DB;
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
        //dd();
        return view('admin.partner', ['partners' => Partner::where('LogicalDelete',0)->paginate(12),'type_activities' => DB::table('type_activities')->leftJoin('partners', 'partners.type_activities_id', '=', 'type_activities.id')->where('type_activities.LogicalDelete', '=', 0)->orWhereIn('partners.type_activities_id', Partner::select('type_activities_id')->where('LogicalDelete',0)->get()->toArray())->select('type_activities.*')->distinct()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partner.create', ['type_activities' => Type_Activity::where('LogicalDelete',0)->get()]);
    }

    public function indexdelete()
    {
        //dd(Partner::select('type_activities_id')->where('LogicalDelete',0)->get()->toArray());
        return view('admin.partner_delete', ['partners' => Partner::where('LogicalDelete', 1)->orderByDesc('updated_at')->paginate(12),'type_activities' => Type_Activity::where('LogicalDelete', 1)->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1 and INN = ?', [$request->Name_Partners, $request->INN])->exists()){
            Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1 and INN = ?', [$request->Name_Partners, $request->INN])->update([
                'type_activities_id' => $request->select_type_activitie,
                'Phone_Number' => $request->Phone_Number,
                'LogicalDelete' => 0,
            ]);
            return redirect()->route('partners.index');
        }
        elseif (Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1', [$request->Name_Partners])->exists()){
            Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1', [$request->Name_Partners])->update([
                'type_activities_id' => $request->select_type_activitie,
                'Phone_Number' => $request->Phone_Number,
                'INN' => $request->INN,
                'LogicalDelete' => 0,
            ]);
            return redirect()->route('partners.index');
        } elseif(Partner::whereRaw('INN = ? and LogicalDelete = 1', [$request->INN])->exists()){
            Partner::whereRaw('INN = ? and LogicalDelete = 1', [$request->INN])->update([
                'type_activities_id' => $request->select_type_activitie,
                'Phone_Number' => $request->Phone_Number,
                'Name_Partners' => $request->Name_Partners,
                'LogicalDelete' => 0,
            ]);
            return redirect()->route('partners.index');
        }else {
            \Validator::make($request->all(), [
                'Name_Partners' => ['required', 'unique:partners', 'string'],
            ],[
                'unique' => 'Данный партнёр уже существует!',
                'required' => 'Обязательно к заполнению!',
            ])->validate();

            $partner = Partner::Create([
                'type_activities_id' => $request->select_type_activitie,
                'Name_Partners' => $request->Name_Partners,
                'INN' => $request->INN ]);

        }

        if ($request->Address)
            for ($i=0; $i < count($request->Address); $i++) { 
                if ($request->Address[$i] != "null") {
                    Address::find($request->Address[$i])->update([
                        'partners_id'=> $partner->id
                    ]);
                }
            };
            Address::where('partners_id', null)->delete();

        if ($request->Phone_Number)
            for ($i=0; $i < count($request->Phone_Number); $i++) { 
                if ($request->Phone_Number[$i] != "null")
                    Phone_nomber::find($request->Phone_Number[$i])->update([
                        'partners_id'=> $partner->id
                    ]);
            };
            Phone_nomber::where('partners_id', null)->delete();

            if ($request->Email)
            for ($i=0; $i < count($request->Email); $i++) { 
                if ($request->Email[$i] != "null") {
                    Email::find($request->Email[$i])->update([
                        'partners_id'=> $partner->id
                    ]);
                }
            };
            Email::where('partners_id', null)->delete();

        if ($request->Websites)
            for ($i=0; $i < count($request->Websites); $i++) { 
                if ($request->Websites[$i] != "null")
                    Website::find($request->Websites[$i])->update([
                        'partners_id'=> $partner->id
                    ]);
            };
            Website::where('partners_id', null)->delete();

        // if($request->Address != null)
        // {
        //     for ($i = 0; $i != count($request->Address); $i++){
        //         Address::firstOrCreate([
        //             'partners_id' => Partner::where('Name_Partners', [$request->Name_Partners])->first()->id,
        //             'Address' => $request->Address[$i],
        //         ]);
        //     }
        // }
        // if($request->Phone_Number != null)
        // {
        //     for ($i = 0; $i != count($request->Phone_Number); $i++){
        //         Phone_nomber::firstOrCreate([
        //             'partners_id' => Partner::where('Name_Partners', [$request->Name_Partners])->first()->id,
        //             'Representative' => $request->Representative[$i],
        //             'Phone_Number' => $request->Phone_Number[$i],
        //         ]);
        //     }
        // }
        // if($request->Email != null)
        // {
        //     for ($i = 0; $i != count($request->Email); $i++){
        //         Email::firstOrCreate([
        //             'Representative_Email' => $request->Representative_Email[$i],
        //             'Email' => $request->Email[$i],
        //             'partners_id' => Partner::where('Name_Partners', [$request->Name_Partners])->first()->id,
        //         ]);
        //     }
        // }
        // if($request->Site != null)
        // {
        //     for ($i = 0; $i != count($request->Site); $i++){
        //         Website::firstOrCreate([
        //             'Site' => $request->Site[$i],
        //             'partners_id' => Partner::where('Name_Partners', [$request->Name_Partners])->first()->id,
        //         ]);
        //     }
        // }

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
        //dd(DB::table('type_activities')->leftJoin('partners', 'partners.type_activities_id', '=', 'type_activities.id')->where('type_activities.LogicalDelete', '=', 0)->orWhere('partners.type_activities_id', '=', $partner->type_activities_id)->select('type_activities.*')->distinct()->get());

        return view('admin.partner.update', ['partner' => $partner, 'type_activities' =>  DB::table('type_activities')->leftJoin('partners', 'partners.type_activities_id', '=', 'type_activities.id')->where('type_activities.LogicalDelete', '=', 0)->orWhere('partners.type_activities_id', '=', $partner->type_activities_id)->select('type_activities.*')->distinct()->get(),
            'address' => Address::where('partners_id', $partner->id)->get(), 'phone_nombers' => Phone_nomber::where('partners_id', $partner->id)->get(), 'emails' => Email::where('partners_id', $partner->id)->get(), 'websites' => Website::where('partners_id', $partner->id)->get()]);
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
        //dd($request);

        if(Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1 and INN = ?', [$request->Name_Partners, $request->INN])->exists()){
            Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1 and INN = ?', [$request->Name_Partners, $request->INN])->update([
                'type_activities_id' => $request->select_type_activitie,
                'Phone_Number' => $request->Phone_Number,
                'LogicalDelete' => 0,
            ]);
            return redirect()->route('partners.index');
        }
        elseif (Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1', [$request->Name_Partners])->exists()){
            Partner::whereRaw('Name_Partners = ? and LogicalDelete = 1', [$request->Name_Partners])->update([
                'type_activities_id' => $request->select_type_activitie,
                'Phone_Number' => $request->Phone_Number,
                'INN' => $request->INN,
                'LogicalDelete' => 0,
            ]);
            return redirect()->route('partners.index');
        } elseif(Partner::whereRaw('INN = ? and LogicalDelete = 1', [$request->INN])->exists()){
            Partner::whereRaw('INN = ? and LogicalDelete = 1', [$request->INN])->update([
                'type_activities_id' => $request->select_type_activitie,
                'Phone_Number' => $request->Phone_Number,
                'Name_Partners' => $request->Name_Partners,
                'LogicalDelete' => 0,
            ]);
            return redirect()->route('partners.index');
        }else {
            \Validator::make($request->all(), [
                'Name_Partners' => ['required', 'unique:partners,Name_Partners,' . $partner->id, 'string'],
            ],[
                'unique' => $request->Name_Partners . ' данный партнёр уже существует!',
                'required' => 'Обязательно к заполнению!',
            ])->validate();

        $partner->update([
            'type_activities_id' => $request->select_type_activitie,
            'Name_Partners' => $request->Name_Partners, 
            'Phone_Number' => $request->Phone_Number, 
            ]);
        }

        
        if ($request->Address){
            //dd(Route::where('id', $request->routes_id[0])->exists());
            for ($i=0; $i < count($request->Address); $i++) { 
                if($request->Address[$i] != "null")
                    Address::find($request->Address[$i])->update([
                        'partners_id'=> $partner->id
                    ]);
                    
            };
            Address::where('partners_id', null)->delete();
            
            $Address = Address::select('id')->where('partners_id', $partner->id)->get()->toArray();
            for ($i=0; $i < count($Address); $i++) { 
                if(!in_array($Address[$i]['id'], $request->Address))
                     Address::find($Address[$i]['id'])->delete();
            };
        } 

        if ($request->Phone_Number){
            //dd(Route::where('id', $request->routes_id[0])->exists());
            for ($i=0; $i < count($request->Phone_Number); $i++) { 
                if($request->Phone_Number[$i] != "null")
                    Phone_nomber::find($request->Phone_Number[$i])->update([
                        'partners_id'=> $partner->id
                    ]);
                    
            };
            Phone_nomber::where('partners_id', null)->delete();
            
            $Phone_Number = Phone_nomber::select('id')->where('partners_id', $partner->id)->get()->toArray();
            for ($i=0; $i < count($Phone_Number); $i++) { 
                if(!in_array($Phone_Number[$i]['id'], $request->Phone_Number))
                Phone_nomber::find($Phone_Number[$i]['id'])->delete();
            };
        } 

        if ($request->Email){
            //dd(Route::where('id', $request->routes_id[0])->exists());
            for ($i=0; $i < count($request->Email); $i++) { 
                if($request->Email[$i] != "null")
                    Email::find($request->Email[$i])->update([
                        'partners_id'=> $partner->id
                    ]);
                    
            };
            Email::where('partners_id', null)->delete();
            
            $Email = Email::select('id')->where('partners_id', $partner->id)->get()->toArray();
            for ($i=0; $i < count($Email); $i++) { 
                if(!in_array($Email[$i]['id'], $request->Email))
                     Email::find($Email[$i]['id'])->delete();
            };
        } 

        if ($request->Websites){
            //dd(Route::where('id', $request->routes_id[0])->exists());
            for ($i=0; $i < count($request->Websites); $i++) { 
                if($request->Websites[$i] != "null")
                    Website::find($request->Websites[$i])->update([
                        'partners_id'=> $partner->id
                    ]);
                    
            };
            Website::where('partners_id', null)->delete();
            
            $Websites = Website::select('id')->where('partners_id', $partner->id)->get()->toArray();
            for ($i=0; $i < count($Websites); $i++) { 
                if(!in_array($Websites[$i]['id'], $request->Websites))
                    Website::find($Websites[$i]['id'])->delete();
            };
        } 
           

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

        $partner->update([
            'LogicalDelete' => 1
        ]);

        return redirect()->route('partners.index');
    }

    public function destroyremuve(Partner $partner)
    {   

        $partner->update([
            'LogicalDelete' => 0
        ]);

        return back();
    }

    public function fulldestroy(Partner $partner)
    {   

        foreach ($partner->contract as $contract) {
            $contract->delete();
        }

        foreach ($partner->address as $address) {
            $address->delete();
        }

        foreach ($partner->email as $email) {
            $email->delete();
        }

        foreach ($partner->tour_employees as $tour_employees) {
            $tour_employees->update([
                'partner_id' => null,
            ]);
        }

        foreach ($partner->website as $website) {
            $website->delete();
        }

        foreach ($partner->phone_nomber as $phone_nomber) {
            $phone_nomber->delete();
        }
        
        $partner->delete();


        return back();
    }
}
