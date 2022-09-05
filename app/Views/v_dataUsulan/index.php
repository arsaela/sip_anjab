<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>Data Usulan</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-body table-responsive">
              <table class="table table-bordered" id="datatable-list">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nomor Usul</th>
                    <th>Nama Instansi / OPD</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($getUsulan as $isi) { ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $isi->usulan_id; ?></td>
                      <td><?php echo $isi->instansi_nama; ?></td>
                      <td>
                        <a data-toggle='tooltip' data-placement='top' title='Detail' href="<?php echo base_url('DataUsulan/detail_usulan/' . $isi->usulan_id); ?>" class="btn btn-warning"><i class="fa fa-eye "></i></a>
                      </td>
                    </tr>
                  <?php $no++;
                  } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->






<!-- 
      <div>
        <a data-toggle='tooltip' data-placement='top' title='Cetak Usulan' href="<?php //echo base_url('datausulan/cetak_usulan_all_by_year/'); ?>" class="btn btn-success"><i class="fa fa-print "> Cetak Semua Usulan Yang Disetujui</i></a>
      </div>
 -->



    </div>
</div>
</div>
</section>
<!-- /.content -->

</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>