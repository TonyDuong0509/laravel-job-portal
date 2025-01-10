@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Create Job Posts</h1>
        </div>

        <div class="section-body">
            @foreach ($errors->all() as $error)
                <div class="text-danger">{{ $error }}</div>
            @endforeach
            <div class="col-12">
                <div class="card-body">
                    <form action="{{ route('admin.jobs.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">Job Details</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Title <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control {{ \App\Helpers\hasError($errors, 'title') }}"
                                                value="{{ old('title') }}" name="title">
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
                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
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
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                                value="{{ old('vacancies') }}" name="vacancies">
                                            <x-input-error :messages="$errors->get('vacancies')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Deadline <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control datepicker {{ \App\Helpers\hasError($errors, 'deadline') }}"
                                                value="{{ old('deadline') }}" name="deadline">
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
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                                            </select>
                                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Address </label>
                                            <input type="text"
                                                class="form-control {{ \App\Helpers\hasError($errors, 'address') }}"
                                                value="{{ old('address') }}" name="address">
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
                                                    <input onclick="salaryModeChange('salary_range')" type="radio"
                                                        id="salary_range"
                                                        class="form-control {{ \App\Helpers\hasError($errors, 'salary_mode') }}"
                                                        name="salary_mode" checked value="range">
                                                    <label for="salary_range">Salary Range </label>
                                                    <x-input-error :messages="$errors->get('salary_mode')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <input onclick="salaryModeChange('custom_salary')" type="radio"
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
                                                        value="{{ old('min_salary') }}" name="min_salary">
                                                    <x-input-error :messages="$errors->get('min_salary')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Maximum Salary <span
                                                            class="text-danger">*</span> </label>
                                                    <input type="text"
                                                        class="form-control {{ \App\Helpers\hasError($errors, 'max_salary') }}"
                                                        value="{{ old('max_salary') }}" name="max_salary">
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
                                                value="{{ old('custom_salary') }}" name="custom_salary">
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
                                                    <option value="{{ $salaryType->id }}">{{ $salaryType->name }}
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
                                                    <option value="{{ $experience->id }}">{{ $experience->name }}
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
                                                    <option value="{{ $jobRole->id }}">{{ $jobRole->name }}
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
                                                    <option value="{{ $education->id }}">{{ $education->name }}
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
                                                    <option value="{{ $jobType->id }}">{{ $jobType->name }}
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
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Benefits <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control inputtags {{ \App\Helpers\hasError($errors, 'benefits') }}"
                                                name="benefits" value="{{ old('benefits') }}">
                                            <x-input-error :messages="$errors->get('benefits')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Skills <span class="text-danger">*</span></label>
                                            <select name="skills[]" multiple
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'skill') }}">
                                                @foreach ($skills as $skill)
                                                    <option value="{{ $skill->id }}">{{ $skill->name }}
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
                                                <option value="app">On Our Platform</option>
                                                <option value="email">On your email address</option>
                                                <option value="custom_url">On a custom link</option>
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
                                                    <input type="checkbox" id="featured"
                                                        class="form-control {{ \App\Helpers\hasError($errors, 'featured') }}"
                                                        name="featured" checked>
                                                    <label for="featured">Featured </label>
                                                    <x-input-error :messages="$errors->get('featured')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <input type="checkbox" id="highlight"
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
                                        <textarea id="editor" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
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
