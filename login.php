<?php
  // แทรก head
  include './layouts/head.php';
  // แทรก navbar
  include './layouts/navbar.php';

  // ถ้ามีการกดปุ่ม login
  if(isset($_POST["login"])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // สร้างข้อความเก็บไว้ในตัวแปร salt
    $salt = '/*abcziodjuklivlifkmakglvmgk19534++=?:';
    // สร้างการเข้ารหัสด้วย hash_hmac มี parameter 3 ตัว
    $hash_password = hash_hmac('sha256', $pass, $salt);
    // สร้างคำสั่งเพิ่มข้อมูลสมัครสมาชิก เก็บไว้ในตัวแปร sql

    $sql = "SELECT * FROM tb_users WHERE username = '$user' AND password = '$hash_password'";
    $q = mysqli_query($conn, $sql);

    // เช็คว่า ถ้า login ได้
    if(mysqli_num_rows($q) == 1){

      //fetch ข้อมูลเก็บไว้ในตัวแปร $row
      $row = mysqli_fetch_assoc($q);

      if($row['role'] == "admin"){
        // เก็บชื่อผู้ใช้ไว้ใน session
        $_SESSION["isadmin"] = "yes";
        $_SESSION["uid"] = $row["id_user"];
        $_SESSION["uname"] = $row["username"];
      
        // ไปยังหน้าแรก
        echo "<script>window.location.href = './admin';</script>";
      }else{
        // เก็บชื่อผู้ใช้ไว้ใน session
        $_SESSION["isuser"] = "yes";
        $_SESSION["uid"] = $row["id_user"];
        $_SESSION["uname"] = $row["username"];

        $_SESSION['welcome'] = true;
      
        // ไปยังหน้าแรก
        echo "<script>window.location.href = './';</script>";
      }

    // login ไม่ได้
    }else{
      // เก็บข้อมูล alert ไว้ใน session
      $_SESSION['alert'] = array(
          "uname" => $_SESSION['uname'],
          "icon" => "warning",
          "msg" => "ชื่อผู้ใช้หรือรหัสผ่านผิด กรุณาลองใหม่อีกครั้ง!!!",
      );
      // ไปหน้า loin
      echo "<script>window.location.href = './login.php';</script>";
    }
  }
?>

  <!-- Container -->
  <div class="container">   
      <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-8 col-sm-10">
          <div class="card p-5">
            <div class="card-header bg-white">
              <h2>การเข้าสู่ระบบ</h2>
            </div>
            <div class="card-body">
              <!-- form -->
              <form method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label"><b>ชื่อผู้ใช้งาน</b></label>
                  <input type="text" name="username" class="form-control" maxlength="50" placeholder="กรอกชื่อผู้ใช้งานของคุณ" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label"><b>รหัสผ่าน</b></label>
                  <input type="password"  name="password" class="form-control" maxlength="50" placeholder="กรอกรหัสผ่านของคุณ" required>
                </div>
                <div class="d-grid gap-2">
                      <button class="btn btn-primary" type="submit" name="login">เข้าสู่ระบบ</button>
                </div>
              </form>
              <!-- .form -->
                <div class="mt-3 float-end">
                    <span>ถ้าคุณยังไม่มีบัญชี <a href="./register.php">สมัครมาชิก</a></span>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <!-- .Container -->

<?php
  // แทรก footer
  include './layouts/footer.php';
?>