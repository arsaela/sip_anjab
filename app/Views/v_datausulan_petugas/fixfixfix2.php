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
      toastr.success('Data ajuan usulan anda berhasil disimpan.');
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
              <h3 class="card-title">Input Usulan Formasi "<?php echo $get_petugas_by_login->instansi_nama;?>"</h3>
              <br>

              <div class="alert alert-danger alert-dismissible alertkeloladatapegawai fade show">
                <p>Sebelum melakukan input ajuan usulan, silahkan melakukan kelola data pegawai di lingkup <?php echo $get_petugas_by_login->instansi_nama;?> terlebih dahulu. Harap sesuaikan dengan realita yang ada. <br><a href="<?php echo base_url('opd/datapegawai'); ?>">Kelola data pegawai </a>
                </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              

              <div class="card-body table-responsive">
                <table id="datatable-list" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Formasi</th>
                      <th>Lokasi Unit Kerja</th>
                      <th>Jumlah Kebutuhan</th>
                      <th>Jumlah ASN</th>
                      <th>Kekurangan Formasi</th>
                      <th>Detail ASN</th>
                      <th>Ajukan Usulan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($getDetailFormasiUsulan as $value) {

                      $kekurangan_formasi = ($value->formasi_jumlah) - ($value->jumlahasn) - ($value->jumlah_usulan_pppk) - ($value->jumlah_usulan_cpns);
                      if ($kekurangan_formasi >= 0 and !empty($kekurangan_formasi)) {

                        ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                        <!-- <td><?php //echo $value->formasi_id; 
                      ?></td> -->

                      <td><?php echo $value->formasi_id; ?> / <?php echo $value->jabatan_nama; ?></td>
                        <!--  <td><?php //echo $value->instansi_unor; 
                      ?></td> -->
                      <td><?php echo $value->instansi_unor_nama; ?></td>
                      <td><?php echo $value->formasi_jumlah; ?></td>
                      <td><?php echo $value->jumlahasn; ?></td>
                      <td><?php echo $kekurangan_formasi; ?></td>
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

                      <td>
                       <?php  

                      // $yearnow = date("Y");

                       //if(($getDetailFormasiUsulan[]->status_usulan_id<>'2') ){

                        //tes
                       if(empty($cekStatusKirimUsulan)){
                         ?>
                         <a href="#" class="btn btn-warning btn-sm btn_input_usulan" data-jabatan_kode="<?= $value->jabatan_kode; ?>" data-id="<?= $no; ?>" data-name="<?= $value->jabatan_nama; ?>" data-kekuranganformasi="<?= $kekurangan_formasi; ?>" data-instansiunornama="<?= $value->instansi_unor_nama; ?>" data-instansiunor="<?= $value->instansi_unor; ?>"><i class="fa fa-check"></i></a>
                       <?php } 
                       else { ?>
                        <a href="#" class="btn btn-warning btn-sm btn_input_usulanku" disabled>Sudah kirim usulan taun ini</a>
                      <?php }
                      ?>
                      <!-- Modal Ajuan Usulan Formasi -->
                      <form action="/opd/DataUsulan/inputusulanopd" method="post" id="frm-inputusulan">
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Input Ajuan Usulan Formasi</h5>
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
                                  <label>Kekurangan Formasi</label>
                                  <input type="text" class="form-control kekuranganformasi" name="jumlah_kekurangan_formasi" readonly placeholder="Jumlah Usulan" required>
                                </div>

                                <div class="form-group">
                                  <label>Jumlah Usulan CPNS</label>

                                  <input type="number" id="jumlah_usulan_cpns" class="form-control jumlah_usulan_cpns_class" value="0" name="jumlah_usulan_cpns" placeholder="Jumlah Usulan CPNS">
                                </div>

                                <div class="form-group prioritas_usulan_cpnsdiv" style="display:none;">
                                  <label>Prioritas Usulan CPNS</label>

                                  <!--   <input type="number" id="prioritas_usulan_cpns" class="form-control prioritas_usulan_cpns_input" name="prioritas_usulan_cpns" placeholder="Prioritas Usulan CPNS"> -->

                                  <select class="form-control" name="prioritas_usulan_cpns" id="prioritas_usulan_cpns">
                                    <option>1</option>
                                    <option selected>2</option>
                                    <option>3</option>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label>Jumlah Usulan PPPK</label>

                                  <input type="number" id="jumlah_usulan_pppk" class="form-control jumlah_usulan_pppk_class" value="0" name="jumlah_usulan_pppk" placeholder="Jumlah Usulan PPPK">
                                </div>

                                <div class="form-group prioritas_usulan_pppkdiv" style="display:none;">
                                  <label>Prioritas Usulan PPPK </label>

                                  <select class="form-control" name="prioritas_usulan_pppk" id="prioritas_usulan_pppk">
                                    <option>1</option>
                                    <option selected>2</option>
                                    <option>3</option>
                                  </select>

                                  <!--  <input type="number" id="prioritas_usulan_pppk" class="form-control prioritas_usulan_pppk_input" name="prioritas_usulan_pppk" placeholder="Prioritas Usulan PPPK"> -->
                                </div>


                                <span class="error_warning_usulan_kebanyakan text-danger"></span>

                              </div>
                              <div class="modal-footer">
                                <input type="hidden" name="usulan_id" class="usulan_id">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-ajuan-usulan">Simpan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      <!-- End Modal Edit Product-->


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



<!-- <div class="modal hide fade" id="myModalLoadOpen">
 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h3 class="card-title">Konfirmasi Data Pegawai saat ini </h3>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <p>Silahkan melakukan kelola data pegawai di lingkup <?php //echo $get_petugas_by_login->instansi_nama;?> terlebih dahulu. Harap sesuaikan dengan realita yang ada.</p>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn">Close</a>
      <a href="<?php //echo base_url('opd/datapegawai'); ?>" class="btn btn-primary">Kelola Data Pegawai</a>
    </div>
  </div>
</div>
</div> -->


<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script type="text/javascript">
  // $(window).on('load', function() {
  //   // $('#myModalLoadOpen').modal('show');
  // });
</script>

<script>

 $("input").keyup(function(){
  var jumlahusulanpppk = parseInt($("input.jumlah_usulan_pppk_class").val());
  var jumlahusulancpns = parseInt($("input.jumlah_usulan_cpns_class").val());
  var kekuranganformasi = parseInt($("input.kekuranganformasi").val());
  //var jumlahusulancpns = $("input.jumlah_usulan_cpns_class").val();
  //var jumlahusulancpns = $("input.jumlah_usulan_cpns_class").val();

  var jumlahusulanasn = jumlahusulanpppk + jumlahusulancpns;




  if(jumlahusulanasn > kekuranganformasi){  
   $(".error_warning_usulan_kebanyakan").text("Maaf, jumlah Usulan ASN (CPNS + PPPK) yang anda inputkan melebihi jumlah kekurangan formasi !");

   $('.btn-ajuan-usulan').prop('disabled', true);
   $('.prioritas_usulan_cpns').hide();
   $('.prioritas_usulan_pppk').hide();

 } else if(jumlahusulancpns > kekuranganformasi){
  $(".error_warning_usulan_kebanyakan").text("Maaf, jumlah Usulan ASN (CPNS + PPPK) yang anda inputkan melebihi jumlah kekurangan formasi !");

  $('.btn-ajuan-usulan').prop('disabled', true);
  $('.prioritas_usulan_cpns').hide();
  $('.prioritas_usulan_pppk').hide();
} else if(jumlahusulanpppk > kekuranganformasi){
  $(".error_warning_usulan_kebanyakan").text("Maaf, jumlah Usulan ASN (CPNS + PPPK) yang anda inputkan melebihi jumlah kekurangan formasi !");

  $('.btn-ajuan-usulan').prop('disabled', true);
  $('.prioritas_usulan_cpns').hide();
  $('.prioritas_usulan_pppk').hide();
} else if(jumlahusulanpppk<= kekuranganformasi)   {
  $('.prioritas_usulan_pppkdiv').show();
  $('.btn-ajuan-usulan').prop('disabled', false);
  $(".error_warning_usulan_kebanyakan").hide();
}else if(jumlahusulancpns<= kekuranganformasi)   {
  $('.prioritas_usulan_cpnsdiv').show();
  $('.btn-ajuan-usulan').prop('disabled', false);
  $(".error_warning_usulan_kebanyakan").hide();
}else if((jumlahusulancpns> kekuranganformasi) && (jumlahusulanpppk> kekuranganformasi))   {
  $('.prioritas_usulan_cpnsdiv').hide();
  $('.prioritas_usulan_pppkdiv').hide();
  $(".error_warning_usulan_kebanyakan").text("Maaf, jumlah Usulan ASN (CPNS + PPPK) yang anda inputkan melebihi jumlah kekurangan formasi !");
}


console.log("usulan cpns="+jumlahusulancpns);
console.log("usulan pppk="+jumlahusulanpppk);
console.log("jumlah usul asn= "+jumlahusulanasn);
console.log("jumlah kekurangan formasi= "+kekuranganformasi);



// $("input").css("background-color", "pink");
});

 $('input.jumlah_usulan_cpns_class').keyup(function(e){
  if(e.keyCode == 8) {
        // alert('Delete key released');
        $('.prioritas_usulan_cpnsdiv').hide();
        console.log('Delete key released');
      }
    });

 $('input.jumlah_usulan_pppk_class').keyup(function(e){
  if(e.keyCode == 8) {
        // alert('Delete key released');
        $('.prioritas_usulan_pppkdiv').hide();
        console.log('Delete key released');
      }
    });



//set 0 after delete value
 $('input.jumlah_usulan_pppk_class').change(function(){
  if($(this).val() == ""){
    $(this).val(0);
  }
});

 $('input.jumlah_usulan_cpns_class').change(function(){
  if($(this).val() == ""){
    $(this).val(0);
  }
});



 $(document).ready(function() {
    // get Edit Product
    $('body').on('click', '.btn_input_usulan', function() {
      // get data from button edit
      const id = $(this).data('id');
      const name = $(this).data('name');
      const kekuranganformasi = $(this).data('kekuranganformasi');
      const instansiunor_nama = $(this).data('instansiunornama');
      const instansiunor = $(this).data('instansiunor');
      const jabatan_kode = $(this).data('jabatan_kode');
      const price = $(this).data('price');
      const category = $(this).data('category_id'); 

      // const jumlah_usulan_pppk = $(this).data('jumlah_usulan_pppk');

      var get_found_usulan = $("#txtname").val();

      // alert(id);
      // Set data to Form Edit
      $('.usulan_id').val(id);
      $('.jabatan_kode').val(jabatan_kode);
      $('.jabatan_nama').val(name);
      $('.kekuranganformasi').val(kekuranganformasi);
      $('.instansi_unor_nama').val(instansiunor_nama);
      $('.instansi_unor').val(instansiunor);

      // if(!empty($get_found_usulan)){


      // }
      // Call Modal Edit
      $('#editModal').modal('show');






      //alert('jumlahkebutuhanformasi = '+kekuranganformasi);

      $('#frm-inputusulan').validate({
        //var a = jumlah_usulan_cpns + jumlah_usulan_pppk;
        //var a = $(".jumlah_usulan_cpns_class").val();


        rules: {
          a: {
            digits: true,
            min: 1,
            max: kekuranganformasi
          }

          // pass2: {
          //   equalTo: "#pass1"
          // }
        },
        messages: {
          a: {
            required: "Jumlah usulan asn harus di isi",
            min: "Jumlah usulan asn minimal 1",
            max: "Jumlah usulan asn tidak boleh melebihi jumlah kekurangan formasi"

          }
        }
      });


    });






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


  });
</script>
<?= $this->endSection() ?>

<style type="text/css">
.error {
  color: #F00;
  background-color: #FFF;
}

.card .alertkeloladatapegawai {
  color: #fff;
  background: #cd3948 !important;
}
</style>