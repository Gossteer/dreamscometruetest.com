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
        return view('admin.customer', ['customers' => Customer::where('LogicalDelete', 0)->orderByDesc('created_at')->paginate(12)]);
    }


    public function account()
    {

        $Carbon_add14 = Carbon::now()->addDays(14);
        $Carbon_now = Carbon::now();
        //dd(DB::table('passengers')->leftJoin('tours', 'passengers.tours_id', '=', 'tours.id')->where('passengers.customers_id', '=', Customer::where('users_id', Auth::user()->id)->first()->id)->where('passengers.LogicalDelete', '=', 0)->Where('tours.Confirmation_Tours', '=', 0)->select('passengers.*')->distinct()->paginate(8,['*'],'tours_hots'));
        return view('site.account', ['Carbon' => $Carbon_add14, 'Cardon_hot' => $Carbon_now,
        'passengers_end' => DB::table('passengers')->Join('tours', 'passengers.tours_id', '=', 'tours.id')->where('passengers.customers_id', '=', Customer::where('users_id', Auth::user()->id)->first()->id)->where('passengers.LogicalDelete', '=', 0)->Where('tours.Confidentiality', '=', 0)->where('Start_Date_Tours', '<=' , $Carbon_now)->select('tours.*', 'passengers.Paid', 'passengers.Comment_Customer', 'passengers.Stars')->distinct()->paginate(8,['*'],'tours_hots_end'), 
        'passengers' => DB::table('passengers')->Join('tours', 'passengers.tours_id', '=', 'tours.id')->where('Start_Date_Tours', '>' , $Carbon_now)->where('passengers.customers_id', '=', Customer::where('users_id', Auth::user()->id)->first()->id)->where('passengers.LogicalDelete', '=', 0)->Where('tours.Confidentiality', '=', 0)->select('tours.*', 'passengers.Paid', 'passengers.Occupied_Place_Bus')->distinct()->paginate(8,['*'],'tours_hots'), 
        'customer' => Customer::where('users_id', Auth::user()->id)->first(), 
        ]);
    }

    public function indexfull(Request $request)
    {
        $res = Customer::find($request->customer);
        $Inviter = Customer::where('Phone_Number_Customer', $res->Phone_Customer_Inviter)->first();
        $Phone_Customer_Inviter_Title = $Inviter != null ? $Inviter->Name . ' ' . $Inviter->Surname . ' ' . $Inviter->Middle_Name : null;
        $us = User::find($res->users_id);
        $data = ['Phone_Customer_Inviter' => $res->Phone_Customer_Inviter,'login' => $us->login, 'email' => $us->email, 'Description'=> $res->Description,
            'White_Days' => $res->White_Days, 'floor' => $res->floor == 0 ? 'М':'Ж',
             'The_amount_of_tokens_spent' => $res->The_amount_of_tokens_spent , 'Amount_Customers_Listed' => $res->Amount_Customers_Listed,
            'Age_customer' => $res->Age_customer, 'Debt' => $res->Debt, 'Phone_Customer_Inviter_Title' => $Phone_Customer_Inviter_Title];

        return $data;
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
            'Condition' => ['required','between:-1,2', 'integer'],
            'Surname' => ['required','string', 'min:2','max:50'],
            'Name' => ['required','string', 'min:2','max:50'],
            'Middle_Name' => ['string', 'min:2','max:50', 'nullable'],
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

        $customer =   Customer::Create([
                'users_id' => $user->id,
                'Surname' => $request['Surname'],
                'Name' => $request['Name'],
                'Condition' => $request['Condition'],
                'Middle_Name' => $request['Middle_Name'],
                'Date_Birth_Customer' => date('Y-m-d', strtotime( $request['Date_Birth_Customer'])),
                'Phone_Number_Customer' => $request['Phone_Number_Customer'],
                'White_Days' => $request['White_Days'] ?? 0,
                'Black_Days' => $request['Black_Days'] ?? 0,
                'Description' => $request['Description'],
                'The_amount_of_tokens_spent' => $request['The_amount_of_tokens_spent'] ?? 0,
                'floor' => $request['floor'],
                'Photo' => "В процессе доработки",
                'Phone_Customer_Inviter' =>  $request['Phone_Customer_Inviter'],
                'Amount_Customers_Listed' => DB::table('customers')->where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->where('Condition', '>', 0)->count(),
                'Age_customer' => Carbon::parse($request->Date_Birth_Customer)->diffInYears(),
                //((Carbon::parse($request['Date_Birth_Customer'])->diff(Carbon::parse(Carbon::today()->toDateString()))->y >= 60 &&  $request['Floor'] == 0) || (Carbon::parse($request['Date_Birth_Customer'])->diff(Carbon::parse(Carbon::today()->toDateString()))->y >= 65 &&  $request['Floor'] == 1)) ? 1 : 0
            ]);

            if ($customer->Phone_Customer_Inviter and Customer::where('Phone_Number_Customer', $customer->Phone_Customer_Inviter)->exists()) {
                Customer::where('Phone_Customer_Inviter', $customer->Phone_Customer_Inviter)->first()->update([
                    'Amount_Customers_Listed' => DB::table('customers')->where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->where('Condition', '>', 0)->count()
                 ]);
            }
        // if(Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->exists())
            // DB::table('customers')->where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->
            // update(['Amount_Customers_Listed' => 1 + Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->first()->Amount_Customers_Listed
            // Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->first()->increment('Amount_Customers_Listed');
        // Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->first()->update([
        //    Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->first()->increment('Amount_Customers_Listed');
        // ]);

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

    public function condition_complite(Request $request)
    {
        $customer = Customer::find($request->id);
        if($request->answer == 1){
            if ($customer->Phone_Customer_Inviter and Customer::where('Phone_Number_Customer', $customer->Phone_Customer_Inviter)->exists()) {
                Customer::where('Phone_Number_Customer', $customer->Phone_Customer_Inviter)->first()->update([
                    'Amount_Customers_Listed' => DB::table('customers')->where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->where('Condition', '>', 0)->count()
                 ]);
            }
            $customer->update([
                'Condition' => 1,
            ]);
        } else{
            if ($customer->Phone_Customer_Inviter and Customer::where('Phone_Number_Customer', $customer->Phone_Customer_Inviter)->exists()) {
                Customer::where('Phone_Number_Customer', $customer->Phone_Customer_Inviter)->first()->update([
                   'Amount_Customers_Listed' => DB::table('customers')->where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->where('Condition', '>', 0)->count()
                ]);
            }
            $customer->update([
                'Condition' => 0,
            ]);
        }
            
        return $request->id;
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
            'Condition' => ['required','between:-1,2', 'integer'],
            'Surname' => ['required','string', 'min:2','max:50'],
            'Name' => ['required','string', 'min:2','max:50'],
            'Middle_Name' => ['min:2','max:50', 'nullable'],
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

        $customer_update = Customer::find($customer->id);
        

        
        if ($request['Phone_Customer_Inviter'] and $customer_update->Condition != 1 and $customer_update->Condition != 2 and $request['Condition'] > 0 and Customer::where('Phone_Number_Customer', $customer->Phone_Customer_Inviter)->exists()) {
            Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->first()->update([
                'Amount_Customers_Listed' => DB::table('customers')->where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->where('Condition', '>', 0)->count()
             ]);
        } elseif($request['Phone_Customer_Inviter'] and ($customer_update->Condition == 1 or $customer_update->Condition == 2) and $request['Condition'] <= 0 and Customer::where('Phone_Number_Customer', $customer->Phone_Customer_Inviter)->exists()){
            Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->first()->decrement('Amount_Customers_Listed');
        }

        $customer_update->update([
            'Surname' => $request['Surname'],
            'Name' => $request['Name'],
            'Condition' => $request['Condition'],
            'Middle_Name' => $request['Middle_Name'],
            'Date_Birth_Customer' => date('Y-m-d', strtotime( $request['Date_Birth_Customer'])),
            'Phone_Number_Customer' => $request['Phone_Number_Customer'],
            'White_Days' => $request['White_Days'] ?? 0,
            'Black_Days' => $request['Black_Days'] ?? 0,
            'Description' => $request['Description'],
            'The_amount_of_tokens_spent' => $request['The_amount_of_tokens_spent'] ?? 0,
            'floor' => $request['floor'],
            'Photo' => "В процессе доработки",
            'Phone_Customer_Inviter' =>  $request['Phone_Customer_Inviter'] ?? null,
            'Amount_Customers_Listed' => DB::table('customers')->where('Phone_Customer_Inviter', $request['Phone_Number_Customer'])->where('Condition', '>', 0)->count(),
            'Age_customer' => Carbon::parse($request->Date_Birth_Customer)->diffInYears(),
        ]);
        // if(Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->exists())
        // DB::table('customers')->where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->
        // update(['Amount_Customers_Listed' => 1 + Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->first()->Amount_Customers_Listed
        // Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->first()->increment('Amount_Customers_Listed');
    // Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->first()->update([
    //    Customer::where('Phone_Number_Customer', $request['Phone_Customer_Inviter'])->first()->increment('Amount_Customers_Listed');
    // ]);

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
        //dd('sadasd');
        $customer->update([
            'LogicalDelete' => 1
        ]);

        return back();
    }
}
