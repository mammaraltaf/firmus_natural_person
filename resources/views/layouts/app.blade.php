<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Person Management')</title>

    <!-- Add Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet">
    <!-- Add Select2 CSS -->
    <link href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/images/logo.png') }}" style="max-height: 50px;" alt="Firmus Financial">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Other Navbar Links -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Language
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('setLocale', 'en') }}">
                                <img src="{{ asset('assets/images/flags/us.png') }}" alt="English" style="width: 20px; height: auto;"> English
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('setLocale', 'es') }}">
                                <img src="{{ asset('assets/images/flags/es.png') }}" alt="Español" style="width: 20px; height: auto;"> Español
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>
<!-- Add Select2 JS -->
<script src="{{asset('assets/js/select2.min.js')}}"></script>

@stack('scripts')

</body>
</html>
