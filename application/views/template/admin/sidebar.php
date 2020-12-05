<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url()?>asset/img/logo/logo_perpustakaan.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Katalog Tugas Akhir</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="<?php echo base_url()?>asset/img/udinus.png" class="img-circle elevation-2" alt="User Image"> -->
          <h2>
            <i class="fa fa-user-circle text-light" aria-hidden="true"></i>
          </h2>
        </div>
        <div class="info">
          <a href="#" class="d-block">Pustakawan</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url()?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url()?>" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Halaman Utama
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url().'admin' ?>" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Kelola Database
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url()?>" class="nav-link">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Kelola Rak
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('analysis')?>" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Analisis
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('login/logout')?>" class="nav-link">
              <i class="nav-icon fas fa-lock"></i>
              <p>
                Log-Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>