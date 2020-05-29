<?php

namespace App\Http\Middleware;

use App\Customer;
use App\Passenger;
use App\Tour;
use Auth;
use Carbon\Carbon;
use Closure;
use PhpParser\Node\Stmt\If_;

class CheckCountTourPlace
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        
        
        $customer = Customer::where('users_id', Auth::user()->id)->first();
        $tour = Tour::find($request->route('tour')); 
        //dd(Passenger::whereRaw('customers_id = ? and tours_id = ?',[Customer::where('users_id', Auth::user()->id)->first()->id, $tour])->exists(), Customer::where('users_id', Auth::user()->id)->first()->id, $tour->id);
        //dd($customer->Condition == 0 or $customer->Condition == -1, !Customer::where('users_id', \Auth::user()->id)->exists(), $tour->Occupied_Place == $tour->Amount_Place or $tour->Occupied_Place >= $tour->Amount_Place);
        if($tour->Confidentiality == 1 or (($tour->Occupied_Place == $tour->Amount_Place and !Passenger::whereRaw('customers_id = ? and tours_id = ?',[Customer::where('users_id', Auth::user()->id)->first()->id, $tour->id])->exists()) or ($tour->Occupied_Place >= $tour->Amount_Place and !Passenger::whereRaw('customers_id = ? and tours_id = ?',[Customer::where('users_id', Auth::user()->id)->first()->id, $tour->id])->exists())) or (!Customer::where('users_id', Auth::user()->id)->exists()) or ($customer->Condition == 0 or $customer->Condition == -1) or ($tour->Start_Date_Tours <= Carbon::now()) or (Auth::user()->customer->Age_customer < 18)){
            return redirect()->route('tourdescript',[$tour, str_slug($tour->Name_Tours, '-')]);
        }

        return $next($request);
    }
}
