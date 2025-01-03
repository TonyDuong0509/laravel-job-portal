@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Price Plan</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit Price Plan</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.plans.index') }}">
                            <- Back </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Label</label>
                                        <input type="text"
                                            class="form-control {{ \App\Helpers\hasError($errors, 'label') }}"
                                            value="{{ old('label', $plan->label) }}" name="label">
                                        <x-input-error :messages="$errors->get('label')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text"
                                            class="form-control {{ \App\Helpers\hasError($errors, 'price') }}"
                                            value="{{ old('price', $plan->price) }}" name="price">
                                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Job Limit</label>
                                        <input type="text"
                                            class="form-control {{ \App\Helpers\hasError($errors, 'job_limit') }}"
                                            value="{{ old('job_limit', $plan->job_limit) }}" name="job_limit">
                                        <x-input-error :messages="$errors->get('job_limit')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Featured Job Limit</label>
                                        <input type="text"
                                            class="form-control {{ \App\Helpers\hasError($errors, 'featured_job_limit') }}"
                                            value="{{ old('featured_job_limit', $plan->featured_job_limit) }}"
                                            name="featured_job_limit">
                                        <x-input-error :messages="$errors->get('featured_job_limit')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Highlight Job Limit</label>
                                        <input type="text"
                                            class="form-control {{ \App\Helpers\hasError($errors, 'highlight_job_limit') }}"
                                            value="{{ old('highlight_job_limit', $plan->highlight_job_limit) }}"
                                            name="highlight_job_limit">
                                        <x-input-error :messages="$errors->get('highlight_job_limit')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Profile Verify</label>
                                        <select class="form-control {{ \App\Helpers\hasError($errors, 'profile_verify') }}"
                                            name="profile_verify">
                                            <option @selected($plan->profile_verify === 0) value="0">No</option>
                                            <option @selected($plan->profile_verify === 1) value="1">Yes</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('profile_verify')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Recommended</label>
                                        <select class="form-control {{ \App\Helpers\hasError($errors, 'recommended') }}"
                                            name="recommended">
                                            <option @selected($plan->recommended === 0) value="0">No</option>
                                            <option @selected($plan->recommended === 1) value="1">Yes</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('recommended')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Show this package in frontend</label>
                                        <select class="form-control {{ \App\Helpers\hasError($errors, 'frontend_show') }}"
                                            name="frontend_show">
                                            <option @selected($plan->frontend_show === 0) value="0">No</option>
                                            <option @selected($plan->frontend_show === 1) value="1">Yes</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('frontend_show')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Show this package in Home</label>
                                        <select class="form-control {{ \App\Helpers\hasError($errors, 'show_at_home') }}"
                                            name="show_at_home">
                                            <option @selected($plan->show_at_home === 0) value="0">No</option>
                                            <option @selected($plan->show_at_home === 1) value="1">Yes</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('show_at_home')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
