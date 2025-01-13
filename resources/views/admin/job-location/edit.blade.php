@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Location</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Job Location</h4>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.job-location.update', $jobLocation?->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <x-image-preview :height="200" :width="300" :source="$jobLocation?->image" />
                                <label for="">Image</label>
                                <input type="file" class="form-control {{ \App\Helpers\hasError($errors, 'image') }}"
                                    name="image">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Country</label>
                                <select
                                    name="country"class="form-control select2 {{ \App\Helpers\hasError($errors, 'country') }}">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option @selected($country->id === $jobLocation?->country_id) value="{{ $country->id }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status"class="form-control {{ \App\Helpers\hasError($errors, 'status') }}">
                                    <option value="">Select Status</option>
                                    <option @selected($jobLocation?->status === 'featured') value="featured">Featured</option>
                                    <option @selected($jobLocation?->status === 'trending') value="trending">Trending</option>
                                    <option @selected($jobLocation?->status === 'hot') value="hot">HOT</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
