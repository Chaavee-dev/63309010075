<?php
    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    require '../includes/condb.php';

    // รหัสธนาคาร
    $bid = $_POST['id'];
    // ดึงข้อมูลธนาคาร
    $q = mysqli_query($conn, "SELECT * FROM tb_banks WHERE id_bank = $bid");
    // แปลงข้อมูลในตัวแปร q ให้เป็น array
    $row=mysqli_fetch_assoc($q);
    // แสดงข้อมูลเป็น json
    echo json_encode($row);
?>