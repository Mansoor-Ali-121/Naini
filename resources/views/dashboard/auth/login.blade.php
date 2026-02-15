@extends('website.web_temp')
@section('main_website')

@include('dashboard.includes.alerts')

    <div class="container-fluid vh-100"
        style="background: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center fixed; background-size: cover;">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6 col-lg-5">
                <!-- Semi-transparent overlay for better readability -->
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden bg-white bg-opacity-90">
                    <!-- Header with theme color -->
                    <div class="card-header bg-danger text-center py-3">
                        <h2 class="mb-0 fw-bold text-light b-3">
                            <strong><b><i class="bi bi-box-arrow-in-right me-2 text-light"></i> WELCOME BACK</strong></b>
                        </h2>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <!-- Login Form -->
                        <form action="" method="POST">
                            @csrf

                            <!-- Email Input -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold text-danger">Email address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-envelope-fill text-danger"></i>
                                    </span>
                                    <input type="email" class="form-control border-start-0 py-2" id="email"
                                        name="email" value="{{ old('email') }}" required>
                                </div>
                                <div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold text-danger">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-lock-fill text-danger"></i>
                                    </span>
                                    <input type="password" class="form-control border-start-0 py-2" id="password"
                                        name="password" value="{{old('password')}}" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                                <div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember" checked>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="#" class="text-decoration-none text-danger fw-semibold">Forgot password?</a>
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 mb-3">
                                <i class="bi bi-box-arrow-in-right me-2"></i> LOGIN
                            </button>

                            <!-- Social Login -->
                            <div class="text-center mb-3">
                                <p class="text-muted mb-2">Or login with</p>
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

                        <!-- Registration Link -->
                        <div class="text-center pt-3 border-top">
                            <p class="mb-0">Don't have an account?
                                <a href="{{route('register.add')}}" class="fw-bold text-decoration-none text-danger">Create one now</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Toggle Script -->
    <script>
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
    </script>
@endsection
