<?php
    require '../includes/condb.php';
    session_start();

    if(isset($_GET['pay_correct'])){
        $oid = $_GET['oid'];
        $sql = "UPDATE tb_orders SET status = 4 WHERE id_order = $oid";
        $result = mysqli_query($conn, $sql);
        if($result){
            // $order = $conn->orderSelect($oid);
            // $row = mysqli_fetch_assoc($order);
            // $mid = $row['id_user'];
            // $sub = "แจ้งเตือนการชำระเงิน!";
            // $des = "การชำระเงินสินค้าสำเร็จ";
            // $conn->addNotify($mid, $sub, $des);

            if($result){
                $_SESSION['alert'] = array(
                    "uname" => $_SESSION['uname'],
                    "icon" => "success",
                    "msg" => "การบันทึกข้อมูลสำเร็จ",
                );
    
            }else{
                $_SESSION['alert'] = array(
                    "uname" => $_SESSION['uname'],
                    "icon" => "warning",
                    "msg" => "การบันทึกข้อมูลเกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!!",
                );
            }
        }
    }

    if(isset($_GET['pay_wrong'])){
        $oid = $_GET['oid'];
        $sql = "UPDATE tb_orders SET status = 2 WHERE id_order = $oid";
        $result = mysqli_query($conn, $sql);
        if($result){

            if($result){

                // ดึงข้อมูล order ที่ต้องการยกเลิก
                $b = mysqli_query($conn,"SELECT * FROM tb_orders WHERE id_order = $oid");

                // ลูปเพื่อคืนจำนวนสินค้า
                foreach($b as $item){
                    $pid = $item['id_product'];
                    $qty = $item['qty'];

                    mysqli_query($conn, "UPDATE tb_products SET qty = qty+$qty WHERE id_product = $pid");
                }

                    $_SESSION['alert'] = array(
                        "uname" => $_SESSION['uname'],
                        "icon" => "success",
                        "msg" => "การบันทึกข้อมูลสำเร็จ",
                    );
        
            }else{
                $_SESSION['alert'] = array(
                    "uname" => $_SESSION['uname'],
                    "icon" => "warning",
                    "msg" => "การบันทึกข้อมูลเกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!!",
                );
            }
        }
    }

    if(isset($_POST['tk'])){
        $oid = $_POST['oid'];
        $tk = $_POST['tk'];

        $sql = "UPDATE tb_orders SET tracking = '$tk' WHERE id_order = $oid";
        $result = mysqli_query($conn, $sql);

        if($result){
            $sql = "UPDATE tb_orders SET status = 5 WHERE id_order = $oid";
            $save = mysqli_query($conn, $sql);
        }

        if($result && $save){
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "success",
                "msg" => "การบันทึกข้อมูลสำเร็จ",
            );

        }else{
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "warning",
                "msg" => "การบันทึกข้อมูลเกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!!",
            );
        }
    }

    if(isset($_POST['status'])){
        $oid = $_POST['oid'];
        $stt = $_POST['status'];

        $sql = "UPDATE tb_orders SET status = '$stt' WHERE id_order = $oid";
        $result = mysqli_query($conn, $sql);

        if($result){

            if($stt == 7){
                // ดึงข้อมูล order ที่ต้องการยกเลิก
                $b = mysqli_query($conn,"SELECT * FROM tb_orders WHERE id_order = $oid");

                // ลูปเพื่อคืนจำนวนสินค้า
                foreach($b as $item){
                    $pid = $item['id_product'];
                    $qty = $item['qty'];

                    mysqli_query($conn, "UPDATE tb_products SET qty = qty+$qty WHERE id_product = $pid");
                }
            }

            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "success",
                "msg" => "การบันทึกข้อมูลสำเร็จ",
            );

        }else{
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "warning",
                "msg" => "การบันทึกข้อมูลเกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!!",
            );
        }
    }


    
    header("Location:orders.php?status=ตรวจสอบ");

?>