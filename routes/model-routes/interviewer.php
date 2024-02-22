<?php
use App\Http\Controllers\InterviewerController;
use Illuminate\Support\Facades\Route;

Route::post('/interviewer/logout',[InterviewerController::class, 'logout'])->name('interviewer.logout');
Route::get('/interviewer/jobs',[InterviewerController::class, 'jobs'])->name('interviewer.jobs');
Route::post('/interviewer/create',[InterviewerController::class, 'addjob'])->name('interviewer.addjob');
Route::get('/interviewer/register', [InterviewerController::class, 'register'])->name('interviewer.register');
Route::post('/interviewer/register', [InterviewerController::class, 'save'])->name('interviewer.save');
Route::resource('interviewer',InterviewerController::class);
