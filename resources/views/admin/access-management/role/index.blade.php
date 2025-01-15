@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Roles and Permissions</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Roles</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.role.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search"
                                        value="{{ request('search') }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <a class="btn btn-primary ml-2" href="{{ route('admin.role.create') }}">
                            <i class="fas fa-plus-circle"> Create New</i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($roles as $role)
                                        <tr>
                                            <td>
                                                <b>{{ $role->name }}</b>
                                            </td>
                                            <td style="width: 70%">
                                                @foreach ($role->permissions as $permission)
                                                    <span
                                                        class="badge bg-primary text-light m-1">{{ $permission->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($role->name !== 'Super Admin')
                                                    <a href="{{ route('admin.role.edit', $role->id) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="{{ route('admin.role.destroy', $role->id) }}"
                                                        class="btn btn-danger delete-item">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No result found !</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
