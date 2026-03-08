@extends('template')

@section('main_section')
    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                📋 Customer Orders
            </h4>
            <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                style="border-width: 2px;">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card-body p-4">
            @if ($orders->isEmpty())
                <div class="alert alert-warning rounded-pill">No orders found.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light-header">
                            <tr>
                                <th class="py-3 ps-4">Order ID</th>
                                <th class="py-3">Total Amount</th>
                                <th class="py-3 text-center">Date</th>
                                <th class="py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">#{{ $order->id }}</td>
                                    <td>
                                        <span class="badge bg-soft-primary text-primary rounded-pill px-3 py-2">
                                            {{ $order->currency ?? 'PKR' }} {{ number_format($order->total_amount, 2) }}
                                        </span>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $order->created_at->format('d M, Y') }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('orders.details', $order->id) }}"
                                            class="btn btn-sm btn-edit rounded-pill px-3">
                                            <i class="bi bi-eye text-primary me-1"></i> View Details
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-center">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .bg-light-header {
            background-color: #f8faff !important;
            border-bottom: 2px solid #edf2f9;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05) !important;
            transform: scale(1.002);
        }

        .bg-soft-primary {
            background-color: rgba(52, 152, 219, 0.15);
        }

        .btn-edit {
            background: #fff;
            border: 1px solid #eee;
            transition: all 0.2s;
        }

        .btn-edit:hover {
            background: #eef6ff;
            border-color: #3498db;
        }

        .pagination .page-link {
            border-radius: 50%;
            margin: 0 5px;
            border: none;
        }

        .pagination .page-item.active .page-link {
            background-color: #3498db;
        }
    </style>
@endsection
