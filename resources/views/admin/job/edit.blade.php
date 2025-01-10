@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Edit Job Posts</h1>
            <p style="font-size: 24px; font-weight: bold"><a href="{{ route('admin.jobs.index') }}"><- Back</a></p>
        </div>

        <div class="section-body">
            @foreach ($errors->all() as $error)
                <div class="text-danger">{{ $error }}</div>
            @endforeach
            <div class="col-12">
                <div class="card-body">
                    <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">Job Details</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Title <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control {{ \App\Helpers\hasError($errors, 'title') }}"
                                                value="{{ old('title', $job->title) }}" name="title">
                                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Company <span class="text-danger">*</span></label>
                                            <select name="company"
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'company') }}">
                                                <option value="">Select Company</option>
                                                @foreach ($companies as $company)
                                                    <option @selected($company->id === $job->company_id) value="{{ $company->id }}">
                                                        {{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('company')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Category <span class="text-danger">*</span></label>
                                            <select name="category"
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'category') }}">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option @selected($category->id === $job->job_category_id) value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Total Vacancies <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control {{ \App\Helpers\hasError($errors, 'vacancies') }}"
                                                value="{{ old('vacancies', $job->vacancies) }}" name="vacancies">
                                            <x-input-error :messages="$errors->get('vacancies')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Deadline <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control datepicker {{ \App\Helpers\hasError($errors, 'deadline') }}"
                                                value="{{ old('deadline', $job->deadline) }}" name="deadline">
                                            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">Location</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Country </label>
                                            <select name="country"
                                                class="form-control select2 country {{ \App\Helpers\hasError($errors, 'country') }}">
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option @selected($country->id === $job->country_id) value="{{ $country->id }}">
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">State </label>
                                            <select name="state"
                                                class="form-control select2 state {{ \App\Helpers\hasError($errors, 'state') }}">
                                                <option value="">Select State</option>
                                                @foreach ($states as $state)
                                                    <option @selected($state->id === $job->state_id) value="{{ $state->id }}">
                                                        {{ $state->name }}</option>32 3391 231
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">City </label>
                                            <select name="city"
                                                class="form-control select2 city {{ \App\Helpers\hasError($errors, 'city') }}">
                                                <option value="">Select City</option>
                                                @foreach ($cities as $city)
                                                    <option @selected($city->id === $job->city_id) value="{{ $city->id }}">
                                                        {{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Address </label>
                                            <input type="text"
                                                class="form-control {{ \App\Helpers\hasError($errors, 'address') }}"
                                                value="{{ old('address', $job->address) }}" name="address">
                                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">Salary Details</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <input @checked($job->salary_mode === 'range')
                                                        onclick="salaryModeChange('salary_range')" type="radio"
                                                        id="salary_range"
                                                        class="form-control {{ \App\Helpers\hasError($errors, 'salary_mode') }}"
                                                        name="salary_mode" checked value="range">
                                                    <label for="salary_range">Salary Range </label>
                                                    <x-input-error :messages="$errors->get('salary_mode')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <input @checked($job->salary_mode === 'custom')
                                                        onclick="salaryModeChange('custom_salary')" type="radio"
                                                        id="custom_salary"
                                                        class="form-control {{ \App\Helpers\hasError($errors, 'salary_mode') }}"
                                                        name="salary_mode" value="custom">
                                                    <label for="custom_salary">Custom Range </label>
                                                    <x-input-error :messages="$errors->get('salary_mode')" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 salary_range_part">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Minimum Salary <span
                                                            class="text-danger">*</span> </label>
                                                    <input type="text"
                                                        class="form-control {{ \App\Helpers\hasError($errors, 'min_salary') }}"
                                                        value="{{ old('min_salary', $job->min_salary) }}"
                                                        name="min_salary">
                                                    <x-input-error :messages="$errors->get('min_salary')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Maximum Salary <span
                                                            class="text-danger">*</span> </label>
                                                    <input type="text"
                                                        class="form-control {{ \App\Helpers\hasError($errors, 'max_salary') }}"
                                                        value="{{ old('max_salary', $job->max_salary) }}"
                                                        name="max_salary">
                                                    <x-input-error :messages="$errors->get('max_salary')" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 custom_salary_part d-none">
                                        <div class="form-group">
                                            <label for="">Custom Salary <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control {{ \App\Helpers\hasError($errors, 'custom_salary') }}"
                                                value="{{ old('custom_salary', $job->custom_salary) }}"
                                                name="custom_salary">
                                            <x-input-error :messages="$errors->get('custom_salary')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Salary Type <span class="text-danger">*</span> </label>
                                            <select name="salary_type"
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'salary_type') }}">
                                                <option value="">Select Salary Type</option>
                                                @foreach ($salaryTypes as $salaryType)
                                                    <option @selected($salaryType->id === $job->salary_type_id) value="{{ $salaryType->id }}">
                                                        {{ $salaryType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('salary_type')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">Attributes</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Experience <span class="text-danger">*</span></label>
                                            <select name="experience"
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'experience') }}">
                                                <option value="">Select</option>
                                                @foreach ($experiences as $experience)
                                                    <option @selected($experience->id === $job->job_experience_id) value="{{ $experience->id }}">
                                                        {{ $experience->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Job Role <span class="text-danger">*</span></label>
                                            <select name="job_role"
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'job_role') }}">
                                                <option value="">Select</option>
                                                @foreach ($jobRoles as $jobRole)
                                                    <option @selected($jobRole->id === $job->job_role_id) value="{{ $jobRole->id }}">
                                                        {{ $jobRole->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('job_role')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Education <span class="text-danger">*</span></label>
                                            <select name="education"
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'education') }}">
                                                <option value="">Select</option>
                                                @foreach ($educations as $education)
                                                    <option @selected($education->id === $job->education_id) value="{{ $education->id }}">
                                                        {{ $education->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('education')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Job Type <span class="text-danger">*</span></label>
                                            <select name="job_type"
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'job_type') }}">
                                                <option value="">Select</option>
                                                @foreach ($jobTypes as $jobType)
                                                    <option @selected($jobType->id === $job->job_type_id) value="{{ $jobType->id }}">
                                                        {{ $jobType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('job_type')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tags <span class="text-danger">*</span></label>
                                            <select name="tags[]" multiple
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'tags') }}">
                                                @php
                                                    $selectedTags = $job->tags()->pluck('tag_id')->toArray();
                                                @endphp
                                                @foreach ($tags as $tag)
                                                    <option @selected(in_array($tag->id, $selectedTags)) value="{{ $tag->id }}">
                                                        {{ $tag->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                                        </div>
                                    </div>
                                    @php
                                        $benefits = $job->benefits()->with('benefit')->get();
                                        $benefitNames = [];
                                        foreach ($benefits as $benefit) {
                                            $benefitNames[] = $benefit->benefit->name;
                                        }
                                        $benefitNameString = implode(',', $benefitNames);
                                    @endphp
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Benefits <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control inputtags {{ \App\Helpers\hasError($errors, 'benefits') }}"
                                                name="benefits" value="{{ old('benefits', $benefitNameString) }}">
                                            <x-input-error :messages="$errors->get('benefits')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Skills <span class="text-danger">*</span></label>
                                            <select name="skills[]" multiple
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'skill') }}">
                                                @php
                                                    $selectedSkills = $job->skills()->pluck('skill_id')->toArray();
                                                @endphp
                                                @foreach ($skills as $skill)
                                                    <option @selected(in_array($skill->id, $selectedSkills)) value="{{ $skill->id }}">
                                                        {{ $skill->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('skill')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">Application Options</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Receive Applications <span
                                                    class="text-danger">*</span></label>
                                            <select name="receive_applications"
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'receive_applications') }}">
                                                <option @selected($job->apply_on === 'app') value="app">On Our Platform
                                                </option>
                                                <option @selected($job->apply_on === 'email') value="email">On your email address
                                                </option>
                                                <option @selected($job->apply_on === 'custom_url') value="custom_url">On a custom link
                                                </option>
                                            </select>
                                            <x-input-error :messages="$errors->get('receive_applications')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">Promote</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <input @checked($job->featured) type="checkbox" id="featured"
                                                        class="form-control {{ \App\Helpers\hasError($errors, 'featured') }}"
                                                        name="featured" checked>
                                                    <label for="featured">Featured </label>
                                                    <x-input-error :messages="$errors->get('featured')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <input @checked($job->highlight) type="checkbox" id="highlight"
                                                        class="form-control {{ \App\Helpers\hasError($errors, 'highlight') }}"
                                                        name="highlight">
                                                    <label for="highlight">Highlight </label>
                                                    <x-input-error :messages="$errors->get('highlight')" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">Description</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Description <span class="text-danger">*</span></label>
                                        <textarea id="editor" name="description">{!! $job->description !!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('.inputtags').tagsinput('items');

        function salaryModeChange(mode) {
            if (mode == 'salary_range') {
                $('.salary_range_part').removeClass('d-none');
                $('.custom_salary_part').addClass('d-none');
            } else if (mode == 'custom_salary') {
                $('.salary_range_part').addClass('d-none');
                $('.custom_salary_part').removeClass('d-none');
            }
        };

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

                    $('.city').html(html);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    </script>
@endpush
