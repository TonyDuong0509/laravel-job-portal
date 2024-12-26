@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Country</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit Country</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.countries.index') }}">
                            <- Back
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.countries.update', $country->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Country Name</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'name') }}"
                                       value="{{ $country->name }}"
                                       name="name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
