@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Salary Types</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Salary Types</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.salary-types.index') }}" method="GET">
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
                        <a class="btn btn-primary ml-2" href="{{ route('admin.salary-types.create') }}">
                            <i class="fas fa-plus-circle"> Create New</i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Sug</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($salaryTypes as $salaryType)
                                        <tr>
                                            <td>
                                                {{ $salaryType->name }}
                                            </td>
                                            <td>
                                                {{ $salaryType->slug }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.salary-types.edit', $salaryType->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ route('admin.salary-types.destroy', $salaryType->id) }}"
                                                    class="btn btn-danger delete-item">Delete</a>
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
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            @if ($salaryTypes->hasPages())
                                {{ $salaryTypes->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
