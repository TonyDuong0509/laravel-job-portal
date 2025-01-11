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
                            <li>Applications</li>
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
                            <h4>{{ $jobTitle->title }}</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Details</th>
                                        <th>Experience</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>
                                        @forelse ($applications as $application)
                                            <tr>
                                                <td>
                                                    <div>
                                                        <div class="d-flex">
                                                            <img style="width: 50px; height: 50px; object-fit: cover"
                                                                src="{{ $application?->candidate?->image }}"
                                                                alt="{{ $application?->candidate?->full_name }}">
                                                            <br>
                                                            <div style="margin-left: 10px">
                                                                <span
                                                                    style="font-weight: bold; color: red">{{ $application?->candidate?->full_name }}</span>
                                                                <br>
                                                                <span>{{ $application?->candidate?->profession?->name }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $application?->candidate?->experience?->name }}</td>
                                                <td>
                                                    <a class="btn btn-primary"
                                                        href="{{ route('candidate.show', $application?->candidate?->slug) }}">View
                                                        Profile</a>
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
                                @if ($applications->hasPages())
                                    {{ $applications->withQueryString()->links() }}
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
