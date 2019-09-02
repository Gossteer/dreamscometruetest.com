<?php

namespace App\Http\Controllers\Auth;

use App\Customer;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Redirect;
use DB;

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
    protected $redirectTo = '/home';

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
        return Validator::make($data, [
            'login' => ['required', 'string','min:3', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'Phone_Number_Customer' => ['required', 'string', 'unique:customers'],
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
            'Notifications' => $data['Notifications'],
        ]);

       // $Phone_Customer_Inviter = ();
        try {
            Customer::create([
                'Surname' => $data['Surname'],
                'Name' => $data['Name'],
                'Middle_Name' => $data['Middle_Name'],
                'Date_Birth_Customer' => date('Y-m-d', strtotime( $data['Date_Birth_Customer'])),
                'Phone_Number_Customer' => $data['Phone_Number_Customer'],
                'Floor' => $data['Floor'],
                'Phone_Customer_Inviter' =>  $data['Number_Customers_Inviter'] ?? null,
                'Number_Customers_Listed' => \Illuminate\Support\Facades\DB::table('customers')->where('Phone_Customer_Inviter', $data['Phone_Number_Customer'])->count(),
            ]);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

//is_int($Phone_Customer_Inviter) ??  0
         return $user;
    }
}
