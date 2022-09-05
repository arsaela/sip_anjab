<?= $this->extend('layouts_petugas/template_petugas') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrappere">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1></h1>
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
                            <h3 class="card-title" style="text-align: center !important;float: unset !important; margin-bottom: 20px;"><strong>Data Usulan Pegawai <?php echo $getnamaInstansi[0]->instansi_nama; ?></strong></h3>

                        </div>

                        <div class="card-body table-responsive">
                            <table id="datatable-list" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Formasi</th>
                                        <th>Lokasi Unit Kerja</th>
                                        <th>Jumlah Usulan CPNS</th>
                                        <th>Prioritas Usulan CPNS</th>
                                        <th>Jumlah Usulan PPPK</th>
                                        <th>Prioritas Usulan PPPK</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (!empty($getLihatDetailUsulan)) {
                                        foreach ($getLihatDetailUsulan as $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $value->jabatan_nama; ?></td>
                                                <td><?php echo $value->instansi_unor_nama; ?></td>
                                                <td><?php echo $value->jumlah_usulan_cpns; ?></td>
                                                <td><?php echo $value->prioritas_usulan_cpns; ?></td>
                                                <td><?php echo $value->jumlah_usulan_pppk; ?></td>
                                                <td><?php echo $value->prioritas_usulan_pppk; ?></td>

                                            </tr>
                                            <?php $no++;
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center;">
                                                <span style="color:red; font-style: italic;">"Mohon Maaf, Silahkan lakukan ajuan usulan dan kirim usulan terlebih dahulu."</span>
                                            </td>
                                        </tr>
                                        <?php  
                                    }?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="back_to_page to-print">
                        <input action="action" onclick="window.history.go(-1); return false;" type="submit" value="Kembali Halaman Sebelumnya" />
                    </div>

                    <!-- /.card -->
                </div>
            </div>



        </div>

        <div style="float:right; margin-right: 30px;">
           <?php $no = 1;
           if (!empty($getLihatUsulan)) { ?>
            <?php echo '<img src="data:' . $QR->getContentType() . ';base64,' . $QR->generate() . '" />'; ?>
        <?php } ?>
    </div>
</section>
<!-- /.content -->
</div>


<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    window.print();
</script>
<?= $this->endSection() ?>

<?= $this->section('head') ?>
<style type="text/css">
@media print {
    @page {
        size: A4;
        /* DIN A4 standard, Europe */
        margin: 7mm 6mm 7mm 15mm;
        font-size: 14px;
    }

    html,
    body {
        width: 210mm;
        /* height: 297mm; */
        height: 282mm;
        font-size: 11px;
        background: #FFF;
        overflow: visible;
    }

    body {
        padding-top: 15mm;
    }

    .back_to_page {
        display: none;
    }
    .to-print{
        display: none;
    }
}
</style>

<style type="text/css" media="print">
/* masukan sintak CSS disini */
h3.card-title {
    font-size: 25px;
}

table#datatable-list {
    font-size: 18px;
}
</style>
<?= $this->endSection() ?>