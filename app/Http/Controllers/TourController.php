<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Contract;
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
        return view('admin.tours', ['tours' => Tour::where('Name_Tours', 'LIKE', "%$serh%")->orderByDesc('Start_Date_Tours')->paginate(12), ]);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.tours.create', ['type_tours' => Type_Tour::where('LogicalDelete', 0)->get(),  'Tour' => [], 'buses_ids' => Bus::where('LogicalDelete', 0)->get(), 'routes_ids' => Route::where('tour_id', null)->get() ]);
    }

    public function prnpriviewvauher()
{
    return view('admin.tours.toursvauher', ['tours' => tour::whereRaw('Start_Date_Tours >= ?',[now()->subDay()])->get()]);
}

    public function prnpriviewspisok()
    {
        return Excel::download(new Pamagite, 'prnpriviewspisok.xlsx');
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
            'Assessment' => ['between:0,10'],
            'Price' => ['required', 'between:0,8388607', 'integer'],
            'Children_price' => [ 'between:0,8388607'],
            'Privilegens_Price' => [ 'between:0,8388607'],
            'Amount_Place' => ['required', 'between:0,8388607', 'integer'],
            'Expenses' => ['required', 'between:0,2147483647', 'integer'],
            'Start_Date_Tours' => ['required','before_or_equal:End_Date_Tours','date'],
            'End_Date_Tours' => ['required','after_or_equal:Start_Date_Tours','date'],

        ],[
            'date' => 'Не является правильной датой',
            'Start_Date_Tours.before_or_equal'=> 'Начало не может быть после конца! (Кличко)',
            'End_Date_Tours.after_or_equal'=> 'Конец не может быть перед началом! (Виталий)',
            'between' => 'Укажите пожалуйста число в диапазоне :min - :max',
            'Amount_Place.integer' => 'Введите пожалуйста число!',
            'Privilegens_Price.integer' => 'Введите пожалуйста число!',
            'Price.integer' => 'Введите пожалуйста число!',
            'Expenses.integer' => 'Введите пожалуйста число!',
            'Amount_Place.digits_between' => 'Размер превысил все допустимые пределы!',
            'Privilegens_Price.digits_between' => 'Размер превысил все допустимые пределы!',
            'Price.digits_between' => 'Размер превысил все допустимые пределы!',
        ])->validate();

        $Start_Date_Tours = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($request->Start_Date_Tours)));
        $End_Date_Tours = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($request->End_Date_Tours)));

        $tour = Tour::create([
            'Name_Tours'=> $request->Name_Tours,
            'Description'=> $request->Description,
            'Price'=> $request->Price,
            'Duration' => $End_Date_Tours->diffInDays($Start_Date_Tours),
            'Privilegens_Price'=> $request->Privilegens_Price,
            'Children_price' => $request->Children_price,
            'Expenses'=> $request->Expenses,
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
                Route::find($request->routes_id[$i])->update([
                    'tour_id'=> $tour->id
                ]);
                Route::where('tour_id', null)->delete();
            };

        if ($request->buses_id)
            for ($i=0; $i < count($request->buses_id); $i++) { 
                Transort::create([
                    'buses_id' => $request->buses_id[$i],
                    'tour_id'=> $tour->id
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
        
        return view('admin.passenger', [
            'passengers' => Passenger::whereRaw('tours_id = ? and LogicalDelete = 0', $tour->id)->paginate(6),
            'tour' => $tour,
            'tour_employees' => Tour_employees::whereRaw('LogicalDelete = 0 and tour_id = ?', $tour->id)->paginate(3),
            'contracts' => Contract::where('LogicalDelete',0)->get(),
            'partners' => Partner::where('LogicalDelete',0)->get(),
            'employees' => Employee::where('LogicalDelete',0)->get(),
            'passenger' => Passenger::all(),
        ]);

    }

    public function tourdescript($tour,$Name_Tours)
    {
        return view('site.packagesingle',['tour'=> Tour::where('id',$tour)->first(), 'tours' => Tour::orderByDesc('Price')->paginate(4)]);
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

        $Transort = Transort::select('buses_id')->where('tour_id', $tour->id)->get()->toArray();
        $Transort_array = array();
        for ($i=0; $i < count($Transort); $i++) { 
            array_push($Transort_array, $Transort[$i]['buses_id']);
        };

        // $latestPosts = DB::table('type_tour_manies')
        //            ->where('tour_id', $tour->id)
        //            ->groupBy('type_tours_id');

        // $users = DB::table('type_tours')
        //         ->joinSub($latestPosts, 'type_tour_manies', function ($join) {
        //             $join->on('type_tours.id', '=', 'type_tour_manies.type_tours_id');
        //         })->get();

        //dd( DB::table('type_tours')->leftJoin('type_tour_manies', 'type_tours.id', '=', 'type_tour_manies.type_tours_id')->where('type_tours.LogicalDelete', '=', 0)->orWhere('type_tour_manies.tour_id', '=', $tour->id)->select('type_tours.*')->distinct()->get(), $tour->id);

        return view('admin.tours.update', ['type_tours' => DB::table('type_tours')->leftJoin('type_tour_manies', 'type_tours.id', '=', 'type_tour_manies.type_tours_id')->where('type_tours.LogicalDelete', '=', 0)->orWhere('type_tour_manies.tour_id', '=', $tour->id)->select('type_tours.*')->distinct()->get(), 
          'tour' => $tour, 'type_tour_many' => $type_tour_many_array, 'transpor' => $Transort_array,
          'buses_ids' => DB::table('buses')->leftJoin('transorts', 'transorts.buses_id', '=', 'buses.id')->where('buses.LogicalDelete', '=', 0)->orWhere('transorts.tour_id', '=', $tour->id)->select('buses.*')->distinct()->get(),  'routes_ids' => Route::where('tour_id', $tour->id)->get()]);
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

        \Validator::make($request->all(), [
            'Name_Tours' => ['required', 'min:2', 'max:50'],
            'Assessment' => ['between:0,10'],
            'Price' => ['required', 'between:0,8388607', 'integer'],
            'Children_price' => [ 'between:0,8388607'],
            'Privilegens_Price' => [ 'between:0,8388607'],
            'Amount_Place' => ['required', 'between:0,8388607', 'integer'],
            'Expenses' => ['required', 'between:0,2147483647', 'integer'],
            'Start_Date_Tours' => ['required','date'],
            'End_Date_Tours' => ['required','date'],

        ],[
            'date' => 'Не является правильной датой',
            'between' => 'Укажите пожалуйста число в диапазоне :min - :max',
            'Amount_Place.integer' => 'Введите пожалуйста число!',
            'Privilegens_Price.integer' => 'Введите пожалуйста число!',
            'Price.integer' => 'Введите пожалуйста число!',
            'Expenses.integer' => 'Введите пожалуйста число!',
            'Amount_Place.digits_between' => 'Размер превысил все допустимые пределы!',
            'Privilegens_Price.digits_between' => 'Размер превысил все допустимые пределы!',
            'Price.digits_between' => 'Размер превысил все допустимые пределы!',
        ])->validate();


        $attributes =[
            'Name_Tours'=> $request->Name_Tours,
            'Description'=> $request->Description,
            'Price'=> $request->Price,
            'Duration' => $End_Date_Tours->diffInDays($Start_Date_Tours),
            'Privilegens_Price'=> $request->Privilegens_Price,
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
    
            
            //$Transorts = Transort::where('tour_id', $tour->id);
            for ($i=0; $i < count($request->buses_id); $i++) { 
                if (!Transort::whereRaw('buses_id = ? and tour_id = ?', [$request->buses_id[$i], $tour->id])->exists())
                    Transort::create([
                        'buses_id' => $request->buses_id[$i],
                        'tour_id'=> $tour->id
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
