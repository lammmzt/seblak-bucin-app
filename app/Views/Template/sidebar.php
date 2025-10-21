<?php 
    
?>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="<?= base_url('/'); ?>" class="brand-link">
            <!--begin::Brand Image-->
            <img src="<?= base_url('Assets/'); ?>img/logo-seblak.png" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">
            </span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Home</li>
                <li class="nav-item">
                    <a href="<?= base_url('/'); ?>" class="nav-link <?= $active == 'Dashboard' ? 'active' : ''; ?>">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">Master Data</li>
                <li class="nav-item ">
                    <a href="<?= base_url('Menu'); ?>" class="nav-link  <?= $active == 'Menu' ? 'active' : ''; ?>">
                        <i class="nav-icon bi bi-journal-richtext"></i>
                        <p>Data Menu</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?= base_url('Toping'); ?>" class="nav-link  <?= $active == 'Toping' ? 'active' : ''; ?>">
                        <i class="nav-icon bi bi-journal-richtext"></i>
                        <p>Data Toping</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?= base_url('Users'); ?>" class="nav-link  <?= $active == 'Users' ? 'active' : ''; ?>">
                        <i class="nav-icon bi bi-person-fill"></i>
                        <p>Data Users</p>
                    </a>
                </li>
                <li class="nav-header">Master Transaksi</li>
                <li class="nav-item ">
                    <a href="<?= base_url('Pengadaan'); ?>"
                        class="nav-link  <?= $active == 'Pengadaan' ? 'active' : ''; ?>">
                        <i class="nav-icon bi bi-journal-richtext"></i>
                        <p>Data Pengadaan</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>