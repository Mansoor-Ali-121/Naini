@extends('template')
@section('main_section')

    @include('dashboard.includes.alerts')

    <div class="card shadow-lg" style="font-family: 'Dancing Script', cursive; border-radius: 15px;">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="
            background: linear-gradient(45deg, #2c3e50, #3498db);
            border-radius: 15px 15px 0 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
         ">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                📋 Categories
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('category.add') }}" class="btn btn-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-plus-lg me-1"></i> Add New
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($cats->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    No categories found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="bg-light-primary">
                            <tr>
                                <th class="py-3">#ID</th>
                                <th class="py-3">Category Name</th>
                                <th class="py-3">Final Slug</th>
                                <th class="py-3 text-center">Description</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cats as $cat)
                                <tr>
                                    <td class="fw-bold">#{{ $cat->id }}</td>
                                    <td>
                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            {{ $cat->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            {{ $cat->ActualSlug }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            {{ $cat->description }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('category.edit', $cat->id) }}"
                                                class="btn btn-sm btn-primary rounded-pill px-3" data-bs-toggle="tooltip"
                                                title="Edit Category">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('category.delete', $cat->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3"
                                                    data-bs-toggle="tooltip" title="Delete Category"
                                                    onclick="return confirm('Are you sure?')">
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
            transition: all 0.3s ease;
        }

        .badge {
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    <script>
        // Initialize Bootstrap tooltips
        document.addEventListener('DOMContentLoaded', function() {
            [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                .forEach(function(tooltipTriggerEl) {
                    new bootstrap.Tooltip(tooltipTriggerEl)
                })
        })
    </script>

@endsection
