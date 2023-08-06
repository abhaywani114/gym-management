<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimelineController;
use \App\Models\Timeline;

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
Route::middleware('auth')->get('/', function () {
    $timeline = Timeline::orderBy('created_at', 'desc')->get();
    return view('web_feed', compact('timeline'));
})->name('homepage');

Route::name('profile.')->prefix('/{username}')->middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, "profile"])->name('profile');
    Route::get('/details', [ProfileController::class, "details"])->name('details');
    Route::get('/calendar', [ProfileController::class, "calendar"])->name('calendar');
    Route::get('/settings', [ProfileController::class, "settings"])->name('settings');

    Route::post('/settings', [ProfileController::class, "settingsHandle"])->name('settings.handle');
    Route::post('/exercise-add', [ProfileController::class, "calenderNew"])->name('exercise.handle.add');
    Route::get('/{calendarId}/exercise-delete', [ProfileController::class, "deleteExercise"])->name('exercise.handle.delete');
});

Route::name('timeline.')->prefix('timeline')->middleware(['auth'])->group(function () {
    Route::post('/add-post', [TimelineController::class, "newPost"])->name('add_handle');
});
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
