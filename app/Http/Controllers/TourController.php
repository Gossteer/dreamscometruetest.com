<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Contract;
use App\Employee;
use App\Partner;
use App\Passenger;
use App\tour;
use App\Tour_employees;
use App\Type_Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Concerns\FromView;
use \Excel;

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
        return view('admin.tours.create', ['type_tours' => Type_Tour::all(), 'Tour' => [], 'buses_ids' => Bus::all() ]);
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

       $Start_Date_Tours = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($request->Start_Date_Tours)));
       $End_Date_Tours = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d H:i', strtotime($request->End_Date_Tours)));

        \Validator::make($request->all(), [
            'Name_Tours' => ['required', 'min:2', 'max:50'],
            'type_tours_id' => ['required'],
            'Assessment' => ['required', 'between:0,10', 'integer'],
            'Price' => ['required', 'between:0,8388607', 'integer'],
            'Children_price' => ['required', 'between:0,8388607', 'integer'],
            'Privilegens_Price' => ['required', 'between:0,8388607', 'integer'],
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

        Tour::create([
            'Name_Tours'=> $request->Name_Tours,
            'Description'=> $request->Description,
            'type_tours_id' => $request->type_tours_id,
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
        return view('admin.passenger', [
            'passengers' => Passenger::whereRaw('tours_id = ? and LogicalDelete = 0', $tour->id)->paginate(6),
            'tour' => $tour,
            'tour_employees' => Tour_employees::whereRaw('LogicalDelete = 0 and tour_id = ?', $tour->id)->paginate(3),
            'contracts' => Contract::where('LogicalDelete',0)->get(),
            'partners' => Partner::where('LogicalDelete',0)->get(),
            'employees' => Employee::where('LogicalDelete',0)->get()
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
        return view('admin.tours.update', ['type_tours' => Type_Tour::all(), 'tour' => $tour,]);
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
            'type_tours_id' => ['required'],
            'Assessment' => ['required', 'between:0,10', 'integer'],
            'Price' => ['required', 'between:0,8388607', 'integer'],
            'Children_price' => ['required', 'between:0,8388607', 'integer'],
            'Privilegens_Price' => ['required', 'between:0,8388607', 'integer'],
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
            'type_tours_id' => $request->type_tours_id,
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
