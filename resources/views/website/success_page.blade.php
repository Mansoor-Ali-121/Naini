@extends('website.web_temp')
@section('main_website')
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        .success-wrapper {
            background: #f8f9fa;
            min-height: 90vh;
            display: flex;
            align-items: center;
            padding: 30px 15px;
            /* Mobile par side padding zaroori hai */
        }

        .receipt-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 20px;
            /* Reduced padding for mobile */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-top: 8px solid #ce1212;
            width: 100%;
        }

        .main-heading {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            /* PC par bada, mobile par media query se adjust hoga */
            color: #212529;
            margin-bottom: 15px;
        }

        .order-details {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 30px;
        }

        /* Mobile Specific Fixes */
        @media (max-width: 576px) {
            .main-heading {
                font-size: 1.8rem;
                /* Mobile par heading thodi choti */
            }

            .receipt-card {
                padding: 30px 15px;
            }

            .btn-continue {
                width: 100%;
                /* Mobile par button full width ho jayega */
                padding: 15px !important;
            }
        }

        .btn-continue {
            background-color: #ce1212;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-continue:hover {
            background-color: #212529;
            color: white;
        }
    </style>

    <div class="success-wrapper" style="padding: 100px 0; background: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                    <div class="receipt-card text-center animate__animated animate__zoomIn"
                        style="background: #fff; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">

                        <div class="mb-4">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                        </div>

                        <h1 class="main-heading" style="font-weight: 700; color: #333;">Order Confirmed!</h1>

                        <p class="text-muted mb-4">Order ID: #{{ $order->id }}</p>

                        <p class="order-details" style="font-size: 1.1rem; color: #555; line-height: 1.6;">
                            Fantastic choice! Your order for
                            <strong>
                                @foreach ($order->items as $item)
                                    {{ $item->menu->name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </strong>
                            has been successfully placed.
                            <br>
                            Total Amount: <strong>{{ $order->currency }}
                                {{ number_format($order->total_amount, 2) }}</strong>.
                            <br>
                            Our chefs are already busy preparing your delicious meal.
                        </p>

                        <a href="{{ route('menu') }}" class="btn btn-continue shadow-sm"
                            style="background: #e74c3c; color: #fff; padding: 12px 30px; border-radius: 30px; text-decoration: none; display: inline-block; margin-top: 20px;">
                            Back to Menu
                        </a>

                        <p class="mt-4 text-muted small">
                            A digital receipt has been sent to <strong>{{ Auth::user()->email }}</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
