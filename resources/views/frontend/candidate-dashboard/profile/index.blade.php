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
                            <li>Company Profile</li>
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
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">
                                Basic
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Profile
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-experience" type="button" role="tab"
                                aria-controls="pills-experience" aria-selected="false">Experience & Education
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-account-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account"
                                aria-selected="false">Account
                                Settings
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">

                        @include('frontend.candidate-dashboard.profile.sections.basic-section')

                        @include('frontend.candidate-dashboard.profile.sections.profile-section')

                        @include('frontend.candidate-dashboard.profile.sections.experience-section')

                        @include('frontend.candidate-dashboard.profile.sections.account-section')


                        {{-- <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row">

                                <form action="{{ route('company.profile.account-info') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-sm color-text-mutted mb-10">User Name *</label>
                                                <input type="text" name="name" id=""
                                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    value="{{ Auth::user()->name }}">
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-sm color-text-mutted mb-10">Email *</label>
                                                <input type="email" name="email" id=""
                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    value="{{ Auth::user()->email }}">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default btn-shadow">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <form action="{{ route('company.profile.password-update') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-sm color-text-mutted mb-10">Password *</label>
                                                <input type="password" name="password" id=""
                                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-sm color-text-mutted mb-10">Password Confirmation
                                                    *</label>
                                                <input type="password" name="password_confirmation" id=""
                                                    class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button class="btn btn-default btn-shadow">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-120"></div>

    <div class="modal fade" id="experienceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create or Update Experience</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="experienceForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Company</label>
                                    <input type="text" class="form-control" name="company" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Department</label>
                                    <input type="text" class="form-control" name="department" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Designation</label>
                                    <input type="text" class="form-control" name="designation" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input type="text" class="form-control datepicker" name="start" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Start End</label>
                                    <input type="text" class="form-control datepicker" name="end" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-group form-check-inline">
                                    <input type="checkbox" class="form-check-input" style="margin-right: 10px"
                                        name="currently_working">
                                    <label for="" class="form-check-label">I am currently working</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Responsibilities</label>
                                    <textarea name="responsibility" maxlength="500" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="educationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create or Update Education</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="educationForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Level</label>
                                    <input type="text" class="form-control" name="level" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Degree</label>
                                    <input type="text" class="form-control" name="degree" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Year</label>
                                    <input type="text" class="form-control yearpicker" name="year" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Note</label>
                                    <textarea name="note" maxlength="500" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        /** Experience */
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
        });

        var editId = "";
        var editMode = false;

        function fetchExperience() {
            $.ajax({
                method: "GET",
                url: "{{ route('candidate.experiences.index') }}",
                data: {},
                success: function(response) {
                    $('.experience-tbody').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);

                }
            });
        }

        $('#experienceForm').on('submit', function(event) {
            event.preventDefault();

            const formData = $(this).serialize();

            if (editMode) {
                $.ajax({
                    method: "PUT",
                    url: "{{ route('candidate.experiences.update', ':id') }}".replace(':id', editId),
                    data: formData,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        fetchExperience();
                        $('#experienceForm').trigger('reset');
                        $('#experienceModal').modal('hide');
                        editId = "";
                        editMode = false;
                        hideLoader();
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        hideLoader();
                        console.log(error);

                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: "{{ route('candidate.experiences.store') }}",
                    data: formData,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        fetchExperience();
                        $('#experienceForm').trigger('reset');
                        $('#experienceModal').modal('hide');
                        hideLoader();
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        hideLoader();
                    }
                });
            }
        });

        // click and handle edit candidate experience
        $('body').on('click', '.edit-experience', function() {
            $('#experienceForm').trigger('reset');
            let url = $(this).attr('href');

            $.ajax({
                method: "GET",
                url: url,
                data: {},
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    editId = response.id;
                    editMode = true;
                    $.each(response, (index, value) => {
                        $(`input[name="${index}"]:text`).val(value);
                        if (index === 'currently_working' && value == 1) {
                            $(`input[name="${index}"]:checkbox`).prop('checked', true);
                        }
                        if (index === 'responsibility') {
                            $(`textarea[name="${index}"]`).val(value);
                        }
                    })
                    hideLoader();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    hideLoader();
                }
            });
        });

        // Delete item
        $(".delete-experience").on('click', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');
            swal({
                    title: 'Are you sure?',
                    text: 'Once deleted, you will not be able to recover this imaginary file!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            beforeSend: function() {
                                showLoader();
                            },
                            success: function(response) {
                                fetchExperience();
                                hideLoader();
                                notyf.success(response.message);
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                swal(xhr.responseJSON.message, {
                                    icon: 'error',
                                });
                                hideLoader();
                            }
                        });
                    }
                });
        });


        /** Education */
        var editEducationId = "";
        var editEducationMode = false;

        function fetchEducation() {
            $.ajax({
                method: "GET",
                url: "{{ route('candidate.educations.index') }}",
                data: {},
                success: function(response) {
                    $('.education-tbody').html(response);
                },
                error: function(xhr, status, error) {
                    console.log(error);

                }
            });
        }

        $('#educationForm').on('submit', function(event) {
            event.preventDefault();

            const formData = $(this).serialize();

            if (editEducationMode) {
                $.ajax({
                    method: "PUT",
                    url: "{{ route('candidate.educations.update', ':id') }}".replace(':id',
                        editEducationId),
                    data: formData,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        fetchEducation();
                        $('#educationForm').trigger('reset');
                        $('#educationModal').modal('hide');
                        editEducationId = "";
                        editEducationMode = false;
                        hideLoader();
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        hideLoader();
                        console.log(error);

                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: "{{ route('candidate.educations.store') }}",
                    data: formData,
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        fetchEducation();
                        $('#educationForm').trigger('reset');
                        $('#educationModal').modal('hide');
                        hideLoader();
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        hideLoader();
                    }
                });
            }
        });

        // click and handle edit candidate experience
        $('body').on('click', '.edit-education', function() {
            $('#educationForm').trigger('reset');
            let url = $(this).attr('href');

            $.ajax({
                method: "GET",
                url: url,
                data: {},
                beforeSend: function() {
                    showLoader();
                },
                success: function(response) {
                    editEducationId = response.id;
                    editEducationMode = true;
                    $.each(response, (index, value) => {
                        $(`input[name="${index}"]:text`).val(value);
                        if (index === 'currently_working' && value == 1) {
                            $(`input[name="${index}"]:checkbox`).prop('checked', true);
                        }
                        if (index === 'note') {
                            $(`textarea[name="${index}"]`).val(value);
                        }
                    })
                    hideLoader();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    hideLoader();
                }
            });
        });

        // Delete item
        $(".delete-education").on('click', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');
            swal({
                    title: 'Are you sure?',
                    text: 'Once deleted, you will not be able to recover this imaginary file!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            beforeSend: function() {
                                showLoader();
                            },
                            success: function(response) {
                                fetchEducation();
                                hideLoader();
                                notyf.success(response.message);
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                swal(xhr.responseJSON.message, {
                                    icon: 'error',
                                });
                                hideLoader();
                            }
                        });
                    }
                });
        });
    </script>
@endpush
