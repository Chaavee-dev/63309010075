<?php
    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    require '../includes/condb.php';

    // รหัสสินค้า
    $pid = $_POST['id'];
    // ดึงข้อมูลสินค้า
    $q = mysqli_query($conn, "SELECT * FROM tb_products WHERE id_product = $pid");
    // แปลงข้อมูลในตัวแปร q ให้เป็น array
    $row=mysqli_fetch_assoc($q);
    // แสดงข้อมูลเป็น json
    echo json_encode($row);
?>