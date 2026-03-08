@extends('template')

@section('main_section')
    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header py-3" style="background: linear-gradient(45deg, #2c3e50, #3498db);">
            <h4 class="mb-0 text-white">📋 Customer Orders</h4>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>Order ID</th>
                            {{-- <th>Customer</th> --}}
                            <th>Total Amount</th>
                            {{-- <th>Status</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{$order->currency}} {{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                <a href="{{ route('orders.details', $order->id) }}" class="btn btn-primary">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
