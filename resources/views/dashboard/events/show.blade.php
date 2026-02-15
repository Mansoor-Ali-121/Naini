@extends('template')
@section('main_section')

    @include('dashboard.includes.alerts')

    <div class="card shadow-lg border-0" style="font-family: 'Dancing Script', cursive; border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                🎉 Master Events
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('events.add') }}" class="btn btn-light btn-sm rounded-pill px-3"
                    style="border-width: 2px; color: #2c3e50;">
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
                            <tr style="font-family: sans-serif;">
                                <th class="py-3 ps-4">#ID</th>
                                <th class="py-3">Preview</th>
                                <th class="py-3">Event Name</th>
                                <th class="py-3" style="min-width: 250px;">Description</th>
                                <th class="py-3">Schedule & Venue</th>
                                <th class="py-3">Host / Org.</th>
                                <th class="py-3 text-center">Price</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 1.1rem;">
                            @foreach ($events as $event)
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge bg-dark rounded-pill">#{{ $event->id }}</span>
                                    </td>

                                    <td>
                                        <div class="event-img-container">
                                            <img src="{{ asset('Events/events_pictures/' . $event->image) }}"
                                                class="rounded-circle shadow-sm border border-2 border-white"
                                                style="width: 55px; height: 55px; object-fit: cover;"
                                                onerror="this.src='{{ asset('default-event.png') }}'">
                                        </div>
                                    </td>

                                    <td>
                                        <div class="fw-bold text-dark">{{ $event->name }}</div>
                                        <small class="text-muted d-block"
                                            style="font-family: sans-serif; font-size: 0.7rem;">
                                            {{ $event->slug ?? 'N/A' }}
                                        </small>
                                        <span class="badge bg-info-soft text-info mt-1"
                                            style="font-family: sans-serif; font-size: 0.7rem;">
                                            {{ $event->category ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="description-box text-muted"
                                            style="font-family: sans-serif; font-size: 0.85rem; max-width: 300px;">
                                            {{ $event->description ?? 'N/A' }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="small" style="font-family: sans-serif;">
                                            <div class="text-nowrap"><i class="bi bi-calendar-event text-primary me-1"></i>
                                                {{ $event->date ?? 'N/A' }}</div>
                                            <div class="text-muted mt-1"><i class="bi bi-geo-alt text-danger me-1"></i>
                                                {{ $event->location ?? 'N/A' }}</div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="small" style="font-family: sans-serif;">
                                            <div><strong>H:</strong> {{ $event->host_name ?? 'N/A' }}</div>
                                            <div class="text-muted"><strong>O:</strong> {{ $event->organizer ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <span
                                            class="badge bg-soft-success text-success rounded-pill px-3 py-2 border border-success"
                                            style="font-family: sans-serif;">
                                            ${{ number_format((float) str_replace('$', '', $event->price), 2) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('events.edit', $event->id) }}"
                                                class="btn btn-sm btn-action rounded-pill px-3" data-bs-toggle="tooltip"
                                                title="Edit Event">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </a>
                                            <form action="{{ route('events.delete', $event->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-action rounded-pill px-3"
                                                    onclick="return confirm('Are you sure?')" data-bs-toggle="tooltip"
                                                    title="Delete Event">
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

        .bg-info-soft {
            background-color: rgba(13, 202, 240, 0.15);
        }

        /* Description Control */
        .description-box {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* 3 lines ke baad dots aayenge */
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.04) !important;
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

        .text-nowrap {
            white-space: nowrap;
        }
    </style>
@endsection
