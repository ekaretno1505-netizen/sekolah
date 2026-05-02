  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="akun.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Account
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Siswa
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="siswa.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input Data Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="siswa_lihat.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Data Siswa</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Guru
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="guru.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Input Data Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="guru_lihat.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lihat Data Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="guru_mapel.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Set Mapel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="walkel.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Wali Kelas</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="kelas.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Kelas
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="mapel.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Mata Pelajaran
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>