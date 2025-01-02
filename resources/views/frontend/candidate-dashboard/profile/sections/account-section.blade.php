<div class="tab-pane fade show" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab">
    <form action="{{ route('candidate.profile.account-info.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <h4>Location</h4>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Country *</label>
                            <select name="country"
                                class="{{ $errors->has('country') ? 'is-invalid' : '' }} form-control form-icons select-active select2 country">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option @selected($country->id === $candidate?->country) value="{{ $country->id }}">
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">State *</label>
                            <select name="state"
                                class="{{ $errors->has('state') ? 'is-invalid' : '' }} form-control form-icons select-active select2 state">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option @selected($state->id === $candidate?->state) value="{{ $state->id }}">
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">City *</label>
                            <select name="city"
                                class="{{ $errors->has('city') ? 'is-invalid' : '' }} form-control form-icons select-active select2 city">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option @selected($city->id === $candidate?->city) value="{{ $city->id }}">
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Address *</label>
                            <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                type="text" value="{{ $candidate?->address }}" name="address">
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <h4>Your Contact Information</h4>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Phone 1 *</label>
                            <input class="form-control {{ $errors->has('phone_one') ? 'is-invalid' : '' }}"
                                type="text" value="{{ $candidate?->phone_one }}" name="phone_one">
                            <x-input-error :messages="$errors->get('phone_one')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Phone 2 *</label>
                            <input class="form-control {{ $errors->has('phone_two') ? 'is-invalid' : '' }}"
                                type="text" value="{{ $candidate?->phone_two }}" name="phone_two">
                            <x-input-error :messages="$errors->get('phone_two')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Email *</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                value="{{ $candidate?->email }}" name="email">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save All Changes
            </button>
        </div>
    </form>

    <div class="mt-4">
        <form action="{{ route('candidate.profile.account-info.update') }}" method="POST">
            @csrf
            <h4>Change Account Email Address</h4>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10">Account Email *</label>
                    <input class="form-control {{ $errors->has('account_email') ? 'is-invalid' : '' }}" type="text"
                        value="{{ Auth::user()->email }}" name="account_email">
                    <x-input-error :messages="$errors->get('account_email')" class="mt-2" />
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save All Changes
                </button>
            </div>
        </form>
    </div>

    <div class="mt-4">
        <form action="{{ route('candidate.profile.account-password.update') }}" method="POST">
            @csrf
            <h4>Change Password</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">Password *</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                            value="" name="password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">Confirm Password *</label>
                        <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                            type="password" value="" name="password_confirmation">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save All Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

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
    </script>
@endpush
