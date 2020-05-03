<?php

namespace App\Http\Controllers\Auth;

use App\Customer;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['date'] = Carbon::today();
        return Validator::make($data, [
            'Phone_Number_Customer' => ['required', 'string', 'unique:customers'],
            'login' => ['required', 'string','min:2', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:16', 'confirmed'],
            'Surname' => ['required','string', 'min:2','max:50'],
            'Name' => ['required','string', 'min:2','max:50'],
            'Middle_Name' => ['string', 'min:2','max:50'],
            'Floor' => ['required'],
            'Name_Category_Source' => ['required'],
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
            'Middle_Name.min' => 'Отчество должено иметь не менее 2 символов!',
            'Middle_Name.max' => 'Отчество должено быть не больше 50 символов',
            'password.confirmed' => 'Пароль не совпадает',
            'email.email' => 'Укажите пожалуйста правильную почту!',
            'required' => 'Это поле обязательно к заполнению!'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'Processing_Personal_Data' => $data['Processing_Personal_Data'],
            'Notifications' => $data['Notifications'] ?? 0,
        ]);

        Customer::create([
            'users_id' => $user->id,
            'Surname' => $data['Surname'],
            'Name' => $data['Name'],
            'Middle_Name' => $data['Middle_Name'],
            'Date_Birth_Customer' => date('Y-m-d', strtotime( $data['Date_Birth_Customer'])),
            'Phone_Number_Customer' => $data['Phone_Number_Customer'],
            'Floor' => $data['Floor'],
            'Description' => $data['Description'] ?? 'Отсуствует',
            'Phone_Customer_Inviter' =>  $data['Phone_Customer_Inviter'] ?? null,
            'Amount_Customers_Listed' => \Illuminate\Support\Facades\DB::table('customers')->where('Phone_Customer_Inviter', $data['Phone_Number_Customer'])->count(),
            'Age_Group' => ((Carbon::parse($data['Date_Birth_Customer'])->diff(Carbon::parse(Carbon::today()->toDateString()))->y >= 60 &&  $data['Floor'] == 0) || (Carbon::parse($data['Date_Birth_Customer'])->diff(Carbon::parse(Carbon::today()->toDateString()))->y >= 65 && $data['Floor'] == 1)) ? 1 : 0,

        ]);


        if(isset($data['Phone_Customer_Inviter']) and Customer::where('Phone_Number_Customer', $data['Phone_Customer_Inviter'])->exists())
            // DB::table('customers')->where('Phone_Number_Customer', $data['Phone_Customer_Inviter'])->
            // update(['Amount_Customers_Listed' => 1 + Customer::where('Phone_Number_Customer', $data['Phone_Customer_Inviter'])->first()->Amount_Customers_Listed
        Customer::where('Phone_Number_Customer', $data['Phone_Customer_Inviter'])->first()->update([
           'Amount_Customers_Listed' => 1 + Customer::where('Phone_Number_Customer', $data['Phone_Customer_Inviter'])->first()->Amount_Customers_Listed
        ]);

       // if(\Illuminate\Support\Facades\DB::table('customers')->where('Phone_Customer_Inviter', $data['Phone_Number_Customer'])->exists())
           // Customer::where('Phone_Customer_Inviter', $data['Phone_Number_Customer'])->update([
            //    'Number_Customers_Listed' => 1 + Customer::where('Phone_Customer_Inviter', $data['Phone_Number_Customer'])->get()->Number_Customers_Listed
            //]);



//is_int($Phone_Customer_Inviter) ??  0
         return $user;
    }
}
