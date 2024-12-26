@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Industry Type</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Industry Types</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.industry-types.index') }}" method="GET">
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
                        <a class="btn btn-primary ml-2" href="{{ route('admin.industry-types.create') }}">
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
                                @foreach($industryTypes as $type)
                                    <tr>
                                        <td>
                                            {{ $type->name }}
                                        </td>
                                        <td>
                                            {{ $type->slug }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.industry-types.edit', $type->id) }}"
                                               class="btn btn-warning">Edit</a>
                                            <a href="{{ route('admin.industry-types.destroy', $type->id) }}"
                                               class="btn btn-danger delete-item">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            @if($industryTypes->hasPages())
                                {{ $industryTypes->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
