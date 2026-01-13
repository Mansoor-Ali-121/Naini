@extends('template')

@section('main_section')
    @include('dashboard.includes.alerts')

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                📋 Sub-Categories List
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3" style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('subcategory.add') }}" class="btn btn-light btn-sm rounded-pill px-3" style="border-width: 2px; color: #2c3e50;">
                    <i class="bi bi-plus-lg me-1"></i> Add New Subcategory
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($subcats->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> No subcategories found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light-header">
                            <tr>
                                <th class="py-3 ps-4" style="width: 100px;">#ID</th>
                                <th class="py-3">Subcategory Name</th>
                                <th class="py-3">Main Category</th>
                                <th class="py-3">Final Slug</th>
                                <th class="py-3 text-center">Status</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcats as $subcat)
                                <tr>
                                    <td class="ps-4 fw-bold text-muted">#{{ $subcat->id }}</td>
                                    
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 1.1rem;">
                                            {{ $subcat->name }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge bg-soft-secondary text-secondary rounded-pill px-3 py-2">
                                            <i class="bi bi-tag-fill me-1"></i> {{ $subcat->category->name ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <td>
                                        <code class="text-primary fw-bold bg-light px-2 py-1 rounded border">
                                            {{ $subcat->Actual_Slug }}
                                        </code>
                                    </td>

                                    <td class="text-center">
                                        @if($subcat->status == 'active')
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
                                            <a href="{{ route('subcategory.edit', $subcat->id) }}" 
                                               class="btn btn-sm btn-action rounded-pill px-3" 
                                               data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </a>
                                            <form action="{{ route('subcategory.delete', $subcat->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-action rounded-pill px-3" 
                                                        onclick="return confirm('Delete this subcategory?')"
                                                        data-bs-toggle="tooltip" title="Delete">
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
        /* Table Header Custom Styling */
        .bg-light-header {
            background-color: #f8faff !important;
            border-bottom: 2px solid #edf2f9;
        }

        /* Hover Effect for Rows */
        .table-hover tbody tr {
            transition: all 0.3s ease;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05) !important;
            transform: scale(1.01);
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        /* Soft Badge for Category */
        .bg-soft-secondary {
            background-color: rgba(108, 117, 125, 0.1);
            border: 1px solid rgba(108, 117, 125, 0.2);
        }

        /* Action Buttons */
        .btn-action {
            background: #fff;
            border: 1px solid #eee;
            transition: all 0.2s;
        }
        .btn-action:hover {
            border-color: #3498db;
            background: #f0f7ff;
        }

        .badge { font-weight: 500; }
    </style>
@endsection