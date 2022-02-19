<?php
    require '../includes/condb.php';
    session_start();

    if (isset($_POST['add_category'])){
        $name = $_POST['name'];

        // query ข้อมูลจากตัวแปร sql ลง database
        $sql = "INSERT INTO tb_category(name) VALUE('$name')";
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
        
        header("Location:category.php");
    }

    if (isset($_POST['edit_category'])){
        $cid = $_POST['cid'];
        $name = $_POST['name'];

        // query ข้อมูลจากตัวแปร sql ลง database
        $sql = "UPDATE tb_category SET name = '$name' WHERE id_category = '$cid'";
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
        header("Location:category.php");
    }

    if(isset($_GET['del_category'])){
        $cid = $_GET['del_category'];

        $sql = "SELECT * 
                FROM tb_products as p , tb_category as c
                WHERE p.category = c.id_category AND
                        c.id_category = $cid";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 0){
            $sql = "DELETE FROM tb_category WHERE id_category = $cid";
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
        }else{
             $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "warning",
                "msg" => "การลบข้อมูลเกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!!",
            );

        }
        header("Location:category.php");
    }
?>