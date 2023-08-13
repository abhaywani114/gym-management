<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChatController;
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

Route::middleware('auth')->get('/search', [SearchController::class, 'search'])->name('search');
Route::middleware('auth')->get('/toggle-follow/{id}', [SearchController::class, 'toggleFollow'])->name('toggle_follow');
Route::name('profile.')->prefix('/{username}')->middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, "profile"])->name('profile');
    Route::get('/details', [ProfileController::class, "details"])->name('details');
    Route::get('/calendar', [ProfileController::class, "calendar"])->name('calendar');
    Route::get('/settings', [ProfileController::class, "settings"])->name('settings');
    Route::get('/following', [ProfileController::class, "following"])->name('following');
    Route::get('/followers', [ProfileController::class, "followers"])->name('followers');

    Route::post('/settings', [ProfileController::class, "settingsHandle"])->name('settings.handle');
    Route::post('/exercise-add', [ProfileController::class, "calenderNew"])->name('exercise.handle.add');
    Route::get('/{calendarId}/exercise-delete', [ProfileController::class, "deleteExercise"])->name('exercise.handle.delete');
    Route::get('/{calendarId}/exercise-done', [ProfileController::class, "doneExercise"])->name('exercise.handle.done');
});

Route::name('chat.')->prefix('/chat')->middleware(['auth'])->group(function () {
    Route::get('/{uid?}', [ChatController::class, "chat"])->name('chat');
    Route::post('/send', [ChatController::class, "sendMessage"])->name('send');
});

Route::middleware('auth')->get('/exercise-today', [ProfileController::class, "today"])->name('exercise.today');

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
