<div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
    <div class="card">
        <form action="{{ route('admin.razorpay-settings.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Razorpay Status</label>
                        <select name="razorpay_status"
                            class="form-control {{ \App\Helpers\hasError($errors, 'razorpay_status') }}">
                            <option @selected(config('gatewaySettings.razorpay_status') === 'active') value="active">Active</option>
                            <option @selected(config('gatewaySettings.razorpay_status') === 'inactive') value="inactive">Inactive</option>
                        </select>
                        <x-input-error :messages="$errors->get('razorpay_status')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Razorpay Country Name</label>
                        <select name="razorpay_country_name"
                            class="form-control select2 {{ \App\Helpers\hasError($errors, 'razorpay_country_name') }}">
                            <option>Select Country</option>
                            @foreach (config('countries') as $key => $country)
                                <option @selected($key === config('gatewaySettings.razorpay_country_name')) value="{{ $key }}">{{ $country }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('razorpay_country_name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Razorpay Currency Name</label>
                        <select name="razorpay_currency_name"
                            class="form-control select2 {{ \App\Helpers\hasError($errors, 'razorpay_currency_name') }}">
                            <option value="">Select Currency</option>
                            @foreach (config('currencies.currency_list') as $key => $currency)
                                <option @selected(config('gatewaySettings.razorpay_currency_name') === $currency) value="{{ $currency }}">{{ $currency }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('razorpay_currency_name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Razorpay Currency Rate</label>
                        <input type="text"
                            class="form-control {{ \App\Helpers\hasError($errors, 'razorpay_currency_rate') }}"
                            name="razorpay_currency_rate"
                            value="{{ config('gatewaySettings.razorpay_currency_rate') }}">
                        <x-input-error :messages="$errors->get('razorpay_currency_rate')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Razorpay Key</label>
                        <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'razorpay_key') }}"
                            name="razorpay_key" value="{{ config('gatewaySettings.razorpay_key') }}">
                        <x-input-error :messages="$errors->get('razorpay_key')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Razorpay Secret Key</label>
                        <input type="text"
                            class="form-control {{ \App\Helpers\hasError($errors, 'razorpay_secret_key') }}"
                            name="razorpay_secret_key" value="{{ config('gatewaySettings.razorpay_secret_key') }}">
                        <x-input-error :messages="$errors->get('razorpay_secret_key')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
</div>
