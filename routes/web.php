<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
})->name('homepage');


//########################################
//User Management Routes
Route::get('usermanagement/login', [UserManagementController::class, "login"])->
  name('user.login')->middleware('guest');

Route::get('usermanagement/signup', [UserManagementController::class, "signup"])->
  name('user.signup')->middleware('guest');;

Route::get('usermanagement/verify-email/{hash}', [UserManagementController::class, "verifyEmail"])->
  name('user.verify.email');

Route::post('usermanagement/signup-handle', [UserManagementController::class, "signupHanlde"])->
  name('user.signup.handle')->middleware('guest');;

Route::post('usermanagement/login-handle', [UserManagementController::class, "loginHandle"])->
  name('user.login.handle')->middleware('guest');

Route::post('usermanagement/reset', [UserManagementController::class, "reset"])->
  name('user.reset')->middleware('guest');

Route::get('usermanagement/logout', [UserManagementController::class, "logout"])->
  name('user.logout')->middleware('auth');

Route::get('usermanagement/change-password', [UserManagementController::class, "changePassword"])->
  name('user.change_password')->middleware('auth');

Route::post('usermanagement/change-password-handle', [UserManagementController::class, "changePasswordHandle"])->
  name('user.change_password.handle')->middleware('auth');

Route::get('usermanagement/reset', function() {
  return view('auth.reset');
});

Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
});
