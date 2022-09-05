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


  <?= $this->section('script') ?>
  <script type="text/javascript">
    <?php if (session("success")) { ?>
      toastr.success('Data usulan berhasil dikirim.');
    <?php } ?>
  </script>
  <?= $this->endSection() ?>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Kirim Usulan OPD "<?php echo $get_petugas_by_login->instansi_nama;?>" ke BKPSDM</h3>
            </div>

            <div class="card-body table-responsive">
              <table id="datatable-list" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Instansi Nama</th>
                    <th>Tahun Usulan</th>
                    <th>Status Usulan</th>
                    <th>Aksi</th>


                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  $yearnow = date("Y");
                  foreach ($getLihatUsulanDescYear as $value) { 
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $value->instansi_nama; ?></td>
                      <td><?php echo $value->tahun_usulan; ?></td>

                      <td>
                        <?php
                        if ($value->status_usulan_id == 1) {
                          echo "<p class='bg_status_belumverifikasi'>belum kirim usulan</p>";
                        } else if ($value->status_usulan_id == 2) {
                          echo "<p class='bg_status_approve'>sudah kirim usulan</p>";
                        } else if ($value->status_usulan_id == 3) {
                          echo "<p class='bg_status_reject'>sudah diverifikasi dan siap diusulkan ke menpan</p>";
                        } else if ($value->status_usulan_id == 4) {
                          echo "<p class='bg_status_reject'>reject usulan</p>";
                        } else if ($value->status_usulan_id == 5) {
                          echo "<p class='bg_status_approve'>pending</p>";
                        } else {
                          echo "<p class='bg_status_pending'>Pending</p>";
                        }
                        ?>
                      </td>


                     <!--  <div style="background-color: yellow; padding:5px;">
                        <?php //echo $value->nama_status; ?>

                      </div> -->
                    </td>
                    <td>
                      <a href="<?php echo base_url('Opd/DataUsulan/detail_usulan_by_year_and_opd/' . $value->tahun_usulan); ?>" class="btn btn-warning"><i class="fa fa-folder-open-o ">
                      Detail</i></a> 




                      <?php if($value->tahun_usulan==$yearnow AND $value->status_usulan_id=='1'){?>
                        <button type="button" class="btn_detail_usulan btn btn-success" data-toggle="modal" value="<?php echo $value->instansi_id; ?>" data-target="#KirimUsulan-<?php echo $value->instansi_id; ?>"><i class="far fa fa-paper-plane-o nav-icon"> Kirim Usulan</i></button>
                      <?php } ?>

                      <!-- Modal KIRIM USULAN-->
                      <form action="aksi_kirimdatausulanopd/<?php echo $value->instansi_id; ?>" method="post">
                        <div class="modal fade" id="KirimUsulan-<?php echo $value->instansi_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kirim Usulan Ke BKPSDM Kab. Klaten</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                              <div class="modal-body">
                                Mohon cek kembali ajuan formasi yang sudah anda inputkan. Pastikan ajuan yang anda input sudah disetujui oleh Kepala Instansi. Selanjutnya, Apakah anda sudah yakin untuk finalisasi data ajuan dan di kirim ke BKPSDM ?
                                <br>
                                <p style="color: red;">
                                  <i>
                                    Warning : Segala bentuk kevalidan data, menjadi tanggung jawab instansi.
                                  </i>
                                </p>
                              </div>
                              <div class="modal-footer">
                                <input type="hidden" name="detail_usulan_id" class="detail_usulan_id" value="<?php echo $value->instansi_id; ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="btn-UpdateKirimUsulan" class="btn btn-primary">Kirim Usulan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>

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


<style type="text/css">
a.btn.btn-warning {
  margin-bottom: 5px;
}
</style>
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