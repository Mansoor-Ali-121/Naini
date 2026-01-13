@extends('template')
@section('main_section')
    @include('dashboard.includes.alerts')

 @if ($errors->any())
    <div class="alert alert-danger rounded-pill shadow-sm mb-4" style="font-family: Arial, sans-serif;">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card shadow-lg" style="font-family: 'Dancing Script', cursive; border-radius: 15px;">
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
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                    style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('menu.add') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
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

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control rounded-pill" id="slug_input"
                                placeholder="Desired Slug" value="{{ old('slug') }}">
                            <label for="slug_input" class="ms-3">
                                <i class="bi bi-pencil me-2"></i> Desired Slug (Type here)
                            </label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text"
                                class="form-control rounded-pill @error('actual_slug') is-invalid @enderror"
                                id="actual_slug" name="actual_slug" placeholder="Actual Slug"
                                value="{{ old('actual_slug') }}" readonly style="background-color: #e9ecef;">
                            <label for="actual_slug" class="ms-3">
                                <i class="bi bi-link-45deg me-2"></i> Actual Slug (Final for DB)
                            </label>
                            @error('actual_slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-4 text-center">
                            <div class="image-upload-wrapper border rounded-circle mx-auto"
                                style="width: 200px; height: 200px; cursor: pointer; background: #f8f9fa;">
                                <img id="menuPreview" src="#" alt="Preview"
                                    class="img-fluid rounded-circle w-100 h-100 d-none" style="object-fit: cover;">
                                <div id="menuUploadPrompt" class="h-100 d-flex flex-column justify-content-center">
                                    <i class="bi bi-camera fs-1 text-muted"></i>
                                    <span class="text-muted">Upload Dish Photo</span>
                                </div>
                                <input type="file" class="d-none" id="menu_picture" name="menu_picture" accept="image/*"
                                    onchange="previewMenuImage()">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating mb-4">
                            <input type="number" class="form-control rounded-pill" id="price" name="price"
                                step="0.01" value="{{ old('price') }}" required>
                            <label for="price" class="ms-3"><i class="bi bi-currency-dollar me-2"></i> Price</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating mb-4">
                            <select class="form-select rounded-pill" id="category_id" name="category_id" required>
                                <option value="" selected disabled>Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="category_id" class="ms-3">Category</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating mb-4">
                            <select class="form-select rounded-pill" id="subcategory_id" name="subcategory_id" required>
                                <option value="" selected disabled>Choose Sub Category</option>
                                @foreach ($subcategories as $sub)
                                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                @endforeach
                            </select>
                            <label for="subcategory_id" class="ms-3">Sub Category</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-4">
                            <textarea class="form-control" id="description" name="description"
                                style="height: 100px; border-radius: 20px !important;" required>{{ old('description') }}</textarea>
                            <label for="description" class="ms-3">Description</label>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-lg rounded-pill px-5 btn-gradient text-white border-0">
                            <i class="bi bi-journal-plus me-2"></i> Create Menu Item
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .form-control,
        .form-select {
            font-family: 'Dancing Script', cursive;
        }

        .btn-gradient {
            background: linear-gradient(45deg, #2c3e50, #3498db);
            transition: 0.3s;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }
    </style>

    <script>
        document.getElementById('slug_input').addEventListener('input', function() {
            updateActualSlug(this.value);
        });

        function updateActualSlug(text) {
            const slug = text.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            document.getElementById('actual_slug').value = slug;
        }

        function previewMenuImage() {
            const preview = document.getElementById('menuPreview');
            const file = document.getElementById('menu_picture').files[0];
            const reader = new FileReader();
            reader.onloadend = function() {
                preview.src = reader.result;
                preview.classList.remove('d-none');
                document.getElementById('menuUploadPrompt').classList.add('d-none');
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }

        document.querySelector('.image-upload-wrapper').addEventListener('click', function() {
            document.getElementById('menu_picture').click();
        });
    </script>
@endsection
