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
                            <li>Bookmarks Jobs</li>
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
                        <h4>Bookmarks</h4>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Job</th>
                                <th>Salary</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="experience-tbody">
                            @forelse ($bookmarks as $bookmark)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <img style="width: 50px; height: 50px; object-fit: cover"
                                                src="{{ $bookmark?->job?->company?->logo }}"
                                                alt="{{ $bookmark?->job?->company?->name }}">
                                            <div style="padding-left: 15px">
                                                <h6>{{ $bookmark?->job?->title }}</h6>
                                                <b>{{ $bookmark?->job?->company?->companyCountry?->name }}</b>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($bookmark?->job?->salary_mode === 'range')
                                            {{ $bookmark?->job?->min_salary }} - {{ $bookmark->job->max_salary }}
                                            {{ config('settings.site_default_currency') }}
                                        @else
                                            {{ $bookmark?->job?->custom_salary }}
                                            {{ config('settings.site_default_currency') }}
                                        @endif
                                    </td>
                                    <td>{{ $bookmark?->created_at }}</td>
                                    <td>
                                        @if ($bookmark?->job?->deadline < date('Y-m-d'))
                                            <span class="badge bg-danger">Expired</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($bookmark?->job?->deadline < date('Y-m-d'))
                                            <a class="btn btn-secondary btn-sm" href="javascript:;"><i
                                                    class="fas fa-eye"></i></a>
                                        @else
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('jobs.show', $bookmark?->job?->slug) }}"><i
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
                    @if ($bookmarks->hasPages())
                        {{ $bookmarks->withQueryString()->links() }}
                    @endif
                </nav>
            </div>
        </div>
    </section>
    <div class="mt-120"></div>
@endsection
