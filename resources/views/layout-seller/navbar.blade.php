<nav class="navbar sticky-top navbar-expand-lg shadow-sm navbar-light bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="{{ asset('img/kalasewa_logo.png') }}" alt="Logo"
                width="40px"></a>
        <a class="nav-link fs-4" href="#"
            style="font-weight: bold;color:#EE1B2F; padding-right:25px; margin-left:-10px">Kalasewa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapse"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Marketplace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Jadi Seller</a>
                </li>
            </ul>
            <a class="me-5" href="{{ route('seller.loginView') }}" style="color: #EE1B2F; text-decoration:none">Sign
                in</a>
        </div>
    </div>
</nav>
