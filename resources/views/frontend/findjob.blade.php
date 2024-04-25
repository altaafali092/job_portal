@extends('frontend.layouts.master')
@section('content')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <form method="get" action="{{ route('search.findJob') }}">
                            <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                   <form action="{{ route('search.findJob') }}" method="GET" name="searchForm" id="searchForm">
                    <div class="card border-0 shadow p-4">
                        <div class="mb-4">
                            <h2>Keywords</h2>
                            <input type="text" name="keyword" placeholder="Keywords" class="form-control"
                            value="{{ request('keyword') ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <h2>Location</h2>
                            <input type="text" name="location" placeholder="Location" class="form-control"
                            value="{{ request('location') ?? '' }}">
                        </div>

                        <div class="mb-4">
                            <h2>Category</h2>
                            <select name="job_category_id" id="job_category_id" class="form-control">
                                <option value="">Select a Category</option>
                                @if ($jobCategories->isNotEmpty())
                                    @foreach ($jobCategories as $jobCategory)
                                        <option value="{{ $jobCategory->id }}" 
                                            {{ (!empty(request('job_category_id')) && request('job_category_id') == $jobCategory->id) ? 'selected' : '' }}
                                            >{{ $jobCategory->name ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-4">
                            <h2>Job Type</h2>
                            @if ($jobTypes->isNotEmpty())
                                @foreach ($jobTypes as $jobType)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input " name="job_type_id[]" type="checkbox"
                                            value="{{ $jobType->id }}" id=""
                                            {{ (!empty(request('job_type_id')) && in_array($jobType->id, request('job_type_id'))) ? 'checked' : '' }}
                                            >
                                        <label class="form-check-label " for="">{{ $jobType->name }}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="mb-4">
                            <h2>Experience</h2>
                            <select name="experience_id" id="experience_id" class="form-control">
                                <option value="">Select Experience</option>
                                @if ($experiences->isNotEmpty())
                                    @foreach ($experiences as $experience)
                                        <option value="{{ $experience->id }}"
                                            {{ (!empty(request('experience_id')) && request('experience_id') == $experience->id) ? 'selected' : '' }}
                                            >{{ $experience->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Search</button>
                        <a href="{{ route('findJob') }}" class="btn btn-secondary mt-3">Reset</a>
                    </div>
                   </form>
                </div>
                <div class="col-md-8 col-lg-9 ">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @if ($jobs->isNotEmpty())
                                    @foreach ($jobs as $job)
                                        <div class="col-md-4">
                                            <div class="card border-0 p-3 shadow mb-4">
                                                <div class="card-body">
                                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->job_name ?? '' }}</h3>
                                                    <p>{{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($job->description ?? '')), 100, '...') }}</p>

                                                    <div class="bg-light p-3 border">
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                            <span class="ps-1">{{ $job->location ?? '' }}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                            <span class="ps-1">{{ $job->jobType->name ?? '' }}</span>
                                                        </p>
                                                        <p class="mb-0">
                                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                            <span class="ps-1">{{ $job->salary ?? '' }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="d-grid mt-3">
                                                        <a href="{{ route('job.show', $job) }}"
                                                            class="btn btn-primary btn-lg">Details</a>
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
        </div>
    </section>
@endsection
