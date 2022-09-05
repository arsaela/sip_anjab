<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>Data Informasi</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

        <?php if (isset($message_success)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $message_success; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        <?php endif; ?>

        <?php if (isset($message_failed)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $message_failed; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        <?php endif; ?>

          <!-- Default box -->
          <div class="card">
            <div class="card-body table-responsive">
              <table class="table table-bordered" id="datatable-list">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Judul Informas</th>
                    <th>Detail Informasi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($getInformasi as $isi) { ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $isi->informasi_judul; ?></td>
                      <td><?php echo $isi->informasi_content; ?></td>
                      <td>
                  
                        <a data-toggle='tooltip' data-placement='top' title='Update Data'  href="<?php echo base_url('DataInformasi/update_informasi/' . $isi->informasi_id); ?>" class="btn btn-success"><i class="fa fa-pencil "></i></a>
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
    </div>
  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>