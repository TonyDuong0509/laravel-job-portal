@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Roles and Permissions</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Create Role and Permissions</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.role.index') }}">
                            <- Back </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.role.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'name') }}"
                                    value="{{ old('name') }}" name="name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <hr>
                            <label class="custom-switch mt-2 mb-4">
                                <input type="checkbox" class="custom-switch-input checkAll">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description text-primary"
                                    style="font-size: 24px; font-weight: bold;">Choose
                                    All Permissions</span>
                            </label>
                            @foreach ($permissions as $groupName => $permission)
                                <div class="form-group">
                                    <h5 style="color: green">{{ $groupName }}</h5>
                                    <div class="row">
                                        @foreach ($permission as $item)
                                            <div class="col-md-2">
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" value="{{ $item->name }}" name="permissions[]"
                                                        class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">{{ $item->name }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.checkAll').on('click', function() {
                let isChecked = $(this).is(':checked');
                $('input[name="permissions[]"]').prop('checked', isChecked);
            });
        });
    </script>
@endpush
