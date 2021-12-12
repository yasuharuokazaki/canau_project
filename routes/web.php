<?php

use App\Http\Controllers\ZoomController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/event',function (){
    return view("event");
})->middleware(['auth'])->name('event');

Route::get("/zoom",[ZoomController::class,"index"])
->middleware(["auth"])->name("zoom");

Route::get("/zoom/auth",[ApiController::class,"oauth_success"])
->middleware(['auth']);

Route::post("/make_meeting",[ApiController::class,"make_meeting"])
->middleware(['auth']);
// Route::group(['middleware' => 'auth'], function ($router) {
//     Route::get('admin', 'AdminController@index')->name('amdin');
    // Route::get('admin/user', 'ZoomApiController@me');


    // Route::get('zoomoatuh/check', 'AdminController@zoomOauth')->name('zoomOauth');
    // Route::get('zoomoatuh/getoauth', 'AdminController@getOauth')->name('getOauth');
// });
