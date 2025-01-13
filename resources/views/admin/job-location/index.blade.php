@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Location</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Job Location</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.job-location.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search"
                                        value="{{ request('search') }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.job-location.create') }}">
                            <i class="fas fa-plus-circle"> Create New</i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Image</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($jobLocations as $jobLocation)
                                        <tr>
                                            <td>
                                                <img style="height: 70px; width: 150px; object-fit: cover; margin-top: 10px"
                                                    src="{{ $jobLocation?->image }}" alt="Country Image">
                                            </td>
                                            <td>
                                                {{ $jobLocation?->country->name }}
                                            </td>
                                            <td>
                                                <span class="badge bg-primary text-light">{{ $jobLocation?->status }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.job-location.edit', $jobLocation?->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ route('admin.job-location.destroy', $jobLocation?->id) }}"
                                                    class="btn btn-danger delete-item">Delete</a>
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
                            @if ($jobLocations->hasPages())
                                {{ $jobLocations->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
