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
    public function index($tour)
    {
        return view('admin.tours_jobs', ['jobs_for_tour' => Tour_employees::where('tour_id',$tour)->paginate(12),
            'tour' => $tour,'employees' => Employee::all()]);
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
        $res = Tour_employees::firstOrCreate([
            'Salary' => $request->Salary ?? 0,
            'Occupied_Place_Bus' => $request->Occupied_Place_Bus,
            'tour_id' => $request->tour_id,
            'employee_id' => $request->employee_id,
            'Confidentiality' => $request->Confidentiality,
        ]);

        $data = [
            'id' => $res->id,
            'Salary' => $request->Salary ?? 0,
            'Occupied_Place_Bus' => $request->Occupied_Place_Bus,
            'tour_id' => $request->tour_id,
            'employee_id' => $request->employee_id,
            'Confidentiality' => $request->Confidentiality,];

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tour, $job_for_tour)
    {
        Tour_employees::findOrFail($job_for_tour)->delete();

        return redirect()->route('jobsindex', $tour);
    }
}
