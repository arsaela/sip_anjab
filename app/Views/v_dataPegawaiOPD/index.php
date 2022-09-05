<?= $this->extend('layouts_petugas/template_petugas') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<?= $this->endSection(); ?>

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
              <h3 class="card-title">Data Pegawai "<?php echo $get_petugas_by_login->instansi_nama;?>"</h3>
            </div>

            <div class="card-body table-responsive">
              <table id="datatable-export" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Pangkat Golongan</th>
                    <th>Jabatan</th>
                    <th>Lokasi Unit Kerja</th>
                    <th>Status</th>
                    <th>TMT Pensiun</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($getPegawaiByInstansi as $value) { 
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $value->pegawai_nama; ?></td>
                      <td><?php echo $value->pegawai_nip; ?></td>
                      <td><?php echo $value->gol_pangkat .' ('.$value->gol_nama.')'; ?></td>
                      <td><?php echo $value->jabatan_nama; ?></td>
                      <td><?php echo $value->instansi_unor_nama; ?></td>
                      <td><?php echo $value->status_nama; ?></td>
                      <td>
                       <?php $date=$value->tmt_pensiun;
                       echo date('d F Y', strtotime(str_replace('/', '-', $date)));
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
<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    $('#datatable-export').DataTable( {

      dom: 'Bfrtip',
      buttons: [
                 {
        extend: 'excelHtml5',
        title: 'Data Pegawai OPD'
      },
      {
        extend: 'print',
        title: 'Data Pegawai OPD'
      }
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