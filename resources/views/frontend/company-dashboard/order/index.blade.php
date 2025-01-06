@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Orders</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Orders</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">

                @include('frontend.company-dashboard.sidebar')

                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Orders</h4>
                            {{-- <div class="card-header-form">
                                <form action="{{ route('admin.orders.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="search"
                                            value="{{ request('search') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Order</th>
                                        <th>Plan</th>
                                        <th>Paid Amount</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>
                                                    #{{ $order->order_id }}
                                                </td>

                                                <td>
                                                    {{ $order->package_name }}
                                                </td>

                                                <td>
                                                    {{ $order->amount }} {{ $order->paid_in_currency }}
                                                </td>

                                                <td>
                                                    {{ $order->payment_provider }}
                                                </td>

                                                <td>
                                                    <p class="badge bg-primary text-light">
                                                        {{ $order->payment_status }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('company.orders.show', $order->id) }}"
                                                        class="btn-sm btn btn-primary">View Details</a>
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
                                @if ($orders->hasPages())
                                    {{ $orders->withQueryString()->links() }}
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
