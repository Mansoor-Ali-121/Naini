@extends('template')

@section('main_section')
    @include('dashboard.includes.alerts')

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                📅 Reservation Desk
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('reservation.add') }}" class="btn btn-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-plus-lg me-1"></i> Add New Booking
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($reservations->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> No reservations found in the system.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light-header">
                            <tr>
                                <th class="py-3 ps-4">Customer Info</th>
                                <th class="py-3 text-center">Schedule</th>
                                <th class="py-3 text-center">Guests</th>
                                <th class="py-3 text-center">Status</th>
                                <th class="py-3 text-center">Decision</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $reservation->name }}</div>
                                        <div class="small text-muted">
                                            <i class="bi bi-envelope me-1"></i>{{ $reservation->email }} <br>
                                            <i class="bi bi-telephone me-1"></i>{{ $reservation->phone }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-soft-primary text-primary rounded-pill px-3 py-2">
                                            {{ date('d M, Y', strtotime($reservation->date)) }}
                                        </span>
                                        <div class="small text-muted mt-1 fw-bold">
                                            <i class="bi bi-clock me-1"></i>{{ $reservation->time }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="fw-bold fs-5 text-dark">
                                            {{ $reservation->persons }}
                                        </div>
                                        <small class="text-muted text-uppercase" style="font-size: 0.65rem;">Persons</small>
                                    </td>

                                    <td class="text-center">
                                        @php
                                            $statusClass = $reservation->status == 'confirmed' ? 'bg-success' : ($reservation->status == 'declined' ? 'bg-danger' : 'bg-warning');
                                        @endphp
                                        <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 text-uppercase" style="font-size: 0.75rem;">
                                            {{ $reservation->status }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <form action="{{ route('reservation.update-status', $reservation) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" name="status" value="confirmed" 
                                                    class="btn btn-sm btn-edit rounded-pill px-3" data-bs-toggle="tooltip" title="Confirm">
                                                    <i class="bi bi-check-circle text-success"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('reservation.update-status', $reservation) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" name="status" value="declined" 
                                                    class="btn btn-sm btn-delete rounded-pill px-3" data-bs-toggle="tooltip" title="Decline">
                                                    <i class="bi bi-x-circle text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('reservation.edit', $reservation->id) }}"
                                                class="btn btn-sm btn-edit rounded-pill px-3" data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </a>
                                            <form action="{{ route('reservation.delete', $reservation->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-delete rounded-pill px-3" 
                                                    onclick="return confirm('Delete this reservation?')" data-bs-toggle="tooltip" title="Delete">
                                                    <i class="bi bi-trash3 text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <style>
        .bg-light-header {
            background-color: #f8faff !important;
            border-bottom: 2px solid #edf2f9;
        }

        .table-hover tbody tr {
            transition: all 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05) !important;
            transform: scale(1.005);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .bg-soft-primary {
            background-color: rgba(52, 152, 219, 0.15);
        }

        .btn-edit, .btn-delete {
            background: #fff;
            border: 1px solid #eee;
            transition: all 0.2s;
        }

        .btn-edit:hover { background: #eef6ff; border-color: #3498db; }
        .btn-delete:hover { background: #fff5f5; border-color: #e74c3c; }

        .badge { font-weight: 500; letter-spacing: 0.3px; }
    </style>
@endsection