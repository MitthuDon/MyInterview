<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\InterviewerController;
use Illuminate\Support\Facades\Response;
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
})->name('welcome');



require __DIR__.'/model-routes/candidate.php';


require __DIR__.'/model-routes/interviewer.php';





