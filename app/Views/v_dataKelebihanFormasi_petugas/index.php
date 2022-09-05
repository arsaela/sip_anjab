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
              <h3 class="card-title">Data Kelebihan Pegawai "<?php echo $get_petugas_by_login->instansi_nama; ?>"</h3>
            </div>

            <div class="card-body table-responsive">
              <table id="datatable-list" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <!--  <th>Formasi</th> -->
                    <th>Formasi</th>
                    <!--  <th>Lokasi Unit Kerja</th> -->
                    <th>Lokasi Unit Kerja</th>
                    <th>Jumlah Kebutuhan</th>
                    <th>Jumlah ASN</th>
                    <th>Kelebihan Pegawai</th>
                    <th>Detail ASN</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($getDetailFormasi as $value) {
                    //$kebutuhan_formasi = ($value->jumlahasn)-($value->formasi_jumlah);

                    $kebutuhan_formasi = ($value->formasi_jumlah) - ($value->jumlahasn);
                    //if($kebutuhan_formasi >=0 AND !empty($kebutuhan_formasi)){
                    if ($kebutuhan_formasi <= 0 and !empty($kebutuhan_formasi)) {
                  ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <!-- <td><?php //echo $value->formasi_id; 
                                  ?></td> -->
                        <td><?php echo $value->jabatan_nama; ?></td>
                        <!--  <td><?php //echo $value->instansi_unor; 
                                  ?></td> -->
                        <td><?php echo $value->instansi_unor_nama; ?></td>
                        <td><?php echo $value->formasi_jumlah; ?></td>
                        <td><?php echo $value->jumlahasn; ?></td>
                        <td><?php echo $kebutuhan_formasi; ?></td>
                        <td>

                          <button type="button" instansi_unor="<?php echo $value->instansi_unor; ?>" jabatan_kode="<?php echo $value->jabatan_kode; ?>" class="edit btn btn-success"><i class="fa fa-search"></i></button>

                          <!-- The Pegawai -->
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <h3 class="card-title">Detail ASN</h3>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Jabatan</th>
                                      </tr>
                                    </thead>
                                    <tbody id="show_data">
                                    </tbody>
                                  </table>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                                </div>

                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                  <?php $no++;
                    }
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

        if (data.length == 0) {
          output += '<tr>' +
            '<td colspan="4" style="background-color:#fff; color:red; text-align:center;">' + 'Data PNS tidak ditemukan ..' + '</td>' +
            '</tr>';
          i++;
        } else {
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
        }

        $('#myModal').modal("show");
        $('#show_data').html(output);
      }
    })

  });
</script>
<?= $this->endSection() ?>