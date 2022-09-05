<?= $this->extend('layouts_user/template_user') ?>
<?php //echo $this->extend('layouts_petugas/header_top'); 
?>

<?= $this->section('header') ?>
<header id="header" class="fixed-top">
  <div class="container">
    <div class="row">
      <div class="wrap-logo-left col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h1 class="logo mr-auto">
          <a href="<?php echo base_url('/'); ?>">
            <img src="/assets/img/klaten_logo.png">
            <div class="sip_text_home"> SISTEM USULAN FORMASI </div>
            <div class="pemkab_text"> BKPSDM KABUPATEN KLATEN </div>
          </a>
        </h1>
      </div>
      <div class="wrap-menu-right col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <nav class="nav-menu d-none d-lg-block">
          <ul>
            <li class="active"><a href="<?php echo base_url('/'); ?>">Home</a></li>
            <li><a href="<?php echo base_url('login'); ?>">Login</a></li>
          </ul>
        </nav><!-- .nav-menu -->
      </div>
    </div>
  </div>
</header><!-- End Header -->

<section class="slider" id="slider">
  <div class="background_contact parallax" style="background-image: url('/assets/img/iconklaten.png')">
    <div class="wrap-slider">
      <div class="container">
        <div class="row">
          <div class="isi-slider col-md-6">
            <!-- <h3> Selamat datang ! </h3> -->
            <h4 class="sip_text"> S I P </h4>
            <h4 class="sip_text_italic"> ( Sistem Informasi Pengusulan Formasi ) </h4>
          </div>
          <div class="isi-slider col-md-6">
            <img class="img_slider_human" src="/assets/img/ICON_PNS2.png" style="float:right;">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main id="main">
  <section class="section_batas_pengusulan" id="section_batas_pengusulan">
    <div class="container">
      <div class="row">
        <div class="title-section-batas-pengusulan col-md-12">
          <h3>Batas Waktu Pengusulan</h3>
        </div>
      </div>

      <!-- count down timer pengusulan -->
      <div class="wrap_countdowntimer row offset-md-3">

        <div class="wrap_timer_shape col-md-2">
          <div class="card countdowntimer">
            <div class="card-content timer">
              <h5 id="hari" class="center"></h5>
              <span class="day_title">Hari</span>
            </div>
          </div>
        </div>

        <div class="wrap_timer_shape col-md-2">
          <div class="card countdowntimer">
            <div class="card-content timer">
              <h5 id="jam" class="center"></h5>
              <span class="day_title">Jam</span>
            </div>
          </div>
        </div>

        <div class="wrap_timer_shape col-md-2">
          <div class="card countdowntimer">
            <div class="card-content timer">
              <h5 id="menit" class="center"></h5>
              <span class="day_title">Menit</span>
            </div>
          </div>
        </div>

        <div class="wrap_timer_shape col-md-2">
          <div class="card countdowntimer">
            <div class="card-content timer">
              <h5 id="detik" class="center"></h5>
              <span class="day_title">Detik</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="informasi" id="informasi">
      <div class="container">
        <div class="row">
          <div class="title-section-informasi col-md-12">
            <h3>Informasi</h3>
          </div>
        </div>

        <div class="row">
          <?php foreach ($getInformasi as $value) { ?>
            <div class="wrap-informasi col-lg-12 col-md-12 col-sm-6 col-xs-12">
              <div class="content_informasi">
                <?php echo $value->informasi_content; ?>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>


    <section class="alur_pengusulan" id="alur_pengusulan">
      <div class="container">
        <div class="row">
          <div class="title-section-informasi col-md-12">
            <h3>Alur Pengusulan</h3>
          </div>
        </div>

        <?php $no = 1;
        foreach ($getAlurPengusulan as $value) { 
         

          ?>
          <div class="wrap-alur-pengusulan left row">
            <div class="content_alur_pengusulan col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <img class="img_alur_pengusulan left" style="width: 200px;" src="/uploads/<?php echo $value->alur_pengusulan_img;?>">
            </div>
            <div class="content_alur_pengusulan col-lg-8 col-md-8 col-sm-6 col-xs-12">
              <h3><?php echo $no.".  ";?><?php echo $value->alur_pengusulan_judul;?></h3>
              <?php echo $value->alur_pengusulan_detail;?>
            </div>
          </div>
          <?php 

          $no++;
        } ?>     


      </div>
    </section>
  </main>
  <?= $this->endSection() ?>


  <?= $this->section('script') ?>
  <script>
    CountDownTimer("<?php echo $timer->waktu; ?>", 'hari', 'jam', 'menit', 'detik');

    function CountDownTimer(dt, id1, id2, id3, id4) {
      var end = new Date(dt);

      var _second = 1000;
      var _minute = _second * 60;
      var _hour = _minute * 60;
      var _day = _hour * 24;
      var timer;

      function showRemaining() {
        var now = new Date();
        var distance = end - now;
        var distance1 = now - end;
        if (distance1 > 0) {
          clearInterval(timer);
          return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById(id1).innerHTML = days;
        document.getElementById(id2).innerHTML = hours;
        document.getElementById(id3).innerHTML = minutes;
        document.getElementById(id4).innerHTML = seconds;
      }

      timer = setInterval(showRemaining, 1000);
    }
  </script>
  <?= $this->endSection() ?>

  <style type="text/css">
  .content_alur_pengusulan h3 {
    font-weight: 700;
    font-size: 26px;
    color: #e7860d !important;
  }
</style>