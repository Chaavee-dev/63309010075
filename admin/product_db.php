<?php
    require '../includes/condb.php';
    session_start();

    if(isset($_POST['add_product'])){
        $name = $_POST['name'];
        $cost = $_POST['cost'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $cg = $_POST['category'];
        $spec = $_POST['spec'];
        $name_file =  $_FILES['upload']['name'];
        $tmp_name =  $_FILES['upload']['tmp_name'];
        $locate_img = "../images/Products/";
        move_uploaded_file($tmp_name,$locate_img. $name_file);

        $sql = "INSERT INTO tb_products(category, name, cost, price, qty, spec, img)
                    VALUES($cg, '$name', $cost, $price, $qty, '$spec', '$name_file')";
        $result = mysqli_query($conn, $sql);
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
        header("Location:./products.php");
    }

    if(isset($_POST['edit_product'])){
        $pid = $_POST['pid'];
        $name = $_POST['name'];
        $cost = $_POST['cost'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $cg = $_POST['category'];
        $spec = $_POST['spec'];
        $name_file = $_POST['upload'];

        // Check image
        $sql = "SELECT img FROM tb_products WHERE id_product = $pid";
        $result = mysqli_query($conn, $sql);
        $f = mysqli_fetch_assoc($result);
        $checkIMG = $f['img'];
        
        if($name_file != $checkIMG){ 
            $name_file =  $_FILES['upload']['name'];
            $tmp_name =  $_FILES['upload']['tmp_name'];
            $locate_img = "../images/Products/";
            move_uploaded_file($tmp_name,$locate_img.$name_file);
        }
        if($name_file == null){
            $name_file = $checkIMG;
        }

        $sql = "UPDATE tb_products
                    SET category = '$cg', name = '$name',
                            cost = $cost,
                            price = '$price', qty = '$qty',
                            img = '$name_file', spec = '$spec'
                    WHERE id_product = $pid";
        $result = mysqli_query($conn, $sql);
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
        header("Location:./products.php");
    }

    if(isset($_GET['del_product'])){
        $pid = $_GET['del_product'];
        $sql = "DELETE FROM tb_products WHERE id_product = $pid";
        $result = mysqli_query($conn, $sql);
        if($result){
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "success",
                "msg" => "การลบข้อมูลสำเร็จ",
            );

        }else{
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "warning",
                "msg" => "การลบข้อมูลเกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!!",
            );
        }
        header("Location:./products.php");
    }
?>