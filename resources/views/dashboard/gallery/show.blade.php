@extends('template')
@section('main_section')

    @include('dashboard.includes.alerts')

    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
            style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                🖼️ Gallery Management
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3" style="border-width: 2px;">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <a href="{{ route('gallery.add') }}" class="btn btn-light btn-sm rounded-pill px-3" style="border-width: 2px; color: #2c3e50;">
                    <i class="bi bi-plus-lg me-1"></i> Add New Image
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            @if ($galleries->isEmpty())
                <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> No images found in gallery.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($galleries as $gallery)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="gallery-card shadow-sm border-0 h-100 position-relative">
                                <span class="badge bg-dark position-absolute top-0 start-0 m-2" style="z-index: 5; opacity: 0.8;">
                                    #{{ $gallery->id }}
                                </span>

                                <div class="gallery-overlay">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('gallery.edit', $gallery->id) }}" 
                                           class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                           data-bs-toggle="tooltip" title="Edit">
                                            <i class="bi bi-pencil-square text-primary"></i>
                                        </a>
                                        <form action="{{ route('gallery.delete', $gallery->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm" 
                                                    onclick="return confirm('Delete this image?')"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="image-wrapper">
                                    <img src="{{ asset('Gallery/gallery_pictures/' . $gallery->image) }}"
                                         class="img-fluid rounded" 
                                         style="height: 250px; width: 100%; object-fit: cover;"
                                         onerror="this.src='{{ asset('default-gallery.png') }}'">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <style>
        .gallery-card {
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            transition: all 0.3s ease;
        }

        .image-wrapper {
            overflow: hidden;
            border-radius: 12px;
        }

        .image-wrapper img {
            transition: transform 0.5s ease;
        }

        .gallery-card:hover .image-wrapper img {
            transform: scale(1.1);
        }

        /* Hover Overlay Logic */
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
            border-radius: 12px;
        }

        .gallery-card:hover .gallery-overlay {
            opacity: 1;
        }

        /* Tooltip animation */
        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>

@endsection