@extends('website.web_temp')
@section('main_website')

<main class="main">

<!-- Hero Section -->
<section id="hero" class="hero section light-background">

  <div class="container">
    <div class="row gy-4 justify-content-center justify-content-lg-between">
      <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Savor Authentic<br>Mediterranean Flavors</h1>
        <p data-aos="fade-up" data-aos-delay="100">Crafted with passion since 2005 - Where tradition meets innovation</p>
        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
          <a href="#book-a-table" class="btn-get-started">Reserve Your Table</a>
          <a href="https://www.youtube.com/watch?v=RESTAURANT_TOUR_VIDEO" class="glightbox btn-watch-video d-flex align-items-center">
            <i class="bi bi-play-circle"></i>
            <span>Our Culinary Story</span>
          </a>
        </div>
      </div>
      <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
        <img src="{{ asset('website/assets/img/hero-img.png') }}" class="img-fluid animated" alt="Elegant dining setting at La Maison">
      </div>
    </div>
  </div>

</section><!-- /Hero Section -->

<!-- About Section -->
<section id="about" class="about section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>About Us</h2>
    <p><span>Our Story</span> <span class="description-title">Flavors & Passion</span></p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">
      <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
        <img src="{{ asset('website/assets/img/about.jpg') }}" class="img-fluid mb-4" alt="Chef preparing dish in our kitchen">
        <div class="book-a-table">
          <h3>Experience Exceptional Dining</h3>
          <p>Reservations: +1 (555) 123-4567</p>
        </div>
      </div>
      <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
        <div class="content ps-0 ps-lg-5">
          <p class="fst-italic">
            Since 2005, La Maison has been redefining culinary excellence in the heart of the city, blending traditional recipes with modern innovation.
          </p>
          <ul>
            <li><i class="bi bi-check-circle-fill"></i> <span>Locally-sourced seasonal ingredients</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span>Award-winning chef team</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span>Sustainable & ethical practices</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span>Wine pairing expertise</span></li>
          </ul>
          <p>
            Our passion for culinary artistry is reflected in every dish we create. We meticulously craft each menu to showcase the region's finest produce, 
            working closely with local farmers and artisans. The elegant yet comfortable ambiance makes us the perfect choice for both intimate dinners 
            and special celebrations.
          </p>

          <div class="position-relative mt-4">
            <img src="{{ asset('website/assets/img/about-2.jpg') }}" class="img-fluid" alt="Artistic plating of our signature dish">
            <a href="https://www.youtube.com/watch?v=OUR_RESTAURANT_VIDEO" class="glightbox pulsating-play-btn"></a>
          </div>
        </div>
      </div>
    </div>

  </div>

</section><!-- /About Section -->

   <!-- Why Us Section -->
<section id="why-us" class="why-us section light-background">

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="why-box">
          <h3>Why Choose Naini</h3>
          <p>
            For over 18 years, we've perfected the art of fine dining through relentless passion and attention to detail. 
            Our commitment to culinary excellence, sustainable practices, and memorable experiences makes us the preferred 
            choice for discerning diners seeking exceptional Mediterranean cuisine with a modern twist.
          </p>
          <div class="text-center">
            <a href="#menu" class="more-btn"><span>Explore Our Menu</span> <i class="bi bi-chevron-right"></i></a>
          </div>
        </div>
      </div><!-- End Why Box -->

      <div class="col-lg-8 d-flex align-items-stretch">
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

          <div class="col-xl-4">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-clipboard-data"></i>
              <h4>Premium Ingredients</h4>
              <p>Daily-sourced from local farms and trusted international suppliers</p>
            </div>
          </div><!-- End Icon Box -->

          <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-gem"></i>
              <h4>Award-Winning Team</h4>
              <p>Michelin-star trained chefs crafting innovative culinary experiences</p>
            </div>
          </div><!-- End Icon Box -->

          <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
              <i class="bi bi-inboxes"></i>
              <h4>Curated Experiences</h4>
              <p>Personalized wine pairings and seasonal tasting menus</p>
            </div>
          </div><!-- End Icon Box -->

        </div>
      </div>

    </div>

  </div>

</section><!-- /Why Us Section -->

<!-- Stats Section -->
<section id="stats" class="stats section dark-background">

    <img src="{{ asset('website/assets/img/stats-bg.jpg') }}" alt="Stats Background" data-aos="fade-in">
  
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
  
      <div class="row gy-4">
  
        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
            <p>Clients</p>
          </div>
        </div><!-- End Stats Item -->
  
        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
            <p>Projects</p>
          </div>
        </div><!-- End Stats Item -->
  
        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
            <p>Hours Of Support</p>
          </div>
        </div><!-- End Stats Item -->
  
        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
            <p>Workers</p>
          </div>
        </div><!-- End Stats Item -->
  
      </div>
  
    </div>
  
  </section><!-- /Stats Section -->
  
  <!-- Testimonials Section -->
<section id="testimonials" class="testimonials section light-background">


    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>TESTIMONIALS</h2>
      <p>What Are They <span class="description-title">Saying About Us</span></p>
    </div><!-- End Section Title -->
  
    <div class="container" data-aos="fade-up" data-aos-delay="100">
  
      <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            }
          }
        </script>
        <div class="swiper-wrapper">
  
          <div class="swiper-slide">
            <div class="testimonial-item">
              <div class="row gy-4 justify-content-center">
                <div class="col-lg-6">
                  <div class="testimonial-content">
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                    <h3>Saul Goodman</h3>
                    <h4>Ceo &amp; Founder</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 text-center">
                  <img src="{{ asset('website/assets/img/testimonials/testimonials-1.jpg') }}" class="img-fluid testimonial-img" alt="Testimonial Image 1">
                </div>
              </div>
            </div>
          </div><!-- End testimonial item -->
  
          <div class="swiper-slide">
            <div class="testimonial-item">
              <div class="row gy-4 justify-content-center">
                <div class="col-lg-6">
                  <div class="testimonial-content">
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                    <h3>Sara Wilsson</h3>
                    <h4>Designer</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 text-center">
                  <img src="{{ asset('website/assets/img/testimonials/testimonials-2.jpg') }}" class="img-fluid testimonial-img" alt="Testimonial Image 2">
                </div>
              </div>
            </div>
          </div><!-- End testimonial item -->
  
          <div class="swiper-slide">
            <div class="testimonial-item">
              <div class="row gy-4 justify-content-center">
                <div class="col-lg-6">
                  <div class="testimonial-content">
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                    <h3>Jena Karlis</h3>
                    <h4>Store Owner</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 text-center">
                  <img src="{{ asset('website/assets/img/testimonials/testimonials-3.jpg') }}" class="img-fluid testimonial-img" alt="Testimonial Image 3">
                </div>
              </div>
            </div>
          </div><!-- End testimonial item -->
  
          <div class="swiper-slide">
            <div class="testimonial-item">
              <div class="row gy-4 justify-content-center">
                <div class="col-lg-6">
                  <div class="testimonial-content">
                    <p>
                      <i class="bi bi-quote quote-icon-left"></i>
                      <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                      <i class="bi bi-quote quote-icon-right"></i>
                    </p>
                    <h3>John Larson</h3>
                    <h4>Entrepreneur</h4>
                    <div class="stars">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 text-center">
                  <img src="{{ asset('website/assets/img/testimonials/testimonials-4.jpg') }}" class="img-fluid testimonial-img" alt="Testimonial Image 4">
                </div>
              </div>
            </div>
          </div><!-- End testimonial item -->
  
        </div>
        <div class="swiper-pagination"></div>
      </div>
  
    </div>
  
  </section><!-- /Testimonials Section -->

  </main>

    
@endsection