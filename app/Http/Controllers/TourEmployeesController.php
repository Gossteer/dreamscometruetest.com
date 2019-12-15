<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Tour_employees;
use Illuminate\Http\Request;
use DB;


class TourEmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $index_TourEmployees = Tour_employees::find($request->id);

        $date = [
            'Salary' =>  $index_TourEmployees->Salary ?? 0,
            'Occupied_Place_Bus' =>  $index_TourEmployees->Occupied_Place_Bus,
            'tour_id' => $request->tour_id,
            'employee_id' =>  $index_TourEmployees->employee_id,
            'Confidentiality' =>  $index_TourEmployees->Confidentiality == 1 ? 1 : 0,
        ];

        return $date;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = Tour_employees::Create([
            'Salary' => $request->Salary ?? 0,
            'Occupied_Place_Bus' => $request->Occupied_Place_Bus,
            'tour_id' => $request->tour_id,
            'employee_id' => $request->employee_id,
            'Confidentiality' => $request->Confidentiality,
        ]);

        $employee = Employee::find($request->employee_id);

        $data = [
            'id' => $res->id,
            'Salary' => number_format($request->Salary, 0, ',', ' ') . '₽' ?? 0,
            'Occupied_Place_Bus' => $request->Occupied_Place_Bus,
            'tour_id' => $request->tour_id,
            'FIO_Full' => $employee->Surname . ' ' . $employee->Name  . ' ' . $employee->Middle_Name,
            'FIO' => $employee->Surname . ' ' . mb_substr($employee->Name, 0, 1)  . '. ' . mb_substr($employee->Middle_Name, 0, 1) . ($employee->Middle_Name != '' ? '.' : ''),
            'Job' => $employee->job != null ? $employee->job->Company . ' ' . $employee->job->Job_Title . ' зп: ' . (($employee->job->Salary == null)? 'договорная': number_format($employee->job->Salary, 0, ',', ' ') . '₽') : 'Не назначена',
            'Confidentiality' => $request->Confidentiality == 1 ? 'Да' : 'Нет',
            'Class_Style' => $request->Confidentiality == 1 ? 'label gradient-2 btn-rounded' : 'label gradient-1 btn-rounded'
            ];

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Tour_employees::find($request->id)->update([
            'Salary' => $request->Salary ?? 0,
            'Occupied_Place_Bus' => $request->Occupied_Place_Bus,
            'tour_id' => $request->tour_id,
            'employee_id' => $request->employee_id,
            'Confidentiality' => $request->Confidentiality,
        ]);

        $employee = Employee::find($request->employee_id);

        $data = [
            'id' => $request->id,
            'Salary' => number_format($request->Salary, 0, ',', ' ') . '₽' ?? 0,
            'Occupied_Place_Bus' => $request->Occupied_Place_Bus,
            'tour_id' => $request->tour_id,
            'FIO_Full' => $employee->Surname . ' ' . $employee->Name  . ' ' . $employee->Middle_Name,
            'FIO' => $employee->Surname . ' ' . mb_substr($employee->Name, 0, 1)  . '. ' . mb_substr($employee->Middle_Name, 0, 1) . ($employee->Middle_Name != '' ? '.' : ''),
            'Job' => $employee->job != null ? $employee->job->Company . ' ' . $employee->job->Job_Title . ' зп: ' . (($employee->job->Salary == null)? 'договорная': number_format($employee->job->Salary, 0, ',', ' ') . '₽') : 'Не назначена',
            'Confidentiality' => $request->Confidentiality == 1 ? 'Да' : 'Нет',
            'Class_Style' => $request->Confidentiality == 1 ? 'label gradient-2 btn-rounded' : 'label gradient-1 btn-rounded'
        ];

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Tour_employees::find($request->id)->delete();

        $date = 1;

        return $date;
    }
}
