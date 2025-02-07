@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Posts</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Job Posts</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.jobs.index') }}" method="GET">
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
                        <a class="btn btn-primary ml-2" href="{{ route('admin.jobs.create') }}">
                            <i class="fas fa-plus-circle"> Create New</i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Job</th>
                                    <th>Category/Role</th>
                                    <th>Salary</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Approve</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($jobs as $job)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="mr-2">
                                                        <img src="{{ asset($job->company->logo) }}"
                                                            style="width: 50px; height: 50px; object-fit: cover"
                                                            alt="{{ $job->company->name }}">
                                                    </div>
                                                    <div>
                                                        {{ $job->title }}
                                                        <br>
                                                        <b>{{ $job->company->name }} - {{ $job->jobType->name }}</b>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <b>{{ $job->category?->name }}</b>
                                                    <br>
                                                    <span>{{ $job->jobRole->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($job->salary_mode === 'range')
                                                    <b>
                                                        {{ $job->min_salary }} -
                                                        {{ $job->max_salary }}
                                                        {{ config('settings.site_default_currency') }}
                                                    </b>
                                                    <br>
                                                    <span>{{ $job->salaryType->name }}</span>
                                                @else
                                                    <b>
                                                        {{ $job->custom_salary }}
                                                        {{ config('settings.site_default_currency') }}
                                                    </b>
                                                    <br>
                                                    <span>{{ $job->salaryType->name }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $job->deadline }}</td>
                                            <td>
                                                @if ($job->status === 'pending')
                                                    <span class="badge bg-warning text-light">Pending</span>
                                                @elseif ($job->deadline >= date('Y-m-d'))
                                                    <span class="badge bg-primary text-light">Active</span>
                                                @else
                                                    <span class="badge bg-danger text-light">Expired</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label class="custom-switch mt-2">
                                                        <input @checked($job->status === 'active') data-id="{{ $job->id }}"
                                                            type="checkbox" name="custom-switch-checkbox"
                                                            class="custom-switch-input post_status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.jobs.edit', $job->id) }}"
                                                    class="btn btn-dark">Edit</a>
                                                <a href="{{ route('admin.jobs.destroy', $job->id) }}"
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
                            @if ($jobs->hasPages())
                                {{ $jobs->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Job Posts In Trash</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.jobs.index') }}" method="GET">
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
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Job</th>
                                    <th>Category/Role</th>
                                    <th>Salary</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Approve</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($trashJobs as $job)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="mr-2">
                                                        <img src="{{ asset($job->company->logo) }}"
                                                            style="width: 50px; height: 50px; object-fit: cover"
                                                            alt="{{ $job->company->name }}">
                                                    </div>
                                                    <div>
                                                        {{ $job->title }}
                                                        <br>
                                                        <b>{{ $job->company->name }} - {{ $job->jobType->name }}</b>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <b>{{ $job->category?->name }}</b>
                                                    <br>
                                                    <span>{{ $job->jobRole->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($job->salary_mode === 'range')
                                                    <b>
                                                        {{ $job->min_salary }} -
                                                        {{ $job->max_salary }}
                                                        {{ config('settings.site_default_currency') }}
                                                    </b>
                                                    <br>
                                                    <span>{{ $job->salaryType->name }}</span>
                                                @else
                                                    <b>
                                                        {{ $job->custom_salary }}
                                                        {{ config('settings.site_default_currency') }}
                                                    </b>
                                                    <br>
                                                    <span>{{ $job->salaryType->name }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $job->deadline }}</td>
                                            <td>
                                                @if ($job->status === 'pending')
                                                    <span class="badge bg-warning text-light">Pending</span>
                                                @elseif ($job->deadline >= date('Y-m-d'))
                                                    <span class="badge bg-primary text-light">Active</span>
                                                @else
                                                    <span class="badge bg-danger text-light">Expired</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label class="custom-switch mt-2">
                                                        <input @checked($job->status === 'active') data-id="{{ $job->id }}"
                                                            type="checkbox" name="custom-switch-checkbox"
                                                            class="custom-switch-input post_status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.job-restore', $job->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning">Restore</button>
                                                </form>
                                                <a href="{{ route('admin.job-force-delete', $job->id) }}"
                                                    class="btn btn-danger delete-item">Force Delete</a>
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
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.post_status').on('change', function() {
                let id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.job-status.change', ':id') }}".replace(':id', id),
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.message == 'success') {
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
