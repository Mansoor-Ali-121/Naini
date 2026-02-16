@extends('website.web_temp')
@section('main_website')
    <style>
        .profile-section {
            min-height: 80vh;
            /* Is se footer hamesha neche rahega */
            padding-top: 140px;
            padding-bottom: 60px;
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .profile-card {
            background: #fff;
            border-left: 5px solid #ce1212;
            /* Aapki theme ka red color */
        }

        .booking-card {
            background: #fff;
        }

        .table thead {
            background-color: #f1f1f1;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #000;
        }

        .badge-confirmed {
            background-color: #198754;
            color: #fff;
        }
    </style>

    <div class="profile-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 style="font-family: 'Amatic SC', sans-serif; font-size: 50px;">Welcome Back, <span
                        style="color: #ce1212;">{{ $user->name }}</span></h2>
                <p>Manage your account details and track your restaurant reservations.</p>
            </div>

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card profile-card p-4 shadow-sm h-100">
                        <h4 class="mb-4"><i class="bi bi-person-badge me-2"></i> Account Info</h4>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Full Name</label>
                            <span class="fw-bold">{{ $user->name }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Email Address</label>
                            <span class="fw-bold">{{ $user->email }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Member Since</label>
                            <span class="fw-bold text-danger">{{ $user->created_at->format('d M, Y') }}</span>
                        </div>
                        <hr>
                        <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm w-100 mt-2">Logout</a>
                    </div>
                </div>

                <div class="col-lg-8 mb-4">
                    <div class="card booking-card p-4 shadow-sm h-100">
                        <h4 class="mb-4"><i class="bi bi-calendar-check me-2"></i> My Reservations</h4>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Guests</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookings as $book)
                                        <tr>
                                            <td><i class="bi bi-calendar3 me-2 text-muted"></i>{{ $book->date }}</td>
                                            <td><i class="bi bi-clock me-2 text-muted"></i>{{ $book->time }}</td>
                                            <td><i class="bi bi-people me-2 text-muted"></i>{{ $book->persons }} Persons
                                            </td>
                                            <td>
                                                @if ($book->status == 'confirmed')
                                                    <span class="badge badge-confirmed"><i
                                                            class="bi bi-check-circle me-1"></i> Confirmed</span>
                                                @else
                                                    <span class="badge badge-pending"><i
                                                            class="bi bi-hourglass-split me-1"></i> Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <i class="bi bi-emoji-frown d-block mb-2"
                                                    style="font-size: 30px; color: #ccc;"></i>
                                                No reservations found. <a href="{{ route('reservation.add') }}#book-a-table"
                                                    class="text-danger">Book a table now?</a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
