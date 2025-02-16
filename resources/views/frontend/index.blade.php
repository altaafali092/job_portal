@extends('frontend.layouts.master')
@section('content')
    @if (session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section class="section-0 lazy d-flex bg-image-style dark align-items-center " class=""
        data-bg="{{ asset('assets/frontend/asset/images/banner5.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-8">
                    <h1>Find your dream job</h1>
                    <p>Thounsands of jobs available.</p>
                    <div class="banner-btn mt-5"><a href="{{ route('findJob') }}" class="btn btn-primary mb-4 mb-sm-0">Explore Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-1 py-5 ">
        <div class="container">
            <div class="card border-0 shadow p-5">
                <form action="{{ route('search.findJob') }}" method="GET" name="searchForm" id="searchForm">
                <div class="row">

                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="job_name" id="search" placeholder="Keywords">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="location" id="location" placeholder="Location"  value="{{ request('location') ?? '' }}">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <select name="category" id="category" class="form-control">
                            <option value="">Select a Category</option>
                            @foreach ($jobCategories as $jobCategory)
                                <option value="{{ $jobCategory->id }}">{{ $jobCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>

                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section-2 bg-2 py-5">
        <div class="container">
            <h2>Popular Categories</h2>

            <div class="row pt-5">
                @if ($jobCategories->isNotEmpty())
                    @foreach ($jobCategories as $jobCategories)
                        <div class="col-lg-4 col-xl-3 col-md-6">
                            <div class="single_catagory">
                                <a href="jobs.html">
                                    <h4 class="pb-2">{{ $jobCategories->name ?? '' }}</h4>
                                </a>
                                <p class="mb-0"> <span>50</span> Available position</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="section-3  py-5">
        <div class="container">
            <h2>Featured Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($jobs->isNotEmpty())
                                @foreach ($jobs as $job)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->job_name??'' }}</h3>
                                                <p>{{ Str::limit(strip_tags($job->description ?? ''), 100, '...') }}</p>
                                                <div class="bg-light p-3 border">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $job->location??'' }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $job->jobType->name ??'' }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $job->salary ??'' }}</span>
                                                    </p>
                                                </div>
                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('job.show', $job) }}" class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2>Latest Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($latestJobs->isNotEmpty())
                                @foreach ($latestJobs as $latestJob)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $latestJob->job_name ??'' }}</h3>
                                                <p>{{ Str::limit($latestJob->description ?? '', 100, '...') }}</p>
                                                <div class="bg-light p-3 border">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $latestJob->location ??'' }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $latestJob->jobType->name ??'' }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $latestJob->salary ??'' }}</span>
                                                    </p>
                                                </div>
                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('job.show', $job) }}" class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
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
                    <form>
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

    <script>
        setTimeout(function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>
@endsection
