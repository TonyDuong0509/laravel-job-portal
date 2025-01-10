@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Companies</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="/">Home</a></li>
                            <li>Companies</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
                    <div class="content-page company_page">
                        <div class="row text-center">
                            @forelse ($companies as $company)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="card-grid-1 hover-up wow animate__animated animate__fadeIn">
                                        <div class="image-box"><a href="{{ route('company.show', $company->slug) }}"><img
                                                    src="{{ $company->logo }}" alt="joblist"></a></div>
                                        <div class="info-text mt-10">
                                            <h5 class="font-bold"><a
                                                    href="{{ route('company.show', $company->slug) }}">{{ $company->name }}</a>
                                            </h5>
                                            <span
                                                class="card-location">{{ App\Helpers\formatLocation($company->companyCountry->name, $company->companyState->name) }}</span>
                                            <div class="mt-30"><a class="btn btn-grey-big"
                                                    href="jobs-grid.html"><span>{{ $company->jobs_count }}</span><span> Jobs
                                                        Open</span></a></div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h5>Sorry No Data Found! 😥</h5>
                            @endforelse
                        </div>
                    </div>
                    <div class="paginations">
                        <nav class="d-inline-block">
                            @if ($companies->hasPages())
                                {{ $companies->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="sidebar-shadow none-shadow mb-30">
                        <div class="sidebar-filters">
                            <div class="filter-block head-border mb-30">
                                <h5>Advance Filter <a class="link-reset" href="{{ route('companies.index') }}">Reset</a>
                                </h5>
                            </div>

                            <form action="{{ route('companies.index') }}" method="GET">
                                <div class="filter-block mb-20">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{ request()?->search }}"
                                            name="search" placeholder="Search">
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="country" class="form-control form-icons select-active country">
                                            @if ($countries)
                                                <option value="">All</option>
                                                @foreach ($countries as $country)
                                                    <option @selected(request()?->country == $country->id) value="{{ $country->id }}">
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Country</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="state" class="form-control form-icons select-active state">
                                            @if ($selectedStates)
                                                <option value="">All</option>
                                                @foreach ($selectedStates as $state)
                                                    <option @selected(request()?->state == $state->id) value="{{ $state->id }}">
                                                        {{ $state->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">State</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="city" class="form-control form-icons select-active city">
                                            @if ($selectedCities)
                                                <option value="">All</option>
                                                @foreach ($selectedCities as $city)
                                                    <option @selected(request()?->city == $city->id) value="{{ $city->id }}">
                                                        {{ $city->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">City</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <button class="submit btn btn-default mb-10 rounded-1 w-100" type="submit">
                                    Search
                                </button>
                            </form>

                            <form action="{{ route('companies.index') }}" method="GET">
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Industry</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            <li>
                                                <label class="d-flex">
                                                    <input type="radio" name="industry" class="x-radio" value="">
                                                    <span class="text-small">All</span>
                                                </label>
                                            </li>
                                            @foreach ($industryTypes as $industryType)
                                                <li>
                                                    <label class="d-flex">
                                                        <input @checked(request()->industry == $industryType->slug) type="radio" name="industry"
                                                            class="x-radio" value="{{ $industryType->slug }}">
                                                        <span class="text-small">{{ $industryType->name }}</span>
                                                        <span
                                                            class="number-item">{{ $industryType->companies_count }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Organization</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            <li>
                                                <label class="d-flex">
                                                    <input type="radio" name="organization" class="x-radio"
                                                        value="">
                                                    <span class="text-small">All</span>
                                                </label>
                                            </li>
                                            @foreach ($organizationTypes as $organizationType)
                                                <li>
                                                    <label class="d-flex">
                                                        <input @checked(request()->organization == $organizationType->slug) type="radio"
                                                            name="organization" class="x-radio"
                                                            value="{{ $organizationType->slug }}">
                                                        <span class="text-small">{{ $organizationType->name }}</span>
                                                        <span
                                                            class="number-item">{{ $organizationType->companies_count }}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button class="submit btn btn-default mb-10 rounded-1 w-100" type="submit">
                                    Search
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.country').on('change', function() {
                let country_id = $(this).val();

                // remove all previous cities
                $('.city').html("");

                $.ajax({
                    method: 'GET',
                    url: '{{ route('get-states', ':id') }}'.replace(':id', country_id),
                    data: {},
                    success: function(response) {
                        console.log(response);
                        let html = '';
                        $.each(response, function(index, value) {
                            html +=
                                `<option value="${value.id}">${value.name}</option>`;
                        });

                        html = `<option value="">Choose</option>` + html;

                        $('.state').html(html);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            $('.state').on('change', function() {
                let state_id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: '{{ route('get-cities', ':id') }}'.replace(':id', state_id),
                    data: {},
                    success: function(response) {
                        console.log(response);
                        let html = '';
                        $.each(response, function(index, value) {
                            html +=
                                `<option value="${value.id}">${value.name}</option>`;
                        });

                        html = `<option value="">Choose</option>` + html;

                        $('.city').html(html);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
