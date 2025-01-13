<section class="section-box overflow-visible mt-15 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="text-center counter_box">
                    <h1 class="color-brand-2"><span class="count">{{ $counter?->counter_one }}</span></h1>
                    <h5>{{ Str::limit($counter?->title_one, 10, '...') }}</h5>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="text-center counter_box">
                    <h1 class="color-brand-2"><span class="count">{{ $counter?->counter_two }}</span></h1>
                    <h5>{{ Str::limit($counter?->title_two, 10, '...') }}</h5>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="text-center counter_box">
                    <h1 class="color-brand-2"><span class="count">{{ $counter?->counter_three }}</span></h1>
                    <h5>{{ Str::limit($counter?->title_three, 10, '...') }}</h5>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="text-center counter_box">
                    <h1 class="color-brand-2"><span class="count">{{ $counter?->counter_four }}</span></h1>
                    <h5>{{ Str::limit($counter?->title_four, 10, '...') }}</h5>
                </div>
            </div>
        </div>
    </div>
</section>
