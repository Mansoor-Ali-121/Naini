@extends('template')
@section('main_section')

@include('dashboard.includes.alerts')

<div class="card shadow-lg" style="font-family: 'Dancing Script', cursive; border-radius: 15px;">
    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center py-3" 
         style="
            background: linear-gradient(45deg, #2c3e50, #3498db);
            border-radius: 15px 15px 0 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
         ">
        <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            ✏️ Edit Gallery Image
        </h4>
        <div class="d-flex gap-2">
            <a href="{{ route('gallery.show') }}" 
               class="btn btn-outline-light btn-sm rounded-pill px-3"
               style="border-width: 2px;">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <!-- Form Body -->
    <div class="card-body p-4">
        <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row g-4 justify-content-center">
                <!-- Image Upload -->
                <div class="col-md-8">
                    <div class="mb-4 text-center">
                        <div class="image-upload-wrapper border rounded-circle mx-auto" 
                             style="width: 300px; height: 300px; cursor: pointer; background: #f8f9fa;">
                            <img id="galleryPreview" src="{{ asset('Gallery/gallery_pictures/' . $gallery->image) }}" 
                                 class="img-fluid rounded-circle w-100 h-100"
                                 style="object-fit: cover;">
                            <div id="uploadPrompt" class="h-100 d-flex flex-column justify-content-center d-none">
                                <i class="bi bi-images fs-1 text-muted"></i>
                                <span class="text-muted">Upload New Image</span>
                            </div>
                            <input type="file" class="d-none" id="image" name="image" 
                                   accept="image/*" onchange="previewImage()">
                        </div>
                        @error('image')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <small class="text-muted mt-2 d-block">Leave empty to keep current image</small>
                    </div>
                </div>

                <!-- Current Image Hidden Field -->
                <input type="hidden" name="current_image" value="{{ $gallery->image }}">

                <!-- Submit Button -->
                <div class="col-12 text-center">
                    <button type="submit" 
                            class="btn btn-lg rounded-pill px-5 border-0 btn-gradient"
                            style="
                                background: linear-gradient(45deg, #2c3e50, #3498db);
                                color: white;
                                font-size: 1.2rem;
                                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
                                padding: 12px 30px;
                            ">
                        <i class="bi bi-arrow-repeat me-2"></i> Update Image
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Styles -->
<style>
    .image-upload-wrapper {
        transition: all 0.3s ease;
        border: 2px dashed #dee2e6 !important;
    }
    .image-upload-wrapper:hover {
        background: #e9ecef !important;
        border-color: #3498db !important;
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
    .rounded-pill {
        border-radius: 50rem !important;
    }
</style>

<!-- JavaScript -->
<script>
function previewImage() {
    const preview = document.getElementById('galleryPreview');
    const file = document.getElementById('image').files[0];
    const reader = new FileReader();
    const uploadPrompt = document.getElementById('uploadPrompt');

    reader.onloadend = function() {
        preview.src = reader.result;
        uploadPrompt.classList.add('d-none');
    }

    if (file) {
        reader.readAsDataURL(file);
        uploadPrompt.classList.remove('d-none');
    } else {
        preview.src = "{{ asset('Gallery/gallery_pictures/' . $gallery->image) }}";
        uploadPrompt.classList.add('d-none');
    }
}

document.querySelector('.image-upload-wrapper').addEventListener('click', function() {
    document.getElementById('image').click();
});
</script>

@endsection