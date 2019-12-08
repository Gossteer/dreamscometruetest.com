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
    Route::resource('admin/customer', 'CustomerController');
    Route::resource('admin/partners', 'PartnerController');

    Route::get('/admin', 'SiteController@adminindex')->name('/admin');

    Route::get('admin/printvauher/tours', 'TourController@prnpriviewvauher')->name('prnpriviewvauher');
    Route::get('admin/printspisoc/tours', 'TourController@prnpriviewspisok')->name('prnpriviewspisok');
    Route::get('admin/tours/{tour}/passengers/printspisoc', 'PassengerController@printpastour')->name('printpastour');

    Route::post('admin/employees/fullindex', 'EmployeeController@indexfull')->name('employees.index.full');
    Route::resource('admin/employees', 'EmployeeController');

    Route::post('admin/typeactivity', 'TypeActivityController@store')->name('typeactivity.store');
    Route::post('admin/deletetypeactivity', 'TypeActivityController@destroy')->name('typeactivity.destroy');
    Route::post('admin/partnerupdatetypeactivity', 'TypeActivityController@partnerupdate')->name('typeactivity.partner.update');

    Route::post('admin/typetourcreate', 'TypeTourController@store')->name('typetour.store');
    Route::post('admin/typetourindex', 'TypeTourController@index')->name('typetour.index');
    Route::post('admin/typetourupdate', 'TypeTourController@update')->name('typetour.update');
    Route::post('admin/create/typetourdestroy', 'TypeTourController@destroy')->name('typetour.destroy');

    Route::delete('admin/partners/{partner}/edit/{addres}', 'AddressController@destroy')->name('addresssdestroy');

    Route::post('admin/job', 'JobController@index')->name('job.index');
    Route::post('admin/jobcreate', 'JobController@store')->name('job.store');
    Route::post('admin/jobupdate', 'JobController@update')->name('job.update');
    Route::post('admin/deletejob', 'JobController@destroy')->name('job.destroy');

    Route::post('admin/touremployeecreate', 'TourEmployeesController@store')->name('touremployee.store');
    Route::post('admin/touremployeeindex', 'TourEmployeesController@index')->name('touremployee.index');
    Route::post('admin/touremployeeupdate', 'TourEmployeesController@update')->name('touremployee.update');
    Route::post('admin/touremployeedestroy', 'TourEmployeesController@destroy')->name('touremployee.destroy');

    Route::post('admin/tours/passengers', 'PassengerController@store')->name('passengers.store');
    Route::get('admin/tours/passengers', 'PassengerController@index')->name('passengers.index');
    Route::put('admin/tours/passengers/{passenger}', 'PassengerController@update')->name('passengers.update');
    Route::get('admin/tours/passengers/{passenger}/edit', 'PassengerController@edit')->name('passengers.edit');
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
