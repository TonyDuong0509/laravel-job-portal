@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Educations</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Educations</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.educations.index') }}" method="GET">
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
                        <a class="btn btn-primary ml-2" href="{{ route('admin.educations.create') }}">
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
                                    @forelse ($educations as $education)
                                        <tr>
                                            <td>
                                                {{ $education->name }}
                                            </td>
                                            <td>
                                                {{ $education->slug }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.educations.edit', $education->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ route('admin.educations.destroy', $education->id) }}"
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
                            @if ($educations->hasPages())
                                {{ $educations->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
