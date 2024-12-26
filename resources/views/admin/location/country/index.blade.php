@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Country</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Countries</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.countries.index') }}" method="GET">
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
                        <a class="btn btn-primary ml-2" href="{{ route('admin.countries.create') }}">
                            <i class="fas fa-plus-circle"> Create New</i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                @foreach($countries as $country)
                                    <tr>
                                        <td>
                                            {{ $country->name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.countries.edit', $country->id) }}"
                                               class="btn btn-warning">Edit</a>
                                            <a href="{{ route('admin.countries.destroy', $country->id) }}"
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
                            @if($countries->hasPages())
                                {{ $countries->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

