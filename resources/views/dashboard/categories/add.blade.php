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
                🍽️ Create New Category
            </h4>
        </div>

        <!-- Form Body -->
        <div class="card-body p-4">
            <form action="{{ route('category.add') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- Category Name -->
                    <div class="col-md-6">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control rounded-pill" id="name" name="name"
                                placeholder="Category Name" required>
                            <label for="name" class="ms-3">
                                <i class="bi bi-tag me-2"></i> Category Name
                            </label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Category Description -->
                    <div class="col-md-6">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control rounded-pill" id="description" name="description"
                                placeholder="Description" required>
                            <label for="description" class="ms-3">
                                <i class="bi bi-card-text me-2"></i> Description
                            </label>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Gradient Submit Button -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-lg rounded-pill px-5 border-0"
                            style="
                                    background: linear-gradient(45deg, #2c3e50, #3498db);
                                    color: white;
                                    font-size: 1.2rem;
                                    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
                                    transition: all 0.3s ease;
                                    padding: 12px 30px;
                                ">
                            <i class="bi bi-journal-plus me-2"></i> Create Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Styles -->
    <style>
        .form-floating label {
            color: #2c3e50;
            font-weight: 500;
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }

        .form-control {
            font-family: 'Dancing Script', cursive;
        }

        .invalid-feedback {
            font-family: Arial, sans-serif;
        }

        .card {
            max-width: 800px;
            margin: 2rem auto;
        }

        /* Button hover effects */
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
            background: linear-gradient(45deg, #3498db, #2c3e50) !important;
        }
    </style>
@endsection

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
@endsection
