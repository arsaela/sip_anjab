<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <!-- <h1>Data Informasi</h1> -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">


              <!-- content update data -->
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4 class="card-title">Form Update Informasi</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('datainformasi/save_update');?>">
                            <div class="form-group">
                                <label for="">Judul Informasi</label>
                                <input type="text" value="<?= $informasi_by_id->informasi_judul;?>" name="informasi_judul" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Content</label>
                                <div>
                                <textarea cols="10" rows="10" class="form-control" name="informasi_content" required="required"><?php echo $informasi_by_id->informasi_content;?></textarea>
                                </div>
                            </div>
                            <input type="hidden" value="<?= $informasi_by_id->informasi_id;?>" name="informasi_id">
                            <button class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
               <!-- end content update data -->


        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>