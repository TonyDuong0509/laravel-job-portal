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
                        <h4>Edit Job Category</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.job-categories.index') }}">
                            <- Back </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.job-categories.update', $jobCategory->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Icon</label>
                                <div role="iconpicker" data-align="left" data-icon="{{ $jobCategory->icon }}" name="icon"
                                    class="{{ \App\Helpers\hasError($errors, 'icon') }}"></div>
                                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'name') }}"
                                    value="{{ $jobCategory->name }}" name="name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Show At Popular</label>
                                <select name="show_at_popular"
                                    class="form-control {{ \App\Helpers\hasError($errors, 'show_at_popular') }}">
                                    <option @selected($jobCategory->show_at_popular === 0) value="0">No</option>
                                    <option @selected($jobCategory->show_at_popular === 1) value="1">Yes</option>
                                </select>
                                <x-input-error :messages="$errors->get('show_at_popular')" class="mt-2" />
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
