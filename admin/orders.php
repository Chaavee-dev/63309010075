<?php
    include 'layouts/head.php';
    include '../includes/thaidate.php';

    $status=$_GET['status'];

    //ยกเลิก order
    if(isset($_GET['cancel'])){
        $oid = $_GET['cancel'];

        // ดึงข้อมูล order ที่ต้องการยกเลิก
        $b = mysqli_query($conn,"SELECT * FROM tb_orders WHERE id_order = $oid");

        // ลูปเพื่อคืนจำนวนสินค้า
        foreach($b as $item){
            $pid = $item['id_product'];
            $qty = $item['qty'];

            mysqli_query($conn, "UPDATE tb_products SET qty = qty+$qty WHERE id_product = $pid");
        }

        $result = mysqli_query($conn, "UPDATE tb_orders SET status = 7 WHERE id_order = $oid");
        
        if($result){

            $_SESSION['alert'] = array(
                "uname" => $_SESSION['uname'],
                "icon" => "success",
                "msg" => "ยกเลิกรายการสั่งซื้อสำเร็จ",
            );

            echo "<script>window.location.href = './orders.php?status=ตรวจสอบ';</script>";
        }
    }
?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'layouts/sidebar.php' ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'layouts/topbar.php' ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row justify-content-start mb-3">
                        <!-- <div class="col-2">
                            <a href="./products.php" class="btn btn-info w-100">สินค้าทั้งหมด</a>
                        </div>
                        <div class="col-2">
                            <a href="?out_of_stock" class="btn btn-danger w-100">สินค้าที่กำลังหมด</a>
                        </div> -->
                        <div class="col-2">
                            <select name="status" class="form-control w-100" onchange="location = this.value">
                                <option value="">-เลือกสถานะสั่งซื้อ-</option>
                                <?php 
                                    $sql1 = "SELECT * FROM tb_status";
                                    $result1 = mysqli_query($conn, $sql1);
                                    while($row1=mysqli_fetch_assoc($result1)) { ?>
                                    <option value="?status=<?=$row1["name_second"]?>" <?= $row1["name_second"] == $status ? 'selected' :''?>><?=$row1["name_second"]?> : <?=//number_format($row_count["count"])?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">ตารางรายการสั่งซื้อ</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class='text-center text-product'>
                                        <th>#</th>
                                        <th>เลขที่สั่งซื้อ</th>
                                        <th>ลูกค้า</th>
                                        <th>วันที่สั่งซื้อ</th>
                                        <th>จัดการ</th>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $i=1;
                                        // ดึงข้อมูลจากตาราง orders ของลูกค้า
                                        $sql = "SELECT o.id_order as oid,
                                                    o.date as odate,
                                                    p.price as price,
                                                    o.qty as oqty,
                                                    o.total as ototal,
                                                    p.name as pname,
                                                    p.img as pimg,
                                                    s.id_status as sid,
                                                    s.name_second as stt_2nd,
                                                    u.id_user as mid,
                                                    u.username as mname
                                                FROM tb_orders as o, tb_products as p,
                                                    tb_status as s, tb_users as u
                                                WHERE o.id_product = p.id_product AND 
                                                        o.status = s.id_status AND
                                                        o.id_user = u.id_user AND
                                                        s.name_second = '$status'
                                                GROUP BY o.id_order
                                                ORDER BY o.date DESC";
                                        $order = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($order)) {?>
                                        <tr>
                                            <th class='text-center align-middle'><?=$i?></th>
                                            <td class='text-center align-middle'><?=$row['oid']?></td>
                                            <td class='text-center align-middle'><?=$row['mname']?></td>
                                            <td class='text-center align-middle'><?=thai_date(strtotime($row['odate']))?></td>
                                            <td class='text-center'>
                                                <?php
                                                    $sid = $row['sid'];
                                                    $disable = "";
                                                    if($sid == 1){ ?>
                                                        <button class="btn btn-outline-success btn-sm w-50 rounded-pill" disabled><?=$row['stt_2nd']?></button><br>
                                                        <a href="order_detail.php?id=<?=$row['oid']?>" target="_black" class="btn btn-info btn-sm w-50 rounded-pill mt-1">รายละเอียด</a><br>
                                                        <button class="btn btn-outline-warning btn-sm w-50 rounded-pill mt-1" onclick="modal_change_status(<?=$row['oid']?>)">
                                                            จัดการสถานะ
                                                        </button>
                                                    <?php }else if($sid == 2){ ?>
                                                        <button class="btn btn-success btn-sm w-50 rounded-pill" disabled><?=$row['stt_2nd']?></button><br>
                                                        <button class="btn btn-outline-warning btn-sm w-50 rounded-pill mt-1" onclick="modal_change_status(<?=$row['oid']?>)">
                                                            จัดการสถานะ
                                                        </button>
                                                    <?php }else if($sid == 3){?>
                                                        <a href="order_detail.php?id=<?=$row['oid']?>" target="_black" class="btn btn-info btn-sm w-50 rounded-pill my-1">รายละเอียด</a><br>
                                                        <button class="btn btn-outline-primary btn-sm w-50 rounded-pill" onclick="modal_check_pay(<?=$row['oid']?>)"><?=$row['stt_2nd']?></button><br>
                                                        <button class="btn btn-outline-warning btn-sm w-50 rounded-pill mt-1" onclick="modal_change_status(<?=$row['oid']?>)">
                                                            จัดการสถานะ
                                                        </button>
                                                    <?php }else if($sid == 4){?>
                                                        <button class="btn btn-primary btn-sm w-50 rounded-pill" onclick="modal_add_tracking(<?=$row['oid']?>)"><?=$row['stt_2nd']?></button><br>
                                                        <a href="order_detail.php?id=<?=$row['oid']?>" target="_black" class="btn btn-info btn-sm w-50 rounded-pill mt-1">รายละเอียด</a><br>
                                                        <button class="btn btn-outline-warning btn-sm w-50 rounded-pill mt-1" onclick="modal_change_status(<?=$row['oid']?>)">
                                                            จัดการสถานะ
                                                        </button>
                                                    <?php $disable = "disabled"; }else if($sid == 5){?>
                                                        <button class="btn btn-outline-dark btn-sm w-50 rounded-pill" disabled><?=$row['stt_2nd']?></button><br>
                                                    <?php $disable = "disabled"; }else if($sid == 6){?>
                                                        <button class="btn btn-dark btn-sm w-50 rounded-pill" disabled><?=$row['stt_2nd']?></button><br>
                                                    <?php $disable = "disabled"; }else if($sid == 7){?>
                                                        <button class="btn btn-dark btn-sm w-50 rounded-pill" disabled><?=$row['stt_2nd']?></button><br>
                                                    <?php $disable = "disabled"; }else{?>
                                                        <button class="btn btn-outline-dark btn-sm w-50 rounded-pill" disabled><?=$row['stt_2nd']?></button><br>
                                                    <?php $disable = "disabled"; }?>

                                            </td>
                                        </tr>
                                    <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include 'layouts/footer.php' ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Modal รายละเอียดการชำระเงิน -->
    <div class='modal fade' id='OrderPayModal' tabindex='-1' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-pname' id='exampleModalLabel'>ชำระเงินเลขที่สั่งซื้อ: <b id="order"></b></h5>
                </div>
                <div class='modal-body'>
                    <img id="slip" style="width:100%"><hr>
                    <h4>โอนจาก: <b id="transfer-from" class="text-danger"></b></h4>
                    <h4>ยอดชำระ: <b class="text-danger">฿<span id="total"></span></b></h4>
                    <h4>วันที่และเวลาโอน: <b id="datetime" class="text-danger"></b></h4>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>ปิด</button>
                    <a id="wrong" class='btn btn-warning'>ไม่ถูกต้อง</a>
                    <a id="correct" class='btn btn-primary'>ถูกต้อง</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal กรอกเลขพัสดุ -->
    <div class='modal fade' id='OrderTrackingModal' tabindex='-1' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-pname' id='exampleModalLabel'>กรอกเลขพัสดุรายการสั่งซื้อ: <span id="order"></span></h5>
                </div>
                <div class='modal-body'>
                    <form action="orders_db.php" method="post">
                        <input type="hidden" id="oid" name="oid">
                        <label>กรอกเลขพัสดุ:</label>
                        <input type="text" name="tk" class="form-control">
                </div>
                <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>ปิด</button>
                        <button type='submit' class='btn btn-success'>บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal จัดการสถานะรายการสั่งซื้อ -->
    <div class="modal fade" id="OrderManageStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">จัดการสถานะการสั่งซื้อ: <span id="id_order"></span></h5>
                </div>
                <div class="modal-body">
                    <form action="orders_db.php" method="post">
                        <input type="hidden" id="oid_hidden" name="oid">
                        <label>เลือกสถานะ</label>
                        <select name="status" class="form-control" required>
                            <option value="">-เลือก-</option>
                            <?php
                                // ดึงข้อมูลสถานะ
                                $stt=mysqli_query($conn, "SELECT * FROM tb_status");
                                // ลูปเป็น option
                                while($row_stt = mysqli_fetch_assoc($stt)){
                            ?>
                                <option value="<?=$row_stt['id_status']?>"><?=$row_stt['name_second']?></option>
                            <?php } ?>
                        </select>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <input type="submit" value="บันทึก" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- momentjs จัดการเกี่ยวกับวันที่และเวลา -->
    <script src="./plugins/moment/moment.min.js"></script>

    <!-- simple.money.format js จัดการเกี่ยวกับรูปแบบเงิน -->
    <script src="./plugins/simple-money-format/simple.money.format.js"></script>

    <!-- Script -->
    <script type='text/javascript'>
        
        //กดเปลี่ยนสถานะการสั่งซื้อ
        function modal_change_status(oid){
            $.ajax({
                url:"orderFetch.php",
                method:"post",
                data:{id:oid},
                dataType:"json",
                success:function(response){
                    $('#id_order').html(response.id_order);
                    $('#oid_hidden').val(response.id_order)
                    $('#OrderManageStatusModal').modal('show');
                }
            });
        }

         //กดเพื่อตรวจสอบการชำระเงิน
         function modal_check_pay(oid){
            $.ajax({
                url:"payFetch.php",
                method:"post",
                data:{id:oid},
                dataType:"json",
                success:function(response){
                    $('#order').html(response.id_order);
                    $('#slip').attr("src","../images/Slip/"+response.slip);
                    $('#transfer-from').html(response.bthname);
                    $('#total').html(response.total).simpleMoneyFormat();
                    $('#datetime').html(moment(new Date(response.date)).format('hh:mm , d/MM/yyyy'));
                    $('#wrong').attr("href", "orders_db.php?pay_wrong&oid="+response.id_order);
                    $('#correct').attr("href", "orders_db.php?pay_correct&oid="+response.id_order);
                    $('#OrderPayModal').modal('show');
                }
            });
         }

        //กดเพื่อกรอกเลขพัสดุ
        function modal_add_tracking(oid){
            $.ajax({
                url:"orderFetch.php",
                method:"post",
                data:{id:oid},
                dataType:"json",
                success:function(response){
                    $('#order').html(response.id_order)
                    $('#oid').val(response.id_order)
                    $('#OrderTrackingModal').modal('show');
                }
            });
        }
        
    </script>
    <!-- .Script -->

</body>
</html>
