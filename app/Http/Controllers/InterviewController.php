<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Models\candidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $interviewerID = Auth::guard('interviewer')->id();
        $interviews = Interview::where('interviewer_id','=',$interviewerID);
        $interviews = DB::table('candidates as c')
        ->joinSub($interviews, 'i', function ($join) {
            $join->on('c.id', '=', 'i.candidate_id');
        })->select('i.id','i.schedule','i.status','i.job_id','i.candidate_id','c.id','c.name','c.email')->get();
        // $interviews = DB::table('jobs as j')
        // ->joinSub($interviews, 'i', function ($join) {
        //     $join->on('j.id', '=', 'i.job_id');
        // })
        

        
        // return Response::json($interviews);
        return view('interview.index',compact('interviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function update(UpdateInterviewRequest $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
        //
    }
}
