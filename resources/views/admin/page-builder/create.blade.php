@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Page Builder</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Create Page</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.page-builder.index') }}">
                            <- Back </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.page-builder.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Page Name</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'page_name') }}"
                                    value="{{ old('page_name') }}" name="page_name">
                                <x-input-error :messages="$errors->get('page_name')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Page Name</label>
                                <textarea name="content" id="editor" class="{{ \App\Helpers\hasError($errors, 'content') }}"></textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
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
