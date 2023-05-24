<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ExampleController;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class,"showCorrectHomepage"]);

Route::get('/about', [ExampleController::class,'aboutPage']);

//we are preforming an action that relates to the user so
//we will use a user controller
Route::post('/register',[UserController::class,'register']);

Route::post('/login',[UserController::class,'login']);
