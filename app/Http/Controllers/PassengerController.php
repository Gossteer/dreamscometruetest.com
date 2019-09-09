<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Passenger;
use App\tour;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_tour)
    {
        return view('admin.passenger', ['passengers' => Passenger::where('tours_id', $id_tour), 'id_tour' => $id_tour]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $aa = Customer::find(Auth::user()->id);
        $Preferential_Terms = '';
        $dtr = $aa->Date_Birth_Customer;
        $diff = Carbon::parse($dtr)->diff(Carbon::parse(Carbon::today()->toDateString()));
        if($diff->y < 14 or $diff->y > 60)
            $Preferential_Terms = 1;
        else
            $Preferential_Terms = 0;
        $user = Auth::user()->id;
        Tour::findOrFail($request->tours_id)->update(['Occupied_Place' => Tour::find($request->tours_id)->Occupied_Place + 1]);
        //DB::table('tours')
         //   ->where('id', $request->tours_id)
           // ->update(['Amount_Place' => Tour::find($request->tours_id)->Amount_Place + 1]);
        $attribute = [
            'tours_id' => $request->tours_id,
            'customers_id' => $user,
            'Preferential_Terms' => $Preferential_Terms,
        ];
        Passenger::create($attribute);
        return redirect()->route('/packages');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passenger $passenger)
    {
        switch ($passenger->Presence) {
            case -1:
                if ($request->Presence == 1){
                    Customer::findOrFail($passenger->customers_id)->update([
                        'White_Days' => Customer::find($passenger->customers_id)->White_Days + 1,
                        'Black_Days' => Customer::find($passenger->customers_id)->Black_Days - 1,
                    ]);
                }
                break;
            case 1:
                if ($request->Presence == -1){
                    Customer::findOrFail($passenger->customers_id)->update([
                        'White_Days' => Customer::find($passenger->customers_id)->White_Days - 1,
                        'Black_Days' => Customer::find($passenger->customers_id)->Black_Days + 1
                    ]);
                }
                break;
            case 0:
                if ($request->Presence == 1)
                {
                    Customer::findOrFail($passenger->customers_id)->update([
                        'White_Days' => Customer::find($passenger->customers_id)->White_Days + 1,
                    ]);
                }
                else
                    Customer::findOrFail($passenger->customers_id)->update([
                        'Black_Days' => Customer::find($passenger->customers_id)->Black_Days + 1]);
                break;
        }




        if (Customer::find($passenger->customers_id)->White_Days >=
            ((Customer::find($passenger->customers_id)->Black_Days == 0) ?
                (Customer::find($passenger->customers_id)->Black_Days + 2) :
                (Customer::find($passenger->customers_id)->Black_Days * 2)) and
            (Passenger::where('customers_id', $passenger->customers_id)->count() >= 2))
            Customer::findOrFail($passenger->customers_id)->update([
                'Condition' => 1]);
        elseif (Customer::find($passenger->customers_id)->Black_Days >=
            ((Customer::find($passenger->customers_id)->White_Days == 0) ?
                (Customer::find($passenger->customers_id)->White_Days + 2) :
                (Customer::find($passenger->customers_id)->White_Days * 2)) and
            ((Passenger::where('customers_id', $passenger->customers_id)->count() - 2) <= Customer::find($passenger->customers_id)->White_Days))
            Customer::findOrFail($passenger->customers_id)->update([
                'Condition' => -2]);


        $passenger->update([
'Presence' => $request->Presence,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passenger $passenger)
    {
        Tour::findOrFail($passenger->tours_id)->update(['Occupied_Place' => Tour::find($passenger->tours_id)->Occupied_Place - 1]);

        switch ($passenger->Presence){
            case 1:
                Customer::findOrFail($passenger->customers_id)->update([
                    'White_Days' => Customer::find($passenger->customers_id)->White_Days - 1,
                ]);
                break;
            case -1:
                Customer::findOrFail($passenger->customers_id)->update([
                    'Black_Days' => Customer::find($passenger->customers_id)->Black_Days - 1]);
                break;
        }

        $passenger->delete();

        return redirect()->back();
    }
}
