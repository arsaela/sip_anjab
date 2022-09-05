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
      toastr.success('Data ajuan perubahan ABK berhasil disimpan.');
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
              <h3 class="card-title"><strong>Rekap Formasi OPD "<?php echo $get_petugas_by_login->instansi_nama;?>"</strong></h3>
            </div>

            <div class="card-body table-responsive">
              <table id="datatable-list" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th rowspan="2" class="align-middle text-center">No.</th>
                    <!--  <th>Formasi</th> -->
                    <th rowspan="2" class="align-middle text-center">Formasi</th>
                    <!--  <th>Lokasi Unit Kerja</th> -->
                    <th rowspan="2" class="align-middle text-center">Lokasi Unit Kerja</th>
                    <th rowspan="2" class="align-middle text-center">Jumlah Kebutuhan (ABK)</th>
                    <th rowspan="2" class="align-middle text-center">Jumlah ASN</th>
                    <th colspan="5" class="text-center">Pensiun / BUP</th>
                    <th rowspan="2" class="align-middle text-center">Detail ASN</th>
                    <!--   <th>Ajukan Perubahan ABK</th> -->
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
                  <?php 
                  $no = 1;
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
                      <!-- <td><?php //echo $value->formasi_id; ?></td> -->
                      <td><?php echo $value->jabatan_nama; ?></td>
                      <!--  <td><?php //echo $value->instansi_unor; ?></td> -->
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

                      <!--  <td> -->
                       <?php 
                       //if(empty($cekFormasiAjuanABK)){
                       ?>
                       <!--  <a href="#" class="btn btn-warning btn-sm btn_ubah_abk" data-jabatan_kode="<?= $value->jabatan_kode; ?>" data-id="<?= $no; ?>" data-name="<?= $value->jabatan_nama; ?>" data-abk_lama="<?= $value->formasi_jumlah; ?>" data-instansiunornama="<?= $value->instansi_unor_nama; ?>" data-instansiunor="<?= $value->instansi_unor; ?>"><i class="fa fa-check"></i></a> -->
                         <?php //} 
                       //else { ?>
                         <!--  <a href="#" class="btn btn-warning btn-sm btn_ubah_abkku" disabled>Jumlah ABK = </a> -->
                       <?php //}
                       ?>

                       <!-- Modal Ajuan Perubahan ABK -->
<!--                        <form action="/opd/dataFormasi/ajukan_perubahan_abk_opd" method="post" id="frm-inputusulan">
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Input Ajuan Perubahan ABK</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                              <div class="modal-body">
                                <div class="form-group">
                                  <label>Jabatan Nama</label>
                                  <input type="text" class="form-control jabatan_nama" name="jabatan_nama" placeholder="Jabatan Nama" readonly required>
                                  <input type="hidden" class="form-control jabatan_kode" name="jabatan_kode" placeholder="Jabatan Kode" readonly required>
                                  <input type="hidden" class="form-control instansi_unor" name="instansi_unor" placeholder="Instansi Unor" readonly required>
                                </div>

                                <div class="form-group">
                                  <label>Lokasi Unit Kerja</label>
                                  <input type="text" class="form-control instansi_unor_nama" name="instansi_unor_nama" readonly placeholder="Lokasi Unit Kerja" required>
                                </div>

                                <div class="form-group">
                                  <label>Jumlah Kebutuhan (ABK) Lama</label>

                                  <input type="text" class="form-control abk_lama" name="jumlah_abk_lama" readonly placeholder="Jumlah Usulan" required>
                                </div>

                                <div class="form-group">
                                  <label>Jumlah Kebutuhan (ABK) yang diajukan</label>

                                  <input type="number" id="jumlah_abk_yang_diajukan" class="form-control jumlah_abk_yang_diajukan" required name="jumlah_abk_yang_diajukan" placeholder="Jumlah Usulan">
                                </div>


                                <span class="error_warning_abk_kurang text-danger">
                                  Maaf, ABK yang anda ajukan kurang dari ABK Lama.
                                </span>

                              </div>
                              <div class="modal-footer">
                                <input type="hidden" name="usulan_id" class="usulan_id">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn_ajukan_update_abk">Simpan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form> -->
                      <!-- End Modal Edit Product-->
                      <!--  </td> -->
                    </tr>
                    <?php $no++;

                  } 

                  ?>

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
  //Menampilakan modal detail pegawai
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

        if(data.length==0){
         output += '<tr>' +
         '<td colspan="4" style="background-color:#fff; color:red; text-align:center;">' +  'Data PNS tidak ditemukan ..' + '</td>' +
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




<script>
  $("input.jumlah_abk_yang_diajukan").keyup(function(){
    var jumlahabklama = parseInt($("input.abk_lama").val());
    var jumlah_abk_yang_diajukan = parseInt($("input.jumlah_abk_yang_diajukan").val());;

    if(jumlah_abk_yang_diajukan < jumlahabklama){
      // alert("tes1");
      $(".error_warning_abk_kurang").show();
      $('.btn_ajukan_update_abk').prop('disabled', true);
      // alert("errror abk kurang");
    }
  });

  $('input.jumlah_abk_yang_diajukan').keyup(function(e){
    if(e.keyCode == 8) {
      $('.error_warning_abk_kurang').hide();
      console.log('Delete key released');
    }
  });


  $(document).ready(function() {
    $('body').on('click', '.btn_ubah_abk', function() {
      $(".error_warning_abk_kurang").hide();
    });
  });


















  $(document).ready(function() {
    // $('#frm-inputusulan').validate();

    // get Edit Product
    $('body').on('click', '.btn_ubah_abk', function() {
      // alert('tesss');

      // get data from button edit
      const id = $(this).data('id');
      const name = $(this).data('name');
      const instansiunor_nama = $(this).data('instansiunornama');
      const instansiunor = $(this).data('instansiunor');
      const jabatan_kode = $(this).data('jabatan_kode');
      const abk_lama = $(this).data('abk_lama');
      var get_found_usulan = $("#txtname").val();

      // alert(id);
      // Set data to Form Edit
      $('.usulan_id').val(id);
      $('.jabatan_kode').val(jabatan_kode);
      $('.jabatan_nama').val(name);
      $('.abk_lama').val(abk_lama);
      $('.instansi_unor_nama').val(instansiunor_nama);
      $('.instansi_unor').val(instansiunor);

      $('#editModal').modal('show');


    });

  });
</script>
<?= $this->endSection() ?>