<?php
    // ดึงไฟล์เชื่อมต่อฐานข้อมูล
    require './includes/condb.php';
    
    session_start();
    $uid = $_SESSION['uid'];
    $uname = $_SESSION['uname'];

    if(isset($_POST['buy']) OR (isset($_POST['cart']))){
        
        $pid = $_POST['pid'];
        $qty = $_POST['qty'];

        // ดึงข้อมูลของสินค้าใน cart
        $cart = mysqli_query($conn, "SELECT * FROM tb_cart WHERE id_user = $uid AND id_product = $pid");
        $rowCart = mysqli_fetch_assoc($cart);

        // ดึงข้อมูลของสินค้าใน product
        $product = mysqli_query($conn, "SELECT * FROM tb_products WHERE id_product = $pid");
        $rowProduct = mysqli_fetch_assoc($product);

        // เช็คว่ามีข้อมูลสินค้าใน cart ของลูกค้า
        if(mysqli_num_rows($cart) > 0) {
            
            // เช็คว่าจำนวนสินค้าในตาราง Product มากกว่าในตาราง Cart+กับจำนวนที่เพิ่มเข้ามา
            if(($rowProduct['qty']) >= ($rowCart['qty']+$qty)){

                // อัพเดตข้อมูลตาราง Cart
                $sql = "UPDATE tb_cart SET qty = qty+$qty WHERE id_user = $uid AND id_product = $pid";
                $result = mysqli_query($conn, $sql);
                
                // เช็คว่ามีข้อมูลในตัวแปร result
                if($result){
                    // mysqli_query($conn,"UPDATE tb_products SET qty = qty-$qty WHERE id_product = $pid");
                
                    if(isset($_POST['cart'])){
                        $_SESSION['alert'] = array(
                            "uname" => $uname,
                            "icon" => "success",
                            "msg" => "คุณได้ทำการเพิ่มสินค้าลงในตะกร้าแล้ว",
                        );
                        // ไปยังหน้าตะกร้า
                        header("Location: ./product.php?pid=".$pid);
                    }else{
                        header("Location: ./cart.php");
                    }
                }else{
                    $_SESSION['alert'] = array(
                        "uname" => $uname,
                        "icon" => "warning",
                        "msg" => "เพิ่มสินค้าไม่สำเร็จ กรุณาลองใหม่อีกครั้ง!!!",
                    );

                    // ย้อนกลับไปก่อนหน้า
                    header("Location: ./product.php?pid=".$pid);
                }
            }else{
                $_SESSION['alert'] = array(
                    "uname" => $uname,
                    "icon" => "warning",
                    "msg" => "ขออภัย คุณสามารถซื้อสินค้าได้อีก ".($rowProduct['qty']-$rowCart['qty'])." ชิ้น",
                );

                // ย้อนกลับไปก่อนหน้า
                header("Location: ./product.php?pid=".$pid);
            }

        // ถ้าไม่มีข้อมูลสินค้าใน cart ของลูกค้า
        }else{

            // เพิ่มข้อมูลลงในตาราง cart
            $sql = "INSERT INTO tb_cart(id_user, id_product, qty) VALUES ($uid, $pid, $qty)";
            $result = mysqli_query($conn, $sql);
            
            // เช็คว่ามีข้อมูลในตัวแปร result
            if($result){
                // mysqli_query($conn,"UPDATE tb_products SET qty = qty-$qty WHERE id_product = $pid");

                if(isset($_POST['cart'])){
                    $_SESSION['alert'] = array(
                        "uname" => $uname,
                        "icon" => "success",
                        "msg" => "คุณได้ทำการเพิ่มสินค้าลงในตะกร้าแล้ว",
                    );
                    // ไปยังหน้าตะกร้า
                    header("Location: ./product.php?pid=".$pid);
                }else{
                    header("Location: ./cart.php");
                }
            }else{
                $_SESSION['alert'] = array(
                    "uname" => $uname,
                    "icon" => "warning",
                    "msg" => "เพิ่มสินค้าไม่สำเร็จ กรุณาลองใหม่อีกครั้ง!!!",
                );

                // ย้อนกลับไปก่อนหน้า
                header("Location: ./product.php?pid=".$pid);
            }
        }
    }
?>