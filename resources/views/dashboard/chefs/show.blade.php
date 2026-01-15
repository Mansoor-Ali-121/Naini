@extends('template')

@section('main_section')
    @include('dashboard.includes.alerts')

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                👨‍🍳 Master Chefs
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3" style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('chef.add') }}" class="btn btn-light btn-sm rounded-pill px-3" style="border-width: 2px; color: #2c3e50;">
                    <i class="bi bi-person-plus-fill me-1"></i> Add New Chef
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($chefs->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> No chefs found in the kitchen!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light-header">
                            <tr>
                                <th class="py-3 ps-4">Chef Details</th>
                                <th class="py-3">Role & Category</th>
                                <th class="py-3 text-center">Experience</th>
                                <th class="py-3">Specialty</th>
                                <th class="py-3">Contact info</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chefs as $chef)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-container">
                                                <img src="{{ asset('Chefs/chefs_pictures/' . $chef->chef_picture) }}"
                                                     class="rounded-circle shadow-sm border border-2 border-white"
                                                     style="width: 55px; height: 55px; object-fit: cover;"
                                                     onerror="this.src='{{ asset('default-chef.png') }}'">
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark mb-0" style="font-size: 1.1rem;">{{ $chef->name }}</div>
                                                <small class="text-muted">ID: #{{ $chef->id }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="mb-1"><span class="badge bg-soft-primary text-primary rounded-pill">{{ str_replace('-', ' ', ucwords($chef->role_slug)) }}</span></div>
                                        <div class="small text-muted"><i class="bi bi-tag me-1"></i>{{ $chef->category->name ?? 'No Category' }}</div>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-soft-info text-info rounded-pill px-3 py-2 border border-info">
                                            <i class="bi bi-star-fill me-1"></i> {{ $chef->experience }} Years
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-soft-danger text-danger rounded-pill px-3 py-2">
                                            <i class="bi bi-egg-fried me-1"></i> {{ $chef->specialty }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="small fw-bold text-dark"><i class="bi bi-telephone me-1"></i> {{ $chef->phone }}</div>
                                        <div class="small text-muted text-truncate" style="max-width: 150px;" title="{{ $chef->address }}">
                                            <i class="bi bi-geo-alt me-1"></i> {{ $chef->address }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('chef.edit', $chef->id) }}" 
                                               class="btn btn-sm btn-action rounded-pill px-3" 
                                               data-bs-toggle="tooltip" title="Edit Chef">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </a>
                                            <form action="{{ route('chef.delete', $chef->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-action rounded-pill px-3" 
                                                        onclick="return confirm('Are you sure you want to remove this chef?')"
                                                        data-bs-toggle="tooltip" title="Delete Chef">
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
        .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
        .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); border: 1px solid rgba(220, 53, 69, 0.2); }
        .bg-soft-primary { background-color: rgba(52, 152, 219, 0.1); border: 1px solid rgba(52, 152, 219, 0.2); }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.04) !important;
            transform: scale(1.005);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .btn-action { background: #fff; border: 1px solid #eee; transition: all 0.2s; }
        .btn-action:hover { border-color: #3498db; background: #f0f7ff; }

        tr:hover .avatar-container img { transform: scale(1.1) rotate(3deg); }
        .avatar-container img { transition: all 0.3s ease; }
    </style>
@endsection