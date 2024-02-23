<?php
use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'candidate', 'middleware' => 'cand'],function(){
Route::get('/apply/{candidateID}/{job}',[CandidateController::class, 'apply'])->name('candidate.apply');
Route::get('/jobs',[CandidateController::class, 'jobs'])->name('candidate.jobs');
Route::get('/myjobs',[CandidateController::class, 'myjobs'])->name('candidate.myjobs');
Route::get('/myinterviews',[CandidateController::class, 'myinterviews'])->name('candidate.myinterviews');
Route::post('/logout',[CandidateController::class, 'logout'])->name('candidate.logout');
});
Route::get('/candidate/register', [CandidateController::class, 'register'])->name('candidate.register');
Route::post('/candidate/register', [CandidateController::class, 'save'])->name('candidate.save');
Route::resource('candidate', CandidateController::class)->missing(function(){
    $nav = "candidate";
    return Response::view('lost',compact('nav'));
});