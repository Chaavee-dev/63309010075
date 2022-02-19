<?php
    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    require '../includes/condb.php';

    // รหัสสั่งซื้อ
    $oid = $_POST['id'];
    // ดึงข้อมูลการชำระเงิน
    $q = mysqli_query($conn, "SELECT p.*,o.id_product ,p.total, bth.name as bthname
                                FROM tb_pay as p, tb_orders as o,
                                    tb_banks as b, tb_banks_th as bth
                                WHERE p.id_order = o.id_order AND
                                    p.member_id_bank = bth.id_bankth AND
                                    p.id_order = $oid");
    // แปลงข้อมูลในตัวแปร q ให้เป็น array

    $row=mysqli_fetch_assoc($q);
    
    // แสดงข้อมูลเป็น json
    echo json_encode($row);
?>