@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Newsletter</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Send Newsletter</h4>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('admin.newsletter-send-mail') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Subject</label>
                                <input type="text" class="form-control {{ \App\Helpers\hasError($errors, 'subject') }}"
                                    value="{{ old('subject') }}" name="subject">
                                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="">Message</label>
                                <textarea name="message" id="editor" class="{{ \App\Helpers\hasError($errors, 'message') }}"></textarea>
                                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>All Newsletter</h4>
                        <div class="card-header-form">
                            <form action="{{ route('admin.newsletter.index') }}" method="GET">
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
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($subscribers as $subscribe)
                                        <tr>
                                            <td>
                                                {{ $subscribe->email }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.newsletter.destroy', $subscribe->id) }}"
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
                            @if ($subscribers->hasPages())
                                {{ $subscribers->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
