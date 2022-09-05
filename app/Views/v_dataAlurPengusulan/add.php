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
              <h4 class="card-title">Form Tambah Data Alur Pengusulan</h4>
            </div>
            <div class="card-body">

             <form method="post" action="<?php echo base_url('dataalurpengusulan/upload'); ?>" enctype="multipart/form-data">
              <?= csrf_field(); ?>
              <div class="form-group">
                <label for="">Icon Alur Pengusulan</label>
                <input type="file" name="file" class="form-control" required/>
              </div>
              
              <div class="form-group">
                <label for="">Judul Alur Pengusulan</label>
                  <input type="text" name="alur_pengusulan_judul" required class="form-control">
              </div>

              <div class="form-group">
                <label for="">Detail Alur Pengusulan</label>
                <!--   <input type="text" name="alur_pengusulan_detail" required class="form-control"> -->

                <div>
                  <textarea cols="10" rows="10" class="form-control" name="alur_pengusulan_detail" required="required"></textarea>
                </div>
              </div>



              <!--  <button class="btn btn-success">Save</button> -->
              <input type="submit" name="mysubmit" value="Upload File!"  />
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