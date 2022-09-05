<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('head') ?>
  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <?= $this->endSection() ?>

    <?= $this->section('content') ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1>Import Data</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <?php
              if(session()->getFlashdata('message')){
                ?>
                <div class="alert alert-info">
                  <?= session()->getFlashdata('message') ?>
                </div>
                <?php
              }
              ?>
              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Import Data</h3><br>
                  <div class="mt-1">
                   <form method="post" action="Importpegawai/simpanExcel" enctype="multipart/form-data">
                     <?= csrf_field(); ?>   
                     <div class="row form-group">
                      <div class="col-md-3">
                        <input class="form-control" name="fileexcel" type="file" id="file" required accept=".xls, .xlsx">
                      </div>
                      <div class="col-md-3">
                        <button class="btn btn-success" type="submit">import</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card-body table-responsive">
                <table id="datatable-list" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Pegawai</th>
                      <th>NIP</th>
                      <th>Instansi</th>
                      <th>Instansi Unor</th>
                      <th>Jabatan</th>
                      <th>Golongan</th>
                      <th>TMT Pensiun</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($pegawai as $key => $value) { ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $value['pegawai_nama'] ?></td>
                        <td><?php echo $value['pegawai_nip'] ?></td>
                        <td><?php echo $value['instansi_id'] ?></td>
                        <td><?php echo $value['instansi_unor'] ?></td>
                        <td><?php echo $value['jabatan_kode'] ?></td>
                        <td>
                          <?php echo $value['pegawai_gol'] ?>
                        </td>
                        <td>
                          <?php $date=$value['tmt_pensiun'];
                          echo date('d F Y', strtotime(str_replace('/', '-', $date)));
                          ?>
                        </td>
                      </tr>
                      <?php $no++; } ?>

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <?= $this->endSection() ?>