<?= $this->extend('layouts_petugas/template_petugas') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4>Selamat Datang, <span style="text-transform: capitalize;"><?php echo $get_petugas_by_login->petugas_nama;?> - <?php echo $get_petugas_by_login->instansi_nama;?></span> di sistem S.I.P. </h4>
                            <p>Sistem Informasi Pengusulan Pegawai - Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Klaten</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="padding-bottom: 40px;padding-left: 5px;padding-right: 5px;">
                      <div class="card-header">
                        <h3 class="card-title"><b><i class="fa fa-bullhorn" style="padding-right: 10px;">   Informasi Terkini </i></b></h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="d-md-flex">
                      <div class="p-1 flex-fill" style="overflow: hidden">
                        <?php foreach($getInformasi as $value) { ?>
                            <div class="wrap-informasi col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                <div class="content_informasi">                
                                    <?php echo $value->informasi_content;?>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div><!-- /.d-md-flex -->
        </div>
    </div>
</div>
</div>
    
</div>
</section>
<!-- /.content -->    
</div>

<style type="text/css">
    .inner h4 {
    font-size: 20px;
    }
</style>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>