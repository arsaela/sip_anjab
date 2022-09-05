<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1></h1>
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
            <div class="card-header">
              <h3 class="card-title">Data Usulan OPD yang sudah disubmit</h3>
            </div>

            <div class="card-body table-responsive">
              <table id="datatable-export" class="table table-bordered table-striped">
                <thead>
                 <tr>
                  <th>No</th>
                  <th>Nama Jabatan</th>
                  <th>Instansi Nama</th>
                  <th>ABK</th>
                  <!-- <th>ASN yang ada</th> -->
                  <th>Jumlah Usulan CPNS</th>
                  <th>Approve CPNS</th>
                  <th>Jumlah Usulan PPPK</th>
                  <th>Approve PPPK</th>
                  <th>Status Usulan</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1;
                foreach ($getDetailUsulanByInstansi as $value) { ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                  <td>
                      <?php echo $value->jabatan_nama . ' ' . $value->instansi_unor_nama;?>
                  </td>
                      <td>
                        <?php echo $value->instansi_nama; ?>
                      </td>
                      <td><?php echo $value->formasi_jumlah; ?></td>
                      <!--  <td><?php //echo $value->jumlahasn; ?></td> -->
                      <td>
                        <?php echo $value->jumlah_usulan_cpns; ?><br>
                        Prioritas :
                        <?php echo $value->prioritas_usulan_cpns; ?>
                      </td>
                      <td><?php echo $value->jumlah_approve_cpns; ?></td>
                      <td>
                        <?php echo $value->jumlah_usulan_pppk; ?><br>
                        Prioritas :
                        <?php echo $value->prioritas_usulan_pppk; ?>
                      </td>
                      <td><?php echo $value->jumlah_approve_pppk; ?></td>
                      <td><?php
                      if ($value->status_usulan_id == 0) {
                        echo "<p class='bg_status_belumverifikasi'>Belum Mengajukan Usulan</p>";
                      } else if ($value->status_usulan_id == 1) {
                        echo "<p class='bg_status_reject'>Belum Kirim Usulan</p>";
                      } else if ($value->status_usulan_id == 2) {
                        echo "<p class='bg_status_belumverifikasi'>Sudah Kirim Usulan, Belum di verifikasi</p>";
                      } else if ($value->status_usulan_id == 3) {
                        echo "<p class='bg_status_approve'>sudah diverifikasi dan siap diusulkan ke menpan</p>";
                      } else if ($value->status_usulan_id == 4) {
                        echo "<p class='bg_status_reject'>Reject Usulan</p>";
                      } else {
                        echo "<p class='bg_status_pending'>Pending</p>";
                      }
                      ?>
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
    </div>
    <input action="action" onclick="window.history.go(-1); return false;" type="submit" value="Kembali Halaman Unit Kerja" />
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->\
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    $('#datatable-export').DataTable( {
      dom: 'Bfrtip',
      buttons: [

      {
        extend: 'excelHtml5',
        title: 'Data usulan sudah diverifikasi BKPSDM Kabupaten Klaten'
      },
      {
        extend: 'print',
        title: 'Data usulan sudah diverifikasi BKPSDM Kabupaten Klaten'
      }


            // 'excel',  'print'
            ]
          } );
  } );
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<?= $this->endSection(); ?>