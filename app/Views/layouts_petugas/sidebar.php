<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('opd/dashboard'); ?>" class="brand-link">
    <img src="/assets/adminlte3/dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">PETUGAS OPD</span>
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
          <a href="<?php echo base_url('opd/dashboard'); ?>" class="nav-link <?php if ($page == 'dashboard') echo " active";  ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <!-- Data Formasi -->
        <li class="nav-item">
          <a href="<?php echo base_url('opd/dataformasi'); ?>" class="nav-link <?php if ($page == 'dataformasi') echo " active";  ?>">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
              Rekap Formasi OPD
            </p>
          </a>
        </li>        

      <!--   <li class="nav-item">
          <a href="<?php //echo base_url('opd/DataAjuanABK'); ?>" class="nav-link <?php //if ($page == 'DataAjuanABK') echo " active";  ?>">
            <i class="nav-icon fas fa-briefcase"></i>
            <p>
              Data Ajuan ABK
            </p>
          </a>
        </li> -->

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-inbox"></i>
            <p>
              Kebutuhan Pegawai
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('opd/datakekuranganformasi'); ?>" class="nav-link <?php if ($page == 'opd/datakekuranganformasi') echo " active";  ?>">
                <i class="far fa fa-minus nav-icon"></i>
                <p>Kekurangan Pegawai</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('opd/datakelebihanformasi'); ?>" class="nav-link <?php if ($page == 'opd/datakelebihanformasi') echo " active";  ?>">
                <i class="far fa fa-plus nav-icon"></i>
                <p>Kelebihan Pegawai</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Data Pegawai -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Data Pegawai
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!--  <li class="nav-item">
            <a href="<?php //echo base_url('opd/inputpegawaiopd'); 
                      ?>" class="nav-link <?php //if ($page == 'opd/inputpegawai') echo " active";  
                                          ?>">
              <i class="far fa fa-plus nav-icon"></i>
              <p>Input Pegawai</p>
            </a>
          </li> -->
            <li class="nav-item">
              <a href="<?php echo base_url('opd/datapegawai'); ?>" class="nav-link <?php if ($page == 'opd/lihatpegawaiopd') echo " active";  ?>">
                <i class="far fa-eye nav-icon"></i>
                <p>Lihat Pegawai</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('opd/datapegawai/cetakdatapegawaiopd/'); ?>" class="nav-link <?php if ($page == 'opd/datapegawai/cetakdatapegawaiopd/') echo " active";  ?>">
                <i class="far fa fa-pencil nav-icon"></i>
                <p>Cetak Data Pegawai</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Data Usulan -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-inbox"></i>
            <p>
              Data Usulan
              <i class="fas fa-angle-right right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('opd/datausulan'); ?>" class="nav-link <?php if ($page == 'opd/datausulan') echo " active";  ?>">
                <i class="far fa fa-plus nav-icon"></i>
                <p>Input Usulan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('opd/datausulan/lihatusulanopd'); ?>" class="nav-link <?php if ($page == 'opd/lihatusulan') echo " active";  ?>">
                <i class="far fa-eye nav-icon"></i>
                <p>Lihat Usulan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('opd/datausulan/kirimdatausulanopd'); ?>" class="nav-link" <?php if ($page == 'opd/datausulan/kirimdatausulanopd') echo " active";  ?>">
                <i class="far fa fa-paper-plane-o nav-icon"></i>
                <p>Kirim Usulan</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo base_url('opd/datausulan/cetakdatausulan'); ?>" class="nav-link <?php if ($page == 'opd/datausulan/cetakdatausulan') echo " active";  ?>">
                <i class="far fa fa-print nav-icon"></i>
                <p>Cetak Usulan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('opd/datausulan/rekapusulanopd'); ?>" class="nav-link <?php if ($page == 'opd/datausulan/rekapusulanopd') echo " active";  ?>">
                <i class="far fa fa-paper-plane-o nav-icon"></i>
                <p>Rekap Usulan</p>
              </a>
            </li>
          </ul>
        </li>






        <!--    <li class="nav-item">
          <a href="<?php //echo base_url('datausulanpetugas'); 
                    ?>" class="nav-link <?php //if ($page == 'datausulanpetugas') echo " active";  
                                        ?>">
            <i class="nav-icon fas fa-inbox"></i>
            <p>
              Data Usulan
            </p>
          </a>
        </li> -->
        <!--  <li class="nav-item">
          <a href="<?php //echo base_url('datainformasi'); 
                    ?>" class="nav-link <?php //if ($page == 'datainformasi');  
                                        ?>">
            <i class="nav-icon fas fa-id-card"></i>
            <p>
              Data Informasi
            </p>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>