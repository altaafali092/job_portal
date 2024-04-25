<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Experience\StoreExperienceRequest;
use App\Http\Requests\Experience\UpdateExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::latest()->paginate(5);
        return view('admin.experience.index',compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExperienceRequest $request)
    {
        Experience::create($request->validated());
        toast('Added Successfully','success');
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
    public function edit(Experience  $experience)
    {
        return view('admin.experience.edit',compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->validated());
        toast('Updated Successfully','success');
        return redirect(route('admin.experience.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();
        toast('Deleted Successfully','success');
        return back();
    }
    public function updateStatus(Experience $experience)
    {
        $experience->update([
            'status' => !$experience->status
        ]);
        toast('Status updated successfully', 'success');
        return back();
    }
}
