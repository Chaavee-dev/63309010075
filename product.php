<?php
    // แทรก head
    include('./layouts/head.php');
    // แทรก Navigationbar
    include('./layouts/navbar.php');

    // รับค่าจาก get-pid มาเก็บไว้ในตัวแปร $pid
    $pid = $_GET['pid'];

    //ดึงข้อมูลสินค้าจากฐานข้อมูล
    $sql = "SELECT * 
            FROM tb_products 
            WHERE id_product = $pid";
    $q = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($q);

?>
    <!-- Container -->
    <div class="container p-5 bg-white">
        <div class="container px-4 px-lg-5 my-5  border border-2 p-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="./images/Products/<?=$row['img']?>" alt="..." /></div>
                <div class="col-md-6">
                    <h4 class="fw-bolder">
                        <!-- แสดงชื่อสินค้า -->
                        <?=$row['name']?>
                    </h4>
                    <div class="fs-5 mb-2">
                        <h5 class="text-danger">
                            <!-- แสดงราคาสินค้า -->
                            ราคา: ฿<?=number_format($row['price'])?>
                        </h5>
                        <h6 class="text-secondary">
                            <!-- แสดงจำนวนสินค้า -->
                            มีสินค้าทั้งหมด: <?=number_format($row['qty'])?> ชิ้น
                        </h6>
                    </div>
                    
                    <form action='cart_db.php' method='POST'>
                        <input type='hidden' name='pid' value='<?=$pid?>'>
                        <div class="d-flex mb-2">
                            <?php
                                if($row['qty'] == 0){
                                    $i=0;
                                    echo "<button type='submit' name='submit' class='btn btn-outline-danger btn-lg me-2 btn-width-100' disabled>สินค้าหมด</button>";
                                }else{
                                    $i=1;
                                    if(isset($_SESSION['uid'])) { ?>
                                        <input type="number" name="qty" class="form-control me-2" min="1" max="<?=$row['qty']?>" value="1" style="width:100px">
                                        <button type="submit" name="cart" class='btn btn-outline-danger btn-lg me-2 btn-width-100' >หยิบใส่ตะกร้า</button>
                                        <button type="submit" name="buy" class='btn btn-danger btn-lg me-2 btn-width-100' >ซื้อสินค้า</button>
                                    <?php }else{?>
                                        <a href="./login.php" class='btn btn-primary btn-lg me-2 btn-width-100'>เข้าสู่ระบบ</a>
                                        <a href="./register.php" class='btn btn-success btn-lg me-2 btn-width-100'>สมัคสมาชิก</a>
                                    <?php }}?>
                            </form><br>
                        </div>
                </div>
            </div>
            <?php
                // ถ้ามีค่าใน row-spec
                if($row['spec']){ ?>
                    <div class="row mt-5">
                        <h4>รายละเอียดสินค้า</h4><hr>
                        <!-- แสดงรายละเอียดสินค้า -->
                        <?=$row['spec']?>
                    </div>
            <?php }?>
            
        </div>
    </div>
    <!-- .Container -->

<?php
    // แทรก Footer
    include('./layouts/footer.php');
?>