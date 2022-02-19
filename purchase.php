<?php
    // แทรก head
    include('./layouts/head.php');
    // แทรก Navigationbar
    include('./layouts/navbar.php');
    // alert
    include('./includes/alert.php');
    // thaidate format
    include('./includes/thaidate.php');

    $uid = $_SESSION['uid'];

    //ยกเลิก order
    if(isset($_GET['cancel'])){
        $oid = $_GET['cancel'];

        // // ดึงข้อมูล order ที่ต้องการยกเลิก
        // $b = mysqli_query($conn,"SELECT * FROM tb_orders WHERE id_order = $oid");

        // // ลูปเพื่อคืนจำนวนสินค้า
        // foreach($b as $item){
        //     $pid = $item['id_product'];
        //     $qty = $item['qty'];

        //     mysqli_query($conn, "UPDATE tb_products SET qty = qty+$qty WHERE id_product = $pid");
        // }

        $result = mysqli_query($conn, "DELETE tb_orders FROM tb_orders WHERE id_order = $oid");
        
        if($result){

            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "success",
                "msg" => "ยกเลิกรายการสั่งซื้อสำเร็จ",
            );

            echo "<script>window.location.href = './purchase.php';</script>";
        }
    }

    //ถ้ามีการกดยอมว่าได้รับสินค้า
    if(isset($_GET['accept'])){
        $oid = $_GET['accept'];
        $sql = "UPDATE tb_orders SET status = 6 WHERE id_order = $oid";
        $result = mysqli_query($conn, $sql);
    }

    // ดึงข้อมูลจากตาราง orders ของลูกค้า
    $sql1 = "SELECT  o.qty as oqty,
                    p.qty as pqty,
                    s.id_status as sid,
                    s.name_first as stt_1st,
                    s.name_third as stt_3rd,
                    o.id_order as oid,
                    o.date as odate
            FROM tb_orders as o
            INNER JOIN tb_products as p
            ON o.id_product = p.id_product
            INNER JOIN tb_status as s
            ON o.status = s.id_status
            WHERE o.id_user = $uid
            GROUP BY o.id_order
            ORDER BY o.date DESC";
    $order = mysqli_query($conn, $sql1);
?>

    <div class="container p-5">   
    <h1>การซื้อของฉัน</h1><hr>
        <!-- ลูป order ของลูกคนคนนี้ -->
        <?php while($row1 = mysqli_fetch_assoc($order)) { ?>
            <div class="card border-secondary mt-5">
                <div class="card-header bg-transparent border-secondary">
                    <div class="row">
                        <div class="text-end">
                            <b><?=thai_date(strtotime($row1['odate']))?></b>
                        </div>
                        <div class="text-end">
                            <b>หมายเลขคำสั่งซื้อ: <?=$row1['oid']?> |</b>
                            <b class="text-danger"><?=$row1['stt_1st']?></b>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <?php
                            $total_pay = 0;
                            $oid = $row1['oid'];
                            $sql = "SELECT o.*, p.*, o.qty as oqty
                                    FROM tb_orders as o
                                    INNER JOIN tb_products as p
                                    ON o.id_product = p.id_product
                                    WHERE id_order = $oid";
                            $more = mysqli_query($conn, $sql);
                            while($row2=mysqli_fetch_assoc($more)){
                                $total_pay += $row2['total'];
                                $sid = $row1['sid'];
                            ?>

                            <div class="row">
                                <div class="col-sm-12 col-lg-1">
                                    <img src='./images/Products/<?=$row2['img']?>' height='75px'>
                                </div>
                                <div class="col-sm-10 col-lg-9">
                                    <a href="./product.php?pid=<?=$row2['id_product']?>" class="text-decoration-none text-dark">
                                        <b><?=$row2['name']?></b>
                                    </a><br>
                                    <?php   // เช็คว่ามีสินค้าเพียงพอสำหรับรายการสั่งซื้อนี้ไหม
                                            if($row2['qty'] < $row2['oqty'] && $sid <= 2){
                                                echo "<b class='text-danger'>สินค้ามีไม่เพียงพอ</b>";
                                                $btn1 = "disabled";
                                            }
                                    ?>
                                    <p>จำนวน: x<?=$row2['oqty']?></p>
                                </div>
                                <div class="col-sm-2 col-lg-2 text-end">
                                    <p>
                                        ฿<?=number_format($row2['total'])?>
                                    </p>
                                </div><hr>
                            </div>
                            
                            <?php } ?>

                    <div class="row text-end">
                        <div class="col-sm-10 col-lg-10">
                            <h6>
                                ยอดคำสั่งซื้อทั้งหมด:
                            </h6>
                        </div>
                        <div class="col-sm-2 col-lg-2">
                            <b class="text-danger">
                                ฿<?=number_format($total_pay)?>
                            </b>
                        </div>
                    </div>

                </div>
                <div class="card-footer bg-transparent border-secondary text-end">
                    <?php if($sid == 1) {?>
                        <button class="btn btn-outline-success btn-sm" onclick="modal_order_pay(<?=$row1['oid']?>,'pay',<?=$total_pay?>)" <?=$btn1?>><?=$row1['stt_3rd']?></button>
                    <?php }else if($sid == 2){?>
                        <button class="btn btn-warning btn-sm" onclick="modal_order_pay(<?=$row1['oid']?>,'re-pay',<?=$total_pay?>)" <?=$btn1?>><?=$row1['stt_3rd']?></button>
                    <?php }else if($sid == 3){?>
                        <button class="btn btn-outline-primary btn-sm disabled"><?=$row1['stt_3rd']?></button>
                    <?php $cancel = "disabled"; }else if($sid == 4){?>
                        <button class="btn btn-primary btn-sm disabled"><?=$row1['stt_3rd']?></button>
                    <?php $cancel = "disabled"; }else if($sid == 5){?>
                        <button class="btn btn-outline-dark btn-sm" onclick="modal_order_tracking(<?=$row1['oid']?>)"><?=$row1['stt_3rd']?></button>
                    <?php $cancel = "disabled"; }else if($sid == 6){?>
                        <button class="btn btn-dark btn-sm disabled"><?=$row1['stt_3rd']?></button>
                    <?php $cancel = "disabled"; }else if($sid == 7){?>
                        <button class="btn btn-dark btn-sm disabled"><?=$row1['stt_3rd']?></button>
                    <?php $cancel = "disabled"; }else{ $cancel = "disabled"; }?>
                    
                    <!-- ปุ่มยกเลิกแบบ modal -->
                    <button class="btn btn-danger btn-sm" onclick="modal_order_cancel(<?=$row1['oid']?>)" <?=$cancel?>>ยกเลิกคำสั่งซื้อ</button>
                </div>
            </div>
        <?php } ?>
    </div>


    <!-- modal ชำระเงิน -->
    <div class='modal fade' id='ModalOrderPay' tabindex='-1' aria-hidden='true'>
        <div class="modal-dialog modal-dialog-centered">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-pname' id='exampleModalLabel'>ชำระเงินเลขที่สั่งซื้อ: <span id="oidz"></span></h5>
                </div>
                <div class='modal-body text-center'>

                    <?php
                        $sql = "SELECT b.*, th.name as th
                                FROM tb_banks as b
                                INNER JOIN tb_banks_th as th
                                ON b.id_bankth = th.id_bankth
                                ORDER BY id_bank DESC";
                        $bank = mysqli_query($conn, $sql);
                    ?>

                    <table class='table table-bordered mt-3 align-middle'>
                        <thead class='table-dark'>
                            <th>ธนาคาร</th>
                            <th>ชื่อบัญชี</th>
                            <th>เลขที่บัญชี</th>
                        </thead>
                        <tbody>
                            <?php while($rowB = mysqli_fetch_assoc($bank)){?>
                                <tr>
                                    <td><?=$rowB['th']?></td>
                                    <td><?=$rowB['name']?></td>
                                    <td><?=$rowB['number']?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <h1 class="text-white bg-danger">ยอดที่ต้องชำระ: ฿<span id="total"></span></h1>

                    <form action="pay_db.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="oid" id="oid">
                            <input type="hidden" name="total" id="sumtotal">
                            <input type="file" name="upload" class="form-control" required/>
                        
                        <label>วันที่และเวลาโอนเงิน</label>
                            <input type="datetime-local" class="form-control" name="date" required>

                        <label>โอนจากธนาคาร</label>
                            <select name="transfer-from"  class="form-control" required>
                                <option value="">--เลือกธนาคารของคุณ--</option>
                                <?php 
                                $sql = "SELECT * FROM tb_banks_th";
                                $bankTH = mysqli_query($conn, $sql); 
                                while($rowTH = mysqli_fetch_assoc($bankTH)){ ?>
                                    <option value="<?=$rowTH['id_bankth']?>"><?=$rowTH['name']?></option>
                                <?php } ?>
                            </select>

                        <label>โอนไปยัง</label>
                            <select name="transfer-to"  class="form-control" required>
                                <option value="">--เลือกธนาคารที่คุณโอนชำระ--</option>
                                <?php
                                $sql = "SELECT b.*, th.name as th
                                        FROM tb_banks as b
                                        INNER JOIN tb_banks_th as th
                                        ON b.id_bankth = th.id_bankth
                                        ORDER BY id_bank DESC";
                                $banks = mysqli_query($conn, $sql);
                                                        
                                while($rowBk = mysqli_fetch_assoc($banks)) {?>
                                    <option value="<?=$rowBk['id_bankth']?>"><?=$rowBk['th']?></option>
                                <?php } ?>
                            </select>

                        
                </div>
                <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>ปิด</button>
                        <button id="submit" class='btn btn-success' type='submit'>บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal ดูเลข tracking -->
    <div class="modal fade" id="ModalOrderTracking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เลขพัสดุรายการสั่งซื้อ: <span id="oidx"></span></h5>
                </div>
                <div class='modal-body text-center'>
                    <h4 id="tk"></h4>
                    <a id="kerry" target="_blank">คลิกเพื่อตรวจสอบ</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <a id="link-accept" class="btn btn-success">ฉันได้รับสินค้าแล้ว</a>
                </div>
            </div>
        </div>
    </div>

    <!-- modal ยกเลิก -->
    <div class="modal fade" id="ModalOrderCanncel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">คุณแน่ใจที่จะยกเลิกรายการสั่งซื้อนี้ใช่ไหม?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <a id="link-cancel" class="btn btn-primary">ตกลง</a>
                </div>
            </div>
        </div>
    </div>

    <!-- simple.money.format js จัดการเกี่ยวกับรูปแบบเงิน -->
    <script src="./admin/plugins/simple-money-format/simple.money.format.js"></script>

    <!-- Script -->
    <script type='text/javascript'>
            
        //กดเพื่อชำระเงินรายการสั่งซื้อ
        function modal_order_pay(oid, btn, amount){
            $('#oidz').html(oid);
            $('#oid').val(oid);
            $('#total').html(amount).simpleMoneyFormat();
            $('#sumtotal').val(amount);
            $('#submit').attr('name',btn);
            $('#ModalOrderPay').modal('show');
        }

        //กดเพื่อดูเลข tracking
        function modal_order_tracking(oid){
            $.ajax({
                url:"orderFetch.php",
                method:"post",
                data:{id:oid},
                dataType:"json",
                success:function(response){
                    $('#oidx').html(response.id_order);
                    $('#tk').html("Kerry : "+response.tracking);
                    $('#kerry').attr("href","https://th.kerryexpress.com/th/track/v2/?track="+response.tracking);
                    $('#link-accept').attr("href", "?accept="+response.id_order);
                    $('#ModalOrderTracking').modal('show');
                }
            });
        }

        //กดเพื่อยกเลิกรายการสั่งซื้อ
        function modal_order_cancel(oid){
            $.ajax({
                url:"orderFetch.php",
                method:"post",
                data:{id:oid},
                dataType:"json",
                success:function(response){
                    $('#link-cancel').attr("href", "?cancel="+response.id_order);
                    $('#ModalOrderCanncel').modal('show');
                }
            });
        }

    </script>
    <!-- .Script -->

<?php
    // แทรก Footer
    include('./layouts/footer.php');
?>