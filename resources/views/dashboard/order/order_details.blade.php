@extends('template')

@section('main_section')
    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.5rem;">
                📋 Order #{{ $order->id }} Details
            </h4>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Back to Orders
            </a>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded-4">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="bi bi-person-circle text-primary me-2"></i> {{ $order->user->name ?? 'Guest User' }}
                </h5>
                <span
                    class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }} rounded-pill px-3 py-2">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light-header">
                        <tr>
                            <th class="py-3 ps-4">Dish Name</th>
                            <th class="py-3">Quantity</th>
                            <th class="py-3">Price</th>
                            <th class="py-3 text-end pe-4">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="ps-4 fw-bold text-dark">{{ $item->menu->name ?? 'Unknown Dish' }}</td>
                                <td><span
                                        class="badge bg-soft-primary text-primary rounded-pill px-3">{{ $item->quantity }}</span>
                                </td>
                                <td class="text-muted">{{ $order->currency }} {{ number_format($item->price, 2) }}</td>
                                <td class="text-end pe-4 fw-bold">{{ $order->currency }}
                                    {{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="border-top">
                        <tr>
                            <th colspan="3" class="text-end py-3">Total Amount:</th>
                            <th class="text-primary fs-4 text-end pe-4">{{ $order->currency }}
                                {{ number_format($order->total_amount, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <style>
        .bg-light-header {
            background-color: #f8faff !important;
            border-bottom: 2px solid #edf2f9;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05) !important;
        }

        .bg-soft-primary {
            background-color: rgba(52, 152, 219, 0.15);
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }
    </style>
@endsection
