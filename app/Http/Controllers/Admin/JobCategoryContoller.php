<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobCategoryRequest;
use App\Http\Requests\Admin\UpdateJobCategoryRequest;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobCategoryContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobCategories=JobCategory::latest()->paginate(5);
        return view('admin.jobCategory.index',compact('jobCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jobCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobCategoryRequest $request)
    {
        JobCategory::create($request->validated());
        toast('JOb Category added successfully ', 'success');
        return redirect(route('admin.jobCategory.index'));
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
    public function edit(JobCategory $jobCategory)
    {
        return view ('admin.jobCategory.edit',compact('jobCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobCategoryRequest $request, JobCategory $jobCategory)
    {
        $jobCategory->update($request->validated());
        toast('JobCategory updated successfully', 'success');
        return redirect(route('admin.jobCategory.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCategory $jobCategory)
    {
        // $this->deleteFile($course->image);
        $jobCategory->delete();
        toast('Deleted updated successfully', 'success');
        return back();
    }
    public function updateStatus(JobCategory $jobCategory)
    {
        $jobCategory->update([
            'status' => !$jobCategory->status
        ]);
        toast('Status updated successfully', 'success');
        return back();
    }
}
