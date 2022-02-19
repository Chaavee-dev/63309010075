<?php
    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    require '../includes/condb.php';

    // รหัสหมวดหมู่
    $cid = $_POST['id'];
    // ดึงข้อมูลหมวดหมู่
    $q = mysqli_query($conn, "SELECT * FROM tb_category WHERE id_category = $cid");
    // แปลงข้อมูลในตัวแปร q ให้เป็น array
    $row=mysqli_fetch_assoc($q);
    // แสดงข้อมูลเป็น json
    echo json_encode($row);
?>