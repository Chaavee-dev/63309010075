<?php
    // แทรก head
    include('./layouts/head.php');

    $user = '';
    $pass1= '';
    $pass2= '';
    $tel = '';
    $email = '';

    // ถ้ามีการกด submit
    if(isset($_POST['submit'])) {
      $user = $_POST['username'];
      $pass1 = $_POST['password'];
      $pass2 = $_POST['confirm-password'];
      $tel = $_POST['tel'];
      $email = $_POST['email'];
      
        // เช็คชื่อผู้ใช้
        $check=mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$user'");
        if(mysqli_num_rows($check) == 1){
            $error = "มีชื่อผู้ใช้งานนี้แล้ว!";

        // เช็คว่าถ้ารหัสผ่านไม่ตรงกัน
        }else if($pass1 !== $pass2){
            $error = "รหัสผ่านไม่ตรงกัน!";

        }else{
            // สร้างข้อความเก็บไว้ในตัวแปร salt
            $salt = '/*abcziodjuklivlifkmakglvmgk19534++=?:';
            // สร้างการเข้ารหัสด้วย hash_hmac มี parameter 3 ตัว
            $hash_password = hash_hmac('sha256', $pass1, $salt);

            // สร้างคำสั่งเพิ่มข้อมูลสมัครสมาชิก เก็บไว้ในตัวแปร sql
            $sql = "INSERT INTO tb_users(username,password,tel,email,role)
            VALUE('$user','$hash_password','$tel','$email','member')";

            $q = mysqli_query($conn, $sql);

            if($q){
                // เก็บข้อมูล alert ไว้ใน session
                $_SESSION['alert'] = array(
                    "uname" => $uname,
                    "icon" => "success",
                    "msg" => "คุณได้ทำการสมัครสมาชิกสำเร็จแล้ว สามารถเข้าสู่ระบบได้เลย.",
                );
                // ไปหน้า login
                echo "<script>window.location.href='./login.php'</script>";
            }else{
                // เก็บข้อมูล alert ไว้ใน session
                $_SESSION['alert'] = array(
                    "uname" => $uname,
                    "icon" => "warning",
                    "msg" => "การสมัครสมาชิกเกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง!!!",
                );
                // ไปหน้า register
                echo "<script>window.location.href='./register.php'</script>";
            }
      }
    }

    // แทรก Navigationbar
    include('./layouts/navbar.php');
?>

<!-- Container -->
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-10">
            <div class="card p-5">
                <div class="card-header bg-white">
                    <h2>การสมัครสมาชิก</h2>
                </div>
                <div class="card-body">
                    <!-- form -->
                    <form method="POST">
                        <?php if(isset($error)){ ?>
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <b><?=$error?></b>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row mb-2">
                            <div class="col-12">
                                <label class="form-label"><b>ชื่อผู้ใช้งาน</b></label>
                                <input type="text" id="username" name="username" class="form-control" maxlength="50"
                                    placeholder="กรอกชื่อผู้ใช้งาน" value="<?=$user?>" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label class="form-label"><b>รหัสผ่าน</b></label>
                                <input type="password" id="password" name="password" class="form-control" maxlength="50"
                                    placeholder="กรอกรหัสผ่าน" value="<?=$pass1?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><b>รหัสผ่านอีกครั้ง</b></label>
                                <input type="password" id="confirm-password" name="confirm-password"
                                    class="form-control" maxlength="50" placeholder="กรอกรหัสผ่านอีกครั้ง"
                                    value="<?=$pass2?>" required>
                                <span id="passwordmatch"></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <label class="form-label"><b>เบอร์โทร</b></label>
                                <input type="tel" id="tel" name="tel" class="form-control" maxlength="10"
                                    placeholder="กรอกเบอร์โทรศัพท์" value="<?=$tel?>" required />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <label class="form-label"><b>อีเมล</b></label>
                                <input type="email" id="email" name="email" class="form-control" maxlength="50"
                                    placeholder="กรอกอีเมล" value="<?=$email?>" required>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="submit" id="submit" class="btn btn-success">สมัครมาชิก</button>
                        </div>
                    </form>
                    <!-- .form -->
                    <div class="mt-3">
                        <span>ถ้าคุณมีบัญชีแล้ว <a href="./login.php">เข้าสู่ระบบ</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .Container -->

<?php
    // แทรก Footer
    include('./layouts/footer.php');
?>