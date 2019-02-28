<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'API\AuthController@login');

Route::middleware('auth:api')->get('/get_user', function (Request $request) {
    return ['status_code'=>200,'data'=>$request->user()];
});


Route::middleware('auth:api')->group(function () {
/*
Route::get('/test', function (Request $request) {
  return [$request->user(),true,$request->user()->id,$request->user()->role_id];
});*/

Route::get('/get_expense_list', 'API\TravelExpenseApiController@get_expense_list');
Route::get('/get_travel_request', 'API\TravelExpenseApiController@get_travel_request');
Route::get('/get_expense_details/{id}', 'API\TravelExpenseApiController@get_expense_details');

Route::post('/expense_status_update', 'API\TravelExpenseApiController@expense_status_update');

});
Route::get('/get_travel_request_details/{id}', 'API\TravelExpenseApiController@get_travel_request_details');
