@extends('template')
@section('main_section')
    @include('dashboard.includes.alerts')

    {{-- All errors display --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>There were some problems with your input:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg" style="font-family: 'Dancing Script', cursive; border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
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

        <div class="card-body p-4">
            <form action="{{ route('events.add') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Event Name" value="{{ old('name') }}" required>
                            <label for="name" class="ms-3"><i class="bi bi-calendar-event me-2"></i> Event
                                Name</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill @error('slug') is-invalid @enderror"
                                id="slug" name="slug" placeholder="slug-name" value="{{ old('slug') }}" required
                                readonly>
                            <label for="slug" class="ms-3"><i class="bi bi-link-45deg me-2"></i> Slug
                                (Auto-generated)</label>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" class="form-control rounded-pill @error('date') is-invalid @enderror"
                                id="date" name="date" value="{{ old('date') }}" required>
                            <label for="date" class="ms-3"><i class="bi bi-calendar-check me-2"></i> Event
                                Date</label>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill @error('location') is-invalid @enderror"
                                id="location" name="location" placeholder="Location" value="{{ old('location') }}">
                            <label for="location" class="ms-3"><i class="bi bi-geo-alt me-2"></i> Location</label>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill @error('category') is-invalid @enderror"
                                id="category" name="category" placeholder="Category" value="{{ old('category') }}">
                            <label for="category" class="ms-3"><i class="bi bi-grid me-2"></i> Category</label>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-4 text-center">
                            <div class="image-upload-wrapper border rounded-circle mx-auto"
                                style="width: 180px; height: 180px; cursor: pointer; background: #f8f9fa;">
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
                                <div class="text-danger mt-2 small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-2">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text"
                                        class="form-control rounded-pill @error('price') is-invalid @enderror"
                                        id="price" name="price" placeholder="Price" value="{{ old('price') }}"
                                        required>
                                    <label for="price" class="ms-3"><i class="bi bi-tag me-2"></i> Price</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="number"
                                        class="form-control rounded-pill @error('guests') is-invalid @enderror"
                                        id="guests" name="guests" placeholder="Guests" value="{{ old('guests') }}">
                                    <label for="guests" class="ms-3"><i class="bi bi-people me-2"></i> Guests</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control rounded-pill @error('host_name') is-invalid @enderror" id="host_name"
                                name="host_name" placeholder="Host Name" value="{{ old('host_name') }}">
                            <label for="host_name" class="ms-3"><i class="bi bi-person-badge me-2"></i> Host
                                Name</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control rounded-pill @error('organizer') is-invalid @enderror" id="organizer"
                                name="organizer" placeholder="Organizer" value="{{ old('organizer') }}">
                            <label for="organizer" class="ms-3"><i class="bi bi-briefcase me-2"></i> Organizer</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                placeholder="Description" style="height: 120px; border-radius: 20px;" required>{{ old('description') }}</textarea>
                            <label for="description" class="ms-3"><i class="bi bi-text-paragraph me-2"></i>
                                Description</label>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5"
                            style="background: linear-gradient(45deg, #2c3e50, #3498db); border: none; transition: all 0.3s ease;">
                            <i class="bi bi-save me-2"></i> Create Event
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
            transition: 0.3s;
        }

        input.form-control:focus,
        textarea.form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
    </style>

    <script>
        // Auto-generate Slug from Name
        document.getElementById('name').addEventListener('input', function() {
            let name = this.value;
            let slug = name.toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
            document.getElementById('slug').value = slug;
        });

        // Price Formatting
        document.getElementById('price').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9.]/g, '');
            if (value !== '') {
                e.target.value = '$' + value;
            }
        });

        // Image Preview
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
            }
        }

        document.querySelector('.image-upload-wrapper').addEventListener('click', function() {
            document.getElementById('image').click();
        });
    </script>
@endsection
