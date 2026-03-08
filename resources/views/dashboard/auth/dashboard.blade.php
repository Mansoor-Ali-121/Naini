@extends('template')

@section('main_section')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container-fluid p-4" style="background: #f4f7f6; min-height: 100vh;">

        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h3 class="fw-bold" style="color: #2c3e50; letter-spacing: -1px;">Naini Dashboard</h3>
                <p class="text-muted mb-0">Analytics & Management Overview</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="bg-white d-inline-block p-2 px-3 rounded-3 shadow-sm border">
                    <i class="bi bi-clock-history me-2 text-danger"></i>
                    <span class="fw-bold">{{ date('l, d M Y') }}</span>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card revenue shadow-sm border-0">
                    <div class="card-body p-4 position-relative" style="z-index: 2;">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-uppercase small fw-bold mb-1 card-label">Total Revenue</p>
                                <h3 class="mb-0 fw-bold card-value">PKR {{ number_format($totalRevenue, 0) }}</h3>
                            </div>
                            <div class="icon-circle bg-danger-subtle text-danger"><i class="bi bi-currency-dollar fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card orders shadow-sm border-0">
                    <div class="card-body p-4 position-relative" style="z-index: 2;">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-uppercase small fw-bold mb-1 card-label">Total Orders</p>
                                <h3 class="mb-0 fw-bold card-value">{{ $totalOrders }} Orders</h3>
                            </div>
                            <div class="icon-circle bg-success-subtle text-success"><i class="bi bi-bag-check fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card menu shadow-sm border-0">
                    <div class="card-body p-4 position-relative" style="z-index: 2;">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-uppercase small fw-bold mb-1 card-label">Menu Items</p>
                                <h4 class="mb-0 fw-bold card-value">{{ $menuItems }} Dishes</h4>
                            </div>
                            <div class="icon-circle bg-warning-subtle text-warning"><i class="bi bi-egg-fried fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card customers shadow-sm border-0">
                    <div class="card-body p-4 position-relative" style="z-index: 2;">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-uppercase small fw-bold mb-1 card-label">New Customers</p>
                                <h4 class="mb-0 fw-bold card-value">{{ $newCustomers }} Users</h4>
                            </div>
                            <div class="icon-circle bg-primary-subtle text-primary"><i class="bi bi-people fs-4"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold mb-0">Sales Analytics</h5>
                        <p class="text-muted small">Revenue growth for the last 7 days</p>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <canvas id="salesChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Order section start from here --}}
            <div class="col-xl-7">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-receipt me-2 text-danger"></i>Recent Food Orders
                        </h6>
                        <a href="{{ url('/orders') }}" class="btn btn-sm btn-outline-secondary">View Table</a>
                    </div>
                    <div class="table-responsive px-3">
                        <table class="table table-borderless align-middle">
                            <thead>
                                <tr class="text-muted small text-uppercase">
                                    <th class="py-3">Order</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $order)
                                    <tr>
                                        <td class="py-3 fw-bold">#{{ $order->id }}</td>
                                        <td class="fw-bold text-dark">PKR {{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span
                                                class="badge bg-success-subtle text-success border-0 px-3 py-2">Completed</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Reservation section start from here --}}
            <div class="col-xl-5">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-calendar-check me-2 text-primary"></i>Latest
                            Table Reservations</h6>
                        <a href="{{ url('/reservations') }}" class="btn btn-sm btn-outline-secondary">View Table</a>
                    </div>
                    <div class="px-3 pb-3">
                        @foreach ($reservations as $res)
                            @php
                                $status = strtolower($res->status);
                                $class =
                                    $status == 'confirmed'
                                        ? 'style-green'
                                        : ($status == 'declined'
                                            ? 'style-red'
                                            : 'style-yellow');
                            @endphp

                            <div
                                class="reservation-card-sync {{ $class }} d-flex align-items-center p-3 mb-2 rounded-3 shadow-sm">
                                <div class="flex-grow-1 position-relative" style="z-index: 2;">
                                    <h6 class="mb-0 fw-bold small name-text">{{ $res->name }}</h6>
                                    <span class="text-muted extra-small info-text">
                                        {{ $res->persons }} Guests |
                                        {{ \Carbon\Carbon::parse($res->time)->format('h:i A') }}
                                    </span>
                                </div>
                                <div style="z-index: 2;">
                                    <span class="badge rounded-pill custom-badge">
                                        {{ ucfirst($res->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .stat-card {
            position: relative;
            overflow: hidden;
            transition: 0.4s ease;
            cursor: pointer;
        }

        .stat-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            transition: 0.5s cubic-bezier(.17, .67, .83, .67);
            z-index: 1;
        }

        .stat-card:hover::before {
            width: 100%;
        }

        .revenue::before {
            background: #ce1212;
        }

        .orders::before {
            background: #2ecc71;
        }

        .menu::before {
            background: #f1c40f;
        }

        .customers::before {
            background: #3498db;
        }

        .stat-card:hover .card-label,
        .stat-card:hover .card-value,
        .stat-card:hover .bi {
            color: #fff !important;
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            transition: 0.3s;
        }

        .stat-card:hover .icon-circle {
            background: rgba(255, 255, 255, 0.2) !important;
        }

        .extra-small {
            font-size: 0.75rem;
        }

        /* reservation styling  */

        .reservation-card-sync {
            position: relative;
            overflow: hidden;
            background: #ffffff;
            border-left: 5px solid;
            transition: all 0.4s ease;
            z-index: 1;
        }

        .reservation-card-sync::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            transition: all 0.5s ease;
            z-index: -1;
        }

        .reservation-card-sync:hover::before {
            left: 0;
        }

        .reservation-card-sync:hover .name-text,
        .reservation-card-sync:hover .info-text {
            color: #fff !important;
        }

        /* Status Based Styles */

        /* Green (Confirmed) */
        .style-green {
            border-left-color: #28a745;
        }

        .style-green::before {
            background: linear-gradient(90deg, #28a745, #38ef7d);
        }

        .style-green .custom-badge {
            background: #28a745;
            color: #fff;
        }

        /* Red (Declined) */
        .style-red {
            border-left-color: #dc3545;
        }

        .style-red::before {
            background: linear-gradient(90deg, #dc3545, #ff7e5f);
        }

        .style-red .custom-badge {
            background: #dc3545;
            color: #fff;
        }

        /* Yellow (Pending) - Updated for better visibility */
        .style-yellow {
            border-left-color: #ffc107;
        }

        .style-yellow::before {
            background: linear-gradient(90deg, #ffc107, #f6d365);
        }

        /* Badge ka text dark kar diya taake saaf dikhe */
        .style-yellow .custom-badge {
            background: #ffc107;
            color: #212529 !important;
            /* Dark text for yellow background */
        }

        /* Jab hover ho, tab bhi text dark rakhein ya white ka contrast check karein */
        .reservation-card-sync.style-yellow:hover .name-text,
        .reservation-card-sync.style-yellow:hover .info-text {
            color: #212529 !important;
            /* Yellow background par dark text zyada readable hai */
        }
    </style>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData->pluck('date')) !!},
                datasets: [{
                    label: 'Revenue (PKR)',
                    data: {!! json_encode($chartData->pluck('total')) !!},
                    borderColor: '#ce1212',
                    backgroundColor: 'rgba(206, 18, 18, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection
