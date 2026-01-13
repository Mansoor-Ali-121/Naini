@extends('template')

@section('main_section')
    @include('dashboard.includes.alerts')

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                <i class="bi bi-people-fill text-warning me-2"></i> User Management
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3" style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('register.add') }}" class="btn btn-light btn-sm rounded-pill px-3" style="border-width: 2px; color: #2c3e50;">
                    <i class="bi bi-person-plus-fill me-1"></i> Add New User
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($users->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> No users found.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light-header">
                            <tr>
                                <th class="py-3 ps-4" style="width: 80px;">#ID</th>
                                <th class="py-3">User Profile</th>
                                <th class="py-3">Contact Info</th>
                                <th class="py-3">Location</th>
                                <th class="py-3 text-center">Role</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <span class="text-muted fw-bold">#{{ $user->id }}</span>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-container me-3">
                                                <img src="{{ $user->picture ? asset('Users/users_pictures/' . $user->picture) : asset('default-user.png') }}"
                                                     class="rounded-circle shadow-sm border border-2 border-white"
                                                     style="width: 50px; height: 50px; object-fit: cover;"
                                                     onerror="this.src='{{ asset('default-user.png') }}'">
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark" style="font-size: 1.05rem;">{{ $user->name }}</div>
                                                <div class="text-muted small"><i class="bi bi-envelope me-1"></i>{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge bg-soft-info text-info rounded-pill px-3 py-2">
                                            <i class="bi bi-telephone me-1"></i> {{ $user->contact }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="text-muted small" style="max-width: 180px;">
                                            <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ Str::limit($user->address, 40) }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        @if ($user->usertype == 'admin')
                                            <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">
                                                <i class="bi bi-shield-lock me-1"></i> Admin
                                            </span>
                                        @else
                                            <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm">
                                                <i class="bi bi-person me-1"></i> User
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{route('register.edit',$user->id)}}" 
                                               class="btn btn-sm btn-action rounded-pill px-3" 
                                               data-bs-toggle="tooltip" title="Edit User">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </a>
                                            <form action="{{route('register.delete',$user->id)}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-action rounded-pill px-3" 
                                                        onclick="return confirm('Are you sure you want to delete this user?')"
                                                        data-bs-toggle="tooltip" title="Delete User">
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

        .bg-soft-info {
            background-color: rgba(13, 202, 240, 0.1);
            border: 1px solid rgba(13, 202, 240, 0.2);
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

        .avatar-container img {
            transition: transform 0.3s ease;
        }

        .avatar-container:hover img {
            transform: scale(1.15) rotate(5deg);
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