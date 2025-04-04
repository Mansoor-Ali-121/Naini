@extends('template')
@section('main_section')

    <div class="card shadow-lg" style="font-family: 'Dancing Script', cursive; border-radius: 15px;">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center py-3" style="
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

        <!-- Form Body -->
        <div class="card-body p-4">
            <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Item Name -->
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control rounded-pill" id="name" name="name"
                                value="{{ old('name', $menu->name) }}" required>
                            <label for="name" class="ms-3">
                                <i class="bi bi-utensils me-2"></i> Item Name
                            </label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price with Dollar Sign -->
                        <div class="form-floating mb-4 position-relative">
                            <span class="position-absolute start-0 ms-3"
                                style="top: 50%; transform: translateY(-50%); z-index: 3;">
                                <i class="bi bi-currency-dollar text-secondary"></i>
                            </span>
                            <input type="number" class="form-control rounded-pill ps-5 @error('price') is-invalid @enderror"
                                id="price" name="price" step="0.01" value="{{ old('price', $menu->price) }}" required>
                            <label for="price" class="ms-5">
                                Price
                            </label>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Image Upload -->
                        <div class="mb-4 text-center">
                            <div class="image-upload-wrapper border rounded-circle mx-auto"
                                style="width: 200px; height: 200px; cursor: pointer; background: #f8f9fa;">
                                @if($menu->menu_picture)
                                    <img src="{{ asset('Menus/menu_picture/' . $menu->menu_picture) }}"
                                        class="img-fluid rounded-circle w-100 h-100" style="object-fit: cover;">
                                @else
                                    <div class="h-100 d-flex flex-column justify-content-center">
                                        <i class="bi bi-image text-muted fs-1"></i>
                                        <span class="text-muted">No Image</span>
                                    </div>
                                @endif
                            </div>
                            <input type="file" class="form-control mt-3" id="menu_picture" name="menu_picture"
                                accept="image/*">
                            @error('menu_picture')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <div class="form-floating mb-4">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" style="height: 120px;"
                                required>{{ old('description', $menu->description) }}</textarea>
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
                        <button type="submit" class="btn btn-lg rounded-pill px-5 border-0 btn-gradient" style="
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

@endsection