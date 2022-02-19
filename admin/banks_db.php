<?php
    require '../includes/condb.php';
    session_start();

    if (isset($_POST['add_bank'])){
        $bank = $_POST['bank'];
        $name = $_POST['name'];
        $number = $_POST['number'];

        // query ข้อมูลจากตัวแปร sql ลง database
        $sql = "INSERT INTO tb_banks(id_bankth, name, number)
                    VALUE('$bank', '$name', '$number')";
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
        
        header("Location:banks.php");
    }

    if (isset($_POST['edit_bank'])){
        $bid = $_POST['bid'];
        $bank = $_POST['bank'];
        $name = $_POST['name'];
        $number = $_POST['number'];

        // query ข้อมูลจากตัวแปร sql ลง database
        $sql = "UPDATE tb_banks SET id_bankth = '$bank', 
                            name = '$name',
                            number = '$number'
                    WHERE id_bank = '$bid'";
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
        header("Location:banks.php");
    }

    if(isset($_GET['del_bank'])){

        $bid = $_GET['del_bank'];
        $sql = "DELETE FROM tb_banks WHERE id_bank = $bid";
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
        header("Location:banks.php");
    }
?>