@extends('template')
@section('main_section')
    <div class="card shadow-lg" style="font-family: 'Dancing Script', cursive; border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="
                    background: linear-gradient(45deg, #2c3e50, #3498db);
                    border-radius: 15px 15px 0 0;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                 ">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                ✍️ Edit {{ $menu->name }}
            </h4>
            <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                style="border-width: 2px;">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control rounded-pill" id="name" name="name"
                                value="{{ old('name', $menu->name) }}" required>
                            <label for="name" class="ms-3">
                                <i class="bi bi-utensils me-2"></i> Item Name
                            </label>
                            @error('name')
                                <div class="text-danger small ms-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control rounded-pill" id="slug_input" placeholder="Edit Slug"
                                value="{{ old('slug', $menu->actual_slug) }}">
                            <label for="slug_input" class="ms-3">
                                <i class="bi bi-pencil me-2"></i> Desired Slug
                            </label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text"
                                class="form-control rounded-pill @error('actual_slug') is-invalid @enderror"
                                id="actual_slug" name="actual_slug" value="{{ old('actual_slug', $menu->actual_slug) }}"
                                readonly style="background-color: #f1f3f5;">
                            <label for="actual_slug" class="ms-3">
                                <i class="bi bi-link-45deg me-2"></i> Actual Slug (Final)
                            </label>
                            @error('actual_slug')
                                <div class="invalid-feedback ms-3">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="number" class="form-control rounded-pill @error('price') is-invalid @enderror"
                                id="price" name="price" step="0.01" value="{{ old('price', $menu->price) }}"
                                required>
                            <label for="price" class="ms-3">
                                <i class="bi bi-currency-dollar me-2"></i> Price
                            </label>
                            @error('price')
                                <div class="invalid-feedback ms-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-4 text-center">
                            <div class="image-upload-wrapper border rounded-circle mx-auto" id="imageWrapper"
                                style="width: 200px; height: 200px; cursor: pointer; background: #f8f9fa; overflow: hidden;">
                                <img id="menuPreview"
                                    src="{{ $menu->menu_picture ? asset('Menus/menu_picture/' . $menu->menu_picture) : '#' }}"
                                    class="img-fluid rounded-circle w-100 h-100 {{ $menu->menu_picture ? '' : 'd-none' }}"
                                    style="object-fit: cover;">

                                <div id="menuUploadPrompt"
                                    class="h-100 d-flex flex-column justify-content-center {{ $menu->menu_picture ? 'd-none' : '' }}">
                                    <i class="bi bi-camera fs-1 text-muted"></i>
                                    <span class="text-muted">Change Photo</span>
                                </div>
                            </div>
                            <input type="file" class="d-none" id="menu_picture" name="menu_picture" accept="image/*"
                                onchange="previewMenuImage()">
                            <p class="text-muted mt-2 small">Click circle to change image</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-4">
                            <select class="form-select rounded-pill" id="category_id" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="category_id" class="ms-3">Category</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-4">
                            <select class="form-select rounded-pill" id="subcategory_id" name="subcategory_id" required>
                                @foreach ($subcategories as $sub)
                                    <option value="{{ $sub->id }}"
                                        {{ $menu->subcategory_id == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="subcategory_id" class="ms-3">Sub Category</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating mb-4">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                style="height: 120px; border-radius: 20px !important;" required>{{ old('description', $menu->description) }}</textarea>
                            <label for="description" class="ms-3">
                                <i class="bi bi-card-text me-2"></i> Description
                            </label>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-lg rounded-pill px-5 border-0 btn-gradient"
                            style="
                                        background: linear-gradient(45deg, #2c3e50, #3498db);
                                        color: white;
                                        font-size: 1.2rem;
                                        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
                                        padding: 12px 30px;
                                    ">
                            <i class="bi bi-arrow-repeat me-2"></i> Update Item
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Slug generation logic
        document.getElementById('slug_input').addEventListener('input', function() {
            updateActualSlug(this.value);
        });

        function updateActualSlug(text) {
            const slug = text.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            document.getElementById('actual_slug').value = slug;
        }

        // Image Preview logic
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
            }
        }

        document.getElementById('imageWrapper').addEventListener('click', function() {
            document.getElementById('menu_picture').click();
        });
    </script>

    <style>
        .form-floating label {
            color: #2c3e50;
            font-weight: 500;
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }

        .form-control,
        .form-select {
            font-family: 'Dancing Script', cursive;
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
    </style>
@endsection
