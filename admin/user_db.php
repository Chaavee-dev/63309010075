<?php
    require '../includes/condb.php';
    session_start();

    if (isset($_POST['add_user'])){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // สร้างข้อความเก็บไว้ในตัวแปร salt
        $salt = '/*abcziodjuklivlifkmakglvmgk19534++=?:';
        // สร้างการเข้ารหัสด้วย hash_hmac มี parameter 3 ตัว
        $hash_password = hash_hmac('sha256', $pass, $salt);

        $sql = "INSERT INTO tb_users(username,password,tel,email,role)
                VALUE('$user','$hash_password','$tel','$email','$role')";
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
                "msg" => "การบันทึกข้อมูลเกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!!!",
            );
        }
        header("Location:users.php");
    }

    if (isset($_POST['edit_user'])){
        $user = $_POST['username'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // query ข้อมูลจากตัวแปร sql ลง database
        $sql = "UPDATE tb_users
                    SET tel = '$tel',
                        email = '$email',
                        role = '$role'
                    WHERE username = '$user'";
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
                "msg" => "การบันทึกข้อมูลเกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!!!",
            );
        }
        header("Location:users.php");
    }

    if(isset($_GET['del_user'])){
        $aid = $_GET['del_user'];
        $sql = "DELETE FROM tb_users WHERE id_user = $aid";
        $result = mysqli_query($conn, $sql);

        if($result){
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "success",
                "msg" => "การลบข้อมูลสำเร็จ",
            );

        // login ไม่ได้
        }else{
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "warning",
                "msg" => "การลบข้อมูลเกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!!!",
            );
        }
        header("Location:users.php");
    }
?>