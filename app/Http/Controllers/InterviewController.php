<?php

namespace App\Http\Controllers;

use App\Mail\InterviewScheduledMail;
use App\Models\Interview;
use App\Http\Controllers\Controller;
use App\Models\candidate;
use App\Providers\LogServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $interviewerID = Auth::guard('interviewer')->id();
        $interviews = Interview::where('interviewer_id','=',$interviewerID)
        ->where('status','=','pending');
        $interviews = DB::table('candidates as c')
        ->joinSub($interviews, 'i', function ($join) {
            $join->on('c.id', '=', 'i.candidate_id');
        })->select('i.id','i.schedule','i.status','i.job_id','i.candidate_id','c.name','c.email')
        ->orderBy('schedule','asc')->get();
        
        return view('interview.index',compact('interviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('interview.update');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $interview = new Interview(['schedule'=>$request->input('schedule'),'status'=>'pending',
        ]);
        $interview->candidate_id=$request->input('candidateID');
        $interview->job_id=$request->input('jobID');
        $interview->interviewer_id=$request->input('interviewerID');
        $interview->save();
        $candidate = candidate::find($request->input('candidateID'));
        Mail::to($candidate->email)->send(new InterviewScheduledMail($candidate->name,$request->input('schedule')));
        LogServiceProvider::schedule($interview->job_id,$interview->candidate_id, $interview->schedule);
        return redirect()->route('interview.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Interview $interview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interview $interview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    
     public function updateView(int $id){
        return view('interview.update', compact('id'));
     }
     public function status(Request $request)
    {
        Interview::find($request->input('id'))->update(['status'=>$request->input('feedback')]);
        return Redirect::route('interview.index');
    }
    
     
    public function reschedule(Request $request){
        $id = $request->input('interviewID');
        $schedule = $request->input('schedule');
        $interview = Interview::find($id);
        $interview->schedule = $schedule; 
        $interview->save();
        $candidate = candidate::find($request->input('candidateID'));
        Mail::to($candidate->email)->send(new InterviewScheduledMail($candidate->name,$request->input('schedule')));
        LogServiceProvider::schedule($interview->job_id,$interview->candidate_id, $interview->schedule);
        return redirect()->route('interview.index');
       
    }

    public function completed(){
        $interviewerID = Auth::guard('interviewer')->id();
        $interviews = Interview::where('interviewer_id','=',$interviewerID)
        ->where('status','!=','pending');
        $interviews = DB::table('candidates as c')
        ->joinSub($interviews, 'i', function ($join) {
            $join->on('c.id', '=', 'i.candidate_id');
        })->select('i.id','i.schedule','i.status','i.job_id','i.candidate_id','c.name','c.email')
        ->orderBy('schedule','asc')->get();
        return view('interview.completed',compact('interviews'));
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
        //
    }
}
