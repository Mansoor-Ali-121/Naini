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
                ✏️ Edit Subcategory
            </h4>
            <a href="{{ route('subcategory.show') }}" class="btn btn-light btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('subcategory.update', $subcat->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row g-3">
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <select class="form-select rounded-pill" id="cat_id" name="cat_id" required>
                                <option value="" disabled>Select Main Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('cat_id', $subcat->cat_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="cat_id" class="ms-3">
                                <i class="bi bi-diagram-3 me-2"></i> Main Category
                            </label>
                            @error('cat_id')
                                <div class="invalid-feedback d-block ms-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill" id="name" name="name"
                                value="{{ old('name', $subcat->name) }}" placeholder="Subcategory Name" required>
                            <label for="name" class="ms-3">
                                <i class="bi bi-tag me-2"></i> Subcategory Name
                            </label>
                            @error('name')
                                <div class="invalid-feedback d-block ms-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- SLug Input (Initial) --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill" id="slug" name="slug"
                                value="{{ old('slug', $subcat->Actual_Slug) }}" placeholder="Type Slug Here">
                            <label for="slug" class="ms-3">
                                <i class="bi bi-pencil me-2"></i> Edit Slug Here
                            </label>
                        </div>
                    </div>

                    {{-- Final Slug Preview (Hidden/Readonly) --}}
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill bg-light fw-bold text-primary"
                                id="Actual_Slug" name="Actual_Slug" value="{{ old('Actual_Slug', $subcat->Actual_Slug) }}"
                                placeholder="Final Slug" readonly style="border: 1px dashed #3498db;">
                            <label for="Actual_Slug" class="ms-3">
                                <i class="bi bi-link-45deg me-2"></i> Final Slug (Cannot contain numbers)
                            </label>
                            @error('Actual_Slug')
                                <div class="invalid-feedback d-block ms-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select rounded-pill" id="status" name="status" required>
                                <option value="active" {{ old('status', $subcat->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $subcat->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                            <i class="bi bi-check-circle me-2"></i> Update Subcategory
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .rounded-pill { border-radius: 50rem !important; }
        .card { max-width: 800px; margin: 2rem auto; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); }
        .form-control:focus, .form-select:focus { border-color: #3498db; box-shadow: none; }
    </style>

    {{-- Slug JS Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeInput = document.getElementById('slug');
            const finalSlug = document.getElementById('Actual_Slug');
            const nameInput = document.getElementById('name');

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