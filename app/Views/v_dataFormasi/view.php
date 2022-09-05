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
              <h3 class="card-title">Tabel Detail Formasi</h3>
            </div>

            <div class="card-body table-responsive">
              <table id="datatable-list" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th rowspan="2" class="align-middle text-center">No.</th>
                    <th rowspan="2" class="align-middle text-center">Formasi</th>
                    <th rowspan="2" class="align-middle text-center">Lokasi Unit Kerja</th>
                    <th rowspan="2" class="align-middle text-center">Jumlah Kebutuhan (ABK)</th>
                    <th rowspan="2" class="align-middle text-center">Jumlah ASN</th>
                    <th colspan="5" class="text-center">Pensiun / BUP</th>
                    <th rowspan="2" class="align-middle text-center">Detail ASN</th>  
                  </tr>

                  <?php 
                  $tahun_usulan_now = date("Y");
                  $bup_pertama = $tahun_usulan_now + 1;
                  $bup_kedua = $tahun_usulan_now + 2;
                  $bup_ketiga = $tahun_usulan_now + 3;
                  $bup_keempat = $tahun_usulan_now + 4;
                  $bup_kelima = $tahun_usulan_now + 5;

                  ?>
                  <tr>
                    <td><strong><?php echo $bup_pertama;  ?></strong></td>
                    <td><strong><?php echo $bup_kedua;  ?></strong></td>
                    <td><strong><?php echo $bup_ketiga;  ?></strong></td>
                    <td><strong><?php echo $bup_keempat;  ?></strong></td>
                    <td><strong><?php echo $bup_kelima;  ?></strong></td>
                  </tr>

                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($getDetailFormasi as $value) {
                    $jabatankode = $value->jabatan_kode;
                    $instansiunor = $value->instansi_unor;

                    $db      = \Config\Database::connect();
                    $builder = $db->table('tbl_pegawai');
                    $queryku   = $builder->select('*,tbl_pegawai.tmt_pensiun,count(tbl_pegawai.tmt_pensiun) as jumlah_asn_bup')
                    ->where('tbl_pegawai.jabatan_kode', $jabatankode)
                    ->where('tbl_pegawai.instansi_unor', $instansiunor)
                    ->orderBy('tbl_pegawai.id asc')
                    ->get();
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $value->jabatan_nama; ?></td>
                      <td><?php echo $value->instansi_unor_nama; ?></td>
                      <td><?php echo $value->formasi_jumlah; ?></td>
                      <td><?php echo $value->jumlahasn; ?></td>
                      <?php
                      $i = 0;
                      foreach ($queryku->getResult() as $row) { 
                        $explode_taun_tmt_pensiun = substr($row->tmt_pensiun, 0, 4);

                        if($bup_pertama==$explode_taun_tmt_pensiun){ ?>
                          <td> <?php  
                          $jml_pensiun   = $db->query("SELECT count(tbl_pegawai.tmt_pensiun) as jumlahpensiun FROM tbl_pegawai WHERE jabatan_kode='$jabatankode' AND instansi_unor='$instansiunor' AND tmt_pensiun LIKE '$explode_taun_tmt_pensiun%'")->getRow();

                          echo $jml_pensiun->jumlahpensiun;                          
                          ?>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                      <?php } else if ($bup_kedua==$explode_taun_tmt_pensiun) { ?>
                        <td>-</td>
                        <td> 
                          <?php  
                          $jml_pensiun   = $db->query("SELECT count(tbl_pegawai.id) as jumlahpensiun FROM tbl_pegawai WHERE jabatan_kode='$jabatankode' AND instansi_unor='$instansiunor' AND tmt_pensiun LIKE '$explode_taun_tmt_pensiun%'")->getRow();
                          echo $jml_pensiun->jumlahpensiun;                          
                        ?></td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                      <?php } else if ($bup_ketiga==$explode_taun_tmt_pensiun) { ?>
                        <td>-</td>
                        <td>-</td>
                        <td>  
                          <?php  
                          $jml_pensiun   = $db->query("SELECT count(tbl_pegawai.tmt_pensiun) as jumlahpensiun FROM tbl_pegawai WHERE jabatan_kode='$jabatankode' AND instansi_unor='$instansiunor' AND tmt_pensiun LIKE '$explode_taun_tmt_pensiun%'")->getRow();

                          echo $jml_pensiun->jumlahpensiun;                          
                          
                        ?></td>
                        <td>-</td>
                        <td>-</td>
                      <?php } else if ($bup_keempat==$explode_taun_tmt_pensiun) { ?>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>  
                          <?php  
                          $jml_pensiun   = $db->query("SELECT count(tbl_pegawai.id) as jumlahpensiun FROM tbl_pegawai WHERE jabatan_kode='$jabatankode' AND instansi_unor='$instansiunor' AND tmt_pensiun LIKE '$explode_taun_tmt_pensiun%'")->getRow();
                          echo $jml_pensiun->jumlahpensiun;                          
                        ?></td>
                        <td>-</td>
                      <?php } else if ($bup_kelima==$explode_taun_tmt_pensiun) { ?>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td> <?php  
                        $jml_pensiun   = $db->query("SELECT count(tbl_pegawai.id) as jumlahpensiun FROM tbl_pegawai WHERE jabatan_kode='$jabatankode' AND instansi_unor='$instansiunor' AND tmt_pensiun LIKE '$explode_taun_tmt_pensiun%'")->getRow();
                        echo $jml_pensiun->jumlahpensiun;                          
                      ?></td>
                    <?php } else { ?>
                      <td><?php echo "-"; ?></td>
                      <td><?php echo "-"; ?></td>
                      <td><?php echo "-"; ?></td>
                      <td><?php echo "-"; ?></td>
                      <td><?php echo "-"; ?></td>
                    <?php } ?>
                    

                    <?php $i++; 
                  } ?>
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
  //Menampilkan modal detail data pegawai di formasi
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
        // alert('nilai i adalah ='+data.length);
        if(data.length>=1){
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
        } else {
          // alert('tidak ada pns');
          output += '<tr>' +
          '<td colspan="4" style="color:red; font-style:italic; text-align:center;"> Maaf, Belum ada Data PNS di jabatan tersebut <br> atau <br> Data PNS belum di tambahkan ! </td>' +
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