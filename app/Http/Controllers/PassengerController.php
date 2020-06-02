<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Employee;
use App\Passenger;
use App\tour;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_tour)
    {
        return view('admin.passenger', ['passengers' => Passenger::where('tours_id', $id_tour), 'id_tour' => $id_tour]);
    }

    public function indexforcustomer(Request $request)
    {
        $passenger = Passenger::where('LogicalDelete',0)->where('Paid', 1)->where('customers_id', Customer::where('users_id',Auth::user()->id)->first()->id)->where('tours_id', $request->tours_id)->first();
        $date['Comment_Customer'] = $passenger->Comment_Customer;
        $date['Stars'] = $passenger->Stars;
        return $date;
    }

    public function createstar(Request $request)
    {
        if ($request->Stars < 0 or $request->Stars > 10) {
            $data ['errornumber'] = 1;
        } else {
            Passenger::where('LogicalDelete',0)->where('Paid', 1)->where('customers_id', Customer::where('users_id',Auth::user()->id)->first()->id)->where('tours_id', $request->tours_id)->update([
                'Stars' =>  $request->Stars,
                'Comment_Customer'=> $request->Comment_Customer,  
            ]);
            $data ['errornumber'] = 0;
        }

        return $data;
    }

    public function create_notbus(Request $request, $tour)
    {
        \Validator::make($request->all(),[
            'g-recaptcha-response' => 'required|captcha',
        ],[
            'g-recaptcha-response.required' => 'Пожалуйста подтвердите, что вы не робот!',
        ])->validate();

        $customer = Customer::where('users_id', Auth::user()->id)->first();
        $tour = tour::find($tour);

        if (($request->checkselecttypeprice != 'Наличными' or $request->Payment_method != 2) and ($request->checkselecttypeprice != 'Безналичными' or $request->Payment_method != 1)) {
            $answer['Payment_method'] = false;
        }else{
            $answer['Payment_method'] = true;
        }

        if (Passenger::where('LogicalDelete', 0)->where('tours_id', $tour->id)->where('customers_id', $customer->id)->exists()) {
            $answer['Payment_method'] = false;
        } else {
            $answer['Payment_method'] = true;
        }
        
        \Validator::make($answer,[
            'Payment_method' => ['accepted'],
        ],[
            'Payment_method.accepted' => 'Не балуйтесь!',
        ])->validate();

        \Validator::make($request->all(),[
            'Payment_method' => ['required','string'],
        ],[
            'Payment_method.required' => 'Пожалуйста выберете способ оплаты!',
            'Payment_method.integer' => 'Пожалуйста не балуйстесь!',
        ])->validate();



        $passenger = Passenger::create([
            'tours_id' => $tour->id, 
            'Occupied_Place_Bus' => $request->Occupied_Place_Bus,
            'Final_Price' => (($customer->Age_customer >= 65 and $customer->floor == 0) or ($customer->Age_customer >= 60 and $customer->floor == 1)) ? (($tour->Privilegens_Price != 0 or $tour->Privilegens_Price != null) ? $tour->Privilegens_Price : $tour->Price) : $tour->Price,
            'Payment_method' => $request->Payment_method, 
            'customers_id' => $customer->id, 
         ]);
         
         $passenger->tour->increment('Occupied_Place');

         return redirect()->route('AccountCustomer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $tour)
    {
        \Validator::make($request->all(),[
            'g-recaptcha-response' => 'required|captcha',
        ],[
            'g-recaptcha-response.required' => 'Пожалуйста подтвердите, что вы не робот!',
        ])->validate();
        
        if (Passenger::where('LogicalDelete', 0)->where('tours_id', $tour)->where('Occupied_Place_Bus',$request->Occupied_Place_Bus)->exists()) {
            $answer['exisattru'] = false;
        }else{
            $answer['exisattru'] = true;
        }

        $customer = Customer::where('users_id', Auth::user()->id)->first();
        $tour = tour::find($tour);

        if (($request->checkselecttypeprice != 'Наличными' or $request->Payment_method != 2) and ($request->checkselecttypeprice != 'Безналичными' or $request->Payment_method != 1)) {
            $answer['Payment_method'] = false;
        }else{
            $answer['Payment_method'] = true;
        }

        if (Passenger::where('LogicalDelete', 0)->where('tours_id', $tour->id)->where('customers_id', $customer->id)->exists()) {
            $answer['Payment_method'] = false;
        } else {
            $answer['Payment_method'] = true;
        }

        \Validator::make($answer,[
            'exisattru' => ['accepted'],
            'Payment_method' => ['accepted'],
        ],[
            'exisattru.accepted' => 'Данное место уже занято!',
            'Payment_method.accepted' => 'Не балуйтесь!',
        ])->validate();

        \Validator::make($request->all(),[
            'Occupied_Place_Bus' => ['required','integer'],
            'Payment_method' => ['required','string'],
        ],[
            'Payment_method.required' => 'Пожалуйста выберете способ оплаты!',
            'Occupied_Place_Bus.required' => 'Пожалуйста выберете себе место!',
            'Payment_method.integer' => 'Пожалуйста не балуйстесь!',
            'Occupied_Place_Bus.string' => 'Пожалуйста не балуйстесь!',
        ])->validate();



        $passenger = Passenger::create([
            'tours_id' => $tour->id, 
            'Occupied_Place_Bus' => $request->Occupied_Place_Bus,
            'Final_Price' => (($customer->Age_customer >= 65 and $customer->floor == 0) or ($customer->Age_customer >= 60 and $customer->floor == 1)) ? (($tour->Privilegens_Price != 0 or $tour->Privilegens_Price != null) ? $tour->Privilegens_Price : $tour->Price) : $tour->Price,
            'Payment_method' => $request->Payment_method, 
            'customers_id' => $customer->id, 
         ]);
        
        $passenger->tour->increment('Occupied_Place');

        // $aa = Customer::where('users_id', Auth::user()->id)->first();
        // $Preferential_Terms = '';
        // $dtr = $aa->Date_Birth_Customer;
        // $diff = Carbon::parse($dtr)->diff(Carbon::parse(Carbon::today()->toDateString()));
        // if($diff->y < 14 or $diff->y > 60)
        //     $Preferential_Terms = 1;
        // else
        //     $Preferential_Terms = 0;

        // Tour::findOrFail($request->tours_id)->update(['Occupied_Place' => Tour::find($request->tours_id)->Occupied_Place + 1]);
        // //DB::table('tours')
        //  //   ->where('id', $request->tours_id)
        //    // ->update(['Amount_Place' => Tour::find($request->tours_id)->Amount_Place + 1]);
        // $attribute = [
        //     'tours_id' => $request->tours_id,
        //     'customers_id' => $aa->id,
        //     'Preferential_Terms' => $Preferential_Terms,
        // ];
        // Passenger::create($attribute);
        return redirect()->route('AccountCustomer');
    }

    public function createadmin(Request $request, $tour)
    {


        \Validator::make($request->all(),[
            'Final_Price' => ['required', 'between:0,8388607', 'integer'],
            'Free_Children' => ['integer', 'nullable', 'between:0,8388607'],
            'Amount_Children' => ['integer', 'nullable', 'between:0,8388607'],
            'Accompanying' => ['nullable', 'between:0,1', 'integer'],
            'customers_id' => ['required', 'integer'],
            'Payment_method' => ['required', 'between:1,2', 'integer'],
            'Occupied_Place_Bus' => ['integer', 'nullable', 'between:0,8388607'],
            'Paid'=> ['nullable', 'between:0,1', 'integer'],
        ],[
            'between' => 'Укажите пожалуйста значения в диапозоне :min - :max.',
            'required' => 'Обязательное поле!',
            'integer' => 'Только числа!'
        ])->validate();

        $paidcomlite = Passenger::where('tours_id',$tour)->where('customers_id',$request->customers_id)->first() ?? null;
        if ($request->Paid == 0 and  $paidcomlite and $paidcomlite->Paid == 1 ) {
            tour::find($tour)->decrement('Profit',$request->Final_Price);
        }

        if ($request->Paid == 1 and  $paidcomlite and $paidcomlite->Paid == 0) {
            tour::find($tour)->increment('Profit',$request->Final_Price);
        } 

        if ($paidcomlite) {
            $paidcomlite->update([
                'tours_id' => $tour,
                'customers_id' => $request->customers_id,
                'Paid' => $request->Paid ?? 0,
               'Occupied_Place_Bus' => $request->Occupied_Place_Bus, 
               'Final_Price' => $request->Final_Price, 
               'Free_Children' => $request->Free_Children ?? 0,
               'Amount_Children' => $request->Amount_Children ?? 0,
               'Accompanying' => $request->Accompanying,
               'Payment_method' => $request->Payment_method,
                
            ]);
        } else {
            $passenger = Passenger::create([
                'tours_id' => $tour,
                'customers_id' => $request->customers_id,
                'Paid' => $request->Paid ?? 0,
               'Occupied_Place_Bus' => $request->Occupied_Place_Bus, 
               'Final_Price' => $request->Final_Price, 
               'Free_Children' => $request->Free_Children ?? 0,
               'Amount_Children' => $request->Amount_Children ?? 0,
               'Accompanying' => $request->Accompanying,
               'Payment_method' => $request->Payment_method,
                
            ]);
            if ($request->Paid == 1) {
                tour::find($tour)->increment('Profit',$request->Final_Price);
            } 
            $passenger->tour->increment('Occupied_Place');
        }




        

        

        // $aa = Customer::where('users_id', Auth::user()->id)->first();
        // $Preferential_Terms = '';
        // $dtr = $aa->Date_Birth_Customer;
        // $diff = Carbon::parse($dtr)->diff(Carbon::parse(Carbon::today()->toDateString()));
        // if($diff->y < 14 or $diff->y > 60)
        //     $Preferential_Terms = 1;
        // else
        //     $Preferential_Terms = 0;

        // Tour::findOrFail($request->tours_id)->update(['Occupied_Place' => Tour::find($request->tours_id)->Occupied_Place + 1]);
        // //DB::table('tours')
        //  //   ->where('id', $request->tours_id)
        //    // ->update(['Amount_Place' => Tour::find($request->tours_id)->Amount_Place + 1]);
        // $attribute = [
        //     'tours_id' => $request->tours_id,
        //     'customers_id' => $aa->id,
        //     'Preferential_Terms' => $Preferential_Terms,
        // ];
        // Passenger::create($attribute);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    public function complitetourforcustomer(Request $request)
    {
        $passenger = Passenger::find($request->Passenger_id);
        switch ($request->params) {
            case 0:
                $passenger->update([
                    'Payment_method' =>  $request->valueselect,
                ]);
                break;
            case 1:
                if ($request->valueselect == 1) {
                    tour::find($request->tour_id)->increment('Profit', $passenger->Final_Price);
                } elseif ($request->Paid == 0 and  $passenger and $passenger->Paid == 1 ) {
                    tour::find($request->tour_id)->decrement('Profit',$passenger->Final_Price);
                }
                $passenger->update([
                    'Paid' =>  $request->valueselect,
                ]);
                break;
            case 2:
                $passenger->update([
                    'Presence' =>  $request->valueselect,
                ]);
                break;
            case 3:
                $employee = Employee::where('users_id', Auth::user()->id)->first();
                $passenger->update([
                    'Comment_Employee' =>  ($employee->Surname . ' ' . mb_substr($employee->Name, 0, 1)  . '. ' . mb_substr($employee->Middle_Name, 0, 1) . ($employee->Middle_Name != '' ? '.' : '')) . ' ' . date('d.m.Y H:i', strtotime(Carbon::now())) . ': ' . $request->valueselect,
                ]);
                break;
        }

        return tour::find($request->tour_id)->Profit;
    }

    public function printpastour($tour)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord(); 
        $section = $phpWord->addSection();
        $i = 1;
        $section->addText( 'Список пассажиров',   array('name' => 'Tahoma', 'size' => 14 ), array('align' => 'center'));
        foreach (Passenger::where('tours_id', 3)->get() as $passenger){
            $section->addText(
              $i . '. ' .$passenger->customer->Name . ' ' . $passenger->customer->Surname . ' ' . $passenger->customer->Middle_Name . ', ' . ($passenger->Occupied_Place_Bus ? $passenger->Occupied_Place_Bus : '') . 
              ((($passenger->customer->Age_customer >= 65 and $passenger->customer->floor == 0) or ($passenger->customer->Age_customer >= 60 and $passenger->customer->floor == 1)) ? ', льготник' : ', не льготник'). ', ' . 
              $passenger->customer->Phone_Number_Customer . ($passenger->Accompanying == 0 ? '' : ', cопровождающий') . ($passenger->Amount_Children == 0 ? '' : ', детей: ' . $passenger->Amount_Children) . 
              ($passenger->Free_Children == 0 ? '' : ', бесплатных детей: ' . $passenger->Free_Children) . ($passenger->Payment_method == 1 ? ', наличными' : ', безналичными ') . 
              ($passenger->Paid == 0 ? ', ожидаем оплату' : ', оплатил ') . (($passenger->Presence == 0 and $passenger->tour->Confirmation_Tours == 1) ? ', не явился' : ', пришёл ') . 
              (', итоговая цена: ' . $passenger->Final_Price) . ($passenger->Stars ? (', оценка: ' . $passenger->Stars) : '') . ($passenger->Comment_Customer ? (', комментарий пассажира: ' . $passenger->Comment_Customer) : '') . 
              ($passenger->Comment_Employee ? (', комментарий сотрудника: ' . $passenger->Comment_Employee) : ''),
                array('name' => 'Tahoma', 'size' => 12)
            );
            $i++;
    }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('TestWordFile.docx'));
        } catch (Exception $e) {
        }

        return response()->download(storage_path('TestWordFile.docx'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function show(Passenger $passenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function edit(Passenger $passenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passenger  $passenger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tour, Passenger $passenger)
    {
        \Validator::make($request->all(),[
            'g-recaptcha-response' => 'required|captcha',
        ],[
            'g-recaptcha-response.required' => 'Пожалуйста подтвердите, что вы не робот!',
        ])->validate();

        $tour_find = tour::find($tour);
        if (Customer::where('users_id',Auth::user()->id)->first()->id == $passenger->customers_id and $tour_find->Start_Date_Tours > Carbon::now()) {
            if (Passenger::where('LogicalDelete', 0)->where('tours_id', $tour)->where('Occupied_Place_Bus',$request->Occupied_Place_Bus)->exists() and Passenger::where('LogicalDelete', 0)->where('tours_id', $tour)->where('Occupied_Place_Bus',$request->Occupied_Place_Bus)->first()->customers_id != Customer::where('users_id', Auth::user()->id)->first()->id) {
                    $answer['exisattru'] = false;
                }else{
                    $answer['exisattru'] = true;
                }

                if (($request->checkselecttypeprice != 'Наличными' or $request->Payment_method != 2) and ($request->checkselecttypeprice != 'Безналичными' or $request->Payment_method != 1)) {
                    $answer['Payment_method'] = false;
                }else{
                    $answer['Payment_method'] = true;
                }

                \Validator::make($answer,[
                    'exisattru' => ['accepted'],
                    'Payment_method' => ['accepted'],
                ],[
                    'exisattru.accepted' => 'Данное место уже занято!',
                    'Payment_method.accepted' => 'Не балуйтесь!',
                ])->validate();

                \Validator::make($request->all(),[
                    'Occupied_Place_Bus' => ['required','integer'],
                    'Payment_method' => ['required','string'],
                ],[
                    'Payment_method.required' => 'Пожалуйста выберете способ оплаты!',
                    'Occupied_Place_Bus.required' => 'Пожалуйста выберете себе место!',
                    'Payment_method.integer' => 'Пожалуйста не балуйстесь!',
                    'Occupied_Place_Bus.string' => 'Пожалуйста не балуйстесь!',
                ])->validate();

                $customer = Customer::where('users_id', Auth::user()->id)->first();
        
                $passenger->update([
                    'tours_id' => $tour, 
                    'Occupied_Place_Bus' => $request->Occupied_Place_Bus,
                    'Final_Price' => (($customer->Age_customer >= 65 and $customer->floor == 0) or ($customer->Age_customer >= 60 and $customer->floor == 1)) ? (($tour_find->Privilegens_Price != 0 or $tour_find->Privilegens_Price != null) ? $tour_find->Privilegens_Price : $tour_find->Price) : $tour_find->Price,
                    'Payment_method' => $request->Payment_method, 
                    'customers_id' => $customer->id, 
                 ]);
            } else {
                $answer['customers_id'] = false;
                \Validator::make($answer,[
                    'customers_id' => ['accepted'],
                ],[
                    'customers_id.accepted' => 'Не балуйтесь!',
                ])->validate();
            }


        

        // $aa = Customer::where('users_id', Auth::user()->id)->first();
        // $Preferential_Terms = '';
        // $dtr = $aa->Date_Birth_Customer;
        // $diff = Carbon::parse($dtr)->diff(Carbon::parse(Carbon::today()->toDateString()));
        // if($diff->y < 14 or $diff->y > 60)
        //     $Preferential_Terms = 1;
        // else
        //     $Preferential_Terms = 0;

        // Tour::findOrFail($request->tours_id)->update(['Occupied_Place' => Tour::find($request->tours_id)->Occupied_Place + 1]);
        // //DB::table('tours')
        //  //   ->where('id', $request->tours_id)
        //    // ->update(['Amount_Place' => Tour::find($request->tours_id)->Amount_Place + 1]);
        // $attribute = [
        //     'tours_id' => $request->tours_id,
        //     'customers_id' => $aa->id,
        //     'Preferential_Terms' => $Preferential_Terms,
        // ];
        // Passenger::create($attribute);
        return redirect()->route('AccountCustomer');
    }

//         switch ($passenger->Presence) {
//             case -1:
//                 if ($request->Presence == 1){
//                     Customer::findOrFail($passenger->customers_id)->update([
//                         'White_Days' => Customer::find($passenger->customers_id)->White_Days + 1,
//                         'Black_Days' => Customer::find($passenger->customers_id)->Black_Days - 1,
//                     ]);
//                 }
//                 break;
//             case 1:
//                 if ($request->Presence == -1){
//                     Customer::findOrFail($passenger->customers_id)->update([
//                         'White_Days' => Customer::find($passenger->customers_id)->White_Days - 1,
//                         'Black_Days' => Customer::find($passenger->customers_id)->Black_Days + 1
//                     ]);
//                 }
//                 break;
//             case 0:
//                 if ($request->Presence == 1)
//                 {
//                     Customer::findOrFail($passenger->customers_id)->update([
//                         'White_Days' => Customer::find($passenger->customers_id)->White_Days + 1,
//                     ]);
//                 }
//                 else
//                     Customer::findOrFail($passenger->customers_id)->update([
//                         'Black_Days' => Customer::find($passenger->customers_id)->Black_Days + 1]);
//                 break;
//         }




//         if (Customer::find($passenger->customers_id)->White_Days >=
//             ((Customer::find($passenger->customers_id)->Black_Days == 0) ?
//                 (Customer::find($passenger->customers_id)->Black_Days + 2) :
//                 (Customer::find($passenger->customers_id)->Black_Days * 2)) and
//             (Passenger::where('customers_id', $passenger->customers_id)->count() >= 2))
//             Customer::findOrFail($passenger->customers_id)->update([
//                 'Condition' => 1]);
//         elseif (Customer::find($passenger->customers_id)->Black_Days >=
//             ((Customer::find($passenger->customers_id)->White_Days == 0) ?
//                 (Customer::find($passenger->customers_id)->White_Days + 2) :
//                 (Customer::find($passenger->customers_id)->White_Days * 2)) and
//             ((Passenger::where('customers_id', $passenger->customers_id)->count() - 2) <= Customer::find($passenger->customers_id)->White_Days))
//             Customer::findOrFail($passenger->customers_id)->update([
//                 'Condition' => -2]);


//         $passenger->update([
// 'Presence' => $request->Presence,
//         ]);

//         return redirect()->back();
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  \App\Passenger  $passenger
//      * @return \Illuminate\Http\Response
//      */
    public function destroy($tour, Passenger $passenger)
    {
         
        $tour_find = tour::find($tour);
        if (Customer::where('users_id',Auth::user()->id)->first()->id == $passenger->customers_id and $tour_find->Start_Date_Tours > Carbon::now()) {
            $passenger->delete();
            tour::find($tour)->decrement('Occupied_Place', 1); 
        } else {
            $answer['customers_id'] = false;
            \Validator::make($answer,[
                'customers_id' => ['accepted'],
            ],[
                'customers_id.accepted' => 'Не балуйтесь!',
            ])->validate();
        }

        
        // Tour::findOrFail($passenger->tours_id)->update(['Occupied_Place' => Tour::find($passenger->tours_id)->Occupied_Place - 1]);

        // switch ($passenger->Presence){
        //     case 1:
        //         Customer::findOrFail($passenger->customers_id)->update([
        //             'White_Days' => Customer::find($passenger->customers_id)->White_Days - 1,
        //         ]);
        //         break;
        //     case -1:
        //         Customer::findOrFail($passenger->customers_id)->update([
        //             'Black_Days' => Customer::find($passenger->customers_id)->Black_Days - 1]);
        //         break;
        // }

//         $passenger->delete();

         return redirect()->back();
    }

    public function complitepaid($tour, Request $request)
    {
        $passenger = Passenger::where('tours_id', $tour)->where('customers_id', $request->customers_id)->first();
        $passenger->update([
            'Paid' => !$request->Paid,
        ]);
        if ($request->Paid == 1) {
            tour::find($passenger->tours_id)->increment('Profit', $passenger->Final_Price);
        } else {
            tour::find($passenger->tours_id)->decrement('Profit', $passenger->Final_Price);
        }

         return redirect()->back();
    }

    public function destroyadmin($tour, Request $request)
    {
        Passenger::where('tours_id', $tour)->where('customers_id', $request->customers_id)->delete();

        tour::find($tour)->decrement('Occupied_Place', 1); 
        // Tour::findOrFail($passenger->tours_id)->update(['Occupied_Place' => Tour::find($passenger->tours_id)->Occupied_Place - 1]);

        // switch ($passenger->Presence){
        //     case 1:
        //         Customer::findOrFail($passenger->customers_id)->update([
        //             'White_Days' => Customer::find($passenger->customers_id)->White_Days - 1,
        //         ]);
        //         break;
        //     case -1:
        //         Customer::findOrFail($passenger->customers_id)->update([
        //             'Black_Days' => Customer::find($passenger->customers_id)->Black_Days - 1]);
        //         break;
        // }

//         $passenger->delete();

         return redirect()->back();
    }

    
}
