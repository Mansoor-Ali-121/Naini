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
</head>


<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <div class="logo-box">
                    <h1 class="sitename animate-logo">nai<span>ni</span></h1>
                    <span class="tagline">RESTAURANT</span>
                </div>
            </a>

            {{-- navbar  --}}
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="{{ url('/') }}" class="{{ Route::is('website') ? 'active' : '' }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="{{ Route::is('about') ? 'active' : '' }}">About</a>
                    </li>
                    <li>
                        <a href="{{ route('menu') }}" class="{{ Route::is('menu') ? 'active' : '' }}">Menu</a>
                    </li>
                    <li>
                        <a href="{{ route('events') }}" class="{{ Route::is('events') ? 'active' : '' }}">Events</a>
                    </li>
                    <li>
                        <a href="{{ route('chefs') }}" class="{{ Route::is('chefs') ? 'active' : '' }}">Chefs</a>
                    </li>
                    <li>
                        <a href="{{ route('gallery') }}"
                            class="{{ Route::is('gallery') ? 'active' : '' }}">Gallery</a>
                    </li>

                    @guest
                        <li>
                            <a href="{{ route('login.add') }}"
                                class="{{ Route::is('login.add') ? 'active' : '' }}">Login</a>
                        </li>
                    @endguest

                    @auth
                        <li>
                            <a href="{{ route('user.profile') }}"
                                class="{{ Route::is('user.profile') ? 'active' : '' }}">Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">Logout</a>
                        </li>
                    @endauth

                    <li>
                        <a href="{{ route('contacts.add') }}"
                            class="{{ Route::is('contacts.add') ? 'active' : '' }}">Contact</a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('reservation.add') }}">Book a Table</a>

        </div>
    </header>

    @yield('main_website')

{{-- Footer Section --}}
    <footer id="footer" class="footer dark-background">

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div class="address">
                        <h4>Address</h4>
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Contact</h4>
                        <p>
                            <strong>Phone:</strong> <span>+1 5589 55488 55</span><br>
                            <strong>Email:</strong> <span>info@example.com</span><br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Opening Hours</h4>
                        <p>
                            <strong>Mon-Sat:</strong> <span>11AM - 23PM</span><br>
                            <strong>Sunday</strong>: <span>Closed</span>
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
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('website/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('website/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('website/assets/js/main.js') }}"></script>

</body>


<!-- Mirrored from themewagon.github.io/yummy-red/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 28 Dec 2024 19:59:26 GMT -->

</html>
