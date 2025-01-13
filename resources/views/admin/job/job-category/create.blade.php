@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Category</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Create Job Category</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.job-categories.index') }}">
                            <- Back </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.job-categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Icon</label>
                                <div role="iconpicker" data-align="left" name="icon"
                                    class="{{ \App\Helpers\hasError($errors, 'icon') }}"></div>
                                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'name') }}"
                                    value="{{ old('name') }}" name="name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Show At Popular</label>
                                <select name="show_at_popular"
                                    class="form-control {{ \App\Helpers\hasError($errors, 'show_at_popular') }}">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                <x-input-error :messages="$errors->get('show_at_popular')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Show At Featured</label>
                                <select name="show_at_featured"
                                    class="form-control {{ \App\Helpers\hasError($errors, 'show_at_featured') }}">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                <x-input-error :messages="$errors->get('show_at_featured')" class="mt-2" />
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
