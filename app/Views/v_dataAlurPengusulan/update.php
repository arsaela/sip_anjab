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
              <h4 class="card-title">Form Update Alur Pengusulan</h4>
            </div>
            <div class="card-body">

              <form method="post" action="<?php echo base_url('dataalurpengusulan/edit_save_alur_pengusulan'); ?>" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Icon Alur Pengusulan</label>
                  <div>
                    <?php
                    if (!empty($alur_pengusulan_by_id->alur_pengusulan_img)) {
                      echo '<img src="'.base_url("/uploads/$alur_pengusulan_by_id->alur_pengusulan_img").'" width="150">';
                    }
                    ?>
                  </div>
                  <br>
                  <div class="form-group">
                   <input type="file" name="file_upload" class="form-control"> 
                 </div> 
               </div> 

               <div class="form-group">
                <label for="">Judul Alur Pengusulan</label>
                <input type="text" value="<?= $alur_pengusulan_by_id->alur_pengusulan_judul;?>" name="alur_pengusulan_judul" required class="form-control">
              </div>

              <div class="form-group">
                <label for="">Alur pengusulan Detail</label>
                <div>
                  <textarea cols="10" rows="10" class="form-control" name="alur_pengusulan_detail" required="required"><?php echo $alur_pengusulan_by_id->alur_pengusulan_detail;?></textarea>
                </div>
              </div>
              <input type="hidden" value="<?= $alur_pengusulan_by_id->alur_pengusulan_id;?>" name="alur_pengusulan_id">
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