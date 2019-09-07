<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Tour;
use App\Customer;

Route::get('/', function () {
    return view('site.index', ['tours' => Tour::orderByDesc('Price')->paginate(4)]);
})->name('/');

Route::get('/about', function () {
    return view('site.about');
})->name('/about');

Route::get('/contact', function () {
    return view('site.contact');
})->name('/contact');

// Что делать с экскурсиями?

Route::get('/packages', function () {
    return view('site.packages', ['tours' => Tour::paginate(12),
        'Age_Group' => Customer::find(Auth::user()->id)->Age_Group,
        'Condition' => Customer::find(Auth::user()->id)->Condition,
        'customer_activ' => Customer::find(Auth::user()->id),]);
})->name('/packages');

Route::get('/admin', function () {
    return view('layouts.admin');
})->name('/admin')->middleware('auth');

Route::resource('admin/tours', 'TourController')->middleware('auth');

Route::resource('admin/employees', 'EmployeeController')->middleware('auth');

Route::resource('admin/job', 'JobController')->middleware('auth');

Route::resource('admin/customer', 'CustomerController')->middleware('auth');

Route::resource('admin/tours/passengers', 'PassengerController')->middleware('auth');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('/lol','CustomerController');
