@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Tags</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Tags</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.tags.index') }}" method="GET">
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
                        <a class="btn btn-primary ml-2" href="{{ route('admin.tags.create') }}">
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
                                    @forelse ($tags as $tag)
                                        <tr>
                                            <td>
                                                {{ $tag->name }}
                                            </td>
                                            <td>
                                                {{ $tag->slug }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.tags.edit', $tag->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ route('admin.tags.destroy', $tag->id) }}"
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
                            @if ($tags->hasPages())
                                {{ $tags->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
