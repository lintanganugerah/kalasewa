<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admincss/img/logo/Logo_Kalasewa.png') }}">
        </div>
        
        <div class="sidebar-brand-text mx-3">Kalasewa</div>
    </a>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="false"
          aria-controls="collapseTable" id="dashboard">
          <i class="fas fa-fw fa-atom"></i>
          <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="false"
          aria-controls="collapseTable" id="manajemenSeries">
          <i class="fas fa-fw fa-table"></i>
          <span>Manajemen Series</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="false"
          aria-controls="collapseTable" id="manajemenPengguna">
          <i class="fas fa-fw fa-user"></i>
          <span>Manajemen User</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="false"
          aria-controls="collapseTable" id="verifikasiUser">
          <i class="fas fa-fw fa-user-check"></i>
          <span>Verifikasi User</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
          aria-controls="collapseTable" id="peraturanPlatform">
          <i class="fas fa-fw fa-book"></i>
          <span>Peraturan Platform</span>
        </a>
    </li>
</ul>

<script>
    document.getElementById('dashboard').addEventListener('click', function(event) {
        event.preventDefault();

        window.location.href = '/admin/dashboard/';
    });

    document.getElementById('manajemenSeries').addEventListener('click', function(event) {
        event.preventDefault();

        window.location.href = '/admin/series/';
    });

    document.getElementById('manajemenPengguna').addEventListener('click', function(event) {
        event.preventDefault();

        window.location.href = '/admin/users/';
    });

    document.getElementById('verifikasiUser').addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = '{{ route('admin.verify.index') }}';
    });
</script>
