<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <div class="user-info text-center py-4">
            <div class="profile-pic-container">
                @auth
                    <img src="{{ Auth::user()->picture ? asset('Users/users_pictures/' . Auth::user()->picture) : asset('default-user.png') }}"
                        class="profile-pic rounded-circle shadow" alt="Admin Profile"
                        onerror="this.src='{{ asset('default-user.png') }}'">
                @else
                    <img src="{{ asset('default-user.png') }}" class="profile-pic rounded-circle shadow"
                        alt="Default Profile">
                @endauth
            </div>
            <h2 class="user-role fancy-text">Admin</h2>
        </div>

        <style>
            /* Apka existing CSS */
            .profile-pic-container {
                display: inline-block;
                background: linear-gradient(145deg, #34495e, #2c3e50);
                border-radius: 50%;
                padding: 5px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
                position: relative;
                overflow: hidden;
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
                box-shadow: 0 0 20px rgb(171, 15, 233), 0 0 40px rgba(188, 81, 255, 0.7);
                opacity: 0.5;
                animation: glow-picture 1.5s infinite alternate;
            }

            .user-info {
                background: linear-gradient(145deg, #2c3e50, #1c1c1c);
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            }

            .user-role {
                margin-top: 10px;
                color: #ecf0f1;
                font-weight: 600;
                font-size: 2.5rem;
            }

            .fancy-text {
                background: linear-gradient(90deg, #12c2f3, #e74c3c);
                background-clip: text;
                -webkit-background-clip: text;
                color: transparent;
                font-family: 'Satisfy', cursive;
                text-shadow: 2px 2px 10px rgb(114, 60, 231);
                animation: text-glow 1.5s ease-in-out infinite alternate;
            }

            .active-menu-item {
                background-color: rgba(255, 255, 255, 0.1) !important;
                border-left: 4px solid #ab0fe9;
            }

            @keyframes text-glow {
                from {
                    text-shadow: 2px 2px 10px rgba(109, 86, 159, 0.8);
                }

                to {
                    text-shadow: 2px 2px 10px rgba(46, 204, 113, 0.5);
                }
            }

            @keyframes glow-picture {
                0% {
                    box-shadow: 0 0 20px rgb(126, 48, 157);
                    opacity: 0.5;
                    transform: scale(1);
                }

                100% {
                    box-shadow: 0 0 30px rgba(46, 204, 113, 1);
                    opacity: 1;
                    transform: scale(1.1);
                }
            }

            .sidebar-link {
                position: relative;
                transition: all 0.4s ease-in-out;
                background: linear-gradient(90deg, transparent 50%, rgba(171, 15, 233, 0.15) 50%);
                background-size: 200% 100%;
                background-position: 100% 0;
            }

            .sidebar-link:hover {
                background-position: 0 0;
                color: #fff !important;
            }

            .active-menu-item .sidebar-link {
                background-position: 0 0;
                border-left: 4px solid #ab0fe9;
                background-color: rgba(171, 15, 233, 0.1);
            }
        </style>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}"><i class="align-middle"
                        data-feather="activity"></i> <span class="align-middle">Dashboard</span></a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}"><i class="align-middle"
                        data-feather="user"></i> <span class="align-middle">Profile</span></a>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('register.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="users"></i> <span class="align-middle">Users</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('register.show') ? 'active' : '' }}"
                            href="{{ route('register.show') }}">View Users</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('register.add') ? 'active' : '' }}"
                            href="{{ route('register.add') }}">Add User</a></li>
                </ul>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('menu.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="coffee"></i> <span class="align-middle">Menu</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('menu.show') ? 'active' : '' }}"
                            href="{{ route('menu.show') }}">View Menu</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('menu.add') ? 'active' : '' }}"
                            href="{{ route('menu.add') }}">Add Menu</a></li>
                </ul>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('orders.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="shopping-cart"></i> <span class="align-middle">Orders</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('orders.index') ? 'active' : '' }}"
                            href="{{ route('orders.index') }}">View Orders</a></li>
                </ul>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('category.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="tag"></i> <span class="align-middle">Categories</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('category.show') ? 'active' : '' }}"
                            href="{{ route('category.show') }}">View Categories</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('category.add') ? 'active' : '' }}"
                            href="{{ route('category.add') }}">Add Categories</a></li>
                </ul>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('subcategory.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="layers"></i> <span class="align-middle">Sub-Categories</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('subcategory.show') ? 'active' : '' }}"
                            href="{{ route('subcategory.show') }}">View Sub-Categories</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('subcategory.add') ? 'active' : '' }}"
                            href="{{ route('subcategory.add') }}">Add Sub-Categories</a></li>
                </ul>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('workers.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="users"></i> <span class="align-middle">Workers</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('workers.show') ? 'active' : '' }}"
                            href="{{ route('workers.show') }}">View Workers</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('workers.add') ? 'active' : '' }}"
                            href="{{ route('workers.add') }}">Add Workers</a></li>
                </ul>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('chef.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="award"></i> <span class="align-middle">Chefs</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('chef.show') ? 'active' : '' }}"
                            href="{{ route('chef.show') }}">View Chefs</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('chef.add') ? 'active' : '' }}"
                            href="{{ route('chef.add') }}">Add Chefs</a></li>
                </ul>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('events.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="calendar"></i> <span class="align-middle">Events</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('events.show') ? 'active' : '' }}"
                            href="{{ route('events.show') }}">View Events</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('events.add') ? 'active' : '' }}"
                            href="{{ route('events.add') }}">Add Events</a></li>
                </ul>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('gallery.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="image"></i> <span class="align-middle">Gallery</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('gallery.show') ? 'active' : '' }}"
                            href="{{ route('gallery.show') }}">View Gallery</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('gallery.add') ? 'active' : '' }}"
                            href="{{ route('gallery.add') }}">Add Gallery</a></li>
                </ul>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('contacts.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="mail"></i> <span class="align-middle">Contacts</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('contacts.show') ? 'active' : '' }}"
                            href="{{ route('contacts.show') }}">View Contacts</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('contacts.add') ? 'active' : '' }}"
                            href="{{ route('contacts.add') }}">Add Contact</a></li>
                </ul>
            </li>

            <li class="sidebar-item dropdown {{ request()->routeIs('reservation.*') ? 'active-menu-item' : '' }}">
                <a class="sidebar-link dropdown" href="#" data-bs-toggle="dropdown"><i class="align-middle"
                        data-feather="clock"></i> <span class="align-middle">Reservation</span></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request()->routeIs('reservation.show') ? 'active' : '' }}"
                            href="{{ route('reservation.show') }}">View Reservation</a></li>
                    <li><a class="dropdown-item {{ request()->routeIs('reservation.add') ? 'active' : '' }}"
                            href="{{ route('reservation.add') }}">Add Reservation</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link text-danger" href="{{ route('logout') }}"><i class="align-middle"
                        data-feather="power"></i> <span class="align-middle">Logout</span></a>
            </li>
        </ul>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace();
</script>
