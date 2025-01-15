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
                        <h4>Update Role and Permissions</h4>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.role.index') }}">
                            <- Back </a>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'name') }}"
                                    value="{{ old('name', $role->name) }}" name="name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            @foreach ($permissions as $groupName => $permission)
                                <div class="form-group">
                                    <h5 style="color: green">{{ $groupName }}</h5>
                                    <div class="row">
                                        @foreach ($permission as $item)
                                            <div class="col-md-2">
                                                <label class="custom-switch mt-2">
                                                    <input {{ in_array($item->name, $rolePermissions) ? 'checked' : '' }}
                                                        type="checkbox" value="{{ $item->name }}" name="permissions[]"
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
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
