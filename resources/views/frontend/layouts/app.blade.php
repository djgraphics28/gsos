<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GSO | @yield('title', 'Page')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    body {
        position: relative;
        min-height: 100vh;
    }

    /* Background image with opacity */
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('images/background.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0.5;
        /* Adjust the opacity here */
        z-index: -1;
        /* Ensures the background stays behind content */
    }

    /* body {
        background-image: url('{{ asset('images/background.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
    } */

    /* Full-screen height for carousel */
    .carousel-item {
        height: 80vh;
    }

    .carousel-item img {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }

    /* Footer styling */
    footer {
        background-color: #f8f9fa;
        padding: 20px 0;
        text-align: center;
    }

    footer a {
        color: #007bff;
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }

    /* Main element minimum height */
    main {
        min-height: 80vh;
        /* Ensures main fills at least the full viewport height */
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* Center content vertically */
    }
</style>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50">
                <label class="text-lg">General Services Office System</label>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services') }}">Services</a> <!-- New Services menu item -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faq') }}">FAQs</a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/account') }}">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="btn btn-success" href="">Submit a Request</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} General Services Office System. All Rights Reserved.</p>
            <p>
                <a href="#home">Home</a> |
                <a href="#faqs">FAQs</a> |
                <a href="#services">Services</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS and Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
