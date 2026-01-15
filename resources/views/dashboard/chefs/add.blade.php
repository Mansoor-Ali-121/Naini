@extends('template')
@section('main_section')
    @include('dashboard.includes.alerts')

    {{-- Error handling --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert" style="border-radius: 10px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg" style="font-family: 'Dancing Script', cursive; border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0;">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                👨‍🍳 Add New Chef
            </h4>
            <a href="{{ route('chef.show') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('chef.add') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill" id="name" name="name"
                                placeholder="Chef Name" required onkeyup="generateSlug(this.value)"
                                value="{{ old('name') }}">
                            <label for="name" class="ms-3"><i class="bi bi-person-badge me-2"></i> Chef Name</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill" id="slug" name="slug"
                                placeholder="Slug" readonly style="background-color: #f1f3f5;" value="{{ old('slug') }}">
                            <label for="slug" class="ms-3"><i class="bi bi-link-45deg me-2"></i> URL Slug</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select rounded-pill" id="role" name="role" required>
                                <option value="" disabled {{ old('role') == '' ? 'selected' : '' }}>Select Role
                                    Type</option>
                                <option value="executive-chef" {{ old('role') == 'executive-chef' ? 'selected' : '' }}>
                                    Executive Chef</option>
                                <option value="sous-chef" {{ old('role') == 'sous-chef' ? 'selected' : '' }}>Sous Chef
                                </option>
                            </select>
                            <label for="role" class="ms-3"><i class="bi bi-briefcase me-2"></i> Role Slug</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select rounded-pill" id="cat_id" name="cat_id" required>
                                <option value="" disabled {{ old('cat_id') == '' ? 'selected' : '' }}>Choose a
                                    Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('cat_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="cat_id" class="ms-3"><i class="bi bi-grid me-2"></i> Select Category</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control rounded-pill" id="experience" name="experience"
                                placeholder="Experience" required value="{{ old('experience') }}">
                            <label for="experience" class="ms-3"><i class="bi bi-clock-history me-2"></i> Experience
                                (Years)</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill" id="specialty" name="specialty"
                                placeholder="Specialty" required value="{{ old('specialty') }}">
                            <label for="specialty" class="ms-3"><i class="bi bi-stars me-2"></i> Specialty</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control rounded-pill" id="phone" name="phone"
                                placeholder="Phone" required value="{{ old('phone') }}">
                            <label for="phone" class="ms-3"><i class="bi bi-phone me-2"></i> Phone Number</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-pill" id="address" name="address"
                                placeholder="Address" required value="{{ old('address') }}">
                            <label for="address" class="ms-3"><i class="bi bi-geo-alt me-2"></i> Address</label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-md-8">
                        <div class="border rounded-4 p-4 text-center"
                            style="border: 2px dashed #3498db !important; background: #f8f9fa;">
                            <input type="file" name="chef_picture" id="chef_picture" class="d-none" accept="image/*"
                                onchange="previewFile()">

                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class="border rounded-3 d-flex align-items-center justify-content-center overflow-hidden"
                                        style="height: 140px; width: 100%; border: 1px solid #dee2e6; background-color: #ffffff;">
                                        <img id="previewImage" src="" class="d-none"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                        <i id="placeholderIcon" class="bi bi-image text-muted fs-1"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 text-md-start mt-3 mt-md-0">
                                    <h5 class="fw-bold mb-1">Chef Portrait</h5>
                                    <p class="text-muted small mb-3">Upload a high-quality JPG or PNG</p>

                                    <div id="file-info" class="d-none mb-3">
                                        <span class="badge rounded-pill px-3 py-2"
                                            style="background: #eef2ff; color: #3498db; border: 1px solid #3498db;">
                                            <i class="bi bi-file-earmark-image me-1"></i> <span
                                                id="fileNameDisplay"></span>
                                        </span>
                                    </div>

                                    <button type="button" class="btn btn-outline-primary rounded-pill px-4 shadow-sm"
                                        onclick="document.getElementById('chef_picture').click()">
                                        <i class="bi bi-cloud-arrow-up me-2"></i> Browse Photo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 text-center mt-5">
                    <button type="submit" class="btn btn-lg rounded-pill px-5 border-0 btn-save-custom shadow">
                        <i class="bi bi-save2-fill me-2"></i> Save Chef Profile
                    </button>
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

        .btn-save-custom {
            background: linear-gradient(45deg, #2c3e50, #3498db);
            color: white !important;
            font-size: 1.25rem;
            font-weight: 600;
            padding: 14px 40px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.3);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-save-custom:hover {
            background: linear-gradient(45deg, #3498db, #2c3e50);
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.5);
            color: #fff;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: #2c3e50 !important;
        }
    </style>

    <script>
        function generateSlug(val) {
            document.getElementById('slug').value = val.toLowerCase().trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        function previewFile() {
            const file = document.getElementById('chef_picture').files[0];
            const previewImage = document.getElementById('previewImage');
            const placeholderIcon = document.getElementById('placeholderIcon');
            const fileInfo = document.getElementById('file-info');
            const fileNameDisplay = document.getElementById('fileNameDisplay');

            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('d-none');
                    placeholderIcon.classList.add('d-none');
                    fileNameDisplay.textContent = file.name;
                    fileInfo.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
