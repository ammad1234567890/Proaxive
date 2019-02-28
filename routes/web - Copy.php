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

Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::post('/create_employee', 'EmployeeController@create')->name('create_employee');
Route::get('/view_employees', 'EmployeeController@view');

//Employee
Route::get('/travel_request', 'TravelController@index')->middleware('accesscontrol:3');
Route::get('/customer_setting', 'CustomerController@setting')->middleware('accesscontrol:3');
Route::get('/customer_members', 'CustomerController@members')->middleware('accesscontrol:3');
Route::get('/customer_travel_details/{id}','TravelController@single_view_customer')->middleware('accesscontrol:3');
Route::get('/customer_travel_list', 'TravelController@get_list_view_customer')->middleware('accesscontrol:3');




Route::get('/department', 'DepartmentController@index');
Route::post('/create_department', 'DepartmentController@create')->name('create_department');
Route::get('/view_departments', 'DepartmentController@view');

Route::get('/designation', 'DesignationController@index');
Route::post('/create_designation', 'DesignationController@create')->name('create_designation');
Route::get('/view_designations', 'DesignationController@view');





Route::post('/update_general', 'CustomerController@update_general');

Route::post('/update_password','CustomerController@update_password');
Route::get('/get_customer_members/{cust_id}','CustomerController@get_customer_member');

//customer

//page View


Route::get('/travel_list', 'TravelController@get_list_view');
Route::get('/single_travel/{id}', 'TravelController@single_view');


Route::get('/customer_travel_request','TravelController@hr_create_travel');


//md View
Route::get('proceed_travel', 'TravelController@get_list_view_md');
Route::get('/proceed_travel_list','TravelController@get_processed_list');
Route::get('/single_proceed_travel/{id}','TravelController@single_view_md');
Route::post('/md_approval', 'TravelController@md_approval');

//Actions
Route::post('/create_request','TravelController@create');
Route::post('/create_request_from_hr','TravelController@create_from_hr');
Route::post('/update_passport', 'CustomerController@update_passport');
Route::post('/create_member','CustomerController@create_member');
Route::get('/get_travel_list','TravelController@get_list');
Route::get('/get_travel_list_by_user', 'TravelController@get_list_by_user');
Route::post('/hr_approval', 'TravelController@hr_approval');

//travel_expense route start

Route::post('travel_details', 'TravelExpenseController@travel_details');
Route::post('expense_status_update', 'TravelExpenseController@expense_status_update');
Route::get('expense_status_check/{id}', 'TravelExpenseController@expense_status_check');
Route::post('expense/save', 'TravelExpenseController@travelexpense_save');

//customer
Route::get('/expense/add', 'TravelExpenseController@add_travelexpense')->middleware('accesscontrol:3');


Route::get('/expense/grid', 'TravelExpenseController@grid')->middleware('accesscontrol:3');
Route::get('/get_expense_list', 'TravelExpenseController@get_expense_list')->middleware('accesscontrol:3');
Route::get('/expense/details/{id}', 'TravelExpenseController@expense_details')->middleware('accesscontrol:3');


//hr
Route::get('/all/expense/grid', 'TravelExpenseController@grid_expense')->middleware('accesscontrol:2');
Route::get('/get_all_customers_expense_list', 'TravelExpenseController@get_all_customers_expense_list')->middleware('accesscontrol:2');
Route::get('/expense/details/view/{id}', 'TravelExpenseController@expense_details_view')->middleware('accesscontrol:2');
Route::get('/hr/expense/add', 'TravelExpenseController@add_travelexpense_hr')->middleware('accesscontrol:2');
Route::post('get_travel_id', 'TravelExpenseController@get_travel_id');


//md
Route::get('/md/expense/grid', 'TravelExpenseController@grid_expense_md')->middleware('accesscontrol:1');
Route::get('/get_all_customers_expense_list_md', 'TravelExpenseController@get_all_customers_expense_list_md')->middleware('accesscontrol:1');
Route::get('/expense/details/view/md/{id}', 'TravelExpenseController@expense_details_view_md')->middleware('accesscontrol:1');

//hr_secretary
Route::get('/hrsecretary/expense/grid', 'TravelExpenseController@grid_expense_hrsecretary');
Route::get('/get_all_customers_expense_list_hrsecretary', 'TravelExpenseController@get_all_customers_expense_list_hrsecretary');
Route::get('/hrsecretary/expense/details/{id}', 'TravelExpenseController@expense_details_view_hrsecretary');

//travel_expense route end

//

/*Route::get('/home', function(){
    return View('customer/dashboard');
});*/

Route::get('/locations', function(){
    return View('upload_locations');
});
Route::post('/upload_locations', 'HomeController@upload_locations');


});