<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\InterviewerController;
use App\Models\Interview;
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


Route::get('interview/completed', [InterviewController::class, 'completed'])->middleware('interviewer')->name('interview.completed');
Route::post('interview/status', [InterviewController::class, 'status'])->middleware('interviewer')->name('interview.status');
Route::get('interview/update/{id}', [InterviewController::class, 'updateView'])->middleware('interviewer')->name('interview.updateview');
Route::post('interview/reschedule', [InterviewController::class, 'reschedule'])->middleware('interviewer')->name('interview.reschedule');
Route::resource('interview',InterviewController::class)->missing(function(){
    $nav = "interviewer";
    return Response::view('lost',compact('nav'));
})
->middleware('interviewer'); 

require __DIR__.'/model-routes/candidate.php';


require __DIR__.'/model-routes/interviewer.php';





