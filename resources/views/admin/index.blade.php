@extends('admin.layouts.master')
@section('content')
<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="title pb-20">
            <h2 class="h3 mb-0">Hospital Overview</h2>
        </div>

        <div class="row pb-10">
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{ $user }}</div>
                            <div class="font-14 text-secondary weight-500">
                                Users
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#00eccf">
                                <i class="icon-copy dw dw-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">124,551</div>
                            <div class="font-14 text-secondary weight-500">
                                Total Patient
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b">
                                <span class="icon-copy ti-heart"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">400+</div>
                            <div class="font-14 text-secondary weight-500">
                                Total Doctor
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i class="icon-copy fa fa-stethoscope" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">$50,000</div>
                            <div class="font-14 text-secondary weight-500">Earning</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06">
                                <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="card-box pb-10">
            <div class="h5 pd-20 mb-0">Recent Users</div>
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <th class="table-plus">Name</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>Designation</th>
                        <th>Role</th>

                        <th class="datatable-nosort">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="table-plus">
                        <div class="name-avatar d-flex align-items-center">
                            <div class="avatar mr-2 flex-shrink-0">
                                <img src="vendors/images/photo4.jpg" class="border-radius-100 shadow"
                                    width="40" height="40" alt="" />
                            </div>
                            <div class="txt">
                                <div class="weight-600">{{ $user->name ??'' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->email ??'' }}</td>
                    <td>{{ $user->phone ??'' }}</td>
                    <td>{{ $user->designation ??'' }}</td>

                    <td>
                        <span class="badge badge-pill" data-bgcolor="#e7ebf5"
                            data-color="#265ed7">{{ $user->role }}</span>
                    </td>
                    <td>
                        <div class="table-actions">

                            <a href="#" data-color="#e95959"><i
                                    class="icon-copy dw dw-delete-3"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
