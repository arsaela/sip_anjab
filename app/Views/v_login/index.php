<?= $this->extend('layouts_user/template_user') ?>

<?php //$this->section('header'); ?>
<!-- <header id="header" class="fixed-top">
    <div class="container">
        <div class="row">
            <div class="wrap-logo-left col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <h1 class="logo mr-auto">
                <a href="<?php //echo base_url('/'); ?>">
                  <img src="/assets/img/klaten_logo.png">
                  <div class="sip_text_home"> APLIKASI FORMASI PEGAWAI </div>
                  <div class="pemkab_text"> BKPSDM KABUPATEN KLATEN </div>
              </a>
          </h1>
      </div>
      <div class="wrap-menu-right col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li><a href="<?php //echo base_url('/'); ?>">Home</a></li>
              <li><a href="#alur_pengusulan">Alur Pengusulan</a></li>
              <li><a href="#informasi">Informasi</a></li>
              <li class="active"><a href="<?php //echo base_url('login'); ?>">Login</a></li>

          </ul>
      </nav>
  </div>
</div>
</div>


</div>
</header> --><!-- End Header -->
<?php //$this->endSection(); ?>

<?= $this->section('content') ?>
<main id="main">
    <!-- ======= Login ======= -->
    <section class="bg_login" style="background-image: url('/assets/img/wallpaper_login.jpg')">
        <div id="formWrapper">
            <div id="form">
                <div class="logo">
                    <h2 class="login_sip"> - LOGIN SIP - </h2>
                </div>

                <form id="formLogin" role="form" class="php-email-form">

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="icofont-email"></i></span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Username" />
                    </div>
                    <small id="username_error" class="form-text text-danger mb-3"></small>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i id="show-password" class="icofont-eye-blocked"></i></span>
                        </div>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    </div>
                    <small id="password_error" class="form-text text-danger mb-3"></small>

                    <div class="text-center mb-2">
                        <button class="btn btn-primary col-lg" type="submit" id="btn-login">Login</button>
                    </div>
                    <a style="float:left" href="/"><i class="fa fa-long-arrow-left"></i> Back</a>
                    <a style="float:right" href="DaftarPetugas/index"> Lupa Password ?</a>
                </form>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {

        //Show Password
        $('#show-password').on('click', function() {
            if ($(this).hasClass('icofont-eye-blocked')) {
                $('#password').attr('type', 'text');
                $(this).removeClass('icofont-eye-blocked');
                $(this).addClass('icofont-eye');
            } else {
                $('#password').attr('type', 'password');
                $(this).removeClass('icofont-eye');
                $(this).addClass('icofont-eye-blocked');
            }
        });
        //-------------------------------------------------------------------

        //Submit pendaftaran user
        $('#btn-login').on('click', function() {
            const formLogin = $('#formLogin');

            $.ajax({
                url: "login/cekUser",
                method: "POST",
                data: formLogin.serialize(),
                dataType: "JSON",
                success: function(data) {
                    //Login Error
                    if (data.error) {

                        if (data.login_error['username'] != '') $('#username_error').html(data.login_error['username']);
                        else $('#username_error').html('');

                        if (data.login_error['password'] != '') $('#password_error').html(data.login_error['password']);
                        else $('#password_error').html('');
                    }

                    //Login Succes
                    if (data.success) {
                        formLogin.trigger('reset');
                        $('#username_error').html('');
                        $('#password_error').html('');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Login Berhasil',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.replace(data.link);
                    }

                }

            });

        });
        //-------------------------------------------------------------------

    });
</script>
<?= $this->endSection() ?>