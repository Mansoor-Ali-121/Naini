@extends('website.web_temp')
@section('main_website')

    <!-- Book A Table Section -->
    <section id="book-a-table" class="book-a-table section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Book A Table</h2>
            <p><span>Book Your</span> <span class="description-title">Stay With Us<br></span></p>
        </div><!-- End Section Title -->

@include('dashboard.includes.alerts')

        <div class="container">

            <div class="row g-0" data-aos="fade-up" data-aos-delay="100">

                <!-- Reservation Image -->
                <div class="col-lg-4 reservation-img"
                    style="background-image: url({{ asset('website/assets/img/reservation.jpg') }});"></div>

                <!-- Reservation Form -->
                <div class="col-lg-8 d-flex align-items-center reservation-form-bg" data-aos="fade-up" data-aos-delay="200">
                    <form action="{{ route('reservation.add') }}" method="post" role="form" class="php-email-form">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-lg-4 col-md-6">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email"required>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="text" class="form-control" name="phone" id="phone"
                                    placeholder="Your Phone" required>
                                @error('phone')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="date" name="date" class="form-control" id="date"
                                    placeholder="Date"required>
                                @error('date')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="time" class="form-control" name="time" id="time"
                                    placeholder="Time"required>
                                @error('time')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="number" class="form-control" name="persons" id="persons"
                                    placeholder="# of people"required>
                                @error('persons')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                            @error('message')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center mt-3">
                            <div class="loading">Loading</div>
                            @if ($errors->any())
                                <div class="error-message">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li class="text-danger">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="sent-message">Your booking request was sent. We will call back or send an Email to
                                confirm your reservation. Thank you!</div>
                            <button type="submit">Book a Table</button>
                        </div>
                    </form>
                </div><!-- End Reservation Form -->

            </div>

        </div>

    </section><!-- /Book A Table Section -->

@endsection
