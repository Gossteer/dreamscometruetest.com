<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Employee;
use App\tour;
use Auth;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function packages()
    {
        return view('site.packages', ['tours' => Tour::paginate(12),
            'Age_Group' => Customer::where('users_id',(Auth::user()->id ?? null))->first()->Age_Group  ?? 0,
            'Condition' => Customer::where('users_id',(Auth::user()->id ?? null))->first()->Condition ?? 0,
            'customer_activ' => Customer::where('users_id',(Auth::user()->id ?? null))->first() ?? null,]);
    }

    public function type_user_false()
    {
        return view('site.type_user_false');
    }
}
