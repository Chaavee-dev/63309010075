<?php 
    // เปิด session
    session_start();

    // ดึงไฟล์การเชื่อมต่อฐานข้อมูล
    require './includes/condb.php';

    // เช็ค session-isadmin
    if(isset($_SESSION['isadmin'])){
        // ให้ไปที่ admin || หลังบ้าน
        header("Location: ./admin");
    }

    // ปิดการแจ้งเตือน error ทั้งหมด
    error_reporting(0); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vHAVECPU</title>
    <link rel="shortcut icon" href="./images/bag.png" type="image/x-icon">
    <!-- My Style.css -->
    <link rel="stylesheet" href="./includes/style.css?v=<?php echo time(); ?>">
    <!-- Bootstap-5 -->
    <link href="./plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- font-awesome -->
    <link rel="stylesheet" href="./plugins/font-awesome/css/all.css">
    <!-- jquery -->
    <script src="./plugins/jQuery/jquery-3.6.0.min.js"></script>
    <!-- sweetalert2 -->
    <script src="./plugins/SweetAlert2/sweetalert2.all.min.js"></script>
</head>
<body style="background-color: rgb(240, 240, 240);">
<?php 
    // นำเข้าไฟล์แสดง alert
    include './includes/alert.php';
?>