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
                <i class="bi bi-people-fill text-warning me-2"></i>User Management
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="bg-light-primary">
                        <tr>
                            <th class="py-3" style="border-bottom: 2px solid #3498db;">#ID</th>
                            <th class="py-3" style="border-bottom: 2px solid #3498db;">User Details</th>
                            <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Contact</th>
                            <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Address</th>
                            <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Type</th>
                            <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Photo</th>
                            <th class="py-3 text-center" style="border-bottom: 2px solid #3498db;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $admin)
                            <tr class="shadow-sm" style="border-bottom: 1px solid #dee2e6; transition: all 0.3s ease;">
                                <td class="fw-bold">#{{ $admin->id }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark">{{ $admin->name }}</span>
                                        <small class="text-muted">{{ $admin->email }}</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info rounded-pill px-3 py-2">
                                        <i class="bi bi-telephone me-1"></i> {{ $admin->contact }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary rounded-pill px-3 py-2">
                                        <i class="bi bi-geo-alt me-1"></i> {{ $admin->address }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($admin->usertype == 'admin')
                                        <span class="badge bg-danger rounded-pill px-3 py-2">
                                            <i class="bi bi-shield-lock me-1"></i> Admin
                                        </span>
                                    @else
                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            <i class="bi bi-person me-1"></i> User
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <img src="{{ $admin->picture ? asset('Users/users_pictures/' . $admin->picture) : asset('default-user.png') }}"
                                        class="img-thumbnail shadow-sm"
                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid #fff;"
                                        onerror="this.src='{{ asset('default-user.png') }}'">
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="" class="btn btn-sm btn-primary rounded-pill px-3"
                                            data-bs-toggle="tooltip" title="Edit User">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3"
                                                data-bs-toggle="tooltip" title="Delete User"
                                                onclick="return confirm('Are you sure? This action cannot be undone.');">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="alert alert-warning rounded-pill d-inline-block">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        No admin found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Rest of your styles and scripts remain the same -->
    <style>
        .bg-light-primary {
            background: linear-gradient(45deg, #f8f9fa, #e9ecef) !important;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1) !important;
            transform: translateX(4px);
        }

        .badge {
            font-size: 0.85rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .img-thumbnail {
            transition: transform 0.3s ease;
        }

        .img-thumbnail:hover {
            transform: scale(1.1);
        }

        .card {
            max-width: 1400px;
            margin: 2rem auto;
        }

        .text-muted {
            font-size: 0.85rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                .forEach(function(tooltipTriggerEl) {
                    new bootstrap.Tooltip(tooltipTriggerEl)
                });
        });
    </script>

@endsection