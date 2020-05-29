<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Contract;
use App\Customer;
use App\Employee;
use App\Partner;
use DB;
use App\Passenger;
use App\Route;
use App\tour;
use App\Tour_employees;
use App\Transort;
use App\Type_Tour;
use Carbon\Carbon;
use App\Type_Tour_Many;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Concerns\FromView;
use \Excel;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Stmt\For_;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $serh = $request->search ?? "";

        return view('admin.tours', ['today'=> Carbon::now(), 'todayadd14' => Carbon::now()->addDays(14), 'tours' => Tour::where('Name_Tours', 'LIKE', "%$serh%")->where('LogicalDelete', 0)->orderByDesc('Start_Date_Tours')->paginate(12), ]);

    }

    public function tourcomplite(Request $request)
    {
        
        return view('admin.tourscomplite', [
            'today'=> Carbon::now(), 'tour' => Tour::find($request->route('tour')), 
            'Passengers' => Passenger::where('tours_id', $request->route('tour'))->paginate(8),
            ]);

    }
    
    public function tourcomplitesubmit($tour, Request $request)
    {
       $tour = tour::find($tour);

        if ($request->answer == 1) {
            \Validator::make($request->all(), [
                'Expenses' => ['required', 'between:0,2147483647', 'integer'],
                'Profit' => ['between:0,2147483647', 'integer', 'nullable'],
            ],[
                'between' => 'Укажите пожалуйста число в диапазоне :min - :max',
                'Expenses.integer' => 'Введите пожалуйста число!',
                'required' => 'Пожалуйста заполните поле!',
            ])->validate();

            $tour ->update([
                'Profit'=> $request->Profit ?? 0,
                'Expenses'=> $request->Expenses,
                'Assessment'=> $request->Assessment ,
                'Confidentiality' => $request->Confidentiality,
                'Confirmation_Tours' => $request->answer
            ]);
            foreach (Passenger::where('tours_id', $tour->id)->where('LogicalDelete', 0)->get() as $passenger) {
                if ($passenger->Presence == 1) {
                    $passenger->customer->increment('White_Days');
                } else {
                    $passenger->customer->increment('Black_Days');
                }
            }
        } else {
            foreach (Passenger::where('tours_id', $tour->id)->where('LogicalDelete', 0)->get() as $passenger) {
                if ($passenger->Presence == 1) {
                    $passenger->customer->decrement('White_Days');
                } else {
                    $passenger->customer->decrement('Black_Days');
                }
            }
            $tour ->update([
                'Confirmation_Tours' => $request->answer
            ]);
        }


        

        return redirect()->route('tours.index');
    }

    public function complite(Request $request)
    {
        $tour = tour::find($request->id);
        if($request->answer == 1){
            $tour->update([
                'Confirmation_Tours' => 1,
            ]);
            foreach ($tour->tour_employees as $tour_employee) {
                $tour_employee->employee->increment('Joint_excursions');
            };
        } else{
            $tour->update([
                'Confirmation_Tours' => 0,
            ]);
            foreach ($tour->tour_employees as $tour_employee) {
                $tour_employee->employee->decrement('Joint_excursions');
            };
        }
            
        return $request->id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.tours.create', ['type_tours' => Type_Tour::where('LogicalDelete', 0)->get(),  
        'Tour' => [], 'buses_ids' => Bus::where('LogicalDelete', 0)->get(), 'routes_ids' => Route::where('tour_id', null)->get() ]);
    }

    public function prnpriviewvauher()
    {
        return view('admin.tours.toursvauher', ['tours' => tour::whereRaw('Start_Date_Tours >= ?',[Carbon::now()])->get()]);
    }

    public function prnpriviewspisok()
    {
        return Excel::download(new Pamagite, 'prnpriviewspisok.xlsx');
    }

    public function tourgo($tour,$Name_Tours)
    {
        $EmployePlaceRecorded = Tour_employees::where('tour_id',$tour)->where('LogicalDelete', 0)->get()->toArray();
        $EmployePlaceRecorded_array = array();
        for ($i=0; $i < count($EmployePlaceRecorded); $i++) { 
            array_push($EmployePlaceRecorded_array, $EmployePlaceRecorded[$i]['Occupied_Place_Bus']);
        };

        $CustomerPlaceRecordedPaid = Passenger::where('tours_id',$tour)->where('LogicalDelete', 0)->where('Paid', 1)->get()->toArray();
        $CustomerPlaceRecordedPaid_array = array();
        for ($i=0; $i < count($CustomerPlaceRecordedPaid); $i++) { 
            array_push($CustomerPlaceRecordedPaid_array, $CustomerPlaceRecordedPaid[$i]['Occupied_Place_Bus']);
        };

        $CustomerPlaceRecorded = Passenger::where('tours_id',$tour)->where('LogicalDelete', 0)->get()->toArray();
        $CustomerPlaceRecorded_array = array();
        for ($i=0; $i < count($CustomerPlaceRecorded); $i++) { 
            array_push($CustomerPlaceRecorded_array, $CustomerPlaceRecorded[$i]['Occupied_Place_Bus']);
        };
        
        //dd(Transort::where('Main_Transort', 1)->where('tour_id', $tour)->first());
        return view('site.packagesrecord',['tour'=> Tour::find($tour),'bus_tour' => Transort::where('Main_Transort', 1)->where('tour_id', $tour)->first(), 
        'PassengerCompliteRecord' => Passenger::whereRaw('customers_id = ? and tours_id = ?',[Customer::where('users_id', Auth::user()->id)->first()->id, $tour])->first() ?? null,
        'EmployePlaceRecorded' => $EmployePlaceRecorded_array, 'CustomerPlaceRecorded' => $CustomerPlaceRecorded_array, 'CustomerPlaceRecordedPaid' => $CustomerPlaceRecordedPaid_array
        ]);
    }
    
    public function customeridnex(Request $request)
    {
        $customer = Customer::find($request->customer_id);
        $tour = tour::find($request->tour_id);
        $passenger = Passenger::where('LogicalDelete', 0)->where('tours_id', $request->tour_id)->where('customers_id',$request->customer_id)->first();

        if(($customer->Age_customer >= 65 and $customer->floor == 0) or ($customer->Age_customer >= 60 and $customer->floor == 1)){
            $data['finalprice'] = $passenger ? $passenger->Final_Price :  (($tour->Privilegens_Price != 0 or $tour->Privilegens_Price != null) ? $tour->Privilegens_Price : $tour->Price);
            $data['age_groop'] = 1;
        } else {
            $data['finalprice'] = $passenger ? $passenger->Final_Price : $tour->Price;
            $data['age_groop'] = 0;
        }
        
        switch ($passenger->Payment_method ?? 0) {
            case 0:
                $data['Payment_method_text'] = '';
                break;
            
            case 1:
                $data['Payment_method_text'] = 'Безналичными';
                break;

            case 2:
                $data['Payment_method_text'] = 'Наличными';
                break;
        }
        
        $data['Occupied_Place_Bus'] = $passenger->Occupied_Place_Bus ?? 0;
        $data['Paid'] = $passenger->Paid ?? 0;
        $data['Free_Children'] = $passenger->Free_Children ?? '';
        $data['Amount_Children'] = $passenger->Amount_Children ?? '';
        $data['Accompanying'] = $passenger->Accompanying ?? 0;
        $data['Payment_method'] = $passenger->Payment_method ?? 0;
        $data['exists_for_rour'] = Passenger::where('LogicalDelete', 0)->where('tours_id', $request->tour_id)->where('customers_id',$request->customer_id )->exists();
        $data['full_name_customer'] = $customer->Name . ' ' .  $customer->Surname . ' ' .  $customer->Middle_Name ?? '';
        $data['duration_date'] = $customer->Age_customer;
        $data['phone_customer'] = $customer->Phone_Number_Customer;
        $data['inviter'] = $customer->Phone_Customer_Inviter ?? 0;
        $data['count_tours'] = $customer->White_Days;

        return $data;

    }

    public function tourgoadmin($tour)
    {
       
        $EmployePlaceRecorded = Tour_employees::where('tour_id',$tour)->where('LogicalDelete', 0)->get()->toArray();
        $EmployePlaceRecorded_array = array();
        for ($i=0; $i < count($EmployePlaceRecorded); $i++) { 
            array_push($EmployePlaceRecorded_array, $EmployePlaceRecorded[$i]['Occupied_Place_Bus']);
        };

        $CustomerPlaceRecordedPaid = Passenger::where('tours_id',$tour)->where('LogicalDelete', 0)->where('Paid', 1)->get()->toArray();
        $CustomerPlaceRecordedPaid_array = array();
        $CustomerRecordedPaid_array = array();
        for ($i=0; $i < count($CustomerPlaceRecordedPaid); $i++) { 
            array_push($CustomerPlaceRecordedPaid_array, $CustomerPlaceRecordedPaid[$i]['Occupied_Place_Bus']);
            array_push($CustomerRecordedPaid_array, $CustomerPlaceRecordedPaid[$i]['customers_id']);
        };

        $CustomerPlaceRecorded = Passenger::where('tours_id',$tour)->where('LogicalDelete', 0)->get()->toArray();
        $CustomerPlaceRecorded_array = array();
        $CustomerRecorded_array = array();
        for ($i=0; $i < count($CustomerPlaceRecorded); $i++) { 
            array_push($CustomerPlaceRecorded_array, $CustomerPlaceRecorded[$i]['Occupied_Place_Bus']);
            array_push($CustomerRecorded_array, $CustomerPlaceRecorded[$i]['customers_id']);
        };

        
        $str_delete = array("(", ")", " ", "+", "-");
        //dd(Transort::where('Main_Transort', 1)->where('tour_id', $tour)->first());
        return view('admin.packagesrecord',['tour'=> Tour::find($tour),'bus_tour' => Transort::where('Main_Transort', 1)->where('tour_id', $tour)->first(), 
        'customers' => Customer::where('LogicalDelete', 0)->get(),  'Amount_place_employees' => Tour_employees::where('tour_id', $tour)->where('Occupied_Place_Bus', '!=', null)->where('LogicalDelete', 0)->count(),
        'passenger' => Passenger::where('tours_id',$tour)->where('LogicalDelete', 0)->where('Occupied_Place_Bus', '!=', null)->where('Occupied_Place_Bus', '!=', 0)->get(),
        'EmployePlaceRecorded' => $EmployePlaceRecorded_array, 'str_delete'=> $str_delete, 'CustomerPlaceRecorded' => $CustomerPlaceRecorded_array, 
        'CustomerPlaceRecordedPaid' => $CustomerPlaceRecordedPaid_array, 'CustomerRecordedPaid_array' => $CustomerRecordedPaid_array, 'CustomerRecorded_array' => $CustomerRecorded_array,
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
        

        \Validator::make($request->all(), [
            'Name_Tours' => ['required', 'min:2', 'max:50'],
            'Assessment' => ['between:0,10','integer', 'nullable'],
            'Price' => ['required', 'between:0,8388607', 'integer'],
            'Children_price' => [ 'between:0,8388607','integer', 'nullable'],
            'Privilegens_Price' => [ 'between:0,8388607','integer', 'nullable'],
            'Amount_Place' => ['required', 'between:0,8388607', 'integer'],
            'Occupied_Place' => ['between:0,8388607','integer', 'nullable'],
            'Expenses' => ['required', 'between:0,2147483647', 'integer'],
            'Profit' => ['between:0,2147483647', 'integer', 'nullable'],
            'Seating' => ['required'],
            'Start_Date_Tours' => ['required','before_or_equal:End_Date_Tours','date','before:'. Carbon::now()->addYear()],
            'End_Date_Tours' => ['required','after_or_equal:Start_Date_Tours','date'],

        ],[
            'date' => 'Не является правильной датой',
            'Start_Date_Tours.before_or_equal'=> 'Начало не может быть после конца! ((C) Кличко)',
            'Start_Date_Tours.before' => 'Планирование экскурсии больше чем на год невозможно!',
            'End_Date_Tours.after_or_equal'=> 'Конец не может быть перед началом! ((C) Виталий)',
            'between' => 'Укажите пожалуйста число в диапазоне :min - :max',
            'Amount_Place.integer' => 'Введите пожалуйста число!',
            'Privilegens_Price.integer' => 'Введите пожалуйста число!',
            'Price.integer' => 'Введите пожалуйста число!',
            'Expenses.integer' => 'Введите пожалуйста число!',
            'Amount_Place.between' => 'Размер превысил все допустимые пределы!',
            'Privilegens_Price.between' => 'Размер превысил все допустимые пределы!',
            'Price.between' => 'Размер превысил все допустимые пределы!',
            'required' => 'Пожалуйста заполните поле!',
        ])->validate();

        if ($request->buses_id and $request->buses_id[0] != "null")
        \Validator::make($request->all(),[
            'bus_Main_Transort' => ['required','integer', 'between:1,2147483647'],
        ],[
            'bus_Main_Transort.required' => 'Пожалуйста назначьте основной транспорт!',
            'bus_Main_Transort.between' => 'Пожалуйста назначьте основной транспорт!',
        ])->validate();

        $Start_Date_Tours = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($request->Start_Date_Tours)));
        $End_Date_Tours = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($request->End_Date_Tours)));

        $tour = Tour::create([
            'Name_Tours'=> $request->Name_Tours,
            'Description'=> $request->Description,
            'Price'=> $request->Price,
            'Program'=> $request->Program,
            'Start_point' => $request->Start_point,
            'Duration' => $End_Date_Tours->diffInDays($Start_Date_Tours),
            'Privilegens_Price'=> $request->Privilegens_Price,
            'Children_price' => $request->Children_price,
            'Occupied_Place' => $request->Occupied_Place ?? 0,
            'Expenses'=> $request->Expenses,
            'Profit'=> $request->Profit ?? 0,
            'Amount_Place'=> $request->Amount_Place,
            'Start_Date_Tours'=> date('Y-m-d H:i', strtotime($request->Start_Date_Tours)),
            'End_Date_Tours'=> date('Y-m-d H:i', strtotime($request->End_Date_Tours)),
            'Assessment'=> $request->Assessment ?? 0,
            'Popular'=> $request->Popular ?? 0,
            'Seating'=> $request->Seating,
            'Confidentiality' => $request->Confidentiality,
        ]);

        if ($request->routes_id)
            for ($i=0; $i < count($request->routes_id); $i++) { 
                if ($request->routes_id[$i] != "null") {
                    Route::find($request->routes_id[$i])->update([
                        'tour_id'=> $tour->id
                    ]);
                }
            };
            Route::where('tour_id', null)->delete();

        if ($request->buses_id)
            for ($i=0; $i < count($request->buses_id); $i++) { 
                if ($request->buses_id[$i] != "null")
                    Transort::create([
                        'buses_id' => $request->buses_id[$i],
                        'tour_id'=> $tour->id,
                        'Main_Transort' => ($request->bus_Main_Transort == $request->buses_id[$i] and $request->bus_Main_Transort != null and $request->bus_Main_Transort != 0) ? 1 : 0,
                    ]);
            };

        for ($i=0; $i < count($request->type_tours_id); $i++) { 
            Type_Tour_Many::create([
                'type_tours_id' => $request->type_tours_id[$i],
                'tour_id'=> $tour->id
            ]);
        };
        

        return redirect()->route('tours.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(tour $tour)
    {
        //dd(Tour_employees::whereRaw('tour_id = ? and employee_id = ?', [$tour->id, $tour->bus->employee_id ?? null])->exists());
        //dd(Transort::where('tour_id', $tour->id)->where('Main_Transort')->first());
        return view('admin.passenger', [
            'place_transport' => Transort::where('tour_id', $tour->id)->where('Main_Transort',1)->first(),
            'passengers' => Passenger::whereRaw('tours_id = ? and LogicalDelete = 0', $tour->id)->paginate(6,['*'],'passenger_pages'),
            'tour' => $tour,
            'tour_employees' => Tour_employees::whereRaw('LogicalDelete = 0 and tour_id = ?', $tour->id)->paginate(3,['*'],'passengertour_employees_pages'),
            'contracts' => Contract::where('LogicalDelete',0)->paginate(3,['*'],'partners_pages'),
            'partners' => Partner::where('LogicalDelete',0)->get(),
            'employees' => Employee::where('LogicalDelete',0)->get(),
            'passenger' => Passenger::all(),
        ]);

    }

    public function tourdescript($tour,$Name_Tours)
    {
        
        return view('site.packagesingle',['tour'=> Tour::find($tour),'Carbon' => Carbon::now()->addDays(14), 'Avg_Stars' => Passenger::where('tours_id', $tour)->where('Stars', '>', 0)->avg('Stars'),
        'Cardon_hot' => Carbon::now(), 'tours' => Tour::orderByDesc('Start_Date_Tours')->paginate(4), 'Count_Star' => Passenger::where('tours_id', $tour)->where('Stars', '>', 0)->count(), 
        'PassengerCompliteRecord' => (Auth::check() and Customer::where('users_id', Auth::user()->id)->exists()) ? Passenger::whereRaw('customers_id = ? and tours_id = ?',[Customer::where('users_id', Auth::user()->id)->first()->id, $tour])->exists() : null  ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(tour $tour)
    {
        $type_tour_many = Type_Tour_Many::select('type_tours_id')->where('tour_id', $tour->id)->get()->toArray();
        $type_tour_many_array = array();
        for ($i=0; $i < count($type_tour_many); $i++) { 
            array_push($type_tour_many_array, $type_tour_many[$i]['type_tours_id']);
        };

        $Transport_Main = Transort::where('tour_id', $tour->id)->where('Main_Transort', 1)->first();
        $Transort_arrayfirst = Transort::where('tour_id', $tour->id)->get()->toArray();
        $Transort_array = array();
        for ($i=0; $i < count($Transort_arrayfirst); $i++) { 
            array_push($Transort_array, $Transort_arrayfirst[$i]['buses_id']);
        };
        
        if($Transport_Main != null){
            $Transport_Main_string = $Transport_Main->bus->Type_Transport . ' ' . $Transport_Main->bus->Title_Transport . ' ' . $Transport_Main->bus->Amount_Place_Bus . 'м ';
            if(($Transport_Main->bus->Type_Transport == 'Автобус' or $Transport_Main->bus->Type_Transport == 'Микроавтобус') and ($Transport_Main->bus->employee != null)){
                $Transport_Main_string .= date('d.m.Y', strtotime($Transport_Main->bus->Year_Issue)) . ' ' . $Transport_Main->bus->employee->Surname . ' ' . mb_substr($Transport_Main->bus->employee->Name, 0, 1)  . '. ' . mb_substr($Transport_Main->bus->employee->Middle_Name, 0, 1) . ($Transport_Main->bus->employee->Middle_Name != '' ? '.' : '');
            }
        }

        //dd(Transort::where('tour_id', $tour->id)->where('Main_Transort', 1)->first());

        // $latestPosts = DB::table('type_tour_manies')
        //            ->where('tour_id', $tour->id)
        //            ->groupBy('type_tours_id');

        // $users = DB::table('type_tours')
        //         ->joinSub($latestPosts, 'type_tour_manies', function ($join) {
        //             $join->on('type_tours.id', '=', 'type_tour_manies.type_tours_id');
        //         })->get();

        //dd( DB::table('type_tours')->leftJoin('type_tour_manies', 'type_tours.id', '=', 'type_tour_manies.type_tours_id')->where('type_tours.LogicalDelete', '=', 0)->orWhere('type_tour_manies.tour_id', '=', $tour->id)->select('type_tours.*')->distinct()->get(), $tour->id);

        return view('admin.tours.update', ['type_tours' => DB::table('type_tours')->leftJoin('type_tour_manies', 'type_tours.id', '=', 'type_tour_manies.type_tours_id')->where('type_tours.LogicalDelete', '=', 0)->orWhere('type_tour_manies.tour_id', '=', $tour->id)->select('type_tours.*')->distinct()->get(), 
          'tour' => $tour, 'type_tour_many' => $type_tour_many_array, 'transpor' => $Transort_array, 'Transport_Main_CountPlace' => $Transport_Main->bus->Amount_Place_Bus ?? 0, 
          'Transport_Main' => $Transport_Main->buses_id ?? 0, 'Transport_Main_string' => $Transport_Main_string ?? '',
          'buses_ids' => DB::table('buses')->leftJoin('transorts', 'transorts.buses_id', '=', 'buses.id')->leftjoin('employees', 'employees.id', '=', 'buses.employee_id')->where('buses.LogicalDelete', '=', 0)->orWhere('transorts.tour_id', '=', $tour->id)->select('buses.*', 'employees.Middle_Name', 'employees.Surname','employees.Name')->distinct()->get(), 
          'routes_ids' => Route::where('tour_id', $tour->id)->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tour $tour)
    {
        $Start_Date_Tours = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($request->Start_Date_Tours)));
        $End_Date_Tours = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($request->End_Date_Tours)));
        //dd($request->bus_Main_Transort);

        \Validator::make($request->all(), [
            'Name_Tours' => ['required', 'min:2', 'max:50'],
            'Assessment' => ['between:0,10','integer', 'nullable'],
            'Price' => ['required', 'between:0,8388607', 'integer'],
            'Children_price' => [ 'between:0,8388607','integer', 'nullable'],
            'Privilegens_Price' => [ 'between:0,8388607','integer', 'nullable'],
            'Seating' => ['required'],
            'Amount_Place' => ['required', 'between:0,8388607', 'integer'],
            'Occupied_Place' => ['between:0,8388607','integer', 'nullable'],
            'Expenses' => ['required', 'between:0,2147483647', 'integer'],
            'Profit' => ['between:0,2147483647', 'integer', 'nullable'],
            'Start_Date_Tours' => ['required','before_or_equal:End_Date_Tours','date','before:'. Carbon::now()->addYear()],
            'End_Date_Tours' => ['required','after_or_equal:Start_Date_Tours','date'],

        ],[
            'date' => 'Не является правильной датой',
            'Start_Date_Tours.before_or_equal'=> 'Начало не может быть после конца! (Кличко)',
            'Start_Date_Tours.before' => 'Планирование экскурсии больше чем на год невозможно!',
            'End_Date_Tours.after_or_equal'=> 'Конец не может быть перед началом! (Виталий)',
            'between' => 'Укажите пожалуйста число в диапазоне :min - :max',
            'Amount_Place.integer' => 'Введите пожалуйста число!',
            'Privilegens_Price.integer' => 'Введите пожалуйста число!',
            'Price.integer' => 'Введите пожалуйста число!',
            'Expenses.integer' => 'Введите пожалуйста число!',
            'Amount_Place.between' => 'Размер превысил все допустимые пределы!',
            'Privilegens_Price.between' => 'Размер превысил все допустимые пределы!',
            'Price.between' => 'Размер превысил все допустимые пределы!',
            'required' => 'Пожалуйста заполните поле!',
        ])->validate();

        if ($request->buses_id and $request->buses_id[0] != "null")
        \Validator::make($request->all(),[
            'bus_Main_Transort' => ['required','integer', 'between:1,2147483647'],
        ],[
            'bus_Main_Transort.required' => 'Пожалуйста назначьте основной транспорт!',
            'bus_Main_Transort.between' => 'Пожалуйста назначьте основной транспорт!',
        ])->validate();

        $attributes =[
            'Name_Tours'=> $request->Name_Tours,
            'Description'=> $request->Description,
            'Price'=> $request->Price,
            'Duration' => $End_Date_Tours->diffInDays($Start_Date_Tours),
            'Privilegens_Price'=> $request->Privilegens_Price,
            'Program'=> $request->Program,
            'Profit'=> $request->Profit ?? 0,
            'Occupied_Place' => $request->Occupied_Place ?? 0,
            'Start_point' => $request->Start_point,
            'Children_price' => $request->Children_price,
            'Expenses'=> $request->Expenses,
            'Amount_Place'=> $request->Amount_Place,
            'Start_Date_Tours'=> date('Y-m-d H:i', strtotime($request->Start_Date_Tours)),
            'End_Date_Tours'=> date('Y-m-d H:i', strtotime($request->End_Date_Tours)),
            'Assessment'=> $request->Assessment ,
            'Popular'=> $request->Popular ?? 0,
            'Seating'=> $request->Seating,
            'Confidentiality' => $request->Confidentiality,
        ];
        $tour->update($attributes);
        

            if ($request->routes_id){
                //dd(Route::where('id', $request->routes_id[0])->exists());
                for ($i=0; $i < count($request->routes_id); $i++) { 
                    if($request->routes_id[$i] != "null")
                        Route::find($request->routes_id[$i])->update([
                            'tour_id'=> $tour->id
                        ]);
                        
                };
                Route::where('tour_id', null)->delete();
                
                $Route = Route::select('id')->where('tour_id', $tour->id)->get()->toArray();
                for ($i=0; $i < count($Route); $i++) { 
                    if(!in_array($Route[$i]['id'], $request->routes_id))
                        Route::find($Route[$i]['id'])->delete();
                };
            }    

        if ($request->buses_id){
            $Transort = Transort::select('buses_id','id')->where('tour_id', $tour->id)->get()->toArray();
            for ($i=0; $i < count($Transort); $i++) { 
                if(!in_array($Transort[$i]['buses_id'], $request->buses_id))
                    Transort::find($Transort[$i]['id'])->delete();
            };
    
            //dd($request->bus_Main_Transort, $request->buses_id[0]);
            //$Transorts = Transort::where('tour_id', $tour->id);
            for ($i=0; $i < count($request->buses_id); $i++) { 
                if ($request->buses_id[$i] != "null")
                    Transort::updateOrCreate([
                        'buses_id' => $request->buses_id[$i],
                        'tour_id'=> $tour->id,  
                    ],[
                        'Main_Transort' => ($request->bus_Main_Transort == $request->buses_id[$i] and $request->bus_Main_Transort != null and $request->bus_Main_Transort != 0) ? 1 : 0,
                    ]);
            };
        }
    
        $type_tour_many = Type_Tour_Many::select('type_tours_id','id')->where('tour_id', $tour->id)->get()->toArray();
        for ($i=0; $i < count($type_tour_many); $i++) { 
            if(!in_array($type_tour_many[$i]['type_tours_id'], $request->type_tours_id))
                Type_Tour_Many::find($type_tour_many[$i]['id'])->delete();
        };

        //$Type_Tour_Manys = Type_Tour_Many::where('tour_id', $tour->id);
        for ($i=0; $i < count($request->type_tours_id); $i++) { 
            //dd($Type_Tour_Manys->where('type_tours_id', 1)->exists(), $request->type_tours_id, count($request->type_tours_id), $Type_Tour_Manys);
            if (!Type_Tour_Many::whereRaw('type_tours_id = ? and tour_id = ?', [$request->type_tours_id[$i], $tour->id])->exists()){
                Type_Tour_Many::create([
                    'type_tours_id' => $request->type_tours_id[$i],
                    'tour_id'=> $tour->id
                ]);
            }
        };

        return redirect()->route('tours.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(tour $tour)
    {
       $tour->delete();

        return redirect()->route('tours.index');
    }
}
