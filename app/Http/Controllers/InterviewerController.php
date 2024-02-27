<?php

namespace App\Http\Controllers;

use App\Models\interviewer;
use App\Http\Controllers\Controller;
use App\Models\candidate;
use App\Models\job;
use App\Providers\LogServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InterviewerController extends Controller
{
    public function index()
    {
        //
        if (Auth::guard('interviewer')->check()) {
            // User is logged in
            // Your code here
            return view("interviewer.welcome");
        } else {
            // User is not logged in
            // Redirect the user to the login page or perform any other action
            return view('interviewer.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
        if (Auth::guard('interviewer')->check()) {
            // User is logged in
            // Your code here
            return view('interviewer.addjob');
        } else {
            // User is not logged in
            // Redirect the user to the login page or perform any other action
             return redirect()->route('interviewer.index');
        }
        
    }
    public function addjob(Request $request, interviewer $interviewer)
    {
        $job = new job([
            'name'=>$request->input('name'),
            'description' => $request->input('description'), 'salary'=>$request->input('salary')
        ]);

        $job->interviewer_id = Auth::guard('interviewer')->id();
        $job->save();
        LogServiceProvider::newLog($job->id);
        return redirect()->route('interviewer.jobs');
    }

    public function jobs(){

        $interviewer_id = Auth::guard('interviewer')->id();
        $jobs= job::where('interviewer_id', $interviewer_id)->get();
        return view('interviewer.jobs', compact('jobs'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $credentials = $request->only('email', 'password');

        if (Auth::guard('interviewer')->attempt($credentials)) {
            // Authentication successful
            return redirect()->intended('/interviewer');
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }


    public function applicants(int $jobid){

        $job = job::find($jobid);
        $interviewerID= Auth::guard('interviewer')->id();

        $candidates= candidate::whereIn('id', function ($query) use ($jobid) {
            $query->select('candidate_id')
                ->from('candidate_job')
                ->where('job_id', $jobid);
        })
        ->whereNotIn('id', function ($query) use ($jobid) {
            $query->select('candidate_id')
                ->from('interviews')
                ->where('job_id', $jobid);
        })->get();

        $currentDateTime = now()->format('Y-m-d\TH:i');
        return view('interviewer.applicants',compact(['candidates','interviewerID','jobid','currentDateTime']));
    }

    /**
     * Display the specified resource.
     */
    public function show(interviewer $interviewer)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(interviewer $interviewer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, interviewer $interviewer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(interviewer $interviewer)
    {
        //
    }
    public function register()
    {
        //
        if(Auth::guard('interviewer')->check()){
            return redirect()->route('interviewer.index');
        }
        else{
            return view('interviewer.register');
        }

    }
    public function save (Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'company' =>'required|string',
            'position' =>'required|string',
        ]);
    
        // Hash the password
        $hashedPassword = Hash::make($request->input('password'));
    
        // Create a new user instance

        $interviewer = new interviewer([ 'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $hashedPassword,
        'company' => $request->input('company'),
        'position' => $request->input('position'),
    ]);
       
    
        // Save the user to the database
        $interviewer->save();
        return redirect()->route('interviewer.index');

    }

    public function logout()
    {
        Auth::guard('interviewer')->logout();
         return redirect('/');
    }
    public function resume(string $filename)
    {
        $path = storage_path('app/resumes/'.$filename);
        $file = Storage::get($path);
        $type = Storage::mimeType($path);
        return response($file)->header('Content-Type', $type);
    }
}
