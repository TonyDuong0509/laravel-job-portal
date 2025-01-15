@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Dashboard</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Applied Jobs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">

                @include('frontend.candidate-dashboard.sidebar')

                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <div class="d-flex justify-content-between">
                        <h4>Applied Jobs ({{ $appliedJobs->count() }})</h4>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Salary</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="experience-tbody">
                            @forelse ($appliedJobs as $appliedJob)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <img style="width: 50px; height: 50px; object-fit: cover"
                                                src="{{ $appliedJob?->job?->company?->logo }}"
                                                alt="{{ $appliedJob?->job?->company?->name }}">
                                            <div style="padding-left: 15px">
                                                <h6>{{ $appliedJob?->job?->company?->name }}</h6>
                                                <b>{{ $appliedJob?->job?->company?->companyCountry?->name }}</b>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($appliedJob?->job?->salary_mode === 'range')
                                            {{ $appliedJob?->job?->min_salary }} - {{ $appliedJob->job->max_salary }}
                                            {{ config('settings.site_default_currency') }}
                                        @else
                                            {{ $appliedJob?->job?->custom_salary }}
                                            {{ config('settings.site_default_currency') }}
                                        @endif
                                    </td>
                                    <td>{{ $appliedJob?->created_at }}</td>
                                    <td>
                                        @if ($appliedJob?->job?->deadline < date('Y-m-d'))
                                            <span class="badge bg-danger">Expired</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($appliedJob?->job?->deadline < date('Y-m-d'))
                                            <a class="btn btn-secondary btn-sm" href="javascript:;"><i
                                                    class="fas fa-eye"></i></a>
                                        @else
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('jobs.show', $appliedJob?->job?->slug) }}"><i
                                                    class="fas fa-eye"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5 text-center">No data found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <nav class="d-inline-block">
                    @if ($appliedJobs->hasPages())
                        {{ $appliedJobs->withQueryString()->links() }}
                    @endif
                </nav>
            </div>
        </div>
    </section>
    <div class="mt-120"></div>
@endsection
