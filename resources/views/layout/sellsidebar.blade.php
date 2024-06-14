<ul class="navbar-nav sidebar sidebar-dark accordion kalasewa-color" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('seller.profilTokoView') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset(session('profilpath')) }}" width="40px" height="40px" style="object-fit: cover;"
                class="rounded-circle">
        </div>
        <div class="sidebar-brand-text mx-2">{{ session('namatoko') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('seller.dashboardtoko') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('seller.statuspenyewaan.belumdiproses') }}">
            <i class="fas fa-light fa-clipboard-list"></i>
            <span>Pesanan</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('seller.viewProdukAnda') }}">
            <i class="fas fa-solid fa-boxes-stacked"></i>
            <span>Produk</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        TOKO
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('seller.profilTokoView') }}">
            <i class="fas fa-regular fa-store"></i>
            <span>Profil Toko</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fa-solid fa-regular fa-star"></i>
            <span>Penilaian Produk</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-regular fa-wallet"></i>
            <span>Keuangan</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-solid fa-circle-exclamation"></i>
            <span>Laporkan permasalahan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        AKUN
    </div>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('seller.logout') }}">
            <i class="fas fa-solid fa-right-from-bracket"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</ul>
