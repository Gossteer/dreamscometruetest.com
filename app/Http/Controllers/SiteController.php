<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Employee;
use App\Passenger;
use App\tour;
use App\Tour_employees;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function packages()
    {
        //dd(Carbon::now()->addDays(14), Carbon::now());
        $Carbon_add14 = Carbon::now()->addDays(14);
        $Carbon_now = Carbon::now();
        //dd($Carbon_now = Carbon::now(), $Carbon_add14 );
        
        return view('site.packages', ['Carbon' => $Carbon_add14, 'Cardon_hot' => $Carbon_now, 
            'tours_hots' => Tour::whereRaw('Start_Date_Tours <= ? and Start_Date_Tours >= ? and Confidentiality = 0',[$Carbon_add14, $Carbon_now])->orderBy('Start_Date_Tours')->paginate(4,['*'],'tours_hots'),
            'tours' => Tour::where('Confidentiality', 0)->orderByDesc('Start_Date_Tours')->paginate(8,['*'],'tours'),
            'tours_Popular' => Tour::where('Popular', 1)->where('Confidentiality', 0)->orderByDesc('Start_Date_Tours')->paginate(4,['*'],'tours_Popular'),
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
        $today_tour = Carbon::now();
        
        // foreach (tour::whereRaw('Start_Date_Tours < ?',[now()->subDay()])->get() as $tour)
        // {
        //     foreach (Passenger::whereRaw('tours_id = ? and Presence = 1', [$tour->id])->get() as $passenger)
        //     {
        //         if ($tour->Privilegens_Price == 0)
        //             $sum += $tour->Price;
        //         else if($passenger->Preferential_Terms == 1)
        //             $sum += $tour->Privilegens_Price;
        //         else
        //             $sum += $tour->Price;
        //     }
        //    $expenses = $tour->Expenses;
        // }
        $count_tour_not_complit = tour::whereRaw('Confirmation_Tours = 0 and LogicalDelete = 0 or Start_Date_Tours >= ?',[$today_tour]);
        $present_tour = Tour::whereRaw('Confirmation_Tours = 1 and LogicalDelete = 0 and Start_Date_Tours <= ?',[$today_tour]);
        $count_men_customers = Customer::where('Floor', 0)->count();
        $count_women_customers = Customer::where('Floor', 1)->count();

        //dd($present_tour->get(), $count_tour_not_complit->count());


        return view('admin.index', [
        'middle_age' =>  Customer::avg('Age_customer'),
        'last_tours' => $present_tour->orderByRaw('Expenses + Profit DESC, Start_Date_Tours DESC')->paginate(3),
        'sum' => tour::whereRaw('Confirmation_Tours = 1 and LogicalDelete = 0 and Start_Date_Tours <= ?',[$today_tour])->sum("Profit") - tour::whereRaw('Confirmation_Tours = 1 and LogicalDelete = 0 and Start_Date_Tours <= ?',[$today_tour])->sum("Expenses"),
        'count_tour' => tour::whereRaw('Confirmation_Tours = 1 and LogicalDelete = 0 and Start_Date_Tours <= ?',[$today_tour])->count(), 
        'count_tour_not_complit' => $count_tour_not_complit->count(), 'tours_not_complit' => $count_tour_not_complit->orderBy('Start_Date_Tours')->paginate(3), 'today_tour' => $today_tour,
        'tours_complit' => $present_tour->orderByRaw('Start_Date_Tours DESC')->paginate(3),
        'last_all_customers' => Customer::where('LogicalDelete',0)->orderByRaw('created_at DESC')->paginate(3),
        'count_all_customers' => Customer::where('LogicalDelete',0)->count(), 'count_men_customers' => $count_men_customers,
        'count_all_employee' => DB::table('employees')->Join('users', 'employees.users_id', '=', 'users.id')->where('employees.LogicalDelete', '=', 0)->Where('users.Type_User', '=', 1)->select('type_tours.*')->distinct()->count(),
        'count_women_customers'=> $count_women_customers, 'substr_count_women_customers' => substr($count_women_customers, -1)]);
        
    }
}
