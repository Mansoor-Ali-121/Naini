@extends('template')

@section('main_section')
    @include('dashboard.includes.alerts')

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                👷 Registered Workers
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('workers.add') }}" class="btn btn-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-person-plus-fill me-1"></i> Add New Worker
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($workers->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> No workers found in the database.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light-header">
                            <tr>
                                <th class="py-3 ps-4">Worker</th>
                                <th class="py-3">Role & Field</th>
                                <th class="py-3">Contact</th>
                                <th class="py-3">Slug</th>
                                <th class="py-3 text-center">Status</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workers as $worker)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="image-container me-3">
                                                @if ($worker->picture)
                                                    <img src="{{ asset('Workers/workers_pictures/' . $worker->picture) }}"
                                                        alt="Profile" class="rounded-circle shadow-sm"
                                                        style="width: 45px; height: 45px; object-fit: cover; border: 2px solid #3498db;">
                                                @else
                                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white shadow-sm"
                                                        style="width: 45px; height: 45px; border: 2px solid #eee;">
                                                        <i class="bi bi-person"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $worker->name }}</div>
                                                <small class="text-muted">ID: #{{ $worker->id }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span
                                            class="badge bg-soft-primary text-primary rounded-pill px-3 py-2 mb-1 d-inline-block">
                                            {{ $worker->role }}
                                        </span>
                                        <br>
                                        <small class="text-muted"><i class="bi bi-briefcase me-1"></i>
                                            {{ $worker->field }}</small>
                                    </td>

                                    <td>
                                        <div class="small"><i class="bi bi-telephone me-1 text-primary"></i>
                                            {{ $worker->phone }}</div>
                                        <div class="small text-truncate" style="max-width: 150px;"
                                            title="{{ $worker->address }}">
                                            <i class="bi bi-geo-alt me-1 text-danger"></i>
                                            {{ Str::limit($worker->address, 20) }}
                                        </div>
                                    </td>

                                    <td>
                                        <code
                                            class="text-info fw-bold bg-light px-2 py-1 rounded">{{ $worker->actual_slug }}</code>
                                    </td>

                                    <td class="text-center">
                                        @if ($worker->status == 'active')
                                            <span class="badge bg-success rounded-pill px-3 py-2">
                                                <i class="bi bi-check-circle me-1"></i> Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-3 py-2">
                                                <i class="bi bi-x-circle me-1"></i> Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('workers.edit', $worker->id) }}"
                                                class="btn btn-sm btn-edit rounded-pill px-3" data-bs-toggle="tooltip"
                                                title="Edit Worker">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </a>
                                            <form action="{{ route('workers.delete', $worker->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-delete rounded-pill px-3"
                                                    data-bs-toggle="tooltip" title="Delete Worker"
                                                    onclick="return confirm('Delete this worker?')">
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
        /* Header styling */
        .bg-light-header {
            background-color: #f8faff !important;
            border-bottom: 2px solid #edf2f9;
        }

        /* Hover animation */
        .table-hover tbody tr {
            transition: all 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05) !important;
            transform: scale(1.005);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* Badge Soft Colors */
        .bg-soft-primary {
            background-color: rgba(52, 152, 219, 0.15);
        }

        /* Action Buttons Styling */
        .btn-edit,
        .btn-delete {
            background: #fff;
            border: 1px solid #eee;
            transition: all 0.2s;
        }

        .btn-edit:hover {
            background: #eef6ff;
            border-color: #3498db;
        }

        .btn-delete:hover {
            background: #fff5f5;
            border-color: #e74c3c;
        }

        .badge {
            font-weight: 500;
            letter-spacing: 0.3px;
        }
    </style>
@endsection
