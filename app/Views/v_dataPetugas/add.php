<?= $this->section('content') ?>
<div class="modal fade" id="modalAdd">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Input Data petugas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formInputDatapetugas">
        <div class="modal-body">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control username2" name="username2" placeholder="Username">
            <small id="username_error" class="text-danger"> </small>
          </div>
          <div class="form-group">
            <label for="petugas_nama">Nama petugas</label>
            <input type="text" class="form-control" name="petugas_nama2" placeholder="Nama petugas" required>
            <small id="petugas_nama_error" class="text-danger"> </small>
          </div>
          <div class="form-group">
            <label for="petugas_no_hp">No. HP</label>
            <input type="text" class="form-control" name="petugas_no_hp2" placeholder="No. HP">
            <small id="petugas_no_hp_error" class="text-danger"> </small>
          </div>
          <div class="form-group">
            <label for="petugas_email">Email</label>
            <input type="email" class="form-control" name="petugas_email2" placeholder="Email">
            <small id="petugas_email_error" class="text-danger"> </small>
          </div>
          <div class="form-group">
            <label for="petugas_password">Password</label>
            <input type="password" class="form-control" name="petugas_password2" placeholder="Password">
            <small id="petugas_password_error" class="text-danger"> </small>
            <!-- </div>
          <div class="form-group">
            <label for="petugas_password_conf">Password Confirmation</label>
            <input type="password" class="form-control" name="petugas_password_conf" placeholder="Password Confirmation">
            <small id="petugas_password_conf_error" class="text-danger"> </small> -->
          </div>
          <div class="form-group">
            <label for="instansi_id">Unit Kerja</label>
            <select class="form-control" name="instansi_id2" id="instansi_id2" required>
              <option value="">TIdak Ada Yang Dipilih</option>
              <?php foreach ($instansi_nama as $row) : ?>
                <option value="<?php echo $row->instansi_id; ?>"><?php echo $row->instansi_nama; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
      </form>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btn-saveDatapetugas" class="btn btn-primary">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

</script>
<?= $this->endSection() ?>