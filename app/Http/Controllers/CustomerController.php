<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Passenger;
use App\User;
use Auth;
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


    public function account()
    {
        return view('site.account', ['passengers' => Passenger::where('customers_id', Customer::where('users_id', Auth::user()->id)->first()->id)->paginate(12)
            , 'customer' => Customer::where('users_id', Auth::user()->id)->first(), ]);
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

        $attribute = $request->all();
        $attribute['date'] = Carbon::today();

        \Validator::make($attribute, [
            'Phone_Number_Customer' => ['required', 'string', 'unique:customers'],
            'login' => ['required', 'string','min:2', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'Date_Birth_Customer' => ['date','before_or_equal:date']
        ],[
            'Date_Birth_Customer.before_or_equal' => 'Вы ещё не родились, досвидание!',
            'Date_Birth_Customer.date' => 'Укажите поажалуйста правильную дату!',
            'Phone_Number_Customer.unique' => 'Пользователь с данным номером телефона уже существует!',
            'login.unique' => 'Пользователь с таким ником уже существует!',
            'login.min' => 'Минимальный размер 2 символа!',
            'login.max' => 'Максимальный размер 255 символов!',
            'login.required' => 'Пожалуйста укажите логин!',
            'email.unique' => 'Пользователь с таким email уже существует!',
            'password.min' => 'Пароль должен быть не менее 8 символов!',
            'password.confirmed' => 'Пароль не совпадает!',
        ])->validate();

        $user = User::Create([
            'login' => $request['login'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'Processing_Personal_Data' => $request['Processing_Personal_Data'],
            'Notifications' => $request['Notifications'] ?? 0,
        ]);


        // $Phone_Customer_Inviter = ();

            Customer::Create([
                'users_id' => $user->id,
                'Surname' => $request['Surname'],
                'Name' => $request['Name'],
                'Middle_Name' => $request['Middle_Name'],
                'Date_Birth_Customer' => date('Y-m-d', strtotime( $request['Date_Birth_Customer'])),
                'Phone_Number_Customer' => $request['Phone_Number_Customer'],
                'Floor' => $request['Floor'],
                'Phone_Customer_Inviter' =>  $request['Number_Customers_Inviter'] ?? null,
                'Amount_Customers_Listed' => \Illuminate\Support\Facades\DB::table('customers')->where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->count(),
                'Age_Group' => (Carbon::parse($request['Date_Birth_Customer'])->diff(Carbon::parse(Carbon::today()->toDateString()))->y >= 60) ? 1 : 0,
            ]);

        if(Customer::where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->exists())
        Customer::where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->update([
           'Number_Customers_Listed' => 1 + Customer::where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->get()->Number_Customers_Listed
        ]);

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

        $attribute = $request->all();
        $attribute['date'] = Carbon::today();

        \Validator::make($attribute, [
            'Phone_Number_Customer' => ['required', 'string', 'unique:customers,Phone_Number_Customer,' . $customer->id],
            'login' => ['required', 'string','min:2', 'max:255', 'unique:users,login,' . $customer->users_id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $customer->users_id],
            'Date_Birth_Customer' => ['date','before_or_equal:date']
        ],[
            'Date_Birth_Customer.before_or_equal' => 'Вы ещё не родились, досвидание!',
            'Date_Birth_Customer.date' => 'Укажите поажалуйста правильную дату!',
            'Phone_Number_Customer.unique' => 'Пользователь с данным номером телефона уже существует!',
            'login.unique' => 'Пользователь с таким ником уже существует!',
            'login.min' => 'Минимальный размер 2 символа!',
            'login.max' => 'Максимальный размер 255 символов!',
            'login.required' => 'Пожалуйста укажите логин!',
            'email.unique' => 'Пользователь с таким email уже существует!',
        ])->validate();

        Customer::find($customer->id)->update(['Name' => $request->Name, 'Surname' => $request->Surname,
            'Middle_Name' => $request->Middle_Name, 'Phone_Number_Customer' => $request->Phone_Number_Customer,
        'Date_Birth_Customer' =>  date('Y-m-d', strtotime($request->Date_Birth_Customer))]);

        User::find($customer->users_id)->update(['login' => $request->login, 'email'=> $request->email]);

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
