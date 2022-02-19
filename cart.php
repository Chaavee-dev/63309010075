<?php
    // แทรก head
    include('./layouts/head.php');
    // แทรก Navigationbar
    include('./layouts/navbar.php');
    
    // ดึงเลขที่ผู้ใช้งานใน session: uid มาเก็บไว้ในตัวแปร $uid
    $uid = $_SESSION['uid'];
    
    // ถ้ามีการส่งค่า del แบบ get ให้ลบสินค้าออกจาก cart
    if(isset($_GET['del'])){

        // ดึงค่าที่เก็บใน del มากเก็บในตัวแปร $cid
        $cid = $_GET['del'];

        // ลบสินค้าที่เลือกในตาราง
        mysqli_query($conn, "DELETE FROM tb_cart WHERE id_cart = $cid AND id_user = $uid");

        // ย้อนกลับก่อนหน้า
        echo "<script>window.history.back()</script>";
    }

    // ถ้ามีการส่งค่า del แบบ get ให้ลบสินค้าออกจาก cart
    if(isset($_GET['clearCart'])){

        // ลบสินค้าที่เลือกในตาราง
        mysqli_query($conn, "DELETE tb_cart FROM tb_cart WHERE id_user = $uid");

        // ย้อนกลับก่อนหน้า
        echo "<script>window.history.back()</script>";
    }

    // ตั้งตัวแปรผลรวมจำนวนและราคาสินค้า กำหนดตัวแปรเริ่มต้นเป็น 0
    $sumQty = 0;
    $sumPrice = 0;
?>

    <!-- container -->
    <div class='container p-5 bg-white'>
        <h3>ตะกร้าสินค้า</h3> 
        <!-- table -->
        <table class='table table-hover table-bordered mt-3 align-middle'>
            <thead bgcolor='#CACACA'>
                <tr>
                    <th class='text-center'>สินค้า</th>
                    <th class='text-end'>รายละเอียด</th>
                    <th class='text-center'>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // แสดงข้อมูลในตะกร้าทั้งหมดที่ยังมีจำนวนมากกว่า 0 หรือสินค้ายังไม่หมด
                $sql_cart = "SELECT p.id_product as pid, img as img,
                                    p.name as pname , p.price as price,
                                    c.qty as qty, c.id_cart as cid,
                                    p.qty as pqty
                            FROM tb_cart as c
                            INNER JOIN tb_products as p
                            ON c.id_product = p.id_product
                            WHERE c.id_user = $uid AND
                                    p.qty > 0 AND p.qty >= c.qty
                            GROUP BY pid
                            ORDER BY id_cart DESC";
                $q_cart = mysqli_query($conn, $sql_cart);
                // ลูป while สินค้าทั้งหมดใน tb_cart
                while($row1 = mysqli_fetch_assoc($q_cart)){
                        $pid = $row1['pid'];
                        $q_product = mysqli_query($conn, "SELECT qty FROM tb_products WHERE id_product = $pid");
                        $row_p = mysqli_fetch_assoc($q_product);
                        $qty = $row_p['qty'];
                    ?>
                    <tr>
                        <td class='text-center'>
                            <input type="hidden" id="pid" value="<?=$row1['pid']?>" />
                            <a href='./product.php?pid=<?=$row1['pid']?>' class='text-decoration-none text-dark'>
                                <img src='./images/Products/<?=$row1['img']?>' height='75px'>
                                <p><?=$row1['pname']?></p>
                            </a>
                        </td>
                        <td class='text-end'>
                            <h6>ราคาต่อชิ้น: ฿<?=number_format($row1['price'])?></h6>
                            <h6>
                                จำนวน:
                                    <input type="number" name="qty" onchange="selectQty(<?=$pid?>, this.value)" max="<?=$row1['pqty']?>" min="1" value="<?=$row1['qty']?>">
                                ชิ้น
                            </h6>
                            <h6>รวม: ฿<?=number_format($row1['price']*$row1['qty'])?></h6>
                        </td>
                        <td class='text-center'>
                            <a href='./cart.php?del=<?=$row1['cid']?>' class='btn btn-danger btn-sm'>ลบ</a>
                        </td>
                    </tr>
                <?php
                    // รวมจำนวนสินค้าและเงิน
                    $sumQty += $row1['qty'];  
                    $sumPrice += $row1['price']*$row1['qty'];
                } ?>
                <!-- ปิดลูป while-->
                
                <tr bgcolor='#CACACA'>
                    <td colspan='2' class='text-end'>
                        <b>รวม (<?=$sumQty?> ชิ้น)</b><br>
                        <b>รวมทั้งหมด: ฿<?=number_format($sumPrice)?></b>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='4' class='text-end'>
                        <a href="./" class="btn btn-secondary">ดูสินค้าต่อ</a>
                        <a onclick="goBack()" class="btn btn-dark">ย้อนกลับ</a>
                        <a href="?clearCart" class="btn btn-warning">ลบทั้งหมด</a>
                        <a href="./checkout.php" class="btn btn-primary">สั่งสินค้า</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- .table -->
        
        <?php 
            // แสดงสินค้าที่อยู่ในตะกร้าแต่สินค้าหมด
            $sql_cart_all = "SELECT p.id_product as pid, img as img,
                            p.name as pname , p.price as price,
                            c.qty as qty, c.id_cart as cid
                    FROM tb_cart as c
                    INNER JOIN tb_products as p
                    ON c.id_product = p.id_product
                    WHERE c.id_user = $uid AND
                            (p.qty = 0 OR c.qty > p.qty)
                    GROUP BY pid
                    ORDER BY id_cart DESC";
            $q_cart_all = mysqli_query($conn, $sql_cart_all);

            // ถ้ามี row มากกกว่า 0 ให้แสดงตารางนี้
            if(mysqli_num_rows($q_cart_all) > 0) {?>
            <!-- table -->
            <!-- ตารางแสดงสินค้าที่อยู่ในตะกร้าแต่สินค้าหมด -->
            <table  class='table table-secondary table-bordered mt-3 align-middle'>
                <thead>
                    <tr>
                        <th colspan="4">รายการสินค้าที่ไม่สามารถซื้อได้</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row2 = mysqli_fetch_assoc($q_cart_all)) {
                            $text = "สินค้าหมด";

                            $out = mysqli_query($conn, "SELECT qty FROM tb_products WHERE id_product = ".$row2['pid']);
                            $row_out = mysqli_fetch_assoc($out);
                            $ckQTY = $row_out['qty'];
                            if($ckQTY < $row2['qty'] && $ckQTY != 0){
                                $text = "สินค้ามีจำนวนไม่พอ";
                            }
                        ?>
                        <tr>
                            <td class='text-center'>
                                <p><?=$text?></p>
                            </td>
                            <td class='text-center'>
                                <a href='product.php?pid=<?=$row2['pid']?>' class='text-decoration-none text-dark'>
                                    <img src='./images/Products/<?=$row2['img']?>' height='75px'><br>
                                    <?=$row2['pname']?>
                                </a>
                            </td>
                            <td class='text-end'>
                                ราคาต่อชิ้น: ฿<?=number_format($row2['price'])?><br>
                                จำนวน:  <select onchange="selectQty(<?=$row2['pid']?>, this.value)">
                                            <option value="">0</option>
                                            <?php 
                                                for($i=1;$i<=$ckQTY;$i++) { ?>
                                                    <option value="<?=$i?>"><?=$i?></option>
                                            <?php } ?>
                                        </select>
                                ชิ้น<br>
                                รวม: ฿<?=number_format($row2['price']*$row2['qty'])?>
                            </td>
                            <td class='text-center'>
                                <a href='./cart.php?del=<?=$row2['cid']?>' class='btn btn-danger btn-sm'>ลบ</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- .table -->
        <?php } ?>
    </div>
    <!-- .container -->

<!-- Script -->
<script>
    function selectQty(pid, qty){                       
        $.ajax({
            url:'update_qty_cart.php',
            method:'post',
            data:{pid:pid, qty:qty},
            success:function(){
                window.location.reload();
            }
        });
    }
</script>
<!-- .Script -->

<?php
    // แทรก Footer
    include('./layouts/footer.php');
?>