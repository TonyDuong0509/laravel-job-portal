@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Jobs</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Jobs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">

                @include('frontend.company-dashboard.sidebar')

                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Job Posts</h4>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="card-header-form">
                                        <form action="{{ route('admin.jobs.index') }}" method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search"
                                                    name="search" value="{{ request('search') }}">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary" type="submit"><i
                                                            class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn-sm text-primary ml-2" href="{{ route('company.jobs.create') }}">
                                        <i class="fas fa-plus-circle"> Create New</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Job</th>
                                        <th>Category/Role</th>
                                        <th>Applications</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>
                                        @forelse ($jobs as $job)
                                            <tr>
                                                <td>
                                                    <div>
                                                        <div>
                                                            {{ $job?->title }}
                                                            <br>
                                                            <b>{{ $job?->company->name }} - {{ $job?->jobType?->name }}</b>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <b>{{ $job?->category?->name }}</b>
                                                        <br>
                                                        <span>{{ $job?->jobRole->name }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $job?->applications_count }} Applications
                                                </td>
                                                <td>{{ $job?->deadline }}</td>
                                                <td>
                                                    @if ($job?->status === 'pending')
                                                        <span class="badge bg-warning text-light">Pending</span>
                                                    @elseif ($job?->deadline >= date('Y-m-d'))
                                                        <span class="badge bg-success text-light">Active</span>
                                                    @else
                                                        <span class="badge bg-danger text-light">Expired</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('company.job.applications', $job->id) }}"
                                                        class="btn-sm text-primary">Applications</a>
                                                    <a href="{{ route('company.jobs.edit', $job->id) }}"
                                                        class="btn-sm text-warning">Edit</a>
                                                    <a href="{{ route('company.jobs.destroy', $job->id) }}"
                                                        class="btn-sm text-danger delete-item">Delete</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No result found !</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                @if ($jobs->hasPages())
                                    {{ $jobs->withQueryString()->links() }}
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
