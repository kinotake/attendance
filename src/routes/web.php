<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RestController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    // $request->fulfill();

    // return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::middleware(['auth','verified'])->group(function(){
Route::get('/', [WorkController::class, 'view']);
// });
Route::post('/', [WorkController::class, 'start']);
Route::get('/rest/start', [WorkController::class, 'restStartView']);
Route::post('/rest/start', [RestController::class, 'restStart']);
Route::get('/rest/end', [WorkController::class, 'restEndView']);
Route::post('/rest/end', [RestController::class, 'restEnd']);
Route::post('/end', [WorkController::class, 'end']);
Route::get('/attendance', [WorkController::class, 'index']);
// ->middleware('verified')
Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 

Route::get('/users', [WorkController::class, 'usersView']);
Route::post('/users', [WorkController::class, 'users']);
Route::get('/person', [WorkController::class, 'personView']);
Route::post('/person', [WorkController::class, 'person']);

Route::get('/error', [RestController::class, 'errorView']);
Route::get('/error/same', [WorkController::class, 'errorSameView']);

Route::get('/before/attendance', [WorkController::class, 'beforeView']);

Route::post('before/attendance/yesterday', [WorkController::class, 'yesterdayView'])->name('yesterday');
Route::post('before/attendance/tomorrow', [WorkController::class, 'tomorrowView'])->name('tomorrow');
