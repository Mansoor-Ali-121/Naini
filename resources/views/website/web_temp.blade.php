<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themewagon.github.io/yummy-red/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2024 19:58:58 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Naini</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="icon" href="{{ asset('website/assets/img/favicon.png') }}" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/" rel="preconnect">
    <link href="https://fonts.gstatic.com/" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;family=Amatic+SC:wght@400;700&amp;display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('website/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('website/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('website/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('website/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('website/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('website/assets/css/main.css') }}" rel="stylesheet">

    <!-- Extra styling for an enhanced footer (all sections) + fix for social icons hover -->
    <style>
        /* ===== FOOTER ENHANCEMENTS ===== */
        .footer {
            background: #1a1a1a;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.03"><path fill="%23ffffff" d="M20 20h10v10H20zM50 50h10v10H50zM80 80h10v10H80z"/></svg>');
            pointer-events: none;
        }

        .footer .col-lg-3,
        .footer .col-md-6 {
            margin-bottom: 2rem;
        }

        .footer h4 {
            color: #fff;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer h4::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, #ce1212, #ff6f61);
            border-radius: 2px;
        }

        .footer .d-flex {
            gap: 1rem;
        }

        .footer .icon {
            font-size: 2rem;
            color: #ce1212;
            background: rgba(206, 18, 18, 0.1);
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .footer .d-flex:hover .icon {
            background: #ce1212;
            color: #fff;
            transform: scale(1.1) rotate(5deg);
        }

        .footer .address p,
        .footer div p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
            margin: 0;
            transition: color 0.3s ease;
        }

        .footer .d-flex:hover p {
            color: #fff;
        }

        .footer strong {
            color: #fff;
            font-weight: 600;
        }

        .footer .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .footer .social-links a:hover {
            background: #ce1212;
            transform: translateY(-5px);
            border-color: #ff6f61;
            box-shadow: 0 5px 15px rgba(206, 18, 18, 0.3);
        }

        .footer .social-links a:hover i {
            color: #ffffff;
        }

        .footer .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 2rem;
            font-family: 'Inter', sans-serif;
        }

        .footer .copyright p {
            margin-bottom: 0.5rem;
            font-size: 1rem;
            letter-spacing: 0.5px;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .footer .copyright p:first-of-type {
            font-weight: 400;
            background: linear-gradient(135deg, #f3e7e7, #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: inline-block;
        }

        .footer .copyright p:last-of-type {
            font-size: 0.95rem;
        }

        .footer .copyright a {
            color: #ce1212;
            text-decoration: none;
            font-weight: 600;
            position: relative;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer .copyright a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #ce1212, #ff8a7a);
            transition: width 0.3s ease;
        }

        .footer .copyright a:hover {
            color: #ff6f61;
            transform: translateY(-2px);
        }

        .footer .copyright a:hover::after {
            width: 100%;
        }

        .footer .copyright a i {
            margin-right: 4px;
            font-size: 0.9rem;
            color: #ce1212;
            transition: transform 0.3s ease;
        }

        .footer .copyright a:hover i {
            transform: scale(1.2);
        }

        .footer .copyright p:last-of-type::before {
            content: "❤️ ";
            font-size: 0.9rem;
            filter: drop-shadow(0 2px 4px rgba(206, 18, 18, 0.3));
            margin-right: 4px;
            display: inline-block;
            animation: heartbeat 1.5s ease infinite;
        }

        @keyframes heartbeat {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .footer .copyright:hover p {
            opacity: 1;
        }
    </style>
</head>


<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <div class="logo-box">
                    <h1 class="sitename animate-logo mb-0">nai<span>ni</span></h1>
                    <span class="tagline">RESTAURANT</span>
                </div>
            </a>

            <nav id="navmenu" class="navmenu d-flex align-items-center">
                <ul>
                    <li><a href="{{ url('/') }}" class="{{ Route::is('website') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('menu') }}" class="{{ Route::is('menu') ? 'active' : '' }}">Menu</a></li>
                    <li><a href="{{ route('events') }}">Events</a></li>
                    <li><a href="{{ route('chefs') }}">Chefs</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>

                    @guest
                        <li><a href="{{ route('login.add') }}">Login</a></li>
                    @endguest

                    @auth
                        <li><a href="{{ route('user.profile') }}"
                                class="{{ Route::is('user.profile') ? 'active' : '' }}">Profile</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    @endauth

                    <li><a href="{{ route('contacts.add') }}">Contact</a></li>
                    <li class="d-md-none"><a href="{{ route('reservation.add') }}">Book a Table</a></li>
                </ul>

                <div class="mobile-icons d-flex d-xl-none align-items-center ms-auto">
                    <a href="{{ route('cart') }}" class="position-relative me-3">
                        <i class="bi bi-cart fs-4 text-dark"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size: 0.6rem;">
                            {{ count((array) session('cart')) }}
                        </span>
                    </a>
                    <i class="mobile-nav-toggle bi bi-list fs-2"></i>
                </div>
            </nav>

            <div class="header-social-links d-none d-xl-flex align-items-center">
                <a href="{{ route('cart') }}" class="position-relative me-4">
                    <i class="bi bi-cart fs-4 text-dark"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size: 0.6rem;">
                        {{ count((array) session('cart')) }}
                    </span>
                </a>
                <a class="btn-getstarted" href="{{ route('reservation.add') }}">Book a Table</a>
            </div>

        </div>
    </header>
    @yield('main_website')

    <footer id="footer" class="footer dark-background">

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div class="address">
                        <h4>Address</h4>
                        <p>Islamabad, Pakistan</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Contact</h4>
                        <p>
                            <strong>Phone:</strong> <span>+92 3125857568</span><br>
                            <strong>Email:</strong> <span>devmansoor0@gmail.com</span><br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Opening Hours</h4>
                        <p>
                            <strong>Mon-Sun:</strong> <span>11AM - 02AM</span><br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h4>Follow Us</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Naini</strong> <span>All Rights Reserved</span>
            </p>
            <p>Designed and Developed by <a href="https://dev-mansoor.vercel.app/"><i class="bi bi-code-slash"></i>
                    Dev
                    Mansoor</a></p>
        </div>

    </footer>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <script src="{{ asset('website/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('website/assets/js/main.js') }}"></script>

</body>


<!-- Mirrored from themewagon.github.io/yummy-red/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2024 19:59:26 GMT -->

</html>
