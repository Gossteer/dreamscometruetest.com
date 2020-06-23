<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

        /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
            //!$this->logicalDelete() => ['accepted'],
          ]);

        //   $request->validate([
        //         
        //   ], [
        //         'LogicalDelete.accepted' => 'Ваша учётная запись удалена, для восстановления пожалуйста обратитесь к нам другими средствами связи!'
        //     ]);

        // $answer['LogicalDelete'] =  !User::where('email', $request->email)->first()->LogicalDelete ?? 1;
        // Validator::make($answer,[
        //     'LogicalDelete' => ['accepted'],
        // ], [
        //     'LogicalDelete.accepted' => 'Ваша учётная запись удалена, для восстановления пожалуйста обратитесь к нам другими средствами связи!'
        // ])->validate();
    }
}
