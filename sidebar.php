<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.php">CV ASRI RENT APP</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.php">AA</a>
    </div>
    <ul class="sidebar-menu">
      <?php if ($_SESSION['hak'] == 'superadmin') : ?>
        <li class="menu-header">Dashboard</li>
        <li class="nav-item <?= $_GET['pg'] == 'dashboard' ? 'active' : '' ?>">
          <a href="index.php?pg=dashboard" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Master</li>
        <li class="nav-item <?= $_GET['pg'] == 'brand' ? 'active' : '' ?>">
          <a href="index.php?pg=brand" class="nav-link"><i class="fas fa-copyright"></i><span>Brand</span></a>
        </li>
        <li class="nav-item <?= $_GET['pg'] == 'kendaraan' ? 'active' : '' ?>">
          <a href="index.php?pg=kendaraan" class="nav-link"><i class="fas fa-car"></i><span>Mobil</span></a>
        </li>
        <li class="nav-item <?= $_GET['pg'] == 'galeri' ? 'active' : '' ?>">
          <a href="index.php?pg=galeri" class="nav-link"><i class="fas fa-images"></i><span>Galeri</span></a>
        </li>
        <li class="nav-item <?= $_GET['pg'] == 'tsewa' ? 'active' : '' ?>">
          <a href="index.php?pg=tsewa" class="nav-link"><i class="fas fa-window-restore"></i><span>Tipe Sewa</span></a>
        </li>
        <li class="nav-item <?= $_GET['pg'] == 'prental' ? 'active' : '' ?>">
          <a href="index.php?pg=prental" class="nav-link"><i class="fas fa-tags"></i><span>Paket Rental</span></a>
        </li>
        <li class="menu-header">Transaksi</li>
        <li class="nav-item <?= $_GET['pg'] == 'rental' ? 'active' : '' ?>">
          <a href="index.php?pg=rental" class="nav-link"><i class="fab fa-get-pocket"></i><span>Rental</span></a>
        </li>
        <li class="menu-header">Utilitas</li>
        <li class="nav-item <?= $_GET['pg'] == 'user' ? 'active' : '' ?>">
          <a href="index.php?pg=user" class="nav-link"><i class="fas fa-user"></i><span>User</span></a>
        </li>
      <?php elseif ($_SESSION['hak'] == 'admin') : ?>
        <li class="menu-header">Dashboard</li>
        <li class="nav-item <?= $_GET['pg'] == 'dashboard' ? 'active' : '' ?>">
          <a href="index.php?pg=dashboard" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>

        <li class="menu-header">Scheduling</li>
        <li class="nav-item <?= $_GET['pg'] == 'rental' ? 'active' : '' ?>">
          <a href="index.php?pg=rental" class="nav-link"><i class="fas fa-calendar"></i><span>Penjadwalan</span></a>
        </li>
      <?php endif; ?>
    </ul>
  </aside>
</div>