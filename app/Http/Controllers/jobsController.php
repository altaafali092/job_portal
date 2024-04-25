<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\job\StoreJobRequest;
use App\Http\Requests\Frontend\job\UpdateJobRequest;
use App\Models\Experience;
use App\Models\Job;
use App\Models\jobApplication;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\SaveJob;
use Illuminate\Http\Request;

class jobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobCategories = JobCategory::where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();
        $experiences = Experience::where('status', 1)->get();
        return view('frontend.job', compact('jobCategories', 'jobTypes', 'experiences'));
    }

  
    public function Store(StoreJobRequest $request)
    {
        Job::create($request->validated()+ ['user_id' => auth()->id()]);
        return redirect(route('myJobs'))->with('success', 'Your job is posted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $applicants = jobApplication::where('job_id', $job->id)->with('user')->get();

    
    
        return view('frontend.job.show', compact('job', 'applicants'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $jobCategories = JobCategory::where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();
        $experiences = Experience::where('status', 1)->get();
    
       return view('frontend.job.edit',compact('job','jobCategories', 'jobTypes', 'experiences'));
    }

    public function Update(UpdateJobRequest $request, Job $job)
{
    $job->update($request->all());
    return redirect(route('myJobs'))->with('success', 'Your job is updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return back()->with('success','your job Deleted successfully');
    }
}
