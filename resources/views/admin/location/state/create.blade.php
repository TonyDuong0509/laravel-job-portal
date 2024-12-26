@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>State</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Create State</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.states.index') }}">
                            <- Back
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.states.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Country</label>
                                        <select name="country"
                                                class="form-control select2 {{ \App\Helpers\hasError($errors, 'country') }}">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">State Name</label>
                                        <input type="text"
                                               class="form-control {{ \App\Helpers\hasError($errors, 'name') }}"
                                               value="{{ old('name') }}"
                                               name="name">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
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
