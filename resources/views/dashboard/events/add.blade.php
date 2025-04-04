@extends('template')
@section('main_section')
    @include('dashboard.includes.alerts')

    <div class="card shadow-lg" style="font-family: 'Dancing Script', cursive; border-radius: 15px;">
        <!-- Header (Your Original Style Preserved) -->
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="
            background: linear-gradient(45deg, #2c3e50, #3498db);
            border-radius: 15px 15px 0 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
         ">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                🎉 Add New Event
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ route('events.show') }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>

        <!-- Form Body (Your Original Structure Kept) -->
        <div class="card-body p-4">
            <form action="{{ route('events.add') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <!-- Left Column - Only Price Input Modified -->
                    <div class="col-md-6">
                        <!-- Event Name (Unchanged) -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Event Name" required>
                            <label for="name" class="ms-3">
                                <i class="bi bi-calendar-event me-2"></i> Event Name
                            </label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price Field (Only Input Type Changed) -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill @error('price') is-invalid @enderror"
                                id="price" name="price" placeholder="Price" required
                                style="/* Your original input styles preserved */">
                            <label for="price" class="ms-3">
                                <i class="bi bi-tag me-2"></i> Price
                            </label>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column (Completely Unchanged) -->
                    <div class="col-md-6">
                        <!-- Your original image upload code preserved -->
                        <div class="mb-4 text-center">
                            <div class="image-upload-wrapper border rounded-circle mx-auto"
                                style="width: 200px; height: 200px; cursor: pointer; background: #f8f9fa;">
                                <img id="previewImage" src="#" alt="Preview"
                                    class="img-fluid rounded-circle w-100 h-100 d-none" style="object-fit: cover;">
                                <div id="uploadPrompt" class="h-100 d-flex flex-column justify-content-center">
                                    <i class="bi bi-image fs-1 text-muted"></i>
                                    <span class="text-muted">Upload Image</span>
                                </div>
                                <input type="file" class="d-none" id="image" name="image" accept="image/*"
                                    onchange="previewFile()">
                            </div>
                            @error('image')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description Field (Unchanged) -->
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                placeholder="Description" style="height: 150px;" required></textarea>
                            <label for="description" class="ms-3">
                                <i class="bi bi-text-paragraph me-2"></i> Description
                            </label>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button (Your Original Style Preserved) -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5"
                            style="
                                background: linear-gradient(45deg, #2c3e50, #3498db);
                                border: none;
                                transition: all 0.3s ease;
                            "
                            onmouseover="this.style.background='linear-gradient(45deg, #3498db, #2c3e50)'"
                            onmouseout="this.style.background='linear-gradient(45deg, #2c3e50, #3498db)'">
                            <i class="bi bi-save me-2"></i> Create Event
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Your Original CSS Styles Preserved -->
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
        }
    </style>

    <!-- Added Minimal JavaScript for Dollar Sign -->
    <script>
        // Simple Dollar Sign Handling (Only New Addition)
        document.getElementById('price').addEventListener('input', function(e) {
            // Preserve existing styling while adding $ handling
            let value = e.target.value.replace(/[^0-9.]/g, '');
            if (value !== '') {
                e.target.value = '$' + value;
            }
        });

        // Your Original Image Preview Script Preserved
        function previewFile() {
            const preview = document.getElementById('previewImage');
            const file = document.getElementById('image').files[0];
            const reader = new FileReader();
            const uploadPrompt = document.getElementById('uploadPrompt');

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
            document.getElementById('image').click();
        });
    </script>
@endsection
