@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Country Type</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Create Country</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.countries.index') }}">
                            <- Back
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.countries.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Country Name</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'name') }}"
                                       value="{{ old('name') }}"
                                       name="name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
