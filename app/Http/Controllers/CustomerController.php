<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Hash;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customer', ['customers' => Customer::paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create');
    }


    protected function validator(Request $request)
    {
        return Validator::make($request, [
            'Phone_Number_Customer' => ['required', 'string', 'unique:customers'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::firstOrCreate([
            'login' => $request['login'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'Processing_Personal_Data' => $request['Processing_Personal_Data'],
            'Notifications' => $request['Notifications'],
        ]);


        // $Phone_Customer_Inviter = ();
        try {
            Customer::firstOrCreate([
                'users_id' => $user->id,
                'Surname' => $request['Surname'],
                'Name' => $request['Name'],
                'Middle_Name' => $request['Middle_Name'],
                'Date_Birth_Customer' => date('Y-m-d', strtotime( $request['Date_Birth_Customer'])),
                'Phone_Number_Customer' => $request['Phone_Number_Customer'],
                'Floor' => $request['Floor'],
                'Phone_Customer_Inviter' =>  $request['Number_Customers_Inviter'] ?? null,
                'Number_Customers_Listed' => \Illuminate\Support\Facades\DB::table('customers')->where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->count(),
                'Age_Group' => (Carbon::parse($request['Date_Birth_Customer'])->diff(Carbon::parse(Carbon::today()->toDateString()))->y >= 60) ? 1 : 0,
            ]);
        } catch (ModelNotFoundException $exception) {

        }
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.update', ['customer' => $customer ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        Customer::findOrFail($customer->id)->update(['Name' => $request->Name, 'Surname' => $request->Surname,
            'Middle_Name' => $request->Middle_Name, 'Phone_Number_Customer' => $request->Phone_Number_Customer,
        'Date_Birth_Customer' =>  date('Y-m-d', strtotime($request->Date_Birth_Customer))]);

        User::findOrFail($customer->users_id)->update(['login' => $request->login, 'email'=> $request->email]);

        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customer.index');
    }
}
