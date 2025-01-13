@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Learn More</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.learn-more.update', 1) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <x-image-preview :height="200" :width="300" :source="$learn?->image" />
                                <label for="">Image</label>
                                <input type="file" name="image"
                                    class="form-control {{ \App\Helpers\hasError($errors, 'image') }}" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'title') }}"
                                    value="{{ old('title', $learn?->title) }}" name="title">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Main Title</label>
                                <input type="text"
                                    class="form-control {{ \App\Helpers\hasError($errors, 'main_title') }}"
                                    value="{{ old('main_title', $learn?->main_title) }}" name="main_title">
                                <x-input-error :messages="$errors->get('main_title')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Sub Title</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'sub_title') }}"
                                    value="{{ old('sub_title', $learn?->sub_title) }}" name="sub_title">
                                <x-input-error :messages="$errors->get('sub_title')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Learn More URL</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'url') }}"
                                    value="{{ old('url', $learn?->url) }}" name="url">
                                <x-input-error :messages="$errors->get('url')" class="mt-2" />
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
