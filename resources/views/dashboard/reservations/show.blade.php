@extends('template')
@section('main_section')

    @include('dashboard.includes.alerts')

    <div class="card shadow-lg" style="font-family: 'Poppins', sans-serif; border-radius: 15px;">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center py-3" style="
                        background: linear-gradient(45deg, #2c3e50, #3498db);
                        border-radius: 15px 15px 0 0;
                        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                     ">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                📅 Reservations
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('reservation.add') }}" class="btn btn-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-plus-lg me-1"></i> Add New
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($reservations->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    No reservations found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="bg-light-primary">
                            <tr>
                                <th class="py-3" style="border-bottom: 2px solid #3498db;">#ID</th>
                                <th class="py-3" style="border-bottom: 2px solid #3498db;">Customer Name</th>
                                <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Email</th>
                                <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Phone</th>
                                <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Date & Time</th>
                                <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Persons</th>
                                <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Status</th>
                                <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Status Decision</th>
                                <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr class="shadow-sm" style="border-bottom: 1px solid #dee2e6; transition: all 0.3s ease;">
                                    <td class="fw-bold">#{{ $reservation->id }}</td>
                                    <td>
                                        <span class="badge bg-primary rounded-pill px-3 py-2">
                                            {{ $reservation->name }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-dark rounded-pill px-3 py-2">
                                            {{ $reservation->email }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary rounded-pill px-3 py-2">
                                            {{ $reservation->phone }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                            {{ $reservation->date }} at {{ $reservation->time }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            {{ $reservation->persons }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge {{ $reservation->status == 'confirmed' ? 'bg-success' : ($reservation->status == 'declined' ? 'bg-danger' : 'bg-warning') }} rounded-pill px-3 py-2">
                                            {{ $reservation->status }}
                                        </span>
                                    </td>

                                    {{-- Accept/Decline buttons --}}
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <form action="{{ route('reservation.update-status', $reservation) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" name="status" value="confirmed"
                                                    class="btn btn-sm btn-success rounded-pill px-3" data-bs-toggle="tooltip"
                                                    title="Accept Reservation">
                                                    <i class="bi bi-check-circle"></i> Accept
                                                </button>
                                            </form>

                                            <form action="{{ route('reservation.update-status', $reservation) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" name="status" value="declined"
                                                    class="btn btn-sm btn-danger rounded-pill px-3" data-bs-toggle="tooltip"
                                                    title="Decline Reservation">
                                                    <i class="bi bi-x-circle"></i> Decline
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('reservation.edit', $reservation->id) }}"
                                                class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="tooltip"
                                                title="Edit Reservation">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('reservation.delete', $reservation->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3"
                                                    data-bs-toggle="tooltip" title="Delete Reservation"
                                                    onclick="return confirm('Are you sure? This action cannot be undone.');">
                                                    <i class="bi bi-trash3"></i>
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
        .bg-light-primary {
            background: linear-gradient(45deg, #f8f9fa, #e9ecef) !important;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1) !important;
            transform: translateX(4px);
        }

        .badge {
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .card {
            max-width: 1400px;
            margin: 2rem auto;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }

            .badge {
                font-size: 0.8rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>

    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function () {
            [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                .forEach(function (tooltipTriggerEl) {
                    new bootstrap.Tooltip(tooltipTriggerEl)
                })
        })
    </script>

@endsection