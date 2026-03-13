@extends('website.web_temp')

@section('main_website')
    <!-- Google Fonts & Bootstrap Icons -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* ===== MODERN VARIABLES ===== */
        :root {
            --primary: #ce1212;
            --primary-dark: #a50e0e;
            --secondary: #1a1a1a;
            --accent: #f9a826;
            --light: #f8f9fa;
            --dark: #212529;
            --gradient: linear-gradient(135deg, #ce1212 0%, #ff6f61 100%);
            --shadow-sm: 0 10px 30px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 20px 40px rgba(206, 18, 18, 0.15);
            --border-radius: 24px;
        }

        .detail-section {
            padding: 60px 0 100px;
            background: #ffffff;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* ===== TOP BAR ===== */
        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 18px;
            background: white;
            border-radius: 40px;
            box-shadow: var(--shadow-sm);
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--secondary);
            text-decoration: none;
            transition: 0.3s;
            border: 1px solid rgba(0, 0, 0, 0.05);
            white-space: nowrap;
        }

        .btn-back:hover {
            box-shadow: var(--shadow-hover);
            transform: translateX(-5px);
            color: var(--primary);
        }

        .chef-tag {
            background: var(--gradient);
            color: white;
            padding: 6px 18px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(206, 18, 18, 0.3);
            white-space: nowrap;
        }

        /* ===== IMAGE SHOWCASE ===== */
        .image-container {
            position: sticky;
            top: 100px;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: 0.5s ease;
            border: 1px solid rgba(206, 18, 18, 0.1);
        }

        .image-container:hover {
            box-shadow: var(--shadow-hover);
        }

        .main-food-img {
            width: 100%;
            height: 550px;
            object-fit: cover;
            transition: transform 0.7s cubic-bezier(0.2, 0.9, 0.3, 1);
        }

        .image-container:hover .main-food-img {
            transform: scale(1.05);
        }

        /* Floating animation */
        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* ===== CONTENT STYLING ===== */
        .detail-header {
            padding-left: 15px;
        }

        .detail-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.8rem;
            font-weight: 800;
            color: var(--secondary);
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: -0.02em;
        }

        /* New meta row for category and rating */
        .meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .category-badge {
            display: inline-block;
            background: rgba(206, 18, 18, 0.08);
            color: var(--primary);
            padding: 6px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: 1px solid rgba(206, 18, 18, 0.2);
            backdrop-filter: blur(4px);
        }

        /* rating stars */
        .rating-wrapper {
            background: #f8f9fa;
            padding: 6px 18px;
            border-radius: 40px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .stars i {
            color: #ffb347;
            margin-right: 2px;
        }

        /* price tag with gradient and background */
        .price-tag {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ce1212, #ff8a7a, #ce1212);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 15px 0 20px;
            line-height: 1;
            animation: shine 4s linear infinite;
            display: inline-block;
            padding: 0 5px;
        }

        @keyframes shine {
            to {
                background-position: 200% center;
            }
        }

        /* enhanced description box */
        .description-box.enhanced {
            font-size: 1.1rem;
            line-height: 1.9;
            color: #4a4a4a;
            background: linear-gradient(145deg, #ffffff, #fafafa);
            padding: 30px;
            border-radius: 20px;
            border-left: 5px solid var(--primary);
            margin: 30px 0;
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.02), 0 10px 20px rgba(206, 18, 18, 0.05);
            position: relative;
            overflow: hidden;
        }

        .description-box.enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(206, 18, 18, 0.03) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* features grid with icons */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 30px 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            background: #f8f9fa;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.3, 1);
            border: 1px solid transparent;
        }

        .feature-item:hover {
            transform: translateY(-5px) scale(1.02);
            background: white;
            border-color: var(--primary);
            box-shadow: 0 10px 25px rgba(206, 18, 18, 0.15);
        }

        .feature-item i {
            font-size: 1.5rem;
            color: var(--primary);
            transition: transform 0.3s;
        }

        .feature-item:hover i {
            transform: rotate(360deg);
        }

        .feature-item span {
            font-weight: 500;
            color: #2d2d2d;
        }

        /* ===== ACTION AREA ===== */
        .action-area {
            background: white;
            padding: 25px;
            border-radius: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 0, 0, 0.03);
            margin-top: 40px;
        }

        .btn-buy {
            background: var(--secondary);
            color: white;
            padding: 16px 40px;
            border-radius: 60px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: 0.4s;
            width: 100%;
            text-align: center;
            text-decoration: none;
            border: none;
            font-size: 1.1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-buy:hover {
            background: var(--primary);
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(206, 18, 18, 0.3);
            color: white;
        }

        /* ===== RELATED SECTION ===== */
        .related-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.6rem;
            font-weight: 800;
            margin: 80px 0 30px;
            position: relative;
            display: inline-block;
        }

        .related-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60%;
            height: 4px;
            background: var(--gradient);
            border-radius: 4px;
        }

        .mini-card {
            border-radius: 20px;
            overflow: hidden;
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            transition: 0.4s;
            text-decoration: none;
            color: inherit;
            display: block;
            border: 1px solid #f0f0f0;
            height: 100%;
        }

        .mini-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 40px rgba(206, 18, 18, 0.1);
            border-color: transparent;
        }

        .mini-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: 0.6s;
        }

        .mini-card:hover img {
            transform: scale(1.08);
        }

        .mini-card-body {
            padding: 20px 15px;
            text-align: center;
        }

        .mini-card-body h6 {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 8px;
            color: var(--secondary);
        }

        .mini-card-body .price {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.3rem;
            background: rgba(206, 18, 18, 0.05);
            padding: 5px 15px;
            border-radius: 40px;
            display: inline-block;
        }

        /* ===== RESPONSIVE FIXES ===== */
        @media (max-width: 768px) {
            .detail-header h1 {
                font-size: 2.5rem;
            }

            .main-food-img {
                height: 350px;
            }

            .image-container {
                position: relative;
                top: 0;
            }

            .container {
                padding-left: 20px;
                padding-right: 20px;
            }

            .meta-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .detail-header h1 {
                font-size: 2rem;
            }

            .price-tag {
                font-size: 3rem;
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 8px;
                /* Gap kam karein */
            }

            .feature-item {
                padding: 8px 5px !important;
                /* Padding kam karein */
                font-size: 0.75rem !important;
                /* Font size chota karein */
                text-align: center;
                flex-direction: column;
                /* Icon ko text ke upar layein */
                gap: 4px !important;
            }

            .feature-item i {
                font-size: 1rem !important;
                /* Icon size chota karein */
            }

            .main-food-img {
                height: 280px;
            }

            .description-box.enhanced {
                padding: 20px;
                font-size: 1rem;
            }

            .top-bar {
                gap: 8px;
            }

            .btn-back,
            .chef-tag {
                white-space: normal;
                font-size: 0.85rem;
                padding: 6px 12px;
            }

            .btn-buy {
                padding: 12px 20px !important;
                /* Button ko thoda compact banayein */
                font-size: 0.95rem !important;
                /* Font size thoda chota karein */
                border-radius: 40px !important;
                margin-top: 10px !important;
                /* Thoda gap dene ke liye */
            }

            .btn-buy i {
                font-size: 1rem !important;
                /* Icon ka size bhi manage karein */
            }

            /* Related Items grid ko thoda space dein */
            .row.row-cols-2 {
                --bs-gutter-x: 10px;
                /* Column ke beech ka horizontal gap */
                --bs-gutter-y: 20px;
                /* Rows ke beech ka vertical gap */
            }

            /* Cards ko thoda sa breath karne ki jagah dein */
            .mini-card {
                border-radius: 15px !important;
                margin-bottom: 5px;
            }

            /* Image aur Content ka balance */
            .mini-card img {
                height: 120px !important;
                /* Height kam karein taaki card balanced lage */
            }

            .mini-card-body {
                padding: 10px 8px !important;
            }

            .mini-card-body h6 {
                font-size: 0.85rem !important;
                margin-bottom: 5px !important;
                line-height: 1.2;
            }

            .mini-card-body .price {
                font-size: 0.95rem !important;
                padding: 2px 8px !important;
            }

            .related-title {
                font-size: 1.8rem !important;
                margin: 40px 0 20px;
            }
        }
    </style>

    <div class="detail-section">
        <div class="container position-relative">
            <!-- Top bar -->
            <div class="top-bar">
                <a href="{{ route('menu') }}" class="btn-back">
                    <i class="bi bi-arrow-left-short"></i> Back to Menu
                </a>
                <span class="chef-tag">
                    <i class="bi bi-star-fill me-1"></i> Chef's Special
                </span>
            </div>

            <!-- Main row -->
            <div class="row g-4 align-items-start">
                <div class="col-lg-6">
                    <div class="image-container floating">
                        <img src="{{ asset('Menus/menu_picture/' . $menuItem->menu_picture) }}" class="main-food-img"
                            alt="{{ $menuItem->name }}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="detail-header">
                        <!-- New meta row with category and rating side by side -->
                        <div class="meta-row">
                            <span class="category-badge">{{ $menuItem->subcategory->name }}</span>
                            <div class="rating-wrapper">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="text-muted">(128 reviews)</span>
                            </div>
                        </div>

                        <h1>{{ $menuItem->name }}</h1>

                        <!-- Price -->
                        <div class="price-tag">${{ number_format($menuItem->price, 2) }}</div>

                        <!-- Description box -->
                        <div class="description-box enhanced">
                            <i class="bi bi-quote fs-1 text-danger opacity-25 me-2"></i>
                            {{ $menuItem->description }}
                        </div>

                        <!-- Feature grid -->
                        <div class="features-grid">
                            <div class="feature-item">
                                <i class="bi bi-egg-fried"></i>
                                <span>Fresh Ingredients</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-droplet"></i>
                                <span>Custom Spice Level</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-clock"></i>
                                <span>20-30 Min Delivery</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-patch-check"></i>
                                <span>Quality Assured</span>
                            </div>
                        </div>

                        <!-- Add to cart -->
                        <div class="action-area">
                            <form action="{{ route('cart.add', $menuItem->id) }}" method="GET" class="w-100">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn-buy">
                                    <i class="bi bi-cart-plus fs-5"></i> Add to Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Items -->
            @if (isset($relatedItems) && $relatedItems->count() > 0)
                <h2 class="related-title">You Might Also Like</h2>
                <div class="row row-cols-2 row-cols-lg-4 g-3 g-lg-4">
                    @foreach ($relatedItems as $related)
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('menu.detail', $related->actual_slug) }}" class="mini-card">
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ asset('Menus/menu_picture/' . $related->menu_picture) }}"
                                        alt="{{ $related->name }}">
                                    @if ($loop->first)
                                        <span
                                            class="position-absolute top-0 end-0 bg-danger text-white px-3 py-1 small fw-bold"
                                            style="border-radius: 0 0 0 15px;">Popular</span>
                                    @endif
                                </div>
                                <div class="mini-card-body">
                                    <h6>{{ $related->name }}</h6>
                                    <span class="price">${{ number_format($related->price, 2) }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
