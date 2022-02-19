<?php
    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    require './includes/condb.php';
    session_start();

    $uname = $_SESSION['uname'];

    if(isset($_POST['pay'])){
        $oid = $_POST['oid'];
        $date = $_POST['date'];
        $total = $_POST['total'];
        $bank = $_POST['transfer-from'];
        $transfer = $_POST['transfer-to'];

        $name_file =  $_FILES['upload']['name'];
        $tmp_name =  $_FILES['upload']['tmp_name'];
        $locate_img = "images/Slip/";
        move_uploaded_file($tmp_name,$locate_img.$name_file);

        $sql = "INSERT INTO `tb_pay` (`id_order`, total, `slip`, `date`, `member_id_bank`, `store_id_bank`)
                    VALUES ('$oid', $total, '$name_file', '$date', '$bank', '$transfer');";
        $result = mysqli_query($conn, $sql);

        if($result){

            // อัพเดตสถานะ order
            mysqli_query($conn, "UPDATE tb_orders SET status = 3 WHERE id_order = $oid");

            // ดึงข้อมูล order 
            $b = mysqli_query($conn,"SELECT * FROM tb_orders WHERE id_order = $oid");

            // ลูปเพื่อลดจำนวนสินค้าในตาราง products
            foreach($b as $item){
                $pid = $item['id_product'];
                $qty = $item['qty'];

                mysqli_query($conn, "UPDATE tb_products SET qty = qty-$qty WHERE id_product = $pid");
            }

            $_SESSION['alert'] = array(
                "uname" => $uname,
                "icon" => "success",
                "msg" => "ชำระเงินแล้ว รอการตรวจสอบความถูกต้อง",
            );
        }else{
            $_SESSION['alert'] = array(
                "uname" => $uname,
                "icon" => "error",
                "msg" => "ชำระเงินผิดพลาด กรุณาลองใหม่อีกครั้ง!",
            );
        }
        header("Location:./purchase.php");
    }

    if(isset($_POST['re-pay'])){
        $oid = $_POST['oid'];
        $date = $_POST['date'];
        $total = $_POST['total'];
        $bank = $_POST['transfer-from'];
        $transfer = $_POST['transfer-to'];

        $name_file =  $_FILES['upload']['name'];
        $tmp_name =  $_FILES['upload']['tmp_name'];
        $locate_img = "images/Slip/";
        move_uploaded_file($tmp_name,$locate_img.$name_file);

        $sql = "UPDATE tb_pay
                SET slip = '$name_file',
                    date = '$date',
                    member_id_bank = '$bank',
                    store_id_bank = '$transfer'
                WHERE id_order = $oid";
        $result = mysqli_query($conn, $sql);

        if($result){
            mysqli_query($conn, "UPDATE tb_orders SET status = 3 WHERE id_order = $oid");

            // ดึงข้อมูล order ที่ต้องการยกเลิก
            $b = mysqli_query($conn,"SELECT * FROM tb_orders WHERE id_order = $oid");

            // ลูปเพื่อลดจำนวนสินค้าในตาราง products
            foreach($b as $item){
                $pid = $item['id_product'];
                $qty = $item['qty'];

                mysqli_query($conn, "UPDATE tb_products SET qty = qty-$qty WHERE id_product = $pid");
            }
        }
        header("Location:./purchase.php");
    }
    
    
?>