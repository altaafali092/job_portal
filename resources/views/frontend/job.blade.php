@extends('frontend.layouts.master')
@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                @include('frontend.Auth.sidebar')
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4 ">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Job Details</h3>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Job Title" id="title" name="job_name"
                                            class="form-control">
                                        @error('job_name')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="job_category_id" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @foreach ($jobCategories as $jobCategory)
                                                <option value="{{ $jobCategory->id }}">{{ $jobCategory->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('job_category_id')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select name="job_type_id" class="form-select">
                                            <option value="">Select a Job Nature</option>
                                            @foreach ($jobTypes as $jobType)
                                                <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('job_type_id')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6  mb-4">
                                        <label for="" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Vacancy" id="vacancy"
                                            name="vacancy" class="form-control">
                                        @error('vacancy')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Salary</label>
                                        <input type="text" placeholder="Salary" id="salary" name="salary"
                                            class="form-control">
                                        @error('salary')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="location" id="location" name="location"
                                            class="form-control">
                                        @error('location')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Experience<span class="req">*</span></label>
                                    <select name="experience_id" class="form-select">
                                        <option>--Select--</option>
                                        @foreach ($experiences as $experience)
                                            <option value="{{ $experience->id }}">{{ $experience->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('experience_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="textarea" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>
                                    @error('description')
                                        <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Benefits</label>
                                    <textarea class="textarea" name="benefit" id="benefits" cols="5" rows="5" placeholder="Benefits"></textarea>
                                    @error('benefit')
                                        <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Responsibility</label>
                                    <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5"
                                        placeholder="Responsibility"></textarea>
                                    @error('responsibility')
                                        <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Qualifications</label>
                                    <textarea class="form-control" name="qualification" id="qualifications" cols="5" rows="5"
                                        placeholder="Qualifications"></textarea>
                                    @error('qualification')
                                        <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Keywords<span class="req">*</span></label>
                                    <input type="text" placeholder="keywords" id="keywords" name="keyword"
                                        class="form-control">
                                    @error('keyword')
                                        <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" placeholder="Company Name" id="company_name"
                                            name="company_name" class="form-control">
                                        @error('company_name')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4 col-md-6">
                                        <label for="" class="mb-2">Location</label>
                                        <input type="text" placeholder="Location" id="location"
                                            name="company_location" class="form-control">
                                        @error('company_location')
                                            <div class="text-danger"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Website</label>
                                    <input type="text" placeholder="Website" id="website" name="company_website"
                                        class="form-control">
                                    @error('company_website')
                                        <div class="text-danger"> {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="card-footer  p-4">
                                    <button type="submit" class="btn btn-primary">Save Job</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pb-0" id="exampleModalLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  action ="{{ route('profile.updatePicture',$userImage)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mx-3">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
