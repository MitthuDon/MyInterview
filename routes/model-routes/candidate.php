<?php
use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;


Route::get('/candidate/apply/{candidateID}/{job}',[CandidateController::class, 'apply'])->name('candidate.apply')->middleware('auth:candidate');
Route::get('/candidate/jobs',[CandidateController::class, 'jobs'])->name('candidate.jobs');
Route::get('/candidate/myjobs',[CandidateController::class, 'myjobs'])->name('candidate.myjobs');
Route::post('/candidate/logout',[CandidateController::class, 'logout'])->name('candidate.logout');
Route::get('/candidate/register', [CandidateController::class, 'register'])->name('candidate.register');
Route::post('/candidate/register', [CandidateController::class, 'save'])->name('candidate.save');
Route::resource('candidate', CandidateController::class);