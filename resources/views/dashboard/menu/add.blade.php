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
            🍴 Create New Menu Item
        </h4>
        <div class="d-flex gap-2">
            <a href="{{ url()->previous() }}" 
               class="btn btn-outline-light btn-sm rounded-pill px-3"
               style="border-width: 2px;">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <!-- Form Body -->
    <div class="card-body p-4">
        <form action="{{ route('menu.add') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-md-6">
                    <!-- Item Name -->
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control rounded-pill @error('name') is-invalid @enderror" 
                               id="name" name="name" placeholder="Item Name" value="{{ old('name') }}" required>
                        <label for="name" class="ms-3">
                            <i class="bi bi-utensils me-2"></i> Item Name
                        </label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="form-floating mb-4">
                        <input type="number" class="form-control rounded-pill" 
                               id="price" name="price" placeholder="Price" step="0.01" value="{{ old('price') }}" required>
                        <label for="price" class="ms-3">
                            <i class="bi bi-currency-dollar me-2"></i> Price
                        </label>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <!-- Dish Image -->
                    <div class="mb-4 text-center">
                        <div class="image-upload-wrapper border rounded-circle mx-auto" 
                             style="width: 200px; height: 200px; cursor: pointer; background: #f8f9fa;">
                            <img id="menuPreview" src="#" alt="Preview" 
                                 class="img-fluid rounded-circle w-100 h-100 d-none"
                                 style="object-fit: cover;">
                            <div id="menuUploadPrompt" class="h-100 d-flex flex-column justify-content-center">
                                <i class="bi bi-camera fs-1 text-muted"></i>
                                <span class="text-muted">Upload Dish Photo</span>
                            </div>
                            <input type="file" class="d-none" id="menu_picture" name="menu_picture" 
                                   accept="image/*" onchange="previewMenuImage()">
                        </div>
                        @error('menu_picture')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="col-12">
                    <div class="form-floating mb-4">
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" 
                                  placeholder="Description" style="height: 120px;" required>{{ old('description') }}</textarea>
                        <label for="description" class="ms-3">
                            <i class="bi bi-card-text me-2"></i> Description
                        </label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12 text-center">
                    <button type="submit" 
                            class="btn btn-lg rounded-pill px-5 border-0 btn-gradient"
                            style="
                                background: linear-gradient(45deg, #2c3e50, #3498db);
                                color: white;
                                font-size: 1.2rem;
                                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
                                padding: 12px 30px;
                            ">
                        <i class="bi bi-journal-plus me-2"></i> Create Menu Item
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
    .image-upload-wrapper:hover {
        background: #e9ecef !important;
        transition: background 0.3s ease;
    }
    .form-control {
        font-family: 'Dancing Script', cursive;
    }
    .invalid-feedback {
        font-family: Arial, sans-serif;
    }
    .btn-gradient {
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }
    .btn-gradient:hover {
        background: linear-gradient(45deg, #3498db, #2c3e50) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(52, 152, 219, 0.5);
    }
    .btn-gradient:active {
        transform: translateY(1px);
        box-shadow: 0 2px 10px rgba(52, 152, 219, 0.3);
    }
</style>

<!-- JavaScript -->
<script>
function previewMenuImage() {
    const preview = document.getElementById('menuPreview');
    const file = document.getElementById('menu_picture').files[0];
    const reader = new FileReader();
    const uploadPrompt = document.getElementById('menuUploadPrompt');

    reader.onloadend = function() {
        preview.src = reader.result;
        preview.classList.remove('d-none');
        uploadPrompt.classList.add('d-none');
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
        preview.classList.add('d-none');
        uploadPrompt.classList.remove('d-none');
    }
}

document.querySelector('.image-upload-wrapper').addEventListener('click', function() {
    document.getElementById('menu_picture').click();
});
</script>

@endsection