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

Route::group(['middleware' => ['auth', 'type.user']], function () {
    Route::resource('admin/tours', 'TourController');
    Route::get('admin/printvauher/tours', 'TourController@prnpriviewvauher')->name('prnpriviewvauher');
    Route::get('admin/printspisoc/tours', 'TourController@prnpriviewspisok')->name('prnpriviewspisok');

    Route::get('/admin', function () { return view('layouts.admin');})->name('/admin');
    Route::resource('admin/employees', 'EmployeeController');
    Route::resource('admin/job', 'JobController');
    Route::resource('admin/customer', 'CustomerController');
    Route::resource('admin/partners', 'PartnerController');

    Route::post('admin/tours/passengers', 'PassengerController@store')->name('passengers.store');
    Route::get('admin/tours/passengers', 'PassengerController@index')->name('passengers.index');
    Route::put('admin/tours/passengers/{passenger}', 'PassengerController@update')->name('passengers.update');
    Route::get('admin/tours/{tour}/passengers/printspisoc', 'PassengerController@printpastour')->name('printpastour');
    Route::get('admin/tours/passengers/{passenger}/edit', 'PassengerController@edit')->name('passengers.edit');

    Route::get('admin/tours/{tour}/jobs', 'TourEmployeesController@index')->name('jobsindex');
    Route::delete('admin/tours/{tour}/jobs/{job_for_tour}', 'TourEmployeesController@destroy')->name('jobsdestroy');
    Route::post('admin/tours/{tour}/jobs', 'TourEmployeesController@store')->name('jobsstore');
    Route::get('admin/tours/{tour}/contracts', 'ContractController@index')->name('contractsindex');
    Route::delete('admin/tours/{tour}/contracts/{contranct}', 'ContractController@destroy')->name('contractsdestroy');
    Route::post('admin/tours/{tour}/contracts', 'ContractController@store')->name('contractsstore');
});

Route::group(['middleware' => ['auth']], function () {
Route::delete('admin/tours/passengers/{passenger}', 'PassengerController@destroy')->name('passengers.destroy');
Route::get('admin/tours/passengers/create', 'PassengerController@create')->name('passengers.create');
});

Route::get('/packages', 'SiteController@packages')->name('/packages');

Route::get('/ухади', 'SiteController@type_user_false')->name('typeuserfalse');

Route::get('/', function () {
    return view('site.index', ['tours' => Tour::orderByDesc('Price')->paginate(4)]);
})->name('/');

Route::get('/about', function () {
    return view('site.about');
})->name('/about');

Route::get('/contact', function () {
    return view('site.contact');
})->name('/contact');

Route::group(['middleware' => ['auth','check.user']], function () {
Route::get('/account', 'CustomerController@account')->name('AccountCustomer');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('/lol','CustomerController');
