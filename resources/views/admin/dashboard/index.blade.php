@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        @if (App\Helpers\canAccess(['dashboard analytics']))
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Earnings</h4>
                            </div>
                            <div class="card-body">
                                {{ config('settings.site_currency_icon') }} {{ $totalEarnings }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Candidates</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCandidates }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Companies</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalCompanies }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Jobs</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalJobs }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Active Jobs</h4>
                            </div>
                            <div class="card-body">
                                {{ $activeJobs }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Expired Jobs</h4>
                            </div>
                            <div class="card-body">
                                {{ $expiredJobs }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending Jobs</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingJobs->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Blogs</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalBlogs }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Subscribers</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSubscribers }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (App\Helpers\canAccess(['dashboard pending posts']))
            <hr>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pending Jobs</h4>
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
                                        @forelse ($pendingJobs as $job)
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
                                                            <input @checked($job->status === 'active')
                                                                data-id="{{ $job->id }}" type="checkbox"
                                                                name="custom-switch-checkbox"
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
                                                <td colspan="7" class="text-center"><span style="color: red">No data
                                                        found
                                                        !</span></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
