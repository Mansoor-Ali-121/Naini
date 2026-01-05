@extends('template')

@section('main_section')
    @include('dashboard.includes.alerts')

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm mb-4" style="border-radius: 15px;">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
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
            <h4 class="mb-0 text-white" style="font-size: 1.8rem;">
                🍽️ Create New Subcategory
            </h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('subcategory.add') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <!-- Select Main Category -->
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <select class="form-select rounded-pill" id="category_id" name="category_id" required>
                                <option value="" selected disabled>Select Main Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="category_id" class="ms-3">
                                <i class="bi bi-diagram-3 me-2"></i> Main Category
                            </label>
                            @error('category_id')
                                <div class="invalid-feedback d-block ms-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Subcategory Name" required>
                            <label for="name" class="ms-3">
                                <i class="bi bi-tag me-2"></i> Subcategory Name
                            </label>
                            @error('name')
                                <div class="invalid-feedback d-block ms-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill" id="slug" name="slug"
                                value="{{ old('slug') }}" placeholder="Type Slug Here">
                            <label for="slug" class="ms-3">
                                <i class="bi bi-pencil me-2"></i> Type Slug Here
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill bg-light fw-bold text-primary"
                                id="ActualSlug" name="ActualSlug" value="{{ old('ActualSlug') }}" 
                                placeholder="Final Slug" readonly style="border: 1px dashed #3498db;">
                            <label for="ActualSlug" class="ms-3">
                                <i class="bi bi-link-45deg me-2"></i> Generated Final Slug (No Numbers)
                            </label>
                            @error('ActualSlug')
                                <div class="invalid-feedback d-block ms-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="description" name="description" 
                                placeholder="Description" style="border-radius: 20px; height: 100px;">{{ old('description') }}</textarea>
                            <label for="description" class="ms-3">
                                <i class="bi bi-card-text me-2"></i> Description (Optional)
                            </label>
                            @error('description')
                                <div class="invalid-feedback d-block ms-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Status Selection -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select rounded-pill" id="status" name="status" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <label for="status" class="ms-3">
                                <i class="bi bi-toggle-on me-2"></i> Status
                            </label>
                            @error('status')
                                <div class="invalid-feedback d-block ms-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-lg rounded-pill px-5 border-0"
                            style="background: linear-gradient(45deg, #2c3e50, #3498db); color: white; transition: all 0.3s ease;">
                            <i class="bi bi-plus-circle me-2"></i> Create Subcategory
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

        .form-control:focus, .form-select:focus {
            border-color: #3498db;
            box-shadow: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeInput = document.getElementById('slug');
            const finalSlug = document.getElementById('ActualSlug');
            const nameInput = document.getElementById('name');

            // Generic function jo sirf letters aur dash allow karega
            function generateSlug(text) {
                return text.toLowerCase()
                    .replace(/[0-9]/g, '') // 1. Numbers ko foran hatao
                    .replace(/[^a-z\s-]/g, '') // 2. Special characters hatao
                    .trim() // 3. Extra spaces khatam
                    .replace(/\s+/g, '-') // 4. Space ko dash (-) banao
                    .replace(/-+/g, '-'); // 5. Double dash (--) ko single (-) karo
            }

            // Jab user slug wali field mein type kare
            typeInput.addEventListener('input', function() {
                // Input box mein se numbers foran gayab ho jayein
                this.value = this.value.toLowerCase().replace(/[0-9]/g, '').replace(/[^a-z\s-]/g, '');

                // ActualSlug wali field update ho jaye
                finalSlug.value = generateSlug(this.value);
            });

            // Optional: Auto-generate slug from name when name field loses focus
            nameInput.addEventListener('blur', function() {
                if (typeInput.value === '' && this.value !== '') {
                    const autoSlug = generateSlug(this.value);
                    typeInput.value = autoSlug;
                    finalSlug.value = autoSlug;
                }
            });
        });
    </script>
@endsection