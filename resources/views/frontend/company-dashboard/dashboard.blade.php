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
                            <li>Company Dashboard</li>
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
                    <div class="content-single">
                        <h3 class="mt-0 mb-0 color-brand-1">Dashboard</h3>
                        <div class="dashboard_overview">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-info-subtle">
                                        <h2>{{ $jobPosts }} <span>Job Posts</span></h2>
                                        <span class="icon"><i class="fas fa-briefcase"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-danger-subtle">
                                        <h2>{{ $totalJobs }} <span>Total Jobs</span></h2>
                                        <span class="icon"><i class="fas fa-briefcase"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-warning-subtle">
                                        <h2>{{ $totalOrders }} <span>Total Orders</span></h2>
                                        <span class="icon"><i class="fas fa-briefcase"></i></span>
                                    </div>
                                </div>
                            </div>

                            @if (!\App\Helpers\isCompanyProfileComplete())
                                <div class="row">
                                    <div class="col-12 mt-30">
                                        <div class="dash_alert_box p-30 bg-danger rounded-4 d-flex flex-wrap">
                                            <span class="img">
                                                <img src="{{ asset(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                    alt="alert">
                                            </span>
                                            <div class="text">
                                                <h4>Warning: You have to complete your company profile first !</h4>
                                                <p>Please complete your company profile to use all the features.</p>
                                            </div>
                                            <a href="{{ route('company.profile') }}" class="btn btn-warning rounded-1">Edit
                                                Profile</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-120"></div>
@endsection
