<!DOCTYPE html>
<html lang="en">

@include('dashboard.includes.head')

<body>
    <div class="wrapper">
        @include('dashboard.includes.sidebar')
        <div class="main">
            @include('dashboard.includes.navbar')
            <main class="content p-0">
                <div class="container-fluid">
                    <div class="row">
                        <div>
                            <div class="p-5">
                                <div class="card-body col-122">
                                    @yield('main_section')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('dashboard.includes.footer')
        </div>
    </div>
</body>

<script src="{{ asset('dashboard/assets/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
