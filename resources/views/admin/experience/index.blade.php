@extends('admin.layouts.master')
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Experience Tables</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Index Page
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <div class="dropdown">
                                <a class="btn btn-primary" href="{{ route('admin.experience.create') }}" role="button">
                                    Add New
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- basic table  Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-left">
                            <h4 class="text-blue h4">Experience Table</h4>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="" role="button">
                                {{ now()->format('F j, Y')  }}
                            </a>
                        </div>

                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                               
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($experiences as  $key=>$experience)
                                <tr>
                                    <th scope="row">{{ $experiences->firstItem() + $key }}</th>
                                    <td>{{ $experience->name }}</td>
                                    
                                    <td>
                                        <form action="{{ route('admin.experience.updateexperienceStatus', $experience) }}" method="post"
                                            style="display: inline">
                                            @csrf
                                            @method('put')
                                            <button type="submit" style="border: none; background: none;">
                                                <i
                                                    class="fa fa-{{ $experience->status == 1 ? 'toggle-on text-success' : 'toggle-off text-danger' }} fa-2x"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        
                                        <a class="btn btn-outline-primary" href="{{ route('admin.experience.edit', $experience) }}">
                                            <i class="bi bi-pencil"></i></a> 
                                                <form action="{{ route('admin.experience.destroy', $experience) }}"
                                                    method="post" style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        onclick="return confirm('Are You sure want to delete')"> <i
                                                            class="bi bi-trash3-fill"></i> </button>
                                                </form>
                                            
                                       
                                    </td>
                                </tr>
                        </tbody>
                    @empty
                        <tr>
                            <td colspan="3">There are no data.</td>
                        </tr>
                        @endforelse
                    </table>
                    {!! $experiences->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
