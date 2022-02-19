<?php 
    // เปิด session
    session_start();
    
    require '../includes/condb.php';

    // เช็คว่าไม่ใช่ผุ้ดูแลระบบให้ออกไปหน้า logout
    if($_SESSION["isadmin"] != "yes"){
        header("Location: logout.php");
    }

    // ปิดการแจ้งเตือน error
    error_reporting(0); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vHAVECPU</title>
    <link rel="shortcut icon" href="../images/bag.png" type="image/x-icon">

    <!-- Custom fonts for this template -->
    <link href="./plugins/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"
    >

    <link rel="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" href="style.css">

    <!-- Custom styles for this template -->
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="./plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- sweetalert2 -->
    <script src="../plugins/SweetAlert2/sweetalert2.all.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="./plugins/jquery/jquery.min.js"></script>
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./plugins/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="./plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="./plugins/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- ckeditor -->
    <script src="./plugins/ckeditor/ckeditor.js"></script>

    <style>

        .img-product{
            width: 70px;
        }
        .text-product{
            font-size: 15px;
        }
        div.dataTables_filter, div.dataTables_length {
            margin-bottom: 10px;
        }
        .ck-editor__editable {min-height: 200px;}

        @media screen and (max-width: 600px) {
            .img-product{
            width: 50px;
            }
            .text-product{
                font-size: 12px;
            }
        }
    </style>

</head>
<body id="page-top">
    <?php
        // alert
        include '../includes/alert.php';
    ?>