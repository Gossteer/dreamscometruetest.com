<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Job;
use App\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $serh = $request->search ?? "";
        return view('admin.employees.employees', ['employees' => Employee::where('jobs_id', 'LIKE', "%$serh%")->paginate(12), 'jobs' => Job::all()]);
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
        //$date = Carbon::new->subYear(18);
        $attribute = $request->all();
        $attribute['date'] = Carbon::now()->subYear(18);

        \Validator::make($attribute, [
            'Phone_Number' => ['required', 'string', 'unique:employees'],
            'login' => ['required', 'string','min:2', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'Byrthday' => ['before_or_equal:date', 'date']
        ],[
            'Byrthday.before_or_equal' => 'Сотрудник не может быть младше 18 лет!',
            'Byrthday.date' => 'Укажите пожалуйста правильную дату!',
            'Phone_Number.unique' => 'Пользователь с данным номером телефона уже существует!',
            'login.unique' => 'Пользователь с таким ником уже существует!',
            'login.min' => 'Минимальный размер 2 символа!',
            'login.max' => 'Максимальный размер 255 символов!',
            'login.required' => 'Пожалуйста укажите логин!',
            'email.unique' => 'Пользователь с таким email уже существует!',
            'password.min' => 'Пароль должен быть не менее 8 символов!',
            'password.confirmed' => 'Пароль не совпадает!',
        ])->validate();

        $user = User::Create([
            'login' => $request['login'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'Processing_Personal_Data' => $request['Processing_Personal_Data'],
            'Notifications' => $request['Notifications'] ?? 0,
            'Type_User' => $request['Type_User'],
        ]);

        $attribute =['Name' => $request->Name, 'Surname' => $request->Surname,
            'Middle_Name' => $request->Middle_Name, 'Byrthday' => date('Y-m-d', strtotime($request->Byrthday)),
            'Phone_Number' => $request->Phone_Number, 'jobs_id' => $request->jobs_id,
            'users_id' => $user->id];

        Employee::Create($attribute);

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
        $attribute = $request->all();
        $attribute['date'] = Carbon::now()->subYear(18);

        \Validator::make($attribute, [
            'Phone_Number' => ['required', 'string', 'unique:employees,Phone_Number,' . $employee->id],
            'login' => ['required', 'string','min:2', 'max:255', 'unique:users,login,' . $employee->users_id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $employee->users_id],
            'Byrthday' => ['before_or_equal:date', 'date']
        ],[
            'Byrthday.before_or_equal' => 'Сотрудник не может быть младше 18 лет!',
            'Byrthday.date' => 'Укажите пожалуйста правильную дату!',
            'Phone_Number.unique' => 'Пользователь с данным номером телефона уже существует!',
            'login.unique' => 'Пользователь с таким ником уже существует!',
            'login.min' => 'Минимальный размер 2 символа!',
            'login.max' => 'Максимальный размер 255 символов!',
            'login.required' => 'Пожалуйста укажите логин!',
            'email.unique' => 'Пользователь с таким email уже существует!',
        ])->validate();

        User::find($employee->users_id)->update([
            'login' => $request['login'],
            'email' => $request['email'],
            'Processing_Personal_Data' => 1,
            'Notifications' => 1,
            'Type_User' => $request['Type_User'],
        ]);

        Employee::find($employee->id)->update([
            'Byrthday' => date('Y-m-d', strtotime($request->Byrthday)),
            'Name' => $request->Name, 'Surname' => $request->Surname,
            'Phone_Number' => $request->Phone_Number, 'jobs_id' => $request->jobs_id,
        ]);

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
