@extends('template')

@section('main_section')
    <div class="container-fluid p-0">
        {{-- Design consistency ke liye wahi card-header style --}}
        <div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-header py-3" style="background: linear-gradient(45deg, #2c3e50, #3498db);">
                <h4 class="mb-0 text-white">📋 Order #{{ $order->id }} Details</h4>
            </div>

            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="text-primary fw-bold">Customer: {{ $order->user->name ?? 'Guest User' }}</h5>
                    <div>
                        <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }} fs-6">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>Dish Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <h3>Order #{{ $order->id }} Details</h3>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->menu->name ?? 'Unknown' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                        @endforeach
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">Total Amount:</th>
                                <th class="text-primary fs-5">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="bi bi-arrow-left"></i> Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
