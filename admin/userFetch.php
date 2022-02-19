<?php
    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    require '../includes/condb.php';

    // รหัสผู้ใช้
    $uid = $_POST['id'];
    // ดึงข้อมูลผู้ใช้
    $q = mysqli_query($conn, "SELECT * FROM tb_users WHERE id_user = $uid");
    // แปลงข้อมูลในตัวแปร q ให้เป็น array
    $row=mysqli_fetch_assoc($q);
    // แสดงข้อมูลเป็น json
    echo json_encode($row);
?>