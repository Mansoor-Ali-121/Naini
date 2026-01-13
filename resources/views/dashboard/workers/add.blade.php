@extends('template')

@section('main_section')
    @include('dashboard.includes.alerts')

    {{-- Error Messages Display: Agar koi validation error ho --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm mb-4" style="border-radius: 15px;">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        {{-- Card Header: Page Title aur Gradient Background --}}
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0;">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem;">
                <i class="bi bi-person-badge me-2"></i> Create New Worker
            </h4>
        </div>

        <div class="card-body p-4 p-md-5">
            <form action="{{ route('workers.add') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    {{-- 1. Worker Name Field --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill border-info" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Worker Name" required>
                            <label for="name" class="ms-3">
                                <i class="bi bi-person me-2"></i> Worker Name
                            </label>
                        </div>
                    </div>

                    {{-- 2. Field/Department (e.g. Kitchen, Delivery) --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill border-info" id="field"
                                name="field" value="{{ old('field') }}" placeholder="Field" required>
                            <label for="field" class="ms-3">
                                <i class="bi bi-briefcase me-2"></i> Field (e.g. Kitchen)
                            </label>
                        </div>
                    </div>

                    {{-- 3. Manual Slug Entry: User yahan khud slug type karega --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill border-primary" id="slug_input"
                                placeholder="Type Slug Here">
                            <label for="slug_input" class="ms-3">
                                <i class="bi bi-pencil me-2"></i> Type Slug Here
                            </label>
                        </div>
                    </div>

                    {{-- 4. Final Generated Slug: Ye field database mein "actual_slug" save karegi --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill bg-light fw-bold text-primary"
                                id="actual_slug" name="actual_slug" value="{{ old('actual_slug') }}"
                                placeholder="Final Slug" readonly style="border: 1px dashed #3498db;">
                            <label for="actual_slug" class="ms-3">
                                <i class="bi bi-link-45deg me-2"></i> Generated Final Slug (No Numbers)
                            </label>
                        </div>
                    </div>

                    {{-- 5. Phone Number Field --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-pill border-info" name="phone"
                                value="{{ old('phone') }}" placeholder="Phone Number" required>
                            <label class="ms-3">
                                <i class="bi bi-telephone me-2"></i> Phone Number
                            </label>
                        </div>
                    </div>

                    {{-- 6. Role Selection (Admin, Manager, Staff, Chef) --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select rounded-pill border-info" name="role" required>
                                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Manager" {{ old('role') == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="Staff" {{ old('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="Chef" {{ old('role') == 'Chef' ? 'selected' : '' }}>Chef</option>
                            </select>
                            <label class="ms-3">
                                <i class="bi bi-shield-lock me-2"></i> Role
                            </label>
                        </div>
                    </div>

                    {{-- 7. Residential Address: Textarea for full address --}}
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control border-info" name="address" placeholder="Address"
                                style="height: 100px; border-radius: 20px;">{{ old('address') }}</textarea>
                            <label class="ms-3">
                                <i class="bi bi-geo-alt me-2"></i> Residential Address
                            </label>
                        </div>
                    </div>

                    {{-- 8. Profile Picture: Custom Styled File Input --}}
                    <div class="col-md-6">
                        <div class="p-1 ps-3 border rounded-pill"
                            style="height: 58px; border: 1px solid #dee2e6 !important;">
                            <label class="text-muted small d-block" style="margin-top: -2px; font-size: 0.75rem;">Profile Picture</label>
                            <input type="file" class="form-control border-0 bg-transparent p-0" name="picture"
                                style="box-shadow: none; margin-top: -5px;">
                        </div>
                    </div>

                    {{-- 9. Status Selection (Active/Inactive) --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select rounded-pill border-info" id="status" name="status" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <label for="status" class="ms-3">
                                <i class="bi bi-toggle-on me-2"></i> Status
                            </label>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="col-12 text-center mt-5">
                        <button type="submit" class="btn btn-lg rounded-pill px-5 border-0 shadow"
                            style="background: linear-gradient(45deg, #2c3e50, #3498db); color: white; min-width: 250px;">
                            <i class="bi bi-plus-circle me-2"></i> Save Worker Info
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Styling --}}
    <style>
        .rounded-pill { border-radius: 50rem !important; }
        .card { max-width: 850px; margin: 2rem auto; }
        .form-control:focus, .form-select:focus { 
            border-color: #3498db !important; 
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25) !important; 
        }
        .btn { transition: transform 0.3s ease, box-shadow 0.2s ease; }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); }
    </style>

    {{-- JavaScript Logic for Slug --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slugInput = document.getElementById('slug_input');
            const actualSlug = document.getElementById('actual_slug');

            // Function: Jo text se numbers aur special chars hata kar dash lagati hai
            function formatSlug(text) {
                return text.toLowerCase()
                    .replace(/[0-9]/g, '')       // 1. Numbers ko delete karo
                    .replace(/[^a-z\s-]/g, '')   // 2. Sirf letters aur space rehne do
                    .trim()                      // 3. Side ki spaces khatam karo
                    .replace(/\s+/g, '-')        // 4. Beech ki space ko dash banao
                    .replace(/-+/g, '-');        // 5. Double dash ko single karo
            }

            // Jab user "Type Slug Here" mein likhe
            slugInput.addEventListener('input', function() {
                // Input box mein se bhi numbers foran hata do
                this.value = this.value.toLowerCase().replace(/[0-9]/g, '').replace(/[^a-z\s-]/g, '');
                
                // Final "actual_slug" field update karo
                actualSlug.value = formatSlug(this.value);
            });
        });
    </script>
@endsection