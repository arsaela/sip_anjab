<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('head') ?>
  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>Batas Pengusulan</h1>
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
              <h3 class="card-title">Setting Batas Pengusulan</h3>
            </div>
            <div class="container card-body">
              <?php foreach ($batasPengusulan as $batas) : ?>
               <?php $time=$batas['waktu'];
               $date = $batas['waktu'];
               echo "<strong> Batas Waktu Pengusulan saat ini : </strong>";
               echo date('d F Y', strtotime(str_replace('/', '-', $date)));
               ?>


              <?php endforeach; ?>

              <br>  <br>

              <form class="row" action="/SetBatasUsulan/update/<?=$batas['id']?>" method="post">
              <?= csrf_field(); ?>
              <input type="hidden" class="form-control" id="id" name="id" value="1"/>
                <label for="date" class="col-2 col-form-label">Ubah Batas Waktu</label>
                <div class="col-3">
                  <div class="input-group date" id="date">
                    <input type="text" class="form-control" id="date" value="<?php  echo date('Y/m/d', strtotime(str_replace('/', '-', $date)));?>" name="waktu" placeholder="<?php echo $batas['waktu'];?>"/>
                    
                  </div>
                </div>
                <div class="col-3">
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
              </form>
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
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

    <script>
        $(document).ready(function() {
            var date_input = $('input[name="waktu"]'); //our date input has the name "date"
           
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'yyyy/mm/dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        })
    </script>
<?= $this->endSection() ?>