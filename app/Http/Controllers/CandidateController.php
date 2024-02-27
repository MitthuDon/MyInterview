<?php

namespace App\Http\Controllers;

use App\Models\candidate;
use App\Http\Controllers\Controller;
use App\Models\job;
use App\Providers\LogServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if (Auth::guard('candidate')->check()) {
            // User is logged in
            // Your code here
            return view("candidateWelcome");
        } else {
            // User is not logged in
            // Redirect the user to the login page or perform any other action
            return view('candidateLogin');
        }
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
        $credentials = $request->only('email', 'password');

        if (Auth::guard('candidate')->attempt($credentials)) {
            // Authentication successful
            return redirect()->intended('/candidate');
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(candidate $candidate)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(candidate $candidate)
    {
        //
    }

    public function jobs()  {

        $candidateId = Auth::guard('candidate')->id();

        $jobs = job::whereNotIn('id', function ($query) use ($candidateId) {
            $query->select('job_id')
                ->from('candidate_job')
                ->where('candidate_id', $candidateId);
        });
        

        $jobs = DB::table('interviewers as i')
        ->joinSub($jobs, 'j', function ($join) {
            $join->on('i.id', '=', 'j.interviewer_id');
        })
        ->select('j.id','j.name','j.description','j.salary','i.company','i.position','i.created_at')
        ->get();
        return view('candidateJobs',compact('jobs','candidateId'));
    }

    public function apply(int $candidateID, int $job )
    {
        $candidate = candidate::find($candidateID);
        $candidate->jobs()->attach($job);
        LogServiceProvider::applied($job,$candidateID);
        return Response::json([
            'reload' => true,
        ]);
    }
    public function myjobs()
    {
        $candidateId = Auth::guard('candidate')->id();
        $candidate = candidate::find($candidateId);
        $jobs = $candidate->jobs()->get();
        return view('myjobs', compact('jobs'));
    }
    
    public function myinterviews(){
        $id = Auth::guard('candidate')->id();
        $interviews = candidate::find($id)->interviews()->get();
        // return Response::json($interviews);
        return view('myinterviews', compact('interviews'));
    }

    public function register()
    {
        //
        if(Auth::guard('candidate')->check()){
            return redirect()->route('candidate.index');
        }
        else{
            return view('candidateRegistration');
        }

    }
    public function save (Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'degree' =>'required|string',
        ]);
    
        // Hash the password
        $hashedPassword = Hash::make($request->input('password'));
    
        // Create a new user instance

        $candidate = new candidate([ 'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $hashedPassword,
        'degree' => $request->input('degree')]);
       
    
        // Save the user to the database
        $candidate->save();
        return redirect()->route('candidate.index');

    }

    public function logout()
    {
        Auth::guard('candidate')->logout();
         return redirect('/');
    
        // Redirect the user to a logged out page or any other page
        
    }
    public function upload(Request $request)
    {
        $filename = $request->input('job_id')."_".$request->input('candidateId').".pdf";
        Storage::putFileAs('public/resumes', $request->file('pdf_file'), $filename);
        return redirect()->route('candidate.jobs');
        // Redirect the user to a logged out page or any other page
        
    }

}
