@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Blog</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Edit Blog</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.blogs.index') }}">
                            <- Back </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <x-image-preview :height="200" :width="300" :source="$blog->image" />
                                <label for="">Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control {{ \App\Helpers\hasError($errors, 'image') }}"
                                    name="image">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'title') }}"
                                    value="{{ old('title', $blog->title) }}" name="title">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Description <span class="text-danger">*</span></label>
                                <textarea class="{{ \App\Helpers\hasError($errors, 'description') }}" name="description" id="editor">{!! $blog->description !!}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Status <span class="text-danger">*</span></label>
                                        <select name="status"
                                            class="form-control {{ \App\Helpers\hasError($errors, 'status') }}">
                                            <option @selected($blog->status == 0) value="0">Inactive</option>
                                            <option @selected($blog->status == 1) value="1">Active</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Featured <span class="text-danger">*</span></label>
                                        <select name="featured"
                                            class="form-control {{ \App\Helpers\hasError($errors, 'featured') }}">
                                            <option @selected($blog->featured == 0) value="0">No</option>
                                            <option @selected($blog->featured == 0) value="1">Yes</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('featured')" class="mt-2" />
                                    </div>
                                </div>
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
