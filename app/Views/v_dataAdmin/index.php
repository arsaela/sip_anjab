<?= $this->extend('layouts_admin/template_admin') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="/resources/demos/style.css"> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<style>
/* .invalid class prevents CSS from automatically applying */
.invalid input:required:invalid {
  background: #BE4C54;
}

/* Mark valid inputs during .invalid state */
.invalid input:required:valid {
  background: #17D654;
}
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="swal" data-swal="<?php echo session()->get('message');?>"> </div>
  <div class="row">
    <div class="col-md-8">
      <?php
      if (session()->get('err')){
        echo "<div class='alert alert-danger p-0 pt-2' role='alert'>". session()->get('err')."</div>";
        session()->remove('err');
      }
      ?>
    </div>
  </div>


  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>Data Admin</h1>
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
              <h3 class="card-title">Data Admin</h3><br>
              <div class="card-tools">
                <a data-toggle="tooltip" data-placement="top" title="Add">
                  <button type="button" class="btn btn-outline-primary btn-sm" type="button"  data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus"></i>
                  </button>
                </a>
              </div>
              <div class="mt-1">
              </div>
            </div>
            <div class="card-body table-responsive">
              <table id="datatable-list" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Nama Admin</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  $encrypter = \Config\Services::encrypter();
                  foreach ($min as $value) { ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $value['username'] ?></td>
                      <td><?php echo $encrypter->decrypt(base64_decode($value['password'])); ?></td>
                      <td><?php echo $value['admin_nama'] ?></td>
                      <td><?php echo $value['admin_no_hp'] ?></td>
                      <td><?php echo $value['admin_email'] ?></td>

                      <td>
                        <button type="button" data-toggle="modal" data-target="#modalubah" class="btn btn-sm btn-warning" id="btn-edit" data-id="<?php echo $value['id'];?>" data-username="<?php echo $value['username'];?>" data-admin_nama="<?php echo $value['admin_nama'];?>" data-admin_no_hp="<?php echo $value['admin_no_hp'];?>" data-admin_email="<?php echo $value['admin_email'];?>"><i class="fa fa-edit"></i></button>

                        <!-- Modal EDIT -->
                        <div class="modal fade" id="modalubah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                              <form action="<?php echo base_url('DataAdmin/save_update_admin/'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                  <input type="hidden" name="id" id="id_admin" value="<?php echo $value['id'];?>">
                                  <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="data-username" class="form-control" id="username" name="username" value="<?php echo $value['username'];?>" placeholder="Username" required readonly>
                                  </div>

                                  <div class="form-group">
                                    <label for="username">Nama</label>
                                    <input type="text" class="form-control" id="data-admin_nama" name="admin_nama" value="<?php echo $value['admin_nama'];?>" placeholder="Nama" required>
                                  </div> 

                                  <div class="form-group">
                                    <label for="username">No HP</label>
                                    <input type="text" class="form-control" id="data-admin_no_hp" name="admin_no_hp" value="<?php echo $value['admin_no_hp'];?>" placeholder="No HP" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="username">Email</label>
                                    <input type="email" class="form-control" id="data-admin_email" name="admin_email" placeholder="Email" value="<?php echo $value['admin_email'];?>" required>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <a href="/dataadmin/delete_admin/<?=$value['username']; ?>" data-toggle="modal" class="btn btn-sm btn-danger btn-hapus"><i class="fa fa-trash"></i></a>

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

      <!-- Modal ADD -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input Data Admin</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="<?php echo base_url('DataAdmin/add/'); ?>" method="post">
              <?= csrf_field(); ?>
              <div class="modal-body">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                  <label for="username">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div> 

                <div class="form-group">
                  <label for="username">Nama</label>
                  <input type="text" class="form-control" id="nama" name="admin_nama" placeholder="Nama" required>
                </div> 

                <div class="form-group">
                  <label for="username">No HP</label>
                  <input type="text" class="form-control" id="nohp" name="admin_no_hp" placeholder="No HP" required>
                </div>

                <div class="form-group">
                  <label for="username">Email</label>
                  <input type="email" class="form-control" id="email" name="admin_email" placeholder="Email" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <?= $this->endSection() ?>

  <?= $this->section('script') ?>
  <script>
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })
  </script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
    })();
  </script>
  <?= $this->endSection() ?>



  <?= $this->section('script') ?>
  <script src="/assets/js/script.js"></script>
  <?= $this->endSection() ?>
