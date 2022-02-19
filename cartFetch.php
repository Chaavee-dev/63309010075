<?php
    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    require './includes/condb.php';
    
    session_start();
    $uid = $_SESSION['uid'];

    if(isset($_POST)){
        
        $pid = $_POST['pid'];
        $qty = $_POST['qty'];

        // อัพเดตข้อมูลตาราง Cart
        $sql = "UPDATE tb_cart SET qty = $qty WHERE id_user = $uid AND id_product = $pid";
        $result = mysqli_query($conn, $sql);
        
    }
?>