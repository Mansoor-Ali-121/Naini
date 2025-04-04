<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <!-- User Info Section -->
        <div class="user-info text-center py-4">
            <div class="profile-pic-container">
                <img src="" class="profile-pic rounded-circle shadow" alt="">
            </div>

            <h2 class="user-role fancy-text">Admin</h2>
        </div>

        <!-- Add the following CSS for styling -->
        <style>
            .profile-pic-container {
                display: inline-block;
                background: linear-gradient(145deg, #34495e, #2c3e50);
                /* Dark blue gradient for a modern look */
                border-radius: 50%;
                padding: 5px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
                position: relative;
                /* Required for positioning the pseudo-element */
                overflow: hidden;
                /* Prevents overflow of the pseudo-element */
            }

            .profile-pic {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                object-fit: cover;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
            }

            .profile-pic-container::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border-radius: 50%;
                box-shadow:
                    0 0 20px rgb(171, 15, 233),
                    /* Bright purple glow */
                    0 0 40px rgba(188, 81, 255, 0.7);
                /* Softer purple glow */
                opacity: 0.5;
                /* Start with some opacity for the glow */
                animation: glow-picture 1.5s infinite alternate;
                /* Apply the glow animation here */
            }

            .user-info {
                background: linear-gradient(145deg, #2c3e50, #1c1c1c);
                /* Slightly lighter gradient for contrast */
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            }

            .user-role {
                margin-top: 10px;
                color: #ecf0f1;
                /* Light gray for readability */
                font-weight: 600;
                font-size: 2.5rem;
                /* Slightly smaller for better fit */
            }

            .fancy-text {
                background: linear-gradient(90deg, #12c2f3, #e74c3c);
                /* Orange to red gradient */
                background-clip: text;
                -webkit-background-clip: text;
                color: transparent;
                font-family: 'Satisfy', cursive;
                text-shadow:
                    2px 2px 10px rgb(114, 60, 231),
                    /* Matching purple shadow */
                    0 0 20px rgba(114, 60, 231, 0.5),
                    0 0 30px rgba(114, 60, 231, 0.3);
                animation: text-glow 1.5s ease-in-out infinite alternate;
            }

            @keyframes text-glow {
                from {
                    text-shadow:
                        2px 2px 10px rgba(109, 86, 159, 0.8),
                        0 0 20px rgba(126, 71, 160, 0.963),
                        0 0 30px rgb(75, 59, 110);
                }

                to {
                    text-shadow:
                        2px 2px 10px rgba(46, 204, 113, 0.5),
                        0 0 20px rgba(46, 204, 113, 0.3),
                        0 0 30px rgba(46, 204, 113, 0.1);
                }
            }

            @keyframes glow-picture {
                0% {
                    box-shadow:
                        0 0 20px rgb(126, 48, 157),
                        0 0 40px rgba(90, 48, 116, 0.7);
                    opacity: 0.5;
                    /* Starting opacity */
                    transform: scale(1);
                }

                100% {
                    box-shadow:
                        0 0 30px rgba(46, 204, 113, 1),
                        /* Bright green glow */
                        0 0 60px rgba(46, 204, 113, 0.7);
                    /* Softer green glow */
                    opacity: 1;
                    /* Ending opacity */
                    transform: scale(1.1);
                    /* Slightly increase size */
                }
            }
        </style>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="activity"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            {{-- User --}}

            <li class="sidebar-item dropdown">
                <a class="sidebar-link dropdown" href="#" id="userDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="">View Users</a></li>
                    <li><a class="dropdown-item" href="">Add User</a></li>
                </ul>
            </li>

            {{-- Menu --}}

            <li class="sidebar-item dropdown">
                <a class="sidebar-link dropdown" href="{{ route('menu.add') }}" id="menuDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Menu</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="menuDropdown">
                    <li><a class="dropdown-item" href="{{ route('menu.show') }}">View Menu</a></li>
                    <li><a class="dropdown-item" href="{{ route('menu.add') }}">Add Menu</a></li>
                </ul>
            </li>

            {{-- Categories --}}

            <li class="sidebar-item dropdown">
                <a class="sidebar-link dropdown" href="#" id="categoryDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="tag"></i> <span class="align-middle">Categories</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                    <li><a class="dropdown-item" href="{{ route('category.show') }}">View Categories</a></li>
                    <li><a class="dropdown-item" href="{{ route('category.add') }}">Add Categories</a></li>
                </ul>
            </li>

            {{-- Chefs --}}

            <li class="sidebar-item dropdown">
                <a class="sidebar-link dropdown" href="#" id="chefDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="award"></i> <span class="align-middle">Chefs</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="chefDropdown">
                    <li><a class="dropdown-item" href="{{ route('chef.show') }}">View Chefs</a></li>
                    <li><a class="dropdown-item" href="{{ route('chef.add') }}">Add Chefs</a></li>
                </ul>
            </li>

            {{-- Events --}}

            <li class="sidebar-item dropdown">
                <a class="sidebar-link dropdown" href="#" id="eventsDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Events</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="eventsDropdown">
                    <li><a class="dropdown-item" href="{{route('events.show')}}">View Events</a></li>
                    <li><a class="dropdown-item" href="{{ route('events.add') }}">Add Events</a></li>
                </ul>
            </li>

            {{-- Gallery --}}

            <li class="sidebar-item dropdown">
                <a class="sidebar-link dropdown" href="#" id="galleryDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="image"></i> <span class="align-middle">Gallery</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="galleryDropdown">
                    <li><a class="dropdown-item" href="{{route('gallery.show')}}">View Gallery</a></li>
                    <li><a class="dropdown-item" href="{{route('gallery.add')}}">Add Gallery</a></li>
                </ul>
            </li>

            {{-- Contacts --}}

            <li class="sidebar-item dropdown">
                <a class="sidebar-link dropdown" href="#" id="contactDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="mail"></i> <span class="align-middle">Contacts</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="contactDropdown">
                    <li><a class="dropdown-item" href="{{route('contacts.show')}}">View Contacts</a></li>
                    <li><a class="dropdown-item" href="{{route('contacts.add')}}">Add Contact</a></li>
                </ul>
            </li>

            {{-- Reservations --}}

            <li class="sidebar-item dropdown">
                <a class="sidebar-link dropdown" href="#" id="reservationDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="clock"></i> <span class="align-middle">Reservation</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="reservationDropdown">
                    <li><a class="dropdown-item" href="{{route('reservation.show')}}">View Reservation</a></li>
                    <li><a class="dropdown-item" href="{{route('reservation.add')}}">Add Reservation</a></li>
                </ul>
            </li>

            {{-- Reviews --}}

            <li class="sidebar-item dropdown">
                <a class="sidebar-link dropdown" href="#" id="reviewsDropdown" role="button"
                    data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="star"></i> <span class="align-middle">Reviews</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="reviewsDropdown">
                    <li><a class="dropdown-item" href="">View Reviews</a></li>
                    <li><a class="dropdown-item" href="">Add Reviews</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link text-danger" href="">
                    <i class="align-middle" data-feather="power"></i> <span class="align-middle">Logout</span>
                </a>
            </li>
        </ul>


    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace();
</script>
