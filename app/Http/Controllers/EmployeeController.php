<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Job;
use App\User;
use Hash;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employees.employees', ['employees' => Employee::paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employees.create',[
            'Employee' => [], 'jobs' => Job::all(),
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
        $user = User::create([
            'login' => $request['login'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'Processing_Personal_Data' => $request['Processing_Personal_Data'],
            'Notifications' => $request['Notifications'],
            'Type_User' => $request['Type_User'],
        ]);

        $attribute =['Name' => $request->Name, 'Surname' => $request->Surname,
            'Middle_Name' => $request->Middle_Name, 'Byrthday' => date('Y-m-d', strtotime($request->Byrthday)),
            'Phone_Number' => $request->Phone_Number, 'jobs_id' => $request->jobs_id,
            'users_id' => $user->id];

        Employee::create($attribute);

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('admin.employees.update', ['employees' => $employee, 'jobs' => Job::all(), 'user' => User::find($employee->users_id) ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        User::findOrFail($employee->users_id)->update($request->all());

        Employee::findOrFail($employee->id)->update(['Byrthday' => date('Y-m-d', strtotime($request->Byrthday)),$request->all()]);

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index');
    }
}
