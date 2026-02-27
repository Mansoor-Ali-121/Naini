@extends('website.web_temp')
@section('main_website')

    <style>
        .cart-section {
            min-height: 80vh;
            padding-top: 140px;
            padding-bottom: 60px;
            background-color: #f8f9fa;
        }

        .table-cart thead {
            background: #ce1212;
            color: #fff;
        }

        .cart-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .total-box {
            background: #fff;
            border-radius: 15px;
            border-left: 5px solid #ce1212;
        }
    </style>

    <div class="cart-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 style="font-family: 'Amatic SC', sans-serif; font-size: 50px;">Your <span style="color: #ce1212;">Shopping
                        Cart</span></h2>
                <p>Review your selected Mediterranean flavors before checkout.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm p-4 border-0 mb-4">
                        <div class="table-responsive">
                            <table class="table align-middle table-cart">
                                <thead>
                                    <tr>
                                        <th>Dish</th>
                                        <th>Price</th>
                                        <th style="width: 150px;">Quantity</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                            {{-- FIX: data-id yahan TR mein hona chahiye --}}
                                            <tr data-id="{{ $id }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('Menus/menu_picture/' . $details['image']) }}"
                                                            class="cart-img me-3" alt="{{ $details['name'] }}">
                                                        <span class="fw-bold">{{ $details['name'] }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ env('MY_CURRENCY_SYMBOL', '$') }}{{ number_format($details['price'], 2) }}
                                                </td>
                                                <td>
                                                    {{-- FIX: quantity class add ki hai --}}
                                                    <input type="number" value="{{ $details['quantity'] }}"
                                                        class="form-control quantity update-cart" min="1">
                                                </td>
                                                <td class="fw-bold">
                                                    {{ env('MY_CURRENCY_SYMBOL', '$') }}{{ number_format($details['price'] * $details['quantity'], 2) }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('cart.remove', $id) }}"
                                                        class="btn btn-outline-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <i class="bi bi-cart-x text-muted" style="font-size: 40px;"></i>
                                                <p class="mt-2">Aapka cart khali hai. <a href="{{ route('menu') }}"
                                                        class="text-danger">Kuch order karein?</a></p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card total-box p-4 shadow-sm">
                        <h4 class="mb-4">Order Summary</h4>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>{{ env('MY_CURRENCY_SYMBOL', '$') }}{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tax (Estimated)</span>
                            <span>{{ env('MY_CURRENCY_SYMBOL', '$') }}0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong class="fs-5">Total</strong>
                            <strong
                                class="fs-5 text-danger">{{ env('MY_CURRENCY_SYMBOL', '$') }}{{ number_format($total, 2) }}</strong>
                        </div>

                        @auth
                            <a href="#" class="btn btn-danger w-100 py-3 rounded-pill fw-bold">Proceed to Checkout</a>
                        @else
                            <a href="{{ route('login.add') }}"
                                class="btn btn-outline-danger w-100 py-3 rounded-pill fw-bold">Login to Checkout</a>
                        @endauth

                        <a href="{{ route('menu') }}" class="btn btn-link w-100 text-muted mt-2 text-decoration-none">
                            <i class="bi bi-arrow-left"></i> Continue Dining
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script ko update kiya hai --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(".update-cart").on('change', function(e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"), // TR se ID uthayega
                    quantity: ele.val() // Input se value uthayega
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    </script>

@endsection
