<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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
});
Route::get('/user', function () {
    return "Hello User Page";
});

// Route::get('/about', function () {
//     return "Hello About Page";
// });
Route::get('/about',[AboutController::class,'index']);
Route::get('/morning',[AboutController::class,'sayMorning']);

//today
Route::get('/student',[StudentController::class,'index']);
Route::get('/customer',[CustomerController::class,'index'])->name('customer');
