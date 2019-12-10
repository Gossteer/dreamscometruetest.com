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
            'login' => ['required', 'string','min:2', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:16', 'confirmed'],
            'Surname' => ['required','string', 'min:2','max:50'],
            'Name' => ['required','string', 'min:2','max:50'],
            'Middle_Name' => ['string', 'min:2','max:50'],
            'floor' => ['required'],
            'Date_Birth_Customer' => ['required','date','before_or_equal:date']
        ],[
            'Date_Birth_Customer.before_or_equal' => 'Вы ещё не родились, просим дождаться этого момента!',
            'Date_Birth_Customer.date' => 'Укажите поажалуйста правильную дату!',
            'Phone_Number_Customer.unique' => 'Пользователь с данным номером телефона уже существует!',
            'login.unique' => 'Пользователь с таким ником уже существует!',
            'login.min' => 'Минимальный размер 2 символа!',
            'login.max' => 'Максимальный размер 20 символов!',
            'email.unique' => 'Пользователь с таким email уже существует!',
            'password.min' => 'Пароль должен быть не менее 8 символов!',
            'password.max' => 'Пароль не должен быть больше 16 символов',
            'Surname.min' => 'Фамилия должена иметь не менее 2 символов!',
            'Surname.max' => 'Фамилия должена быть не больше 50 символов',
            'Name.min' => 'Имя должено иметь не менее 2 символов!',
            'Name.max' => 'Имя должено быть больше не 50 символов',
            'Date_Birth_Customer.min' => 'Отчество должено иметь не менее 2 символов!',
            'Date_Birth_Customer.max' => 'Отчество должено быть не больше 50 символов',
            'password.confirmed' => 'Пароль не совпадает',
            'email.email' => 'Укажите пожалуйста правильную почту!',
            'required' => 'Это поле обязательно к заполнению!'
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
                'White_Days' => $request['White_Days'] ?? 0,
                'Black_Days' => $request['Black_Days'] ?? 0,
                'Description' => $request['Description'] ?? 'Отсуствует',
                'The_amount_of_tokens_spent' => $request['The_amount_of_tokens_spent'] ?? 0,
                'floor' => $request['floor'],
                'Photo' => $request['Photo'] ?? null,
                'Phone_Customer_Inviter' =>  $request['Phone_Customer_Inviter'] ?? null,
                'Amount_Customers_Listed' => \Illuminate\Support\Facades\DB::table('customers')->where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->count(),
                'Age_Group' => ((Carbon::parse($request['Date_Birth_Customer'])->diff(Carbon::parse(Carbon::today()->toDateString()))->y >= 60 &&  $request['Floor'] == 0) || (Carbon::parse($request['Date_Birth_Customer'])->diff(Carbon::parse(Carbon::today()->toDateString()))->y >= 65 &&  $request['Floor'] == 1)) ? 1 : 0,
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
        return view('admin.customer.update', ['customer' => $customer ,'user' => User::find($customer->users_id) ]);
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
            'login' => ['required', 'string','min:2', 'max:20', 'unique:users,login,' . $customer->users_id],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,' . $customer->users_id],
            'password' => ['confirmed'],
            'Surname' => ['required','string', 'min:2','max:50'],
            'Name' => ['required','string', 'min:2','max:50'],
            'Middle_Name' => ['string', 'min:2','max:50'],
            'floor' => ['required'],
            'Date_Birth_Customer' => ['required','date','before_or_equal:date']
        ],[
            'Date_Birth_Customer.before_or_equal' => 'Вы ещё не родились, просим дождаться этого момента!',
            'Date_Birth_Customer.date' => 'Укажите поажалуйста правильную дату!',
            'Phone_Number_Customer.unique' => 'Пользователь с данным номером телефона уже существует!',
            'login.unique' => 'Пользователь с таким ником уже существует!',
            'email.unique' => 'Пользователь с таким email уже существует!',
            'password.min' => 'Пароль должен быть не менее 8 символов!',
            'password.max' => 'Пароль не должен быть больше 16 символов',
            'Surname.min' => 'Фамилия должена иметь не менее 2 символов!',
            'Surname.max' => 'Фамилия должена быть не больше 50 символов',
            'Name.min' => 'Имя должено иметь не менее 2 символов!',
            'Name.max' => 'Имя должено быть больше не 50 символов',
            'Date_Birth_Customer.min' => 'Отчество должено иметь не менее 2 символов!',
            'Date_Birth_Customer.max' => 'Отчество должено быть не больше 50 символов',
            'password.confirmed' => 'Пароль не совпадает',
            'email.email' => 'Укажите пожалуйста правильную почту!',
            'required' => 'Это поле обязательно к заполнению!'
        ])->validate();

        User::find($customer->users_id)->update([
            'login' => $request['login'],
            'email' => $request['email'],
            'password' => $request['password'] == null ?  User::find($customer->users_id)->password :  Hash::make($request['password']) ,
            'Processing_Personal_Data' => $request['Processing_Personal_Data'],
            'Notifications' => $request['Notifications'] ?? 0,
        ]);

        Customer::find($customer->id)->update([
            'Surname' => $request['Surname'],
            'Name' => $request['Name'],
            'Middle_Name' => $request['Middle_Name'],
            'Date_Birth_Customer' => date('Y-m-d', strtotime( $request['Date_Birth_Customer'])),
            'Phone_Number_Customer' => $request['Phone_Number_Customer'],
            'White_Days' => $request['White_Days'] ?? 0,
            'Black_Days' => $request['Black_Days'] ?? 0,
            'Description' => $request['Description'] ?? 'Отсуствует',
            'The_amount_of_tokens_spent' => $request['The_amount_of_tokens_spent'] ?? 0,
            'floor' => $request['floor'],
            'Photo' => $request['Photo'] ?? null,
            'Phone_Customer_Inviter' =>  $request['Phone_Customer_Inviter'] ?? null,
            'Amount_Customers_Listed' => \Illuminate\Support\Facades\DB::table('customers')->where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->count(),
            'Age_Group' => ((Carbon::parse($request['Date_Birth_Customer'])->diff(Carbon::parse(Carbon::today()->toDateString()))->y >= 60 &&  $request['Floor'] == 0) || (Carbon::parse($request['Date_Birth_Customer'])->diff(Carbon::parse(Carbon::today()->toDateString()))->y >= 65 &&  $request['Floor'] == 1)) ? 1 : 0,
        ]);

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
