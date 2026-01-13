@extends('template')

@section('main_section')
    @include('dashboard.includes.alerts')

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                📂 Main Categories
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3" style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('category.add') }}" class="btn btn-light btn-sm rounded-pill px-3" style="border-width: 2px; color: #2c3e50;">
                    <i class="bi bi-plus-lg me-1"></i> Add New Category
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($cats->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> No categories found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light-header">
                            <tr>
                                <th class="py-3 ps-4" style="width: 80px;">#ID</th>
                                <th class="py-3">Category Name</th>
                                <th class="py-3">Slug</th>
                                <th class="py-3">Description</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cats as $cat)
                                <tr>
                                    <td class="ps-4">
                                        <span class="text-muted fw-bold">#{{ $cat->id }}</span>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="icon-box me-3 rounded-circle bg-soft-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="bi bi-folder2-open text-primary"></i>
                                            </div>
                                            <span class="fw-bold text-dark" style="font-size: 1.05rem;">{{ $cat->name }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <code class="bg-light text-primary px-3 py-1 rounded-pill border" style="font-size: 0.85rem;">
                                            {{ $cat->ActualSlug }}
                                        </code>
                                    </td>

                                    <td>
                                        <p class="mb-0 text-muted small" style="max-width: 250px; line-height: 1.4;">
                                            {{ Str::limit($cat->description, 60, '...') }}
                                        </p>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('category.edit', $cat->id) }}" 
                                               class="btn btn-sm btn-action rounded-pill px-3" 
                                               data-bs-toggle="tooltip" title="Edit Category">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </a>
                                            <form action="{{ route('category.delete', $cat->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-action rounded-pill px-3" 
                                                        onclick="return confirm('Delete this category?')"
                                                        data-bs-toggle="tooltip" title="Delete Category">
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

        .bg-soft-primary {
            background-color: rgba(52, 152, 219, 0.1);
        }

        .table-hover tbody tr {
            transition: all 0.3s ease;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.04) !important;
            transform: scale(1.01);
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

        code {
            letter-spacing: 0.5px;
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