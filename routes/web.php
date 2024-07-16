<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PreFlightController;
use App\Http\Controllers\HazardReportController;
use App\Http\Controllers\PreFlightLogController;
use App\Http\Controllers\AccidentReportController;

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
    return view('auth/login');
});



// Route::get('/register', function () {
//     return view('auth/register');
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['middleware'=>['auth:sanctum','admin']], function(){
    /* role: Admin/Sub-admin
    |  controlller: Staff
    |  Routes  api/staffs/
    */
// });

Route::group(['middleware'=>['auth','admin']], function(){
    /* role: Admin/Sub-admin
    |  controlller: Staff
    |  Routes  api/staffs/
    */
    Route::get('/procedure', function () {
        return view('procedure');
    });
    Route::resource('staffs', StaffController::class);
});
// Route::resource('staffs', StaffController::class);

Route::group(['middleware'=>['auth']], function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::resource('ops', OpsController::class);
    Route::post('/ops/check', [OpsController::class, 'check'])->name('ops.check');
    Route::resource('preFlight', PreFlightController::class);
    Route::resource('preFlightLog', PreFlightLogController::class);
    // test
    // safety issue here: all users can download other airports' log file if they type in the right #id 
    // but good thing is user won't be able to see the URL at address bar, which makes it not easy to get here
    Route::get('/export-excel/{id}', [PreFlightLogController::class, 'exportIntoExcel']);
    Route::get('/reports', function () {
        return view('reports');
    });
    Route::resource('accidentReport', AccidentReportController::class);
    Route::resource('hazardReport', HazardReportController::class);
});
