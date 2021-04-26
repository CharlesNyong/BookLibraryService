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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// get all read books
Route::get('/reads/{userID}', "ReadBooks@index");

// get particular user
Route::get('/user/{emailID}', "userController@getUserByEmail");

// get particular user
Route::get('/user/username/{username}', "userController@getUserByUserName");

// get all pending reads
Route::get('/pendingReads/{userID}', "PendingReads@index");

// get all pending reads
Route::post('/addBooks', "AddBooks@index");

// add user
Route::post('/user', "userController@addNewUser");

// update a book status
Route::post('/updateBookStatus', "updateBook@index");

Route::post('/survey', 'userController@sendSurvey');

// get month to read counts
Route::get('/monthToReadCounts/{userID}', "monthToReadCounts@index");

Route::put('/user', "userController@updateUser");