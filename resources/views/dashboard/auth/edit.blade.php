@extends('template')
@section('main_section')

    <div class="card shadow-lg" style="font-family: 'Dancing Script', cursive; border-radius: 15px;">
        <!-- Header - Same gradient as menu form -->
        <div class="card-header d-flex justify-content-between align-items-center py-3" style="
                    background: linear-gradient(45deg, #2c3e50, #3498db);
                    border-radius: 15px 15px 0 0;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                 ">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                ✏️ Edit User Profile
            </h4>
            <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3"
                style="border-width: 2px;">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>

        <!-- Form Body -->
        <div class="card-body p-4">
            <form action="{{route('register.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Name Field - Rounded pill like menu form -->
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control rounded-pill" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required>
                            <label for="name" class="ms-3">
                                <i class="bi bi-person me-2"></i> Full Name
                            </label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-floating mb-4 position-relative">
                            <span class="position-absolute start-0 ms-3"
                                style="top: 50%; transform: translateY(-50%); z-index: 3;">
                                <i class="bi bi-envelope text-secondary"></i>
                            </span>
                            <input type="email" class="form-control rounded-pill ps-5" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required>
                            <label for="email" class="ms-5">
                                Email Address
                            </label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact Field -->
                        <div class="form-floating mb-4 position-relative">
                            <span class="position-absolute start-0 ms-3"
                                style="top: 50%; transform: translateY(-50%); z-index: 3;">
                                <i class="bi bi-telephone text-secondary"></i>
                            </span>
                            <input type="tel" class="form-control rounded-pill ps-5" id="contact" name="contact"
                                value="{{ old('contact', $user->contact) }}">
                            <label for="contact" class="ms-5">
                                Contact Number
                            </label>
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- User Type Field -->
                        <div class="form-floating mb-4">
                            <select class="form-select rounded-pill" id="usertype" name="usertype" required>
                                <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('usertype', $user->usertype) == 'user' ? 'selected' : '' }}>User</option>
                            >Manager</option>
                                <!-- Add more options as needed -->
                            </select>
                            <label for="usertype" class="ms-3">
                                <i class="bi bi-person-badge me-2"></i> User Type
                            </label>
                            @error('usertype')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column - Profile Picture -->
                    <div class="col-md-6">
                        <div class="mb-4 text-center">
                            <div class="image-upload-wrapper border rounded-circle mx-auto"
                                style="width: 200px; height: 200px; cursor: pointer; background: #f8f9fa;">
                                @if($user->picture)
                                    <img src="{{ asset('Users/users_pictures/' . $user->picture) }}"
                                        class="img-fluid rounded-circle w-100 h-100" style="object-fit: cover;">
                                @else
                                    <div class="h-100 d-flex flex-column justify-content-center">
                                        <i class="bi bi-person-circle text-muted fs-1"></i>
                                        <span class="text-muted">No Image</span>
                                    </div>
                                @endif
                            </div>
                            <input type="file" class="form-control mt-3" id="picture" name="picture"
                                accept="image/*">
                            @error('picture')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Address Field -->
                    <div class="col-12">
                        <div class="form-floating mb-4">
                            <textarea class="form-control rounded-pill" id="address" name="address"
                                style="height: 100px;">{{ old('address', $user->address) }}</textarea>
                            <label for="address" class="ms-3">
                                <i class="bi bi-geo-alt me-2"></i> Address
                            </label>
                            @error('address')
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
                            <i class="bi bi-save me-2"></i> Update Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Styles - Same as menu form -->
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
        
        /* Style for select dropdown to match other inputs */
        .form-select {
            font-family: 'Dancing Script', cursive;
            height: calc(3.5rem + 2px);
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }
    </style>
@endsection