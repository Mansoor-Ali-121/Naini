@extends('website.web_temp')
@section('main_website')
    <!-- Gallery Section -->
    <section id="gallery" class="gallery section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Gallery</h2>
            <p><span>Visual Feast</span> <span class="description-title">Behind the Scenes</span></p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Gallery Grid -->
            <div class="row gallery-grid">
                <div class="col-lg-3 col-md-4 col-6 food">
                    <div class="gallery-item">
                        <a class="glightbox" data-gallery="food-gallery"
                            href="{{ asset('website/assets/img/gallery/gallery-1.jpg') }}"
                            data-title="Our Signature Bouillabaisse" data-description="Featured in Michelin Guide 2023">
                            <img src="{{ asset('website/assets/img/gallery/gallery-1.jpg') }}" class="img-fluid"
                                alt="Signature seafood dish with saffron broth">
                            <div class="gallery-overlay">
                                <div class="gallery-caption">Signature Dish</div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-6 ambiance">
                    <div class="gallery-item">
                        <a class="glightbox" data-gallery="ambiance-gallery"
                            href="{{ asset('website/assets/img/gallery/gallery-2.jpg') }}" data-title="Main Dining Room"
                            data-description="Elegant evening ambiance with candle lighting">
                            <img src="{{ asset('website/assets/img/gallery/gallery-2.jpg') }}" class="img-fluid"
                                alt="Elegant restaurant dining room at night">
                            <div class="gallery-overlay">
                                <div class="gallery-caption">Evening Ambiance</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Add more gallery items following the same structure -->

            </div>

<!-- Minimal CTA Section -->
<div class="cta-simple text-center mt-5" data-aos="fade-up">
  <h3 class="mb-4">Ready for an Unforgettable Experience?</h3>
  <a href="{{ route('reservation.add') }}" class="cta-simple-btn">
      Reserve Your Table
      <span class="btn-arrow">→</span>
  </a>
</div>



        </div>

    </section><!-- /Gallery Section -->

    <!-- Reserve btn -->
 
<style>
  .cta-simple-btn {
      display: inline-flex;
      align-items: center;
      padding: 1rem 2.5rem;
      background: linear-gradient(45deg, #ce1212, #e8c97d);
      color: #fff;
      border: none;
      border-radius: 30px;
      font-size: 1.1rem;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(201, 161, 53, 0.3);
      position: relative;
      overflow: hidden;
  }
  
  .cta-simple-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(
          120deg,
          transparent,
          rgba(255,255,255,0.3),
          transparent
      );
      transition: 0.5s;
  }
  
  .cta-simple-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(201, 161, 53, 0.4);
  }
  
  .cta-simple-btn:hover::before {
      left: 100%;
  }
  
  .btn-arrow {
      margin-left: 0.8rem;
      opacity: 0.8;
      transform: translateX(-5px);
      transition: all 0.3s ease;
  }
  
  .cta-simple-btn:hover .btn-arrow {
      transform: translateX(0);
      opacity: 1;
  }
  </style>

    <style>
        .gallery-item {
            position: relative;
            margin-bottom: 1.5rem;
            overflow: hidden;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-caption {
            color: white;
            font-weight: 600;
            text-align: center;
            padding: 1rem;
        }

        .gallery-filter .nav-link {
            border: 2px solid #ddd;
            margin: 0 0.5rem;
            border-radius: 30px;
        }

        .gallery-filter .nav-link.active {
            background: #c9a135;
            border-color: #c9a135;
            color: white;
        }
    </style>
@endsection
