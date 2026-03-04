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
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 10px;
        }

        .total-box {
            background: #fff;
            border-radius: 15px;
            border-left: 5px solid #ce1212;
            position: sticky;
            top: 100px;
        }

        .qty-input {
            max-width: 120px;
        }

        .qty-input .btn {
            background: #fff;
            border: 1px solid #ced4da;
            color: #ce1212;
            font-weight: bold;
            padding: 0.25rem 0.5rem;
        }

        .qty-input .form-control {
            text-align: center;
            font-weight: bold;
            border-left: 0;
            border-right: 0;
            height: 35px;
        }

        .currency-card {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }
    </style>

    <div class="cart-section">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 style="font-family: 'Amatic SC', sans-serif; font-size: clamp(35px, 10vw, 50px);">Your <span
                        style="color: #ce1212;">Shopping Cart</span></h2>
            </div>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="table-responsive border-0">
                            <table class="table align-middle table-cart">
                                <thead>
                                    <tr>
                                        <th>Dish</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                            <tr data-id="{{ $id }}">
                                                <td data-label="Dish">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('Menus/menu_picture/' . $details['image']) }}"
                                                            class="cart-img me-3">
                                                        <span class="fw-bold">{{ $details['name'] }}</span>
                                                    </div>
                                                </td>
                                                <td data-label="Price" class="item-price"
                                                    data-base-price="{{ $details['price'] }}">
                                                    $ {{ number_format($details['price'], 2) }}
                                                </td>
                                                <td data-label="Quantity">
                                                    <div class="input-group qty-input">
                                                        <button class="btn btn-minus" type="button">-</button>
                                                        <input type="text" class="form-control quantity"
                                                            value="{{ $details['quantity'] }}" readonly>
                                                        <button class="btn btn-plus" type="button">+</button>
                                                    </div>
                                                </td>
                                                <td data-label="Subtotal" class="fw-bold text-danger item-subtotal">
                                                    $ {{ number_format($details['price'] * $details['quantity'], 2) }}
                                                </td>
                                                <td data-label="Remove">
                                                    <a href="{{ route('cart.remove', $id) }}"
                                                        class="btn btn-outline-danger btn-sm rounded-pill">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center py-5 border-0">
                                                <p class="text-muted">Aapka cart khali hai. <a href="{{ route('menu') }}"
                                                        class="text-danger fw-bold">Order Karein</a></p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="currency-card shadow-sm">
                            <label class="fw-bold mb-2"><i class="bi bi-currency-exchange me-2"></i> Select Payment
                                Currency</label>
                            <select name="currency" id="currency_choice" class="form-select">
                                <option value="usd" selected>USD (US Dollar - Default)</option>
                                <option value="pkr">PKR (Pakistani Rupee)</option>
                            </select>
                            <small class="text-muted mt-2 d-block">* 1 USD = 280 PKR</small>
                        </div>

                        <div class="card total-box p-4 shadow-sm border-0">
                            <h4 class="mb-4 fw-bold">Order Summary</h4>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span id="summary-subtotal">$ {{ number_format($total, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <strong class="fs-5">Total</strong>
                                <strong class="fs-5 text-danger" id="summary-total">$
                                    {{ number_format($total, 2) }}</strong>
                            </div>

                            @auth
                                <button type="submit" class="btn btn-danger w-100 py-3 rounded-pill fw-bold shadow-sm">Proceed
                                    to Checkout</button>
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
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const exchangeRate = 280;

        $("#currency_choice").change(function() {
            updateDisplay();
        });

        $(".btn-plus, .btn-minus").click(function() {
            var input = $(this).parent().find("input");
            var currentVal = parseInt(input.val());
            if ($(this).hasClass('btn-plus')) {
                input.val(currentVal + 1);
            } else if (currentVal > 1) {
                input.val(currentVal - 1);
            }
            updateCartAjax(input);
        });

        function updateDisplay() {
            var currency = $("#currency_choice").val();
            var symbol = (currency === 'pkr') ? 'PKR ' : '$ '; // Fix: DB currency format
            var total = 0;

            $("tr[data-id]").each(function() {
                var basePrice = parseFloat($(this).find(".item-price").data("base-price"));
                var qty = parseInt($(this).find(".quantity").val());

                var currentPrice = (currency === 'pkr') ? (basePrice * exchangeRate) : basePrice;
                var subtotal = currentPrice * qty;
                total += subtotal;

                $(this).find(".item-price").text(symbol + currentPrice.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                }));
                $(this).find(".item-subtotal").text(symbol + subtotal.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                }));
            });

            $("#summary-subtotal").text(symbol + total.toLocaleString(undefined, {
                minimumFractionDigits: 2
            }));
            $("#summary-total").text(symbol + total.toLocaleString(undefined, {
                minimumFractionDigits: 2
            }));
        }

        function updateCartAjax(ele) {
            var rowId = ele.parents("tr").attr("data-id");
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: rowId,
                    quantity: ele.val()
                },
                success: function() {
                    updateDisplay();
                }
            });
        }
    </script>
@endsection