@extends('template')

@section('main_section')
    @include('dashboard.includes.alerts')

    {{-- Error Alert Box --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm mb-4" style="border-radius: 15px;">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                <h5 class="mb-0">Kuch ghaltiyan hain:</h5>
            </div>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0;">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; font-family: 'Dancing Script', cursive;">
                📝 Edit Category
            </h4>
            <a href="{{ route('category.show') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('category.update', ['id' => $cat->id]) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row g-3">
                    {{-- Category Name --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill" id="name" name="name"
                                value="{{ old('name', $cat->name) }}" placeholder="Category Name" required
                                style="font-family: 'Dancing Script', cursive;">
                            <label for="name" class="ms-3">
                                <i class="bi bi-tag me-2"></i> Category Name
                            </label>
                        </div>
                    </div>

                    {{-- Slug Typing Input (Sirf UI ke liye) --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill" id="slug_input"
                                value="{{ old('ActualSlug', $cat->ActualSlug) }}" placeholder="Type Slug Here">
                            <label for="slug_input" class="ms-3">Edit Slug Here</label>
                        </div>
                    </div>

                    {{-- Final Slug (Jo Database mein jayega) --}}
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill bg-light" id="ActualSlug"
                                name="ActualSlug" value="{{ old('ActualSlug', $cat->ActualSlug) }}" readonly>
                            <label for="ActualSlug" class="ms-3">Actual Slug (Database Column)</label>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="description" name="description" required
                                style="border-radius: 20px; height: 100px; font-family: 'Dancing Script', cursive;" placeholder="Description">{{ old('description', $cat->description) }}</textarea>
                            <label for="description" class="ms-3">
                                <i class="bi bi-card-text me-2"></i> Category Description
                            </label>
                        </div>
                    </div>

                    {{-- Update Button --}}
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-lg rounded-pill px-5 border-0"
                            style="background: linear-gradient(45deg, #2c3e50, #3498db); color: white; transition: all 0.3s ease;">
                            <i class="bi bi-arrow-repeat me-2"></i> Update Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .rounded-pill {
            border-radius: 50rem !important;
        }

        .card {
            max-width: 800px;
            margin: 2rem auto;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeInput = document.getElementById('slug_input');
            const finalSlug = document.getElementById('ActualSlug');

            function generateSlug(text) {
                return text.toLowerCase()
                    .replace(/[0-9]/g, '')
                    .replace(/[^a-z\s-]/g, '')
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }

            typeInput.addEventListener('input', function() {
                this.value = this.value.toLowerCase().replace(/[0-9]/g, '').replace(/[^a-z\s-]/g, '');
                finalSlug.value = generateSlug(this.value);
            });
        });
    </script>
@endsection

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
@endsection
