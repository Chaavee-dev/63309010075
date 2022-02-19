<?php
    // แทรก head
    include('./layouts/head.php');
    // แทรก Navigationbar
    include('./layouts/navbar.php');
    
    // ถ้ามีการกดปุ่ม update 
    if(isset($_POST["btn_update"])){
        // รับข้อมูลมาจาฟอร์ม register.php
        $user = $_SESSION['uname'];
        $fullname = $_POST['fullname'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $address = $_POST['address'];


        $sql = "UPDATE tb_users SET fullname = '$fullname', tel = '$tel', email = '$email', address = '$address' WHERE username = '$user'";
        $result = mysqli_query($conn, $sql);

        if($result){
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "success",
                "msg" => "การแก้ไขข้อมูลส่วนตัวสำเร็จ",
            );

        }else{
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "warning",
                "msg" => "การแก้ไขข้อมูลเกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง",
            );
        }
        echo "<script>window.location.href = './profile.php';</script>";
    }

    // ถ้ามีการกดปุ่มเปลี่ยนรหัส
    if(isset($_POST["pass_update"])){
        // รับข้อมูลมาจาฟอร์ม register.php
        $user = $_SESSION['uname'];
        $pass = $_POST['pass_old'];
        $pass_new1 = $_POST['pass_new1'];
        $pass_new2 = $_POST['pass_new2'];

        // สร้างข้อความเก็บไว้ในตัวแปร salt
        $salt = '/*abcziodjuklivlifkmakglvmgk19534++=?:';
        // สร้างการเข้ารหัสด้วย hash_hmac มี parameter 3 ตัว
        $hash_pass_old = hash_hmac('sha256', $pass, $salt);

        $sql = "SELECT * 
                FROM tb_users 
                WHERE username = '$user' AND 
                        password = '$pass'";
        $check = mysqli_query($conn, $sql);
        if(mysqli_num_rows($check) > 0){
            if($pass_new1 == $pass_new2){
                $pass_new = $pass_new1;
                $hash_pass_new = hash_hmac('sha256', $pass_new, $salt);
                
                $sql = "UPDATE tb_users 
                        SET password = '$hash_pass_new' 
                        WHERE username = '$user'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $_SESSION['alert'] = array(
                        "uname" => $_SESSION['uname'],
                        "icon" => "success",
                        "msg" => "เปลี่ยนรหัสผ่านสำเร็จ",
                    );
                }else{
                    $_SESSION['alert'] = array(
                        "uname" => $_SESSION['uname'],
                        "icon" => "warning",
                        "msg" => "เปลี่ยนรหัสผ่านไม่สำเร็จ กรุณาลองใหม่อีกครั้ง!!!",
                    );
                }
            }else{
                $_SESSION['alert'] = array(
                    "uname" => $_SESSION['uname'],
                    "icon" => "warning",
                    "msg" => "รหัสผ่านใหม่ไม่ตรงกัน กรุณาลองใหม่อีกครั้ง!!!",
                );
            }
        }else{
            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "warning",
                "msg" => "รหัสผ่านเดิมไม่ถูกต้อง",
            );
        }
        echo "<script>window.location.href = './profile.php';</script>";
    }
?>

    <div class='container p-5 bg-white'>
    <!-- เปิดเนื้อหาของเว็บ -->
        <?php
            $user = $_SESSION["uname"];
            $sql = "SELECT * FROM tb_users WHERE username = '$user'";
            $q = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($q);
        ?>
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm">
            <h1>ข้อมูลส่วนตัว</h1><hr>

            <div class="col-md-12">
                <label class="form-label"><b>ชื่อผู้ใช้งาน</b></label>
                <input type="text" class="form-control" value="<?=$row['username']?>" disabled>
            </div>
            <div class="col-md-12">
                <label class="form-label"><b>รหัสผ่าน</b></label>
                <input type="text" class="form-control" value="**********" disabled>
                <a class="link" style="cursor:pointer" data-bs-toggle='modal' data-bs-target='#ChangePasswordModal'>เปลี่ยนรหัสผ่าน</a>
            </div>
                <form class="row g-2" method="POST">
                    <div class="col-md-12">
                        <label class="form-label"><b>ชื่อ-สกุล</b></label>
                        <input type="text" id="fullname" name="fullname" class="form-control" maxlength="50" value="<?=$row['fullname']?>">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label"><b>หมายเลขโทรศัพท์</b></label>
                        <input type="tel" id="tel" name="tel" class="form-control" maxlength="10" value="<?=$row['tel']?>" />
                    </div>
                    <div class="col-md-12">
                        <label class="form-label"><b>อีเมล</b></label>
                        <input type="email" id="email" name="email" class="form-control" maxlength="50" value="<?=$row['email']?>">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label"><b>ที่อยู่</b></label>
                        <textarea id="address" name="address" class="form-control" rows="3"><?=$row['address']?></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="d-grid gap-2 my-3">
                            <button type='submit' name='btn_update' class='btn btn-success'>บันทึก</button>
                            <a onclick="goBack()" class="btn btn-outline-dark">ย้อนกลับ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!-- ปิดเนื้อหาของเว็บ -->
</div>

<!-- Modal เพิ่มสินค้า -->
<div class='modal fade' id='ChangePasswordModal' tabindex='-1' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-pname' id='exampleModalLabel'>เปลี่ยนรหัสผ่าน</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
        <div class='modal-body'>
            <form class="row g-2" method="POST">
                    <div class="col-md-12">
                        <label class="col-form-label"><b>รหัสผ่านเดิม:</b></label>
                        <input type="password" class="form-control" name="pass_old" maxlength="50" required>
                    </div>
                    <div class="col-md-12">
                        <label class="col-form-label"><b>รหัสผ่านใหม่:</b></label>
                        <input type="password" class="form-control" name="pass_new1" maxlength="50" required>
                    </div>
                    <div class="col-md-12">
                        <label class="col-form-label"><b>รหัสผ่านใหม่อีกครั้ง:</b></label>
                        <input type="password" class="form-control" name="pass_new2" maxlength="50" required>
                    </div>
        </div>
        <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>ปิด</button>
                <button type="submit" name="pass_update" class="btn btn-success">บันทึก</button>
            </form>
        </div>
        </div>
    </div>
</div>

<?php
    // แทรก Footer
    include('./layouts/footer.php');
    // ปิดการเชื่อมต่อกับฐานข้อมูล
    mysqli_close($conn);
?>