<?php
    // แทรก head
    include('./layouts/head.php');
    // แทรก Navigationbar
    include('./layouts/navbar.php');
    
    // ล้างค่า session order
    unset($_SESSION['order']);

    $uid = $_SESSION['uid'];

    $sql = "SELECT fullname, address
                    FROM tb_users
                    WHERE id_user = '$uid'";
    $q = mysqli_query($conn, $sql);
    $ck = mysqli_fetch_assoc($q);
    if($ck['fullname'] == '' || $ck['address'] == ''){
        $_SESSION['alert'] = array(
            "uname" => $_SESSION['uname'],
            "icon" => "warning",
            "msg" => "กรุณากรอกข้อมูลส่วนตัวให้ครบถ้วน",
        );

        echo "<script>window.location.href = './profile.php';</script>";
    }

    // สร้างตัวแปร date เก็บวันและเวลาโดยใช้ฟังก์ชั่น date
    $date = "";
    $date = date("Y-m-d H:i");

?>
 
    <!-- เปิด container -->
    <div class="container p-5 bg-white">
            <div class="row mb-2 p-2 bg-light">
                <div class="col-12">
                    <h3>
                        รายละเอียดรายการสั่งซื้อ
                    </h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    ชื่อผู้สั่งซื้อ
                </div>
                <div class="col-5">
                    <?=$_SESSION['uname']?>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    วันที่สั่งซื้อ
                </div>
                <div class="col-5">
                    <?=$date?>
                </div>
            </div>
            <div class="row mt-2 p-2 bg-light">
                <div class="col-12">
                    <h6 class="text-danger">
                        ***กรุณาตรวจสอบรายละเอียดการสั่งซื้อสินค้าให้ครบถ้วน
                    </h6>
                </div>
            </div>
            
            <?php 
                //ดึงข้อมูลสินค้าจากฐานข้อมูล
                $sql = "SELECT p.id_product as pid, img as img,
                            p.name as pname , p.price as price,
                            c.qty as qty, c.id_cart as cid
                    FROM tb_cart as c,tb_products as p
                    WHERE c.id_user = $uid AND 
                            c.id_product = p.id_product AND
                            (p.qty > 0 AND p.qty >= c.qty)
                    GROUP BY pid
                    ORDER BY id_cart DESC";
                $q = mysqli_query($conn, $sql);
            ?>

            <!-- เปิด table-responsive -->
            <div class="table-responsive">

                <!-- เปิด table -->
                <table class='table table-striped table-hover box'>
                    <thead bgcolor='#f5b041'>
                        <tr>
                            <th class='text-center'>สินค้า</th>
                            <th class='text-end'>ราคา</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sumQty = 0;
                        $sumPrice = 0;
                        while($row = mysqli_fetch_assoc($q)){ ?>
                            <tr>
                                <td class='text-center'>
                                    <a href='./product.php?pid=<?=$row['pid']?>' class='text-decoration-none text-dark'>
                                        <img src='./images/Products/<?=$row['img']?>' height='75px'><br>
                                        <?=$row['pname']?>
                                    </a>
                                </td>
                                <td class='text-end'>
                                    ราคาต่อชิ้น: ฿<?=number_format($row['price'])?><br>
                                    จำนวน: <?=$row['qty']?><br>
                                    รวม: ฿<?=number_format($row['price']*$row['qty'])?>
                                </td>
                            </tr>
                        <?php

                            // จำนวนสิน้คาทั้งหมด
                            $sumQty += $row['qty'];

                            // ราคาทั้งหมดทุกชิ้น
                            $sumPrice += $row['price']*$row['qty'];

                            // ราคาทั้งหมดต่อชิ้น
                            $total = $row['price']*$row['qty'];

                            // เก็บข้อมูล array รายละเอียดรายการสั่งซื้อ ไว้ใน sesion order
                            $order = array(
                                "pid" => $row['pid'],
                                "qty" => $row['qty'],
                                "total" => $total,
                                "date" => $date
                            ); 

                            $orders[] = $order;
                            $_SESSION['order'] = $orders;

                        } ?>
                        <tr bgcolor='#CACACA'>
                            <td colspan='2' class='text-end'>
                                <b>รวม (<?=$sumQty?> ชิ้น)</b><br>
                                <b>รวมทั้งหมด: ฿<?=number_format($sumPrice)?></b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2' class='text-end'>
                                <a onclick="goBack()" class="btn btn-outline-dark">ย้อนกลับ</a>
                                <a href="./save_order.php" class="btn btn-primary">บันทึกการสั่งสินค้า</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- ปิด table -->
            </div>
            <!-- ปิด table-responsive -->   

            <div class="row">
                <div class="col-12">
                    <?php
                        $ship=mysqli_query($conn,"SELECT * FROM tb_shipping");
                        while($rowShip=mysqli_fetch_assoc($ship)){
                    ?>
                        <input type="radio" name="ship" value="<?=$rowShip['id_ship']?>">
                        <label><?=$rowShip['name']?> : <?=$rowShip['detail']?></label><br>
                    <?php } ?>
                </div>
            </div>
            
            <!-- ดึงข้อมูลสมาชิกคนนี้มาแสดง -->
            <?php
                $user = $_SESSION["uname"];
                $sql = "SELECT * FROM tb_users WHERE username = '$user'";
                $q = mysqli_query($conn, $sql);
                $rowA = mysqli_fetch_assoc($q);
            ?>
            <div class="row justify-content-around mb-2">
                <div class="col-sm-6 col-md-5 col-lg-5 border border-1 p-5">
                    <p><b>ชื่อลูกค้า:</b> <?=$rowA['fullname']?></p>
                    <p><b>หมายเลขโทรศัพท์:</b> <?=$rowA['tel']?></p>
                    <p><b>ที่อยู่ในการจัดส่ง:</b> <?=$rowA['address']?>
                        <a href="./profile.php" class="btn btn-outline-success btn-sm">แก้ไข</a>
                    </p>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-6 border border-1 p-5">
                    <p class="bg-light p-1">ราคารวม: ฿<?=number_format($sumPrice)?></p>
                    <p class="bg-light p-1">ค่าจัดส่ง: ฟรี</p>
                    <p class="bg-danger text-white p-1 ้ข/">รวมเป็นเงิน: ฿<?=number_format($sumPrice)?></p>
                </div>
            </div>

        </div>
    <!-- ปิด container -->

<?php
    // แทรก Footer
    include('./layouts/footer.php');
?>