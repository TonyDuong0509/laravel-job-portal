<div class="bg-homepage1" style="background-image: url({{ $hero->background_image }})"></div>

<section class="section-box mt-100 mb-100 banner_section">
    <div class="container">
        <div class="banner-hero hero-1">
            <div class="banner-inner">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-lg-12 d-none d-xl-block col-md-6">
                        <div class="banner-imgs mt-40">
                            <div class="block-1">
                                <img class="img-responsive" alt="Job List" src="{{ asset($hero->image) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-12">
                        <div class="block-banner">
                            <h1 class="heading-banner wow animate__animated animate__fadeInUp">{{ $hero->title }}</h1>
                            <div class="banner-description mt-20 wow animate__animated animate__fadeInUp"
                                data-wow-delay=".1s">
                                {{ $hero->sub_title }}
                            </div>
                            <div class="form-find mt-40 wow animate__animated animate__fadeIn" data-wow-delay=".2s">
                                <form action="{{ route('jobs.index') }}" method="GET">
                                    <div class="box-industry">
                                        <select class="form-input mr-10 select-active input-industry" name="category">
                                            <option value="">Industry</option>
                                            @foreach ($jobCategories as $jobCategory)
                                                <option value="{{ $jobCategory->slug }}">
                                                    {{ $jobCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <select class="form-input mr-10 select-active" name="country">
                                        <option value="">Location</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input class="form-input input-keysearch mr-10" type="text"
                                        placeholder="Your keyword... " name="search">
                                    <button class="btn btn-default btn-find font-sm">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
