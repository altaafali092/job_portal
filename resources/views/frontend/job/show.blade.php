@extends('frontend.layouts.master')
@section('content')

    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('findJob') }}"><i class="fa fa-arrow-left"
                                        aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container job_details_area">
            <div class="row pb-5">

                <div class="col-md-8">
                   
                    <div class="card shadow border-0">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">

                                    <div class="jobs_conetent">
                                        <a href="#">
                                            <h4>{{ $job->job_name ?? '' }}</h4>
                                        </a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i> {{ $job->location ?? '' }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fa fa-clock-o"></i> {{ $job->jobType->name ?? '' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a class="heart_mark" href="{{ route('savejob', $job) }}"> <i class="fa fa-heart-o"
                                                aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="descript_wrap white-bg">
                            <div class="single_wrap">
                                <h4>Job description</h4>
                                <p>{{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($job->description ?? '')), 100, '...') }}</p>


                            </div>
                            <div class="single_wrap">
                                <h4>Responsibility</h4>
                                <ul>
                                    <li>{{ strip_tags($job->responsibility ??'') }}</li>
                                </ul>
                            </div>
                            <div class="single_wrap">
                                <h4>Qualifications</h4>
                                <ul>
                                    <li> {{ strip_tags($job->qualification ?? '') }}</li>
                                </ul>
                            </div>
                            <div class="single_wrap">
                                <h4>Benefits</h4>
                                <ul>
                                    <li>{{ strip_tags($job->benefit ?? '') }}</li>
                                </ul>

                            </div>
                            <div class="border-bottom"></div>
                            <div class="pt-3 text-end">
                                @if (Auth::check())
                                    <a href="{{ route('savejob', $job) }}" class="btn btn-secondary">Save</a>
                                    <a href="{{ route('jobapply', $job) }}" class="btn btn-primary">Apply</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary"> Login to Apply</a>
                                @endif
                            </div>
                            {{-- Applicant fetch --}}
                            @if (Auth::user() && $applicants->count() > 0)
                                @if (Auth::user()->id == $job->user_id)
                                    <center>
                                        <h6>Applicant Details</h6>
                                    </center>
                                    <div style="margin-top:10px;" class="table-responsive">
                                        <table class="table ">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>S.No</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Applied Date</th>
                                                </tr>
                                            </thead>
                                            <tbody class="border-0">
                                                @if ($applicants->isNotEmpty())
                                                    @foreach ($applicants as $applicant)
                                                        <tr class="active">
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $applicant->user->name ?? 'N/A' }}</td>
                                                            <td>{{ $applicant->user->email ?? 'N/A' }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($applicant->applied_date)->format('d-M-y') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5" class="text-center">No Applicants Job are Here!
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endif
                            {{-- End Applicant fetch --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Job Summery</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Published on:
                                        <span>{{ \Carbon\Carbon::parse($job->created ?? '')->format('d-M-Y') }}</span>
                                    </li>
                                    <li>Vacancy: <span>{{ $job->vacancy ?? '' }}</span></li>
                                    <li>Salary: <span>{{ $job->salary ?? '' }}</span></li>
                                    <li>Location: <span>{{ $job->location }}</span></li>
                                    <li>Job Nature: <span>{{ $job->jobType->name ?? '' }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0 my-4">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Company Details</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    <li>Name: <span>{{ $job->company_name ?? '' }}</span></li>
                                    <li>Locaion: <span>{{ $job->company_location ?? '' }}</span></li>
                                    <li>Webite: <span>{{ $job->company_website }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        setTimeout(function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>
@endsection
