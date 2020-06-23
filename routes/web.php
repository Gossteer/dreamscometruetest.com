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
use Carbon\Carbon;

Route::group(['middleware' => ['auth', 'type.user']], function () {
    Route::resource('admin/partners', 'PartnerController');
    Route::get('admin/partnersdelete', 'PartnerController@indexdelete')->name('partners.indexdelete');
    Route::put('admin/partnersdelete/{partner}', 'PartnerController@destroyremuve')->name('partners.destroyremuve');
    Route::delete('admin/partnersfulldelete/{partner}', 'PartnerController@fulldestroy')->name('partners.fulldestroy');

    Route::resource('admin/tours', 'TourController');
    Route::post('admin/tourscomplite', 'TourController@complite')->name('tours.complite');
    Route::get('admin/printvauher/tours', 'TourController@prnpriviewvauher')->name('prnpriviewvauher');
    Route::get('admin/printspisoc/tours', 'TourController@prnpriviewspisok')->name('prnpriviewspisok');
    Route::get('admin/tours/{tour}/printspisoc', 'PassengerController@printpastour')->name('printpastour');
    Route::get('admin/tours/{tour}/tourcomplite', 'TourController@tourcomplite')->name('tourcomplite');
    Route::put('admin/tours/{tour}/tourcomplite/complite', 'TourController@tourcomplitesubmit')->name('tourcomplitesubmit');
    Route::post('admin/tours/{tour}/complitepaid', 'PassengerController@complitepaid')->name('complitepaid');
    Route::post('admin/tours/complitetourforcustomer', 'PassengerController@complitetourforcustomer')->name('complitetourforcustomer');
    Route::get('admin/tours/{tour}/record', 'TourController@tourgoadmin')->name('tourgoadmin');
    Route::delete('admin/tours/{tour}/passenger/delete', 'PassengerController@destroyadmin')->name('destroyadmin');
    Route::post('admin/tourscustomeridnex', 'TourController@customeridnex')->name('customer.indexrecord'); 

    Route::resource('admin/customer', 'CustomerController');
    Route::post('admin/customercomplite', 'CustomerController@condition_complite')->name('customer.condition_complite');
    Route::post('admin/customer/fullindex', 'CustomerController@indexfull')->name('customer.index.full');
    Route::get('admin/customerdelete', 'CustomerController@indexdelete')->name('customer.indexdelete'); 
    Route::put('admin/customerdelete/{customer}', 'CustomerController@destroyremuve')->name('customer.destroyremuve');
    Route::delete('admin/customerfulldelete/{customer}', 'CustomerController@fulldestroy')->name('customer.fulldestroy');

    Route::get('/admin', 'SiteController@adminindex')->name('/admin');

    Route::post('admin/employees/fullindex', 'EmployeeController@indexfull')->name('employees.index.full');
    Route::resource('admin/employees', 'EmployeeController');
    Route::get('admin/employeesdelete', 'EmployeeController@indexdelete')->name('employees.indexdelete');
    Route::put('admin/employeesdelete/{employee}', 'EmployeeController@destroyremuve')->name('employees.destroyremuve');
    Route::delete('admin/employeesfulldelete/{employee}', 'EmployeeController@fulldestroy')->name('employees.fulldestroy');

    Route::post('admin/addressstore', 'AddressController@store')->name('address.store');
    Route::post('admin/addressindex', 'AddressController@index')->name('address.index');
    Route::post('admin/addressupdate', 'AddressController@update')->name('address.update');
    Route::post('admin/deleteaddress', 'AddressController@destroy')->name('address.destroy');

    Route::post('admin/phonenomberstore', 'PhoneNomberController@store')->name('phonenomber.store');
    Route::post('admin/phonenomberindex', 'PhoneNomberController@index')->name('phonenomber.index');
    Route::post('admin/phonenomberupdate', 'PhoneNomberController@update')->name('phonenomber.update');
    Route::post('admin/deletephonenomber', 'PhoneNomberController@destroy')->name('phonenomber.destroy');

    Route::post('admin/emailstore', 'EmailController@store')->name('email.store');
    Route::post('admin/emailindex', 'EmailController@index')->name('email.index');
    Route::post('admin/emailupdate', 'EmailController@update')->name('email.update');
    Route::post('admin/deleteemail', 'EmailController@destroy')->name('email.destroy');

    Route::post('admin/websitestore', 'WebsiteController@store')->name('website.store');
    Route::post('admin/websiteindex', 'WebsiteController@index')->name('website.index');
    Route::post('admin/websiteupdate', 'WebsiteController@update')->name('website.update');
    Route::post('admin/deletewebsite', 'WebsiteController@destroy')->name('website.destroy');

    Route::post('admin/typeactivityremovedeleted', 'TypeActivityController@removedeleted')->name('typeactivity.removedeleted');
    Route::post('admin/typeactivityfulldeleted', 'TypeActivityController@fulldeleted')->name('typeactivity.fulldeleted');
    Route::post('admin/typeactivitystore', 'TypeActivityController@store')->name('typeactivity.store');
    Route::post('admin/typeactivityindex', 'TypeActivityController@index')->name('typeactivity.index');
    Route::post('admin/ypeactivityupdate', 'TypeActivityController@update')->name('typeactivity.update');
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

    Route::post('admin/contractcreate', 'ContractController@store')->name('Contract.store');
    Route::post('admin/contractindex', 'ContractController@index')->name('Contract.index');
    Route::post('admin/contractupdate', 'ContractController@update')->name('Contract.update');
    Route::post('admin/contractdestroy', 'ContractController@destroy')->name('Contract.destroy');

    Route::post('admin/buscreate', 'BusController@store')->name('bus.store');
    Route::post('admin/busindex', 'BusController@index')->name('bus.index');
    Route::post('admin/busupdate', 'BusController@update')->name('bus.update');
    Route::post('admin/busdestroy', 'BusController@destroy')->name('bus.destroy');

    Route::post('admin/routecreate', 'RouteController@store')->name('route.store');
    Route::post('admin/routeindex', 'RouteController@index')->name('route.index');
    Route::post('admin/routeupdate', 'RouteController@update')->name('route.update');
    Route::post('admin/routedestroy', 'RouteController@destroy')->name('route.destroy');

    
    Route::post('admin/tours/{tour}/record/storepassengers', 'PassengerController@createadmin')->name('passengers.createadmin');
    Route::get('admin/tours/passengers', 'PassengerController@index')->name('passengers.index');
    Route::get('admin/tours/passengers/{passenger}/edit', 'PassengerController@edit')->name('passengers.edit');
});

Route::group(['middleware' => ['auth']], function () {
Route::post('/packages/createstarpassengers', 'PassengerController@createstar')->name('passengers.createstar');
Route::post('/packages/indexforcustomerpassengers', 'PassengerController@indexforcustomer')->name('passengers.indexforcustomer');
Route::put('/packages/{tour}/updatepassengers/{passenger}/update', 'PassengerController@update')->name('passengers.update')->middleware('check.amountplace');
Route::delete('/packages/{tour}/passengers/{passenger}', 'PassengerController@destroy')->name('passengers.destroy')->middleware('check.amountplace');
Route::post('/packages{tour}/storepassengers', 'PassengerController@create')->name('passengers.create')->middleware('check.amountplace');
Route::post('/packages/{tour}/create_notbuspassengers', 'PassengerController@create_notbus')->name('passengers.create_notbus')->middleware('check.amountplace');
});

Route::get('/packages', 'SiteController@packages')->name('/packages');
Route::get('/packages/{tour}/{Name_Tours}', 'TourController@tourdescript')->name('tourdescript');
Route::get('/packages/{tour}/{Name_Tours}/record', 'TourController@tourgo')->name('tourgo')->middleware('check.amountplace', 'auth');

Route::get('/ухади', 'SiteController@type_user_false')->name('typeuserfalse');

Route::get('/', function () {
    return view('site.index', ['Carbon' => Carbon::now()->addDays(14), 'Cardon_hot' =>Carbon::now(), 'tours' => Tour::where('Confidentiality',0)->orderByDesc('Start_Date_Tours')->paginate(4)]);
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
