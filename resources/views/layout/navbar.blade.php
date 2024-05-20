<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body px-3" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
          <img src="{{ asset('images/kalasewa.png') }}" alt="Kalasewa Logo" width="30px" class="logo-spacing">
          Kalasewa
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active fw-bold px-3" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold px-3" href="#">History</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold px-3" href="#">Wishlist</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold px-3" href="#">Helpdesk</a>
            </li>
            <li class="nav-item py-1 d-none d-lg-flex">
              <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link fw-bold px-3 dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('images/profile.png') }}" alt="Profile" width="30px">
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><h4 class="dropdown-header dropdown-header-bold">Akun</h4></li>
                <li><hr class="dropdown-divider"></li> 
                <li><a class="dropdown-item" href="#">Login</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
                <li><a class="dropdown-item" href="#">Edit Profil</a></li>
                <!-- <li><a class="dropdown-item" href="#">Register</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li> -->
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>