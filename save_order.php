<?php
    // เปิดให้งาน session
    session_start();

    require './includes/condb.php';

    $uid = $_SESSION['uid'];

    // print_r($_SESSION['order']);
    // echo json_encode($_SESSION['order']);

    // สุ่มหมายเลขคำสั่งซื้อ
    $oid = rand();

    $error=0;

    // ลูปเช็คจำนวนสินค้าในตาราง products
    foreach($_SESSION['order'] as $val){
        $pid = $val['pid'];
        $qty = $val['qty'];

        $check = mysqli_query($conn, "SELECT * FROM tb_products WHERE id_product = $pid AND qty >= $qty");
        if(mysqli_num_rows($check) == 0){
            $error += 1;
        }
    }

    // ถ้ามี error มากว่า 0
    if($error > 0){
        $_SESSION['alert'] = array(
            "uname" => $_SESSION['uname'],
            "icon" => "error",
            "msg" => "สินค้ามีจำนวนไม่พอสำหรับการสั่งซื้อครั้งนี้",
        );

        // ไปยังหน้าตะกร้า
        echo "<script>window.history.back();</script>";
    
    // ถ้าไม่มี error
    }else{
        // ลูปเพิ่มข้อมูลการสั่งซื้อลงตาราง orders
        foreach($_SESSION['order'] as $val){
            $pid = $val['pid'];
            $qty = $val['qty'];
            $total = $val['total'];
            $date = $val['date'];

            // เพิ่มข้อมูลการสั่งซื้อลงตาราง orders
            $sql = "INSERT INTO `tb_orders` (`id_order`, `id_user`, `id_product`, `qty`, `total`, `date`, `status`, `tracking`)
                            VALUES ($oid, $uid, $pid, $qty, $total, '$date', 1, '');";
            $result = mysqli_query($conn, $sql);
        }

        // ถ้าเพิ่มข้อมูลการสั่งซื้อลงตาราง orders สำเร็จ
        if($result){

            // ล้างค่า session order
            unset($_SESSION['order']);

            //ลบข้อมูลในตาราง cart ของผู้ใช้โดยใช้ uid
            $sql = "DELETE tb_cart FROM tb_cart WHERE id_user = $uid";
            $delCart = mysqli_query($conn, $sql);

            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "success",
                "msg" => "บันทึกรายการสั่งซื้อสำเร็จ",
            );

            // ไปยังหน้าตะกร้า
            header("Location: ./purchase.php");

        // ไม่สำเร็จ
        }else{
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "warning",
                "msg" => "เพิ่มสินค้าไม่สำเร็จ กรุณาลองใหม่อีกครั้ง!!!",
            );

            // ย้อนกลับไปก่อนหน้า
            echo "<script>window.history.back();</script>";
        }
    }

?>