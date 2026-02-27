@extends('website.web_temp')

@section('main_website')
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;1,700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        .menu {
            background: #ffffff;
            padding: 80px 0;
            font-family: 'Poppins', sans-serif;
        }

        /* 1. Balanced Headings */
        .section-header h6 {
            font-size: 1.1rem;
            /* Pehle se behtar size */
            letter-spacing: 3px;
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
        }

        .section-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.2rem;
            /* Balanced size */
            color: #1a1a1a;
            font-weight: 800;
            margin-top: 10px;
        }

        /* 2. Sweets Button with Floating Animation */
        .menu .nav-tabs {
            border: none;
            background: #f4f4f4;
            border-radius: 50px;
            padding: 6px;
            display: inline-flex;
        }

        .menu .nav-item {
            animation: floatEffect 3s ease-in-out infinite;
            /* Animation added here */
        }

        @keyframes floatEffect {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .menu .nav-link {
            border: none !important;
            border-radius: 50px;
            padding: 12px 35px;
            color: #444;
            font-weight: 600;
            font-size: 1.1rem;
            transition: 0.3s ease;
        }

        .menu .nav-link.active {
            background: #000;
            color: #fff !important;
        }

        .menu .nav-link:hover {
            color: #ce1212;
        }

        /* 3. Subcategory Styling */
        .sub-header {
            font-size: 1.8rem;
            font-family: 'Playfair Display', serif;
            color: #ce1212;
            font-weight: 700;
            margin-bottom: 30px;
            display: block;
            padding-left: 15px;
            border-left: 4px solid #ce1212;
        }

        /* 4. Menu Card */
        .food-item {
            background: #fff;
            border: 2px solid #f0f0f0;
            border-radius: 20px;
            padding: 20px;
            transition: 0.4s;
            height: 100%;
            text-align: left;
        }

        .food-item:hover {
            border-color: #ce1212;
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        .food-image-wrapper {
            width: 100%;
            height: 260px;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
            position: relative;
        }

        .food-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.6s ease;
        }

        .food-item:hover .food-img {
            transform: scale(1.08);
        }

        /* 5. Food Footer & Plus Button Fix */
        .food-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #f5f5f5;
        }

        .food-price {
            font-size: 1.6rem;
            font-weight: 800;
            color: #000;
        }

        .btn-add {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: 0.4s;
            text-decoration: none;
            border: none;
            outline: none;
        }

        .btn-add:hover {
            background: #ce1212;
            transform: scale(1.1) rotate(90deg);
            border-radius: 50%;
            color: #fff;
        }

        .tag-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 2;
            background: #ce1212;
            color: #fff;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
        }
    </style>

    <section id="menu" class="menu">
        <div class="container text-center">
            <div class="section-header mb-5">
                <h3 class="theme-sub-label">OUR DELICIOUS SELECTION</h3>
                <h2 class="theme-main-title">Menu Specialities</h2>
            </div>

            <div class="mb-5">
                <ul class="nav nav-tabs">
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                data-bs-target="#cat-{{ $category->id }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-content">
                @foreach ($categories as $category)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="cat-{{ $category->id }}">
                        @foreach ($category->subcategories as $sub)
                            <div class="text-start mb-4 mt-5">
                                <span class="theme-category-header">{{ $sub->name }}</span>
                            </div>
                            <div class="row g-4">
                                @foreach ($sub->menus as $item)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="food-item">
                                            <div class="food-image-wrapper">
                                                <span class="tag-badge">Premium</span>
                                                <img src="{{ asset('Menus/menu_picture/' . $item->menu_picture) }}"
                                                    class="food-img">
                                            </div>
                                            <div class="food-info">
                                                <h3 class="food-title">{{ $item->name }}</h3>
                                                <p class="food-desc">{{ Str::limit($item->description, 70) }}</p>
                                                <div class="food-footer">
                                                    <span class="food-price">${{ number_format($item->price, 2) }}</span>
                                                    <a href="{{ route('cart.add', $item->id) }}" class="btn-add">
                                                        <i class="bi bi-plus-lg"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
