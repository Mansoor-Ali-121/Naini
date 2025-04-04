@extends('website.web_temp')
@section('main_website')

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
          <img src="{{ asset('website/assets/img/about.jpg') }}" class="img-fluid mb-4" alt="Chef Marco preparing our signature bouillabaisse">
          <div class="book-a-table">
            <h3>Experience Exceptional Dining</h3>
            <p>Reservations: +1 (555) 123-4567</p>
           
          </div>
        </div>
        <div class="col-lg-5" data-aos="fade-up" data-aos-delay="250">
          <div class="content ps-0 ps-lg-5">
            <p class="fst-italic">
              Since 2005, La Maison has redefined Mediterranean culinary excellence in downtown Paris, blending ancestral recipes with contemporary techniques.
            </p>
            <ul>
              <li><i class="bi bi-check-circle-fill"></i> <span>Daily market-fresh ingredients from Marché Bastille</span></li>
              <li><i class="bi bi-check-circle-fill"></i> <span>Led by Chef Marco (3 Michelin stars)</span></li>
              <li><i class="bi bi-check-circle-fill"></i> <span>Zero-waste kitchen initiatives</span></li>
              <li><i class="bi bi-check-circle-fill"></i> <span>300+ curated wines from local vineyards</span></li>
            </ul>
            <p>
              Our culinary philosophy revolves around the Mediterranean trinity - sun, sea, and soil. We work directly with Provençal farmers and 
              Mediterranean fishermen to create seasonal menus that tell a story. The vaulted stone cellar and olive grove patio offer distinct 
              atmospheres for romantic dinners or business gatherings.
            </p>

            <!-- Chef Profile -->
            <div class="chef-profile mt-4">
              <div class="d-flex align-items-center">
                <img src="{{ asset('website/assets/img/chefs/chefs-1.jpg') }}" alt="Chef Marco Lenôtre" class="rounded-circle me-3" width="80">
                <div>
                  <h5>Chef Marco Lenôtre</h5>
                  <p class="text-muted mb-0">Master of Mediterranean Cuisine<br>2019 Bocuse d'Or Finalist</p>
                </div>
              </div>
            </div>

            <!-- Signature Dish -->
            <div class="position-relative mt-4">
              <img src="{{ asset('website/assets/img/about-2.jpg') }}" class="img-fluid" alt="Our signature Bouillabaisse Marseillaise">
              <a href="https://www.youtube.com/watch?v=LA_MAISON_KITCHEN_TOUR" class="glightbox pulsating-play-btn"></a>
              <div class="dish-caption bg-white p-3">
                <h6>Bouillabaisse Marseillaise</h6>
                <p class="small mb-0">Featured in "France's 100 Essential Dishes" - Le Monde</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Sustainability Commitment -->
      <div class="row mt-5" data-aos="fade-up">
        <div class="col-12">
          <div class="commitment-box bg-light p-5 rounded-4">
            <h4 class="mb-3">Our Sustainability Promise</h4>
            <div class="row g-4">
              <div class="col-md-3">
                <div class="text-center">
                  <i class="bi bi-recycle h2 text-success"></i>
                  <p class="mb-0">100% Organic Waste Composted</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="text-center">
                  <i class="bi bi-tree h2 text-success"></i>
                  <p class="mb-0">Carbon-Neutral Since 2020</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="text-center">
                  <i class="bi bi-basket h2 text-success"></i>
                  <p class="mb-0">90% Local Producers</p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="text-center">
                  <i class="bi bi-droplet h2 text-success"></i>
                  <p class="mb-0">Water Conservation Program</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
    </div>
  
  </section><!-- /About Section -->

@endsection