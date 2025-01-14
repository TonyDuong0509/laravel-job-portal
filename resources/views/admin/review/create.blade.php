@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Review Section</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                {{-- <x-image-preview :height="200" :width="300" :source="$hero?->image" /> --}}
                                <label for="">Image</label>
                                <input type="file" class="form-control {{ \App\Helpers\hasError($errors, 'image') }}"
                                    name="image">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'name') }}"
                                    value="{{ old('name') }}" name="name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'title') }}"
                                    value="{{ old('title') }}" name="title">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Review</label>
                                <textarea class="{{ \App\Helpers\hasError($errors, 'review') }} form-control" name="review"></textarea>
                                <x-input-error :messages="$errors->get('review')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Rating</label>
                                <select name="rating" class="form-control {{ \App\Helpers\hasError($errors, 'rating') }}">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <x-input-error :messages="$errors->get('rating')" class="mt-2" />
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
