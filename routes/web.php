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
    Route::resource('admin/typeactivity', 'TypeActivityController');
    Route::get('/admin', 'SiteController@adminindex')->name('/admin');
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
Route::get('/packages/{tour}/{Name_Tours}', 'TourController@tourdescript')->name('tourdescript');

Route::get('/ухади', 'SiteController@type_user_false')->name('typeuserfalse');

Route::get('/', function () {
    return view('site.index', ['tours' => Tour::orderByDesc('Price')->paginate(4)]);
})->name('/');

Route::get('/about', function () {
    return view('site.about');
})->name('/about');

Route::post('/contact', 'ContactController@send')->name('/contactsend');
Route::get('/contact', 'ContactController@index')->name('/contact');

Route::group(['middleware' => ['auth','check.user']], function () {
Route::get('/account', 'CustomerController@account')->name('AccountCustomer');
});

Route::group(['middleware' => ['web','logining.user']], function() {

// Login Routes...
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);


// Registration Routes...
    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);

// Password Reset Routes...
    Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.update', 'uses' => 'Auth\ResetPasswordController@reset']);
});
Route::group(['middleware' => ['web']], function() {
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    });
//Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('/lol','CustomerController');
