@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4> EditForm</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                     Edit Blad
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="">
                                <a class="btn btn-secondary " href="#" role="button">
                                    {{ now()->format('F j, Y') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- horizontal Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Job Edit Forms</h4>

                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('admin.jobType.index') }}" role="button">
                                Back Index 
                            </a>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.jobType.update',$jobType) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" value="{{ old('name',$jobType->name) }}" />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Slug</label>
                                <input class="form-control" name="slug" value="{{ old('slug',$jobType->slug) }}" type="text" />
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-sm scroll-click" rel="content-y"
                                data-toggle="collapse" role="button">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
