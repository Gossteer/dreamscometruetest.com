<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Employee;
use App\Passenger;
use App\tour;
use Auth;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function packages()
    {
        return view('site.packages', ['tours' => Tour::orderByDesc('Start_Date_Tours')->paginate(12),
            'Age_Group' => Customer::where('users_id',(Auth::user()->id ?? null))->first()->Age_Group  ?? 0,
            'Condition' => Customer::where('users_id',(Auth::user()->id ?? null))->first()->Condition ?? 0,
            'customer_activ' => Customer::where('users_id',(Auth::user()->id ?? null))->first() ?? null,]);
    }

    public function type_user_false()
    {
        return view('site.type_user_false');
    }

    public function adminindex()
    {
        $sum = 0;
        foreach (tour::whereRaw('Start_Date_Tours < ?',[now()->subDay()])->get() as $tour)
        {
            foreach (Passenger::whereRaw('tours_id = ? and Presence = 1', [$tour->id])->get() as $passenger)
            {
                if($passenger->Preferential_Terms == 1)
                    $sum += $tour->Privilegens_Price;
                else
                    $sum += $tour->Price;
            }
        }
        return view('admin.index', ['sum' => $sum]);
    }
}
