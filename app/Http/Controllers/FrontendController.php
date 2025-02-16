<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\job\StoreJobRequest;
use App\Http\Requests\Frontend\JobAplication\StoreJobApplicationRequest;
use App\Http\Requests\Frontend\UpdateProfilePictureRequest;
use App\Mail\JobNotificationMail;
use App\Models\Experience;
use App\Models\Job;
use App\Models\jobApplication;
use App\Models\JobCategory;
use App\Models\JobType;
use App\Models\SaveJob;
use App\Models\User;
use App\Models\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function index()
    {
        $jobCategories = JobCategory::where('status', 1)->get();
        $jobs = Job::inRandomOrder()->take(6)->where('status', 1)->get();
        $latestJobs = Job::latest()->take(6)->where('status', 1)->get();
        return view('frontend.index', compact('jobCategories', 'jobs', 'latestJobs'));
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
        $jobs = Job::where('user_id', Auth::user()->id)->with('jobType')->latest()->paginate(5);
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



    public function jobapply(Job $job)
{
    $userId = Auth::user()->id;


    if (JobApplication::where('user_id', $userId)->where('job_id', $job->id)->exists()) {
        toast('You have already applied for this job', 'warning');
        return redirect()->back();
    }

    // Check if the user is trying to apply to their own job
    if ($job->user_id == $userId) {
        toast('You are not allowed to apply to your own job', 'warning');
        return back();
    }

    // Create a new job application
    JobApplication::create([
        'user_id'      => $userId,
        'employer_id' => $job->user_id,
        'job_id'       => $job->id,
        'applied_date' => now(),
    ]);

    // Send email notification to the employer
    $employer = User::find($job->user_id); // Use `find` instead of `where` for simplicity
    $mailData = [
        'employer' => $employer,
        'user'     => Auth::user(),
        'job'      => $job,
    ];

    Mail::to($employer->email)->send(new JobNotificationMail($mailData));

    // Notify the user of successful application
    toast('Job Applied Successfully', 'success');
    return back();
}


    public function appliedjob()
    {
        $jobApplications = JobApplication::where('user_id', Auth::user()->id)->with(['job', 'job.jobType'])->simplePaginate(5);
        // dd($jobs);

        return view('frontend.appliedjob', compact('jobApplications'));
    }

    public function deleteAppliedJob(Request $request, $id)
    {
        $jobApplication = jobApplication::find($id);
        if (!$jobApplication) {
            toast('Applied job not found', 'error');
            return back();
        }
        $jobApplication->delete();
        toast('Applied job deleted successfully', 'success');
        return back();
    }

    public function savejob($jobId)
    {
        // Find the job by ID
        $job = Job::find($jobId);

        // Check if the job exists
        if (!$job) {
            toast('Job not found.', 'error');
            return redirect()->back();
        }

        $userId = auth()->id();

        // Check if the job is already saved by the user
        if (SaveJob::where('user_id', $userId)->where('job_id', $job->id)->exists()) {
            toast('You have already saved this job.', 'error');
            return redirect()->back();
        }

        // Check if the user is trying to save their own job
        if ($job->user_id == $userId) {
            toast('Your are trying to save your own job', 'error');
            return redirect()->back();;
        }

        // Save the job
        SaveJob::create([
            'user_id'    => $userId,
            'job_id'     => $job->id,
            'saved_date' => now(),
        ]);

        // Success message
        toast('Job saved successfully!', 'success');

        return redirect()->back();
    }

    public function saveJoblist()
    {
        //fetch applicants
        $savejobs = SaveJob::where('user_id', Auth::user()->id)->with(['job', 'job.jobType'])->simplepaginate(5);

        return view('frontend.savejoblist', compact('savejobs'));
    }
    public function deleteSavedJob(Request $request, $id)
    {
        $savejob = SaveJob::find($id);
        if (!$savejob) {
            return back()->with('Saved job not found', 'error');
        }
        $savejob->delete();
        toast('Saved job removed successfully', 'success');
        return back();
    }

    // public function updateProfile(UpdateProfilePictureRequest $request, UserImage $userImage)
    // {
    //     $userImage->update($request->validated(),['user_id'=>Auth::user()->id]);
    //     return back()->with('success', 'Profile picture updated successfully');
    // }


}
