<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'settings'],function(){
    Route::get('/general', [ProfileController::class, 'index']);
    Route::post('/change-profile',[ProfileController::class,'change_profile'])->name('change-profile');
    Route::post('/change-password',[ProfileController::class,'change_password'])->name('change-password');

});
