<?= $this->extend('layouts_petugas/template_petugas') ?>

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
              <h3 class="card-title">Data Ajuan Perubahan ABK OPD "<?php echo $get_petugas_by_login->instansi_nama;?>" tahun <?php echo date('Y');?></h3>
            </div>

            <div class="card-body table-responsive">
              <table id="datatable-list" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Formasi</th>
                    <th>Lokasi Unit Kerja</th>
                    <th>Instansi Nama</th>
                    <th>Jumlah Ajuan ABK</th>
                    <th>Tanggal Ajuan</th>                 
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($getAjuanABK as $value) { 
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $value->jabatan_nama; ?></td>
                      <td><?php echo $value->instansi_unor_nama; ?></td>
                      <td><?php echo $value->instansi_nama; ?></td>
                      <td><?php echo $value->jumlah_abk_baru; ?></td>
                      <td><?php echo $value->tanggal_ajuan; ?></td>
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

<style type="text/css">
tbody tr td a {
  padding: 6px !important;
  font-size: 14px !important;
}

tbody tr td a.btn.btn-lg.btn-danger.disabled {
  background-color: #d50a0a;
  border-color: #d50a0a;
  border-radius: 0px;
}

tbody tr td a.btn.btn-lg.btn-success.disabled {
  border-radius: 0px;
}  

tbody tr td a.btn.btn-lg.btn-primary.disabled {
  border-radius: 0px;
}
</style>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  //Menampilakan modal edit data petugas
  $('body').on('click', '.edit', function() {
    var instansiunor = $(this).attr("instansi_unor");
    var jabatankode = $(this).attr("jabatan_kode");
    $.ajax({
      url: "/dataFormasi/detail_pegawai/",
      type: "GET",
      dataType: "JSON",
      data: {
        instansiunor: instansiunor,
        jabatankode: jabatankode
      },
      success: function(data) {
        // alert("sukses"+data);
        var output = '';
        var no = 0;
        var i = 0;
        while (i < data.length) {
          no++;
          output += '<tr>' +
          '<td>' + no + '</td>' +
          '<td>' + data[i].pegawai_nama + '</td>' +
          '<td>' + data[i].pegawai_nip + '</td>' +
          '<td>' + data[i].jabatan_nama + '</td>' +
            // '<td>'+data[i].formasi_jumlah+'</td>'+

            '</tr>';
            i++;
          }

          $('#myModal').modal("show");
          $('#show_data').html(output);
        }
      })

  });
</script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="/assets/js/script.js"></script>
<?= $this->endSection() ?>