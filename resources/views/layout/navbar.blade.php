<link rel="stylesheet" type="text/css" href="{{ asset('css/homepage.css') }}" />

<nav class="navbar sticky-top navbar-expand-lg shadow-sm navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('viewHomepage') }}">
            <img src="{{ asset('images/kalasewa.png') }}" alt="Logo" width="40px">
        </a>
        <a class="nav-link fs-4" href="{{ route('viewHomepage') }}" style="font-weight: bold;color:#EE1B2F; padding-right:25px; margin-left:-10px">Kalasewa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('viewHomepage') }}">Marketplace</a>
                </li>
                @if (auth()->check() && auth()->user()->role === 'penyewa')
                    <li class="nav-item">
                        <a class="nav-link" href="">History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('wishlist.view') }}">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Ticketing</a>
                    </li>
                @endif
            </ul>
            @if (auth()->check())
            <div class="nav-item dropstart mx-2">
                <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset(session('profilpath')) }}" alt="{{ auth()->user()->nama }}" style="width: 30px; height: 30px; border-radius: 50%;">
                </button>
                <ul class="dropdown-menu dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('viewProfile', ['id' => auth()->user()->id]) }}">Ubah Profil</a></li>
                    <li><a class="dropdown-item" href="{{ route('viewGantiPassword', ['id' => auth()->user()->id]) }}">Ubah Password</a></li>
                    <li><a class="dropdown-item" href="{{ route('userLogout') }}">Logout</a></li>
                </ul>
            </div>
            @else
                <a class="me-5" href="{{ route('loginView') }}" style="color: #EE1B2F; text-decoration:none">Sign in</a>
            @endif
        </div>
    </div>
</nav>
