@extends('website.web_temp')
@section('main_website')
    <!-- Menu Section -->
    <section id="menu" class="menu section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Menu</h2>
            <p><span>Mediterranean</span> <span class="description-title">Culinary Journey</span></p>
        </div><!-- End Section Title -->

        <div class="container">
            {{-- SHow Category  --}}
            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-mezze">
                        <h4>Mezze</h4>
                    </a>
                </li>
            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                <!-- Mezze Tab -->
                <div class="tab-pane fade active show" id="menu-mezze">

                    <div class="row gy-5">
                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('website/assets/img/menu/menu-item-1.png') }}" class="glightbox">
                                <img src="{{ asset('website/assets/img/menu/menu-item-1.png') }}" class="menu-img img-fluid"
                                    alt="Traditional Lebanese Hummus">
                            </a>
                            <h4>Hummus Maqluba</h4>
                            <p class="ingredients">
                                Chickpea purée with tahini, lemon & smoked paprika<br>
                                Served with fresh pita
                            </p>
                            <p class="price">
                                €9.50
                            </p>
                        </div>

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('website/assets/img/menu/menu-item-2.png') }}" class="glightbox">
                                <img src="{{ asset('website/assets/img/menu/menu-item-2.png') }}" class="menu-img img-fluid"
                                    alt="Traditional Lebanese Hummus">

                            </a>
                            <h4>Hummus Maqluba</h4>
                            <p class="ingredients">
                                Chickpea purée with tahini, lemon & smoked paprika<br>
                                Served with fresh pita
                            </p>
                            <p class="price">
                                €9.50
                            </p>
                        </div>

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('website/assets/img/menu/menu-item-3.png') }}" class="glightbox">
                                <img src="{{ asset('website/assets/img/menu/menu-item-3.png') }}" class="menu-img img-fluid"
                                    alt="Traditional Lebanese Hummus">

                            </a>
                            <h4>Hummus Maqluba</h4>
                            <p class="ingredients">
                                Chickpea purée with tahini, lemon & smoked paprika<br>
                                Served with fresh pita
                            </p>
                            <p class="price">
                                €9.50
                            </p>
                        </div>

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('website/assets/img/menu/menu-item-4.png') }}" class="glightbox">
                                <img src="{{ asset('website/assets/img/menu/menu-item-4.png') }}" class="menu-img img-fluid"
                                    alt="Traditional Lebanese Hummus">

                            </a>
                            <h4>Hummus Maqluba</h4>
                            <p class="ingredients">
                                Chickpea purée with tahini, lemon & smoked paprika<br>
                                Served with fresh pita
                            </p>
                            <p class="price">
                                €9.50
                            </p>
                        </div>

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('website/assets/img/menu/menu-item-5.png') }}" class="glightbox">
                                <img src="{{ asset('website/assets/img/menu/menu-item-5.png') }}" class="menu-img img-fluid"
                                    alt="Grilled Mediterranean Octopus">

                            </a>
                            <h4>Grilled Octopus</h4>
                            <p class="ingredients">
                                Tenderized octopus, charred lemon,<br>
                                Cretan olive oil & oregano
                            </p>
                            <p class="price">
                                €18.00
                            </p>
                        </div>

                        <div class="col-lg-4 menu-item">
                            <a href="{{ asset('website/assets/img/menu/menu-item-6.png') }}" class="glightbox">
                                <img src="{{ asset('website/assets/img/menu/menu-item-6.png') }}"
                                    class="menu-img img-fluid" alt="Greek Spinach Pie">

                            </a>
                            <h4>Spanakopita</h4>
                            <p class="ingredients">
                                Phyllo pastry filled with spinach,<br>
                                feta & fresh herbs
                            </p>
                            <p class="price">
                                €12.50
                            </p>
                        </div>
                    </div>
                </div><!-- End Mezze Tab -->
            </div>

        </div>

    </section><!-- /Menu Section -->

    <style>
        /* Add these styles to your existing CSS */
        .menu-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
        }

        .menu-img {
            transition: all 0.3s ease;
            position: relative;
        }

        .menu-item:hover .menu-img {
            transform: scale(1.05);
        }

        .glightbox::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .menu-item:hover .glightbox::before {
            opacity: 1;
        }
    </style>
@endsection
