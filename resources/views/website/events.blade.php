@extends('website.web_temp')
@section('main_website')

<!-- Events Section -->
<section id="events" class="events section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Events</h2>
    <p><span>Create</span> <span class="description-title">Unforgettable Moments</span></p>
  </div><!-- End Section Title -->

  <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "keyboard": {
            "enabled": true
          },
          "navigation": {
            "nextEl": ".swiper-button-next",
            "prevEl": ".swiper-button-prev"
          },
          "slidesPerView": "auto",
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 20
            },
            "992": {
              "slidesPerView": 2,
              "spaceBetween": 30
            },
            "1200": {
              "slidesPerView": 3,
              "spaceBetween": 40
            }
          }
        }
      </script>
      <div class="swiper-wrapper">

        <div class="swiper-slide event-item d-flex flex-column justify-content-end" 
             style="background-image: url({{ asset('website/assets/img/events-1.jpg') }})"
             aria-label="Private wine tasting event">
          <div class="event-content">
            <h3>Sommelier Dinners</h3>
            <div class="price align-self-start">From $1500</div>
            <div class="event-details">
              <p class="description">
                Exclusive 5-course menu paired with rare vintages from our cellar. Perfect for corporate events or intimate gatherings.
              </p>
              <ul class="event-features">
                <li><i class="bi bi-person-check"></i> Up to 20 guests</li>
                <li><i class="bi bi-clock"></i> 3-hour experience</li>
                <li><i class="bi bi-cup-straw"></i> Wine pairing included</li>
              </ul>
            </div>
            <button class="btn-event-cta">Request Proposal</button>
          </div>
        </div><!-- End Event item -->

        <div class="swiper-slide event-item d-flex flex-column justify-content-end" 
             style="background-image: url({{ asset('website/assets/img/events-2.jpg') }})"
             aria-label="Wedding reception setup">
          <div class="event-content">
            <h3>Wedding Receptions</h3>
            <div class="price align-self-start">Packages from $15k</div>
            <div class="event-details">
              <p class="description">
                Full-service wedding planning with custom menus, floral arrangements, and dedicated event coordinators.
              </p>
              <ul class="event-features">
                <li><i class="bi bi-people"></i> 50-300 guests</li>
                <li><i class="bi bi-palette"></i> Custom theme design</li>
                <li><i class="bi bi-music-note"></i> Entertainment planning</li>
              </ul>
            </div>
            <button class="btn-event-cta">Schedule Consultation</button>
          </div>
        </div><!-- End Event item -->

        <div class="swiper-slide event-item d-flex flex-column justify-content-end" 
             style="background-image: url({{ asset('website/assets/img/events-3.jpg') }})"
             aria-label="Corporate networking event">
          <div class="event-content">
            <h3>Corporate Events</h3>
            <div class="price align-self-start">Tailored Pricing</div>
            <div class="event-details">
              <p class="description">
                Sophisticated spaces for product launches, board meetings, and executive retreats with AV capabilities.
              </p>
              <ul class="event-features">
                <li><i class="bi bi-projector"></i> Full AV setup</li>
                <li><i class="bi bi-file-text"></i> Branded materials</li>
                <li><i class="bi bi-wifi"></i> High-speed internet</li>
              </ul>
            </div>
            <button class="btn-event-cta">Download Brochure</button>
          </div>
        </div><!-- End Event item -->

        <div class="swiper-slide event-item d-flex flex-column justify-content-end" 
             style="background-image: url({{ asset('website/assets/img/events-4.jpg') }})"
             aria-label="Anniversary celebration">
          <div class="event-content">
            <h3>Milestone Celebrations</h3>
            <div class="price align-self-start">From $250/guest</div>
            <div class="event-details">
              <p class="description">
                Bespoke celebrations for anniversaries, graduations, and retirements with personalized menus and decor.
              </p>
              <ul class="event-features">
                <li><i class="bi bi-camera"></i> Professional photography</li>
                <li><i class="bi bi-gift"></i> Custom favors</li>
                <li><i class="bi bi-flower1"></i> Floral arrangements</li>
              </ul>
            </div>
            <button class="btn-event-cta">Start Planning</button>
          </div>
        </div><!-- End Event item -->

      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </div>

</section><!-- /Events Section -->

<style>
.event-item {
  min-height: 600px;
  background-size: cover;
  background-position: center;
  border-radius: 15px;
  overflow: hidden;
  position: relative;
}

.event-content {
  background: linear-gradient(transparent 0%, rgba(0,0,0,0.8) 60%);
  padding: 2rem;
  color: white;
  position: relative;
  z-index: 1;
}

.btn-event-cta {
  background: #c9a135;
  color: white;
  border: none;
  padding: 12px 25px;
  border-radius: 25px;
  font-weight: 600;
  margin-top: 1rem;
  transition: all 0.3s ease;
}

.btn-event-cta:hover {
  background: #b08d2d;
  transform: translateY(-2px);
}

.event-features {
  list-style: none;
  padding-left: 0;
  margin: 1rem 0;
}

.event-features li {
  margin-bottom: 0.5rem;
  display: flex;
  align-items: center;
  gap: 8px;
}

.swiper-button-next, .swiper-button-prev {
  color: #c9a135 !important;
}

.price {
  font-size: 1.5rem;
  font-weight: 700;
  color: #c9a135;
  margin-bottom: 1rem;
}
</style>

@endsection