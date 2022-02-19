<?php
    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    require './includes/condb.php';

    $oid = $_POST['id'];

    $sql = "SELECT o.*, p.*, o.qty as oqty
            FROM tb_orders as o, tb_products as p
            WHERE o.id_product = p.id_product AND
                id_order = $oid";
    $order = mysqli_query($conn, $sql);
    $rowOrder=mysqli_fetch_assoc($order);

    echo json_encode($rowOrder);
?>