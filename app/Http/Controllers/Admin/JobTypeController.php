<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jobtype\StoreJobTypeRequest;
use App\Http\Requests\Jobtype\UpdateJobTypeRequest;
use App\Models\JobType;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $jobTypes = JobType::latest()->paginate(5);
        return view('admin.jobType.index',compact('jobTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jobType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobTypeRequest $request)
    {
        JobType::create($request->validated());
        toast('job Type Added Successfully','success');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobType $jobType)
    {
        return view('admin.jobType.edit ',compact('jobType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobTypeRequest $request, JobType $jobType)
    {
        $jobType->update($request->validated());
        toast('JbType Update Successfully','success');
        return redirect(route('admin.jobType.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobType $jobType)
    {
        $jobType->delete();
        toast('JobType Deleted Successfully','success');
        return back();
    }
    public function updateStatus(JobType $jobType)
    {
        $jobType->update([
            'status' => !$jobType->status
        ]);
        toast('Status updated successfully', 'success');
        return back();
    }
}
