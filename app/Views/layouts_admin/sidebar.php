<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
    <img src="/assets/adminlte3/dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin BKPSDM</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <!-- <div class="image">
        <img src="/assets/adminlte3/dist/img/user1-128x128.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php //$nama; 
                                    ?></a>
      </div> -->
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php if ($page == 'dashboard') echo " active";  ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <!-- Data Admin -->
        <li class="nav-item">
          <a href="<?php echo base_url('dataadmin'); ?>" class="nav-link <?php if ($page == 'dataadmin') echo " active";  ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Data Admin
            </p>
          </a>
        </li>
        <!-- Data Petugas -->
        <li class="nav-item">
          <a href="<?php echo base_url('datapetugas'); ?>" class="nav-link <?php if ($page == 'datapetugas') echo " active";  ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Data Petugas
            </p>
          </a>
        </li>
        <!-- Data Petugas -->
        <li class="nav-item">
          <a href="<?php echo base_url('datapegawai'); ?>" class="nav-link <?php if ($page == 'datapegawai') echo " active";  ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Data Pegawai
            </p>
          </a>
        </li>
        <!-- Data Formasi -->
        <li class="nav-item">
          <a href="<?php echo base_url('datainstansi'); ?>" class="nav-link <?php if ($page == 'datainstansi') echo " active";  ?>">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
              Data Formasi
            </p>
          </a>
        </li>
        <!-- Data Usulan -->
        <li class="nav-item">
          <a href="<?php echo base_url('datausulan/cetakdatausulan'); ?>" class="nav-link <?php if ($page == 'datausulan/cetakdatausulan') echo " active";  ?>">
            <i class="nav-icon fas fa-inbox"></i>
            <p>
              Data Usulan
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url('datausulan/cetakdatausulan'); ?>" class="nav-link <?php if ($page == 'datausulan/cetakdatausulan') echo " active";  ?>">
            <i class="nav-icon fas fa-inbox"></i>
            <p>
              Cetak Usulan
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url('datainformasi'); ?>" class="nav-link <?php if ($page == 'datainformasi');  ?>">
            <i class="nav-icon fas fa-id-card"></i>
            <p>
              Data Informasi
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url('dataalurpengusulan'); ?>" class="nav-link <?php if ($page == 'dataalurpengusulan'); ?>">
            <i class="nav-icon fas fa-question-circle"></i>
            <p>
              Data Alur Pengusulan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('setbatasusulan'); 
                    ?>" class="nav-link <?php if ($page == 'SetBatasUsulan');  ?>">
            <i class="nav-icon fas fa-gear"></i>
            <p>
              Setting Batas Pengusulan
            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('importpegawai'); ?>" class="nav-link <?php if ($page == 'importpegawai');  ?>">
            <i class="nav-icon fas fa-file-import"></i>
            <p>
              Import Data
            </p>
          </a>
        </li>
      <!--   <li class="nav-item">
          <a href="<?php //echo base_url('exportpegawai'); ?>" class="nav-link <?php //if ($page == 'exportpegawai');  ?>">
            <i class="nav-icon fas fa-file-export"></i>
            <p>
              Eksport Data
            </p>
          </a>
        </li> -->
<!-- TEST -->
        </li> 
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>