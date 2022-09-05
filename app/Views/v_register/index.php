<?= $this->extend('layouts_user/template_user') ?>

<?= $this->section('header') ?>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo mr-auto"><a href="<?php echo base_url('/'); ?>">SI<span>P</span> (Aplikasi Formasi Pegawai) </a></h1>
    </div>
</header>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Register</h2>
                <ol>
                    <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                    <li>Register</li>
                </ol>
            </div>

        </div>
    </section>

    <!-- ======= Register ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h3><span>Halaman Register</span></h3>
                <p>Aplikasi Formasi Pegawai - Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Klaten</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">

                <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
                    <img src="/assets/bizland/img/about.jpg" class="img-fluid" alt="">
                </div>

                <div class="col-lg-6">
                <form method="post" action="<?= base_url('RegisterPetugas/register');?>"  id="formLogin" role="form" class="php-email-form">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="petugas_nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">No Handphone</label>
                    <input type="text" name="petugas_no_hp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="petugas_email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Instansi</label>
                    <input type="text" name="instansi_id" class="form-control" required>
                </div>
                <button class="btn btn-success">Simpan/button>
            </form>
                  
                </div>

            </div>

        </div>
    </section>

</main>
<?= $this->endSection() ?>