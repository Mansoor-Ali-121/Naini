@extends('website.web_temp')
@section('main_website')
    <div class="container-fluid vh-90"
        style="background: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center fixed; background-size: cover;">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 my-5">
                <!-- Semi-transparent overlay for better readability -->
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden bg-white bg-opacity-90">
                    <!-- Header with theme color -->
                    <div class="card-header bg-danger text-center py-3">
                        <h2 class="mb-0 fw-bold text-light b-3">
                            <strong><b><i class="bi bi-person-plus-fill me-2 text-light"></i> CREATE ACCOUNT</strong></b>
                        </h2>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <!-- Registration Form -->
                        <form action="{{route('register.add')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Name Input -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold text-danger">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-person-fill text-danger"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 py-2" id="name"
                                        name="name" required>
                                </div>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold text-danger">Email address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-envelope-fill text-danger"></i>
                                    </span>
                                    <input type="email" class="form-control border-start-0 py-2" id="email"
                                        name="email" required>
                                </div>
                                @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contact Input -->
                            <div class="mb-4">
                                <label for="contact" class="form-label fw-semibold text-danger">Contact Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-telephone-fill text-danger"></i>
                                    </span>
                                    <input type="tel" class="form-control border-start-0 py-2" id="contact"
                                        name="contact" required>
                                </div>
                                @error('contact')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address Input -->
                            <div class="mb-4">
                                <label for="address" class="form-label fw-semibold text-danger">Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-geo-alt-fill text-danger"></i>
                                    </span>
                                    <textarea class="form-control border-start-0 py-2" id="address" name="address" rows="1" required>{{ old('address') }}</textarea>
                                </div>
                                @error('address')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Profile Picture Upload -->
                            <div class="mb-4">
                                <label for="picture" class="form-label fw-semibold text-danger">Profile Picture</label>
                                <input class="form-control" type="file" id="picture" name="picture" accept="image/*">
                                @error('picture')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold text-danger">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-lock-fill text-danger"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 py-2" id="password"
                                        name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                                <div class="form-text">Must be at least 8 characters</div>
                                @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-semibold text-danger">Confirm
                                    Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-lock-fill text-danger"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 py-2"
                                        id="confirm_password" name="confirm_password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" required id="termsCheckbox">
                                <label class="form-check-label" for="termsCheckbox">
                                    I agree to the <a href="#" class="text-decoration-none" id="termsLink">Terms
                                        and Conditions</a>
                                </label>
                            </div>

                            <!-- Register Button -->
                            <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 mb-3">
                                <i class="bi bi-person-plus-fill me-2"></i> REGISTER
                            </button>

                            <!-- Social Registration -->
                            <div class="text-center mb-3">
                                <p class="text-muted mb-2">Or register with</p>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="#" class="btn btn-outline-danger rounded-circle p-2">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-danger rounded-circle p-2">
                                        <i class="bi bi-google"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-danger rounded-circle p-2">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Login Link -->
                        <div class="text-center pt-3 border-top">
                            <p class="mb-0">Already have an account?
                                <a href="#" class="fw-bold text-decoration-none text-danger">Login here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
        // Toggle main password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
            } else {
                password.type = 'password';
                icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
            }
        });

        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPassword = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');
            if (confirmPassword.type === 'password') {
                confirmPassword.type = 'text';
                icon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
            } else {
                confirmPassword.type = 'password';
                icon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
            }
        });

        // Make Terms and Conditions link stay red after click
        document.getElementById('termsLink').addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.toggle('text-danger');
        });
    </script>
@endsection
