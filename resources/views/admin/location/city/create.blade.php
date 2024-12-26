@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>City</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Create City</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.cities.index') }}">
                            <- Back
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.cities.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Country</label>
                                        <select name="country"
                                                class="form-control select2 country {{ \App\Helpers\hasError($errors, 'country') }}">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}">
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('country')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">State</label>
                                        <select name="state"
                                                class="form-control select2 state {{ \App\Helpers\hasError($errors, 'state') }}">
                                            <option value="">Select Country</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}">
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('state')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">City Name</label>
                                        <input type="text"
                                               class="form-control {{ \App\Helpers\hasError($errors, 'city') }}"
                                               value="{{ old('city') }}"
                                               name="city">
                                        <x-input-error :messages="$errors->get('city')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
                $('.country').on('change', function () {
                    let country_id = $(this).val();

                    $.ajax({
                        method: 'GET',
                        url: '{{ route('admin.get-states', ":id") }}'.replace(':id', country_id),
                        data: {},
                        success: function (response) {
                            let html = '';

                            $.each(response, function (index, value) {
                                html += `<option value="${value.id}">${value.name}</option>`;
                            });

                            $('.state').html(html);
                        },
                        error: function (xhr, status, error) {
                        }
                    });
                });
            }
        );
    </script>
@endpush
