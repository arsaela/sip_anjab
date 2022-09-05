<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= "title"; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/assets/favicon.ico">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/adminlte3/plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="/assets/adminlte3/plugins/daterangepicker/daterangepicker.css">
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

    <!--sweet alert arsa-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet"></link>
   <!--  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <?= $this->renderSection('head') ?>
    <style>
        @media print {
            .to-print:display:none;
        }
    </style>
</head>

 <!-- penting untuk menggunakan fungsi session di bawah ini  -->
<?php //session_start(); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include('layouts_petugas/navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('layouts_petugas/sidebar') ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $this->renderSection('content') ?>
        <!-- /.content-wrapper -->

        <footer class="main-footer to-print">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; <script>
                document.write(new Date().getFullYear());
            </script> <a href="#">Badan Kepegawaian dan Pengembangan Sumber Daya Manusia</a>.</strong> All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

 
    <!-- UNTUK MENAMBAHKAN DATATABLE DI SETIAP HALAMAN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable-list').DataTable();
        } );
    </script>


    <!-- jQuery -->
    <script src="/assets/adminlte3/plugins/jquery/jquery.min.js"></script>


       <!-- memvalidasi inputan -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>


    <!-- Bootstrap 4 -->
    <script src="/assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- InputMask -->
    <script src="/assets/adminlte3/plugins/moment/moment.min.js"></script>
    <script src="/assets/adminlte3/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="/assets/adminlte3/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- SweetAlert2 -->
    <script src="/assets/adminlte3/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="/assets/adminlte3/plugins/toastr/toastr.min.js"></script>
    <!-- DataTables -->
    <script src="/assets/adminlte3/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/assets/adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/assets/adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/adminlte3/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/assets/adminlte3/dist/js/demo.js"></script>
    <!-- page script -->
    <?= $this->renderSection('script') ?>
</body>

</html>