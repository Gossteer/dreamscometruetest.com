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
    public function index()
    {
        return view('admin.employees', ['employees' => Employee::where('LogicalDelete',0)->paginate(12), 'jobs' => Job::all()]);
    }

    public function indexfull(Request $request)
    {
        $res = Employee::find($request->employeeid);
        $us = User::find($res->users_id);
        $data = ['Type_User' => ($us->Type_User == 0 ? 'Без прав' : 'С правами'),'login' => $us->login, 'email' => $us->email, 'Description'=> $res->Description,
            'Joint_excursions' => $res->Joint_excursions, 'Set_Permission' => $res->Set_Permission,
            'Man_brought' => $res->Man_brought, 'FIO' => $res->Surname . ' ' . $res->Name  . ' ' . $res->Middle_Name,];

        return $data;
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
            'login' => ['required', 'string','min:2', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:16', 'confirmed'],
            'Surname' => ['required','string', 'min:2','max:50'],
            'Name' => ['required','string', 'min:2','max:50'],
            'Middle_Name' => ['max:50'],
            'Byrthday' => ['required','before_or_equal:date', 'date'],
            'Set_Permission' => ['min:0','max:2147483647'],
            'Man_brought' => ['min:0','max:2147483647'],
            'Joint_excursions' => ['min:0','max:2147483647'],
            'Level' => ['min:0','max:10'],
        ],[
            'Byrthday.before_or_equal' => 'Сотрудник не может быть младше 18 лет!',
            'Byrthday.date' => 'Укажите пожалуйста правильную дату!',
            'Phone_Number.unique' => 'Пользователь с данным номером телефона уже существует!',
            'login.unique' => 'Пользователь с таким ником уже существует!',
            'login.min' => 'Минимальный размер 2 символа!',
            'login.max' => 'Максимальный размер 20 символов!',
            'email.unique' => 'Пользователь с таким email уже существует!',
            'password.min' => 'Пароль должен быть не менее 8 символов!',
            'password.max' => 'Пароль не должен быть больше 16 символов',
            'Surname.min' => 'Фамилия должена иметь не менее 2 символов!',
            'Surname.max' => 'Фамилия должена быть не больше 50 символов',
            'Name.min' => 'Имя должено иметь не менее 2 символов!',
            'Name.max' => 'Имя должено быть больше не 50 символов',
            'Middle_Name.max' => 'Отчество должено быть не больше 50 символов',
            'password.confirmed' => 'Пароль не совпадает!',
            'required' => 'Это поле обязательно к заполнению!',
            'min' => 'Предел максимального значение',
            'max' => 'Превышено максимальное значение',
            'Level.max' => 'Максимальный уровень = 10',
        ])->validate();

        $user = User::Create([
            'login' => $request['login'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'Processing_Personal_Data' => $request['Processing_Personal_Data'],
            'Notifications' => $request['Notifications'] ?? 0,
            'Type_User' => $request['Type_User'],
        ]);

        $attribute =[
            'Name' => $request->Name,
            'Surname' => $request->Surname,
            'Middle_Name' => $request->Middle_Name,
            'Description' => $request->Description ?? 'Лучший в своём деле',
            'Byrthday' => date('Y-m-d', strtotime($request->Byrthday)),
            'Phone_Number' => $request->Phone_Number,
            'Contract_Employee' => $request->Contract_Employee,
            'Set_Permission' => $request->Set_Permission ?? 0,
            'Man_brought' => $request->Man_brought ?? 0,
            'Joint_excursions' => $request->Joint_excursions ?? 0,
            'Level' => $request->Level ?? 0,
            'jobs_id' => $request->jobs_id,
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
            'login' => ['required', 'string','min:2', 'max:20', 'unique:users,login,' . $employee->users_id ],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,' . $employee->users_id],
            'password' => ['confirmed'],
            'Surname' => ['required','string', 'min:2','max:50'],
            'Name' => ['required','string', 'min:2','max:50'],
            'Middle_Name' => ['max:50'],
            'Byrthday' => ['required','before_or_equal:date', 'date'],
            'Set_Permission' => ['min:0','max:2147483647'],
            'Man_brought' => ['min:0','max:2147483647'],
            'Joint_excursions' => ['min:0','max:2147483647'],
            'Level' => ['min:0','max:10'],
        ],[
            'Byrthday.before_or_equal' => 'Сотрудник не может быть младше 18 лет!',
            'Byrthday.date' => 'Укажите пожалуйста правильную дату!',
            'Phone_Number.unique' => 'Пользователь с данным номером телефона уже существует!',
            'login.unique' => 'Пользователь с таким ником уже существует!',
            'login.min' => 'Минимальный размер 2 символа!',
            'login.max' => 'Максимальный размер 20 символов!',
            'email.unique' => 'Пользователь с таким email уже существует!',
            'password.min' => 'Пароль должен быть не менее 8 символов!',
            'password.max' => 'Пароль не должен быть больше 16 символов',
            'Surname.min' => 'Фамилия должена иметь не менее 2 символов!',
            'Surname.max' => 'Фамилия должена быть не больше 50 символов',
            'Name.min' => 'Имя должено иметь не менее 2 символов!',
            'Name.max' => 'Имя должено быть больше не 50 символов',
            'Middle_Name.max' => 'Отчество должено быть не больше 50 символов',
            'required' => 'Это поле обязательно к заполнению!',
            'min' => 'Предел максимального значение',
            'max' => 'Превышено максимальное значение',
            'Level.max' => 'Максимальный уровень = 10',
        ])->validate();

        User::find($employee->users_id)->update([
            'login' => $request['login'],
            'email' => $request['email'],
            'password' => $request['password'] == null ?  User::find($employee->users_id)->password :  Hash::make($request['password']) ,
            'Processing_Personal_Data' => $request['Processing_Personal_Data'],
            'Notifications' => $request['Notifications'] ?? 0,
            'Type_User' => $request['Type_User'],
        ]);

        Employee::find($employee->id)->update([
            'Name' => $request->Name,
            'Surname' => $request->Surname,
            'Middle_Name' => $request->Middle_Name,
            'Description' => $request->Description ?? 'Лучший в своём деле',
            'Byrthday' => date('Y-m-d', strtotime($request->Byrthday)),
            'Phone_Number' => $request->Phone_Number,
            'Contract_Employee' => $request->Contract_Employee,
            'Set_Permission' => $request->Set_Permission ?? 0,
            'Man_brought' => $request->Man_brought ?? 0,
            'Joint_excursions' => $request->Joint_excursions ?? 0,
            'Level' => $request->Level ?? 0,
            'jobs_id' => $request->jobs_id,
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
