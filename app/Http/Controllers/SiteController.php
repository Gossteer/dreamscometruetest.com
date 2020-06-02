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
        $carbon_statistik_add = Carbon::create($today_tour->format('Y'), 1, 1, 00, 0, 0);
        $carbon_statistik_sub = Carbon::create($today_tour->format('Y'), 1, 1, 00, 0, 0);
        $summ_profit = array();
        $sum_expenses = array();
        $count_tours = array();
        $count_customers = array();
        $count_passengers = array();
        $avg_stars_tour = array();
        //dd($carbon_statistik_add->startOfYear(), $carbon_statistik_add, $carbon_statistik_add->startOfYear(), $today_tour, Carbon::now()->startOfYear(), Carbon::now()->endOfYear());

        for ($i=0; $i < 12; $i++) { 
            $carbon_statistik_add->addMonth();
            array_push($summ_profit, tour::where('LogicalDelete',0)->where('End_Date_Tours', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('Confirmation_Tours', 1)->where('End_Date_Tours', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->sum('Profit'));
            array_push($sum_expenses, tour::where('LogicalDelete',0)->where('End_Date_Tours', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('Confirmation_Tours', 1)->where('End_Date_Tours', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->sum('Expenses'));
            array_push($count_tours, tour::where('LogicalDelete',0)->where('End_Date_Tours', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('Confirmation_Tours', 1)->where('End_Date_Tours', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->count());
            array_push($count_customers, Customer::where('LogicalDelete',0)->where('created_at', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('Condition', '>=', 1)->where('created_at', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->count());
            array_push($count_passengers, Passenger::where('LogicalDelete',0)->where('created_at', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('Paid', '=', 1)->where('created_at', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->count());
            array_push($avg_stars_tour, Passenger::where('LogicalDelete',0)->where('created_at', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('Paid', '=', 1)->where('created_at', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->avg('Stars') ?? 0);
            $carbon_statistik_sub->addMonth();
            if (date('Y-m-d H:i', strtotime($carbon_statistik_add)) >  $today_tour) {
                break;  
            }
        }
        //dd($avg_stars_tour);
       

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
        $count_men_customers = Customer::where('LogicalDelete',0)->where('Floor', 0)->count();
        $count_women_customers = Customer::where('LogicalDelete',0)->where('Floor', 1)->count();

        //dd($present_tour->get(), $count_tour_not_complit->count());


        return view('admin.index', [
        'middle_age' =>  Customer::avg('Age_customer'), 'summ_profit' => $summ_profit, 'fullmanyforyers' => tour::where('LogicalDelete',0)->where('End_Date_Tours','>=',Carbon::now()->startOfYear())->where('Confirmation_Tours', 1)->where('End_Date_Tours','<=',Carbon::now()->endOfYear())->sum('Profit'),
        'last_tours' => $present_tour->orderByRaw('Expenses + Profit DESC, Start_Date_Tours DESC')->paginate(3), 'sum_expenses' => $sum_expenses,
        'sum' => tour::whereRaw('Confirmation_Tours = 1 and LogicalDelete = 0 and Start_Date_Tours <= ?',[$today_tour])->sum("Profit") - tour::whereRaw('Confirmation_Tours = 1 and LogicalDelete = 0 and Start_Date_Tours <= ?',[$today_tour])->sum("Expenses"),
        'count_tour' => tour::whereRaw('Confirmation_Tours = 1 and LogicalDelete = 0 and Start_Date_Tours <= ?',[$today_tour])->count(), 
        'count_tour_not_complit' => $count_tour_not_complit->count(), 'tours_not_complit' => $count_tour_not_complit->orderBy('Start_Date_Tours')->paginate(3), 'today_tour' => $today_tour,
        'tours_complit' => $present_tour->orderByRaw('Start_Date_Tours DESC')->paginate(3), 'fullmanyforyersexpens' => tour::where('LogicalDelete',0)->where('End_Date_Tours','>=',Carbon::now()->startOfYear())->where('Confirmation_Tours', 1)->where('End_Date_Tours','<=',Carbon::now()->endOfYear())->sum('Expenses'),
        'last_all_customers' => Customer::where('LogicalDelete',0)->orderByRaw('created_at DESC')->paginate(3), 'count_tours' => $count_tours, 'count_passengers' => $count_passengers,
        'count_all_customers' => Customer::where('LogicalDelete',0)->count(), 'count_men_customers' => $count_men_customers, 'count_customers' => $count_customers,
        'count_all_employee' => DB::table('employees')->Join('users', 'employees.users_id', '=', 'users.id')->where('employees.LogicalDelete', '=', 0)->Where('users.Type_User', '=', 1)->select('type_tours.*')->distinct()->count(),
        'count_women_customers'=> $count_women_customers, 'substr_count_women_customers' => substr($count_women_customers, -1), 'avg_stars_tour' => $avg_stars_tour]);
        
    }
}
