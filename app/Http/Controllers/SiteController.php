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
        $expenses = 0;
        foreach (tour::whereRaw('Start_Date_Tours < ?',[now()->subDay()])->get() as $tour)
        {
            foreach (Passenger::whereRaw('tours_id = ? and Presence = 1', [$tour->id])->get() as $passenger)
            {
                if ($tour->Privilegens_Price == 0)
                    $sum += $tour->Price;
                else if($passenger->Preferential_Terms == 1)
                    $sum += $tour->Privilegens_Price;
                else
                    $sum += $tour->Price;
            }
           $expenses = $tour->Expenses;
        }
        
        $count_tour = tour::whereRaw('Start_Date_Tours < ?',[now()->subDay()])->count();
        $count_all_customers = Customer::all()->count();
        $count_men_customers = Customer::where('Floor', 0)->count();
        $count_women_customers = Customer::where('Floor', 1)->count();
        $substr_count_women_customers = substr($count_women_customers, -1);

        return view('admin.index', ['sum' => ($sum - $expenses), 'count_tour' => $count_tour, 
        'count_all_customers' => $count_all_customers, 'count_men_customers' => $count_men_customers,
        'count_women_customers'=> $count_women_customers, 'substr_count_women_customers' => $substr_count_women_customers]);
    }
}
