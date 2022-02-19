<?php
    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    require '../includes/condb.php';

    // รหัสสั่งซื้อ
    $oid = $_POST['id'];
    // ดึงข้อมูลสั่งซื้อ
    $q = mysqli_query($conn, "SELECT o.*, p.*, o.qty as oqty
                                    FROM tb_orders as o, tb_products as p
                                    WHERE o.id_product = p.id_product AND
                                        id_order = $oid");
    // แปลงข้อมูลในตัวแปร q ให้เป็น array
    $row = mysqli_fetch_assoc($q);
    // แสดงข้อมูลเป็น json
    echo json_encode($row);
?>