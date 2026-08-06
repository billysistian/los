      <!-- Sidebar -->
      <div class="sidebar" data-background-color="white">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="white">
            <a href="../dashboard/index.php" class="logo">
              <img
                src="../../assets/img/logo.png"
                alt="navbar brand"
                class="navbar-brand"
                height="20"
              />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item">
                <a href="../dashboard/index.php">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Menu</h4>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#permohonankredit">
                  <i class="fas fa-hand-holding-usd"></i>
                  <p>Permohonan Kredit</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="permohonankredit">
                  <ul class="nav nav-collapse">
                    <?php if ($_SESSION['role'] === 'AO') : ?>
                    <li>
                      <a href="../kredit/index.php">
                        <span class="sub-item">Daftar Permohonan Kredit</span>
                      </a>
                    </li>
                    <?php endif ?>
                    <?php if ($_SESSION['role'] === 'Kadiv AO') : ?>
                    <li>
                      <a href="../kredit/approval.php">
                        <span class="sub-item">Persetujuan Edit</span>
                      </a>
                    </li>
                    <?php endif ?>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->