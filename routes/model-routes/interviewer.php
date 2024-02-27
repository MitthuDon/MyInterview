<?php
use App\Http\Controllers\InterviewerController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'interviewer', 'middleware' => 'interviewer'],function(){
Route::post('/logout',[InterviewerController::class, 'logout'])->name('interviewer.logout');
Route::get('/jobs',[InterviewerController::class, 'jobs'])->name('interviewer.jobs');
Route::get('/applicants/{jobid}',[InterviewerController::class, 'applicants'])->name('interviewer.applicants');
Route::post('/create',[InterviewerController::class, 'addjob'])->name('interviewer.addjob');
Route::get('/resume/{filename}',[InterviewerController::class, 'resume'])->name('resume.show'); 

});
Route::get('/interviewer/register', [InterviewerController::class, 'register'])->name('interviewer.register');
Route::post('/interviewer/register', [InterviewerController::class, 'save'])->name('interviewer.save');
Route::resource('interviewer',InterviewerController::class)->missing(function(){
    $nav = "interviewer";
    return Response::view('lost',compact('nav'));
}); 
