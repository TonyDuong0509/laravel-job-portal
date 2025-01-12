@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Blog</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Blogs</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.blogs.index') }}" method="GET">
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
                        <a class="btn btn-primary ml-2" href="{{ route('admin.blogs.create') }}">
                            <i class="fas fa-plus-circle"> Create New</i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($blogs as $blog)
                                        <tr>
                                            <td>
                                                <img style="width: 100px; height: 100px; object-fit: contain"
                                                    src="{{ $blog->image }}" alt="{{ $blog->title }}">
                                            </td>
                                            <td>
                                                {{ $blog->title }}
                                            </td>
                                            <td>
                                                @if ($blog->status == 1)
                                                    <span class="badge bg-success text-light">Active</span>
                                                @else
                                                    <span class="badge bg-danger text-light">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($blog->featured == 1)
                                                    <span class="badge bg-success text-light">Yes</span>
                                                @else
                                                    <span class="badge bg-danger text-light">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="{{ route('admin.blogs.destroy', $blog->id) }}"
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
                            @if ($blogs->hasPages())
                                {{ $blogs->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
