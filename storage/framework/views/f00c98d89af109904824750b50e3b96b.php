<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/homepage.css')); ?>" />

<nav class="navbar sticky-top navbar-expand-lg shadow-sm navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo e(route('viewHomepage')); ?>">
            <img src="<?php echo e(asset('images/kalasewa.png')); ?>" alt="Logo" width="40px">
        </a>
        <a class="nav-link fs-4" href="<?php echo e(route('viewHomepage')); ?>"
            style="font-weight: bold;color:#EE1B2F; padding-right:25px; margin-left:-10px">Kalasewa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapse"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if(auth()->check()): ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo e(route('viewHomepage')); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo e(route('viewListToko')); ?>">Merchant</a>
                </li>
                <?php if(auth()->check() && auth()->user()->role === 'penyewa'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('viewHistoryMenungguDiproses')); ?>">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('wishlist.view')); ?>">Wishlist</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('viewTicketing')); ?>">Ticketing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('viewPenarikan')); ?>">Withdrawal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/chat')); ?>" target="_blank">Chat</a>
                </li>
                <?php endif; ?>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo e(route('viewHomepage')); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo e(route('viewListToko')); ?>">Merchant</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo e(route('viewRules')); ?>">Regulation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo e(route('viewAbout')); ?>">About</a>
                </li>
            </ul>
            <?php if(auth()->check() && auth()->user()->role === 'penyewa'): ?>
            <div class="nav-item dropdown mx-2">
                <button class="btn btn-outline-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo e(asset(session('profilpath'))); ?>" alt="<?php echo e(auth()->user()->nama); ?>"
                        style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%;">
                    <?php echo e(auth()->user()->nama); ?>

                </button>
                <ul class="dropdown-menu dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo e(route('viewProfile', ['id' => auth()->user()->id])); ?>">My
                            Profile</a></li>
                    <li><a class="dropdown-item"
                            href="<?php echo e(route('viewGantiPassword', ['id' => auth()->user()->id])); ?>">Change
                            Password</a>
                    </li>
                    <li><a class="dropdown-item" href="<?php echo e(route('logout')); ?>">Logout</a></li>
                </ul>
            </div>
            <?php elseif(auth()->check() && auth()->user()->role === 'pemilik_sewa'): ?>
            <div class="nav-item dropstart mx-2">
                <button class="btn btn-outline-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo e(asset(session('profilpath'))); ?>" alt="<?php echo e(auth()->user()->nama); ?>"
                        style="width: 30px; height: 30px; object-fit: cover; border-radius: 50%;">
                </button>
                <ul class="dropdown-menu dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo e(route('seller.dashboardtoko')); ?>">Dashboard</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('logout')); ?>">Logout</a></li>
                </ul>
            </div>
            <?php else: ?>
            <a class="me-4" href="<?php echo e(route('jadiSellerView')); ?>" style="color: #EE1B2F; text-decoration:none">Setup
                Merch</a>
            <a class="me-4" href="<?php echo e(route('registerViewPenyewa')); ?>"
                style="color: #EE1B2F; text-decoration:none">Register</a>
            <a class="me-5" href="<?php echo e(route('loginView')); ?>" style="color: #EE1B2F; text-decoration:none">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH E:\Backup data c\kuliah\Semester 8\Tugas Akhir\WEBSITE\Development\Iterasi 3\Iterasi 3 kalasewa hosting v2\resources\views/layout/navbar.blade.php ENDPATH**/ ?>