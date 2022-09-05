<html>

<head>
    <title>Cetak Data Usulan Pegawai Kabupaten Klaten</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

    <!-- jQuery -->
    <script type="text/javascript" src="/assets/adminlte3/plugins/jquery/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="/assets/adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="/assets/adminlte3/plugins/toastr/toastr.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/assets/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="/assets/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/assets/adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/adminlte3/dist/css/adminlte.min.css">
    <!--MENAMBAHKAN ICON -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/style-admin.css">


</head>

<body>

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
                             <?php $tahun_usulan_now = date("Y");?>
                             <h3 class="card-title">
                                Data Usulan Seluruh OPD Tahun <?php echo $tahun_usulan_now;?><br>
                                Instansi : Pemerintah Kabupaten Klaten
                            </h3>

                        </div>

                        <div class="card-body table-responsive">
                            <table id="datatable-list" class="table table-bordered table-striped">
                                <thead>
                                    <div>

                                        <div class="mt-3"><?php //echo $value->instansi_nama; ?></div>
                                    </div>

                                    <br>
                                    <tr>
                                        <th>No.</th>
                                        <th>Formasi</th>
                                        <th>Lokasi Unit Kerja</th>
                                        <th>Unit Kerja</th>
                                        <th>Usulan PPPK</th>
                                        <th>Usulan CPNS</th>
                                        <th>Jumlah Approve CPNS</th>
                                        <th>Jumlah Approve PPPK</th>
                                       

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $no = 1;
                                    foreach ($getLihatUsulan as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $value->jabatan_nama; ?></td>
                                            <td><?php echo $value->instansi_unor_nama; ?></td>
                                            <td><?php echo $value->instansi_nama; ?></td>
                                            <td><?php echo $value->jumlah_usulan_pppk; ?></td>
                                            <td><?php echo $value->jumlah_usulan_cpns; ?></td>
                                            <td><?php echo $value->jumlah_approve_pppk; ?></td>
                                            <td><?php echo $value->jumlah_approve_cpns; ?></td>
                                        </tr>
                                        <?php $no++;

                                    } 
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="back_to_page">
                        <input action="action" onclick="window.history.go(-1); return false;" type="submit" value="Kembali Halaman Sebelumnya" />
                    </div>

                    <!-- /.card -->
                </div>
            </div>



        </div>
    </section>
    <!-- /.content -->
</div>


<!-- /.content-wrapper -->


</body>

</html>

<script>
    window.print();
</script>

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