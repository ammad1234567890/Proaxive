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


Route::get('/employee', 'EmployeeController@index')->name('employee')->middleware('accesscontrol:4');
Route::post('/create_employee', 'EmployeeController@create')->name('create_employee');
Route::get('/view_employees', 'EmployeeController@view');

//Employee
Route::get('/travel_request', 'TravelController@index')->middleware('accesscontrol:3');
Route::get('/customer_setting', 'CustomerController@setting')->middleware('accesscontrol:3');
Route::get('/customer_members', 'CustomerController@members')->middleware('accesscontrol:3');
Route::get('/customer_travel_details/{id}','TravelController@single_view_customer')->middleware('accesscontrol:3');
Route::get('/customer_travel_list', 'TravelController@get_list_view_customer')->middleware('accesscontrol:3');




Route::get('/department', 'DepartmentController@index')->middleware('accesscontrol:4');
Route::post('/create_department', 'DepartmentController@create')->name('create_department');
Route::get('/view_departments', 'DepartmentController@view')->middleware('accesscontrol:4');

Route::get('/designation', 'DesignationController@index')->middleware('accesscontrol:4');
Route::post('/create_designation', 'DesignationController@create')->name('create_designation');
Route::get('/view_designations', 'DesignationController@view');





Route::post('/update_general', 'CustomerController@update_general');

Route::post('/update_password','CustomerController@update_password');
Route::get('/get_customer_members/{cust_id}','CustomerController@get_customer_member');

//customer

//page View


Route::get('/travel_list', 'TravelController@get_list_view')->middleware('accesscontrol:2');
Route::get('/single_travel/{id}', 'TravelController@single_view')->middleware('accesscontrol:2');


Route::get('/customer_travel_request','TravelController@hr_create_travel')->middleware('accesscontrol:2');


//md View
Route::get('proceed_travel', 'TravelController@get_list_view_md')->middleware('accesscontrol:1');
Route::get('/proceed_travel_list','TravelController@get_processed_list');
Route::get('/single_proceed_travel/{id}','TravelController@single_view_md')->middleware('accesscontrol:1');
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
Route::post('expense/resubmit', 'TravelExpenseController@resubmit_save');

//customer
Route::get('/expense/add', 'TravelExpenseController@add_travelexpense')->middleware('accesscontrol:3');
Route::get('/expense/grid', 'TravelExpenseController@grid')->middleware('accesscontrol:3');
Route::get('/get_expense_list', 'TravelExpenseController@get_expense_list')->middleware('accesscontrol:3');
Route::get('/expense/details/{id}', 'TravelExpenseController@expense_details')->middleware('accesscontrol:3');
Route::get('/customer/expense/edit/{id}', 'TravelExpenseController@expense_edit_customer')->middleware('accesscontrol:3');

//hr
Route::get('/all/expense/grid', 'TravelExpenseController@grid_expense')->middleware('accesscontrol:2');
Route::get('/get_all_customers_expense_list', 'TravelExpenseController@get_all_customers_expense_list')->middleware('accesscontrol:2');
Route::get('/expense/details/view/{id}', 'TravelExpenseController@expense_details_view')->middleware('accesscontrol:2');

Route::post('get_travel_id', 'TravelExpenseController@get_travel_id');


//md
Route::get('/md/expense/grid', 'TravelExpenseController@grid_expense_md')->middleware('accesscontrol:1');
Route::get('/get_all_customers_expense_list_md', 'TravelExpenseController@get_all_customers_expense_list_md')->middleware('accesscontrol:1');
Route::get('/expense/details/view/md/{id}', 'TravelExpenseController@expense_details_view_md')->middleware('accesscontrol:1');

//hr_secretary
Route::get('/hrsecretary/expense/grid', 'TravelExpenseController@grid_expense_hrsecretary')->middleware('accesscontrol:4');
Route::get('/get_all_customers_expense_list_hrsecretary', 'TravelExpenseController@get_all_customers_expense_list_hrsecretary')->middleware('accesscontrol:4');
Route::get('/hrsecretary/expense/details/{id}', 'TravelExpenseController@expense_details_view_hrsecretary')->middleware('accesscontrol:4');
Route::get('/hrsecretary/expense/add', 'TravelExpenseController@add_travelexpense_hrsecretary')->middleware('accesscontrol:4');
Route::get('/hrsecretary/expense/edit/{id}', 'TravelExpenseController@expense_edit_hrsecretary')->middleware('accesscontrol:4');
//travel_expense route end

//

/*Route::get('/home', function(){
    return View('customer/dashboard');
});*/

Route::get('/locations', function(){
    return View('upload_locations');
});
Route::post('/upload_locations', 'HomeController@upload_locations');
Route::post('/resubmit_travel_req', 'TravelController@resubmit_travel');

Route::get('/resubmit_travel/{travel_id}','TravelController@resubmit_travel_view');
Route::get('/get_travel_members/{travel_id}', 'TravelController@get_travel_members');



//Approval Views
    Route::get('/hr_approvals_list', 'TravelController@approval_view_hr');
    Route::get('/get_hr_approvals_list', 'TravelController@hr_approvals_list');


    Route::get('/md_approvals_list', 'TravelController@approval_view_md');
    Route::get('/get_md_approvals_list', 'TravelController@md_approvals_list');


    Route::get('/sec_account_settings', 'HRController@hr_secretary_setting_view')->middleware('accesscontrol:4');
    Route::get('/hr_account_settings', 'HRController@hr_setting_view')->middleware('accesscontrol:2');
    Route::get('/md_account_settings', 'HRController@md_setting_view')->middleware('accesscontrol:1');

});

