<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\job\StoreJobRequest;
use App\Http\Requests\Frontend\JobAplication\StoreJobApplicationRequest;
use App\Mail\JobNotificationMail;
use App\Models\Experience;
use App\Models\Job;
use App\Models\jobApplication;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\SaveJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index()
    {
        $jobCategories = JobCategory::where('status', 1)->get();
        $jobs = Job::inRandomOrder()->take(6)->where('status', 1)->get();
        $latestJobs = Job::latest()->take(6)->where('status', 1)->get();
        return view('frontend.index', compact('jobCategories', 'jobs', 'latestJobs'));
    }
    public function profile()
    {
        return view('frontend.Auth.profile');
    }
    public function job()
    {
        $jobCategories = JobCategory::where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();
        $experiences = Experience::where('status', 1)->get();
        return view('frontend.job', compact('jobCategories', 'jobTypes', 'experiences'));
    }
    public function myJobs()
    {
        $jobs = Job::where('mobile_user_id', Auth::user()->id)->with('jobType')->latest()->paginate(5);
        // dd($jobs);
        return view('frontend.myjob', compact('jobs'));
    }


    public function findJob()
    {
        //  dd(request('keyword'),request('location'),request('job_category_id'),request('job_type_id'),request('experience_id'));   
        $jobCategories = JobCategory::where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();
        $experiences = Experience::where('status', 1)->get();
        $jobs = Job::where(function ($q) {
            if (!empty(request('keyword'))) {
                $q->where('job_name', 'like', '%' . request('keyword') . '%');
            }
            if (!empty(request('location'))) {
                $q->where('location', 'like', '%' . request('location') . '%');
            }
            if (!empty(request('job_category_id'))) {
                $q->where('job_category_id', request('job_category_id'));
            }
            if (!empty(request('experience_id'))) {
                $q->where('experience_id', request('experience_id'));
            }
            if (!empty(request('job_type_id'))) {
                $q->whereIn('job_type_id', request('job_type_id'));
            }
        })->latest()->get();


        $sort = request('sort', 'latest'); // Default to 'latest' if not provided

        // Sort the collection based on the selected sort option
        if ($sort === 'latest') {
            $jobs = $jobs->sortByDesc('created_at');
        } elseif ($sort === 'oldest') {
            $jobs = $jobs->sortBy('created_at');
        }

        return view('frontend.findjob', compact('jobCategories', 'jobTypes', 'experiences', 'jobs'));
    }

    public function appyjobfrom()
    {
        return view('frontend.applyjobfrom');
    }



    public function jobapply(StoreJobApplicationRequest $request, Job $job)
    {
        $userId = auth()->id();

        // Check if the user has already applied for this job
        if (JobApplication::where('user_id', $userId)->where('job_id', $job->id)->exists()) {
            return redirect()->back()->with('error', 'You have already applied for this job');
        }

        //check you are not apply on your own job
        $employerId = $job->user_id;
        if ($employerId == Auth::user()->id) {
            return redirect()->back()->with('error', 'You are not allowed to apply to your own job');
        }


        // If no existing application, create a new one
        JobApplication::create([
            'user_id'      => $userId,
            'employer_id'  => $job->user_id,
            'job_id'       => $job->id,
            'applied_date' => now(),
        ]);

        //send mail notification
        $employer = User::where('id', $employerId)->first();
        $mailData = [
            'employer' => $employer,
            'user' => Auth::user(),
            'job' => $job,
        ];

        Mail::to($employer->email)->send(new JobNotificationMail($mailData));

        return redirect()->back()->with('success', 'Job applied successfully!');
    }


    public function appliedjob()
    {
        $jobApplications = JobApplication::where('user_id',Auth::user()->id)->with(['job','job.jobType'])->simplePaginate(5);
        // dd($jobs);
   
        return view('frontend.appliedjob', compact('jobApplications'));
    }
     
    public function deleteAppliedJob(Request $request, $id)
    {
        $jobApplication = jobApplication::find($id);
        if (!$jobApplication) {
            return back()->with('error', 'Applied job not found');
        }
        $jobApplication->delete();

        return back()->with('success', 'Applied job deleted successfully');
    }

    public function savejob( Job $job)
    {
        $userId = auth()->id();
        if (SaveJob::where('user_id', $userId)->where('job_id', $job->id)->exists()) {
            return redirect()->back()->with('error', 'You have already saved this job');
        }
        $employerId = $job->user_id;
        if ($employerId == Auth::user()->id) {
            return redirect()->back()->with('error', 'You are not allowed to save to your own job');
        }
        SaveJob::create([
            'user_id'      => $userId,
            'job_id'       => $job->id,
            'saved_date' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Job saved successfully!');
    }

    public function saveJoblist()
    {
        //fetch applicants
        $savejobs=SaveJob::where('user_id',Auth::user()->id)->with(['job','job.jobType'])->simplepaginate(5);
        
        return view('frontend.savejoblist',compact('savejobs'));
    }
    public function deleteSavedJob(Request $request, $id)
    {
        $savejob = SaveJob::find($id);
        if (!$savejob) {
            return back()->with('error', 'Saved job not found');
        }
        $savejob->delete();

        return back()->with('success', 'Saved job removed successfully');
    }
    
}
