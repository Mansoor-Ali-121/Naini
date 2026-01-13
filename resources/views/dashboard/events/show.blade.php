@extends('template')
@section('main_section')

    @include('dashboard.includes.alerts')

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                🎉 Master Events
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3" style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('events.add') }}" class="btn btn-light btn-sm rounded-pill px-3" style="border-width: 2px; color: #2c3e50;">
                    <i class="bi bi-plus-lg me-1"></i> Add New Event
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($events->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> No events found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light-header">
                            <tr>
                                <th class="py-3 ps-4" style="width: 80px;">#ID</th>
                                <th class="py-3 text-center">Preview</th>
                                <th class="py-3">Event Name</th>
                                <th class="py-3">Description</th>
                                <th class="py-3 text-center">Entry Price</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td class="ps-4">
                                        <span class="text-muted fw-bold">#{{ $event->id }}</span>
                                    </td>

                                    <td class="text-center">
                                        <div class="event-img-container">
                                            <img src="{{ asset('Events/events_pictures/' . $event->image) }}"
                                                 class="rounded-circle shadow-sm border border-2 border-white"
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 onerror="this.src='{{ asset('default-event.png') }}'">
                                        </div>
                                    </td>

                                    <td>
                                        <span class="fw-bold text-dark" style="font-size: 1.1rem;">{{ $event->name }}</span>
                                    </td>

                                    <td>
                                        <p class="mb-0 text-muted" style="font-size: 0.9rem; max-width: 300px; line-height: 1.4;">
                                            {{ Str::limit($event->description, 80) }}
                                        </p>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-soft-success text-success rounded-pill px-3 py-2 border border-success">
                                            <i class="bi bi-currency-dollar me-1"></i>{{ number_format((float) str_replace('$', '', $event->price), 2) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('events.edit', $event->id) }}" 
                                               class="btn btn-sm btn-action rounded-pill px-3" 
                                               data-bs-toggle="tooltip" title="Edit Event">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </a>
                                            <form action="{{ route('events.delete', $event->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-action rounded-pill px-3" 
                                                        onclick="return confirm('Are you sure?')"
                                                        data-bs-toggle="tooltip" title="Delete Event">
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

        .bg-soft-success { 
            background-color: rgba(40, 167, 69, 0.1); 
        }

        .table-hover tbody tr {
            transition: all 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.04) !important;
            transform: scale(1.005);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .btn-action {
            background: #fff;
            border: 1px solid #eee;
            transition: all 0.2s;
        }

        .btn-action:hover {
            border-color: #3498db;
            background: #f0f7ff;
        }

        .event-img-container img {
            transition: transform 0.3s ease;
        }

        tr:hover .event-img-container img {
            transform: scale(1.1) rotate(3deg);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>

@endsection