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

Route::get('/packages', 'SiteController@packages')->middleware('auth')->name('/packages');

Route::get('/admin', function () {
    return view('layouts.admin');
})->name('/admin')->middleware('auth');

Route::resource('admin/tours', 'TourController')->middleware('auth');

Route::resource('admin/employees', 'EmployeeController')->middleware('auth');

Route::resource('admin/job', 'JobController')->middleware('auth');

Route::resource('admin/customer', 'CustomerController')->middleware('auth');
Route::get('/account', 'CustomerController@account')->middleware('auth')->name('AccountCustomer');

Route::resource('admin/partners', 'PartnerController')->middleware('auth');

Route::resource('admin/tours/passengers', 'PassengerController')->middleware('auth');

Route::get('admin/tours/{tour}/jobs', 'TourEmployeesController@index')->middleware('auth')->name('jobsindex');

Route::delete('admin/tours/{tour}/jobs/{job_for_tour}', 'TourEmployeesController@destroy')->middleware('auth')->name('jobsdestroy');

Route::post('admin/tours/{tour}/jobs', 'TourEmployeesController@store')->middleware('auth')->name('jobsstore');

Route::get('admin/tours/{tour}/contracts', 'ContractController@index')->middleware('auth')->name('contractsindex');

Route::delete('admin/tours/{tour}/contracts/{contranct}', 'ContractController@destroy')->middleware('auth')->name('contractsdestroy');

Route::post('admin/tours/{tour}/contracts', 'ContractController@store')->middleware('auth')->name('contractsstore');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('/lol','CustomerController');
