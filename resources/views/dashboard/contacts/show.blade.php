@extends('template')
@section('main_section')

@include('dashboard.includes.alerts')

<div class="card shadow-lg border-0" style="border-radius: 15px;">
    <div class="card-header d-flex justify-content-between align-items-center py-3" 
         style="background: linear-gradient(45deg, #2c3e50, #3498db); border-radius: 15px 15px 0 0; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
        <h4 class="mb-0 text-white" style="font-size: 1.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            📞 Contact Inquiries
        </h4>
        <div class="d-flex gap-2">
            <a href="{{ url()->previous() }}" class="btn btn-outline-light btn-sm rounded-pill px-3" style="border-width: 2px;">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
            <a href="{{ route('contacts.add') }}" class="btn btn-light btn-sm rounded-pill px-3" style="border-width: 2px; color: #2c3e50;">
                <i class="bi bi-plus-lg me-1"></i> Add Manual Entry
            </a>
        </div>
    </div>

    <div class="card-body p-4">
        @if ($contacts->isEmpty())
        <div class="alert alert-warning alert-dismissible fade show rounded-pill" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> No contacts found.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light-header">
                    <tr>
                        <th class="py-3 ps-4" style="width: 80px;">#ID</th>
                        <th class="py-3">User Info</th>
                        <th class="py-3">Subject</th>
                        <th class="py-3">Message Snippet</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#{{ $contact->id }}</td>
                        
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $contact->name }}</div>
                                    <small class="text-primary">{{ $contact->email }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="badge bg-soft-info text-info border border-info rounded-pill px-3">
                                {{ $contact->subject }}
                            </span>
                        </td>

                        <td>
                            <p class="mb-0 text-muted" style="font-size: 0.85rem; max-width: 250px; line-height: 1.2;">
                                {{ Str::limit($contact->message, 60) }}
                            </p>
                        </td>

                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('contacts.edit', $contact->id) }}" 
                                   class="btn btn-sm btn-action rounded-pill px-3"
                                   data-bs-toggle="tooltip" title="Edit/View Details">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </a>
                                <form action="{{ route('contacts.delete', $contact->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-action rounded-pill px-3" 
                                            onclick="return confirm('Are you sure you want to delete this contact?')"
                                            data-bs-toggle="tooltip" title="Delete Inquiry">
                                        <i class="bi bi-trash3 text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<style>
    .bg-light-header {
        background-color: #f8faff !important;
        border-bottom: 2px solid #edf2f9;
    }

    .avatar-circle {
        width: 40px;
        height: 40px;
        background: #3498db;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .bg-soft-info {
        background-color: rgba(52, 152, 219, 0.1);
    }

    .table-hover tbody tr {
        transition: all 0.2s;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.04) !important;
    }

    .btn-action {
        background: #fff;
        border: 1px solid #eee;
    }

    .btn-action:hover {
        background: #f8f9fa;
        border-color: #3498db;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })
</script>

@endsection