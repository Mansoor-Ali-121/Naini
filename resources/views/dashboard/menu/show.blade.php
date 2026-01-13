@extends('template')

@section('main_section')
    @include('dashboard.includes.alerts')

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                🍔 Menu Items List
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('menu.add') }}" class="btn btn-light btn-sm rounded-pill px-3"
                    style="border-width: 2px; color: #2c3e50;">
                    <i class="bi bi-plus-lg me-1"></i> Add New Item
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($menus->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> No menu items found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light-header">
                            <tr>
                                <th class="py-3 ps-4" style="width: 60px;">#ID</th>
                                <th class="py-3">Photo</th>
                                <th class="py-3">Item Name</th> <th class="py-3">Description</th> <th class="py-3">Category/Sub</th>
                                <th class="py-3">Slug</th>
                                <th class="py-3 text-center">Price</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td class="ps-4">
                                        <span class="text-muted fw-bold">#{{ $menu->id }}</span>
                                    </td>

                                    <td>
                                        <img src="{{ asset('Menus/menu_picture/' . $menu->menu_picture) }}"
                                            class="rounded-circle shadow-sm border border-2 border-white"
                                            style="width: 50px; height: 50px; object-fit: cover;"
                                            onerror="this.src='{{ asset('default-menu.png') }}'">
                                    </td>

                                    <td>
                                        <span class="fw-bold text-dark" style="font-size: 1rem;">{{ $menu->name }}</span>
                                    </td>

                                    <td>
                                        <div class="text-muted small" style="max-width: 200px; line-height: 1.2;">
                                            {{ Str::limit($menu->description, 50) }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column gap-1">
                                            <span class="badge bg-primary rounded-pill px-2 py-1" style="font-size: 0.7rem; width: fit-content;">
                                                {{ $menu->category->name ?? 'N/A' }}
                                            </span>
                                            <span class="badge bg-info text-white rounded-pill px-2 py-1" style="font-size: 0.7rem; width: fit-content;">
                                                {{ $menu->subcategory->name ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <code class="text-primary small" style="background: #f0f3f7; padding: 2px 6px; border-radius: 4px;">
                                            {{ $menu->actual_slug }}
                                        </code>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-soft-warning text-dark rounded-pill px-3 py-2 border border-warning" style="font-weight: 600;">
                                            ${{ number_format((float) str_replace(['$', ','], '', $menu->price), 2) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('menu.edit', $menu->id) }}"
                                                class="btn btn-sm btn-action rounded-pill px-2" data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </a>
                                            <form action="{{ route('menu.delete', $menu->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-action rounded-pill px-2"
                                                    onclick="return confirm('Delete this item?')" data-bs-toggle="tooltip" title="Delete">
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
        .bg-light-header { background-color: #f8faff !important; border-bottom: 2px solid #edf2f9; }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); }
        .table-hover tbody tr:hover { background-color: rgba(52, 152, 219, 0.03) !important; }
        .btn-action { background: #fff; border: 1px solid #eee; transition: 0.2s; }
        .btn-action:hover { border-color: #3498db; background: #f0f7ff; }
        code { font-size: 0.8rem; }
    </style>
@endsection