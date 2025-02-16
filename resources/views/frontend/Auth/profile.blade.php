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
                    @if (session('success'))
                        <div id="success-alert" class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body  p-4">
                            <h3 class="fs-4 mb-1">My Profile</h3>
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="mb-2">Name*</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $user->name) }}">
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="mb-2">Email*</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $user->email) }}">
                                </div>
                                <div class="mb-4">
                                    <label for="designation" class="mb-2">Designation*</label>
                                    <input type="text" name="designation" class="form-control"
                                        value="{{ old('designation', $user->designation) }}">
                                </div>
                                <div class="mb-4">
                                    <label for="mobile" class="mb-2">Mobile*</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone', $user->phone) }}">
                                </div>

                                <div class="card-footer  p-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>

                        </div>


                    </div>

                    <div class="card border-0 shadow mb-4">
                        <form action="{{ route('profile.updatePassword') }}" method="POST">
                            @csrf
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">Change Password</h3>

                                <div class="mb-4">
                                    <label for="old_password" class="mb-2">Old Password*</label>
                                    <input type="password" name="old_password" placeholder="Old Password"
                                        class="form-control" required>
                                </div>
                                <div class="mb-4">
                                    <label for="new_password" class="mb-2">New Password*</label>
                                    <input type="password" name="new_password" placeholder="New Password"
                                        class="form-control" required>
                                </div>
                                <div class="mb-4">
                                    <label for="new_password_confirmation" class="mb-2">Confirm Password*</label>
                                    <input type="password" name="new_password_confirmation" placeholder="Confirm Password"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="card-footer p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('frontend.Auth.profilepic')
@endsection
