<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = Job::find($request->jobsid);
        $data = ['id' => $res->id, 'Job_Title' => $res->Job_Title, 'Salary' => $res->Salary, 'Company' => $res->Company,];

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.job.create', [ 'Job' => []]);
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
            'Job_Title' => ['required','unique:jobs', 'max:191','min:2'],
        ],[
            'Job_Title.unique' => 'Данная должность уже существует',
        ])->validate();

        $res = Job::firstOrCreate([
            'Job_Title' => $request->Job_Title,
            'Salary' => $request->Salary,
            'Company' => $request->Company,
        ]);

        $data = ['id' => $res->id, 'Job_Title' => $request->Job_Title, 'Salary' => $request->Salary, 'Company' => $request->Company,];

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('admin.job.update', [ 'job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        \Validator::make($request->all(), [
            'Job_Title' => ['required','unique:jobs,Job_Title,' . $request->jobsid, 'max:191','min:2'],
        ],[
            'Job_Title.unique' => 'Данная должность уже существует',
        ])->validate();

        Job::find($request->jobsid)->update([
            'Job_Title' => $request->Job_Title,
            'Salary' => $request->Salary,
            'Company' => $request->Company,
        ]);

        $datas = Job::all();
        return $datas;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Job::find($request->jobsid)->delete();

        $datas = Job::all();
        return $datas;
    }
}
