<?php
    include './layouts/head.php';
    include '../includes/thaidate.php';
    
    $start="";
    $end="";
    $costSum=0;
    $priceSum=0;
    $qtySum=0;
    $totalSum=0;
    $netSum=0;

    $cname = $_POST['category'];

    if(isset($_POST['submit'])){
        $start=$_POST['start'];
        $end=$_POST['end'];

        
        if($_POST['category'] == "all"){
            $sql = "SELECT o.*,p.*, c.*,c.name as cname, o.qty as oqty
                FROM tb_orders as o
                INNER JOIN tb_products as p
                ON o.id_product = p.id_product
                INNER JOIN tb_category as c
                ON p.category = c.id_category
                WHERE DATE(date) BETWEEN '$start' AND  '$end'
                ORDER BY date";
        } else {
            $sql = "SELECT o.*,p.*, c.*, o.qty as oqty
                FROM tb_orders as o
                INNER JOIN tb_products as p
                ON o.id_product = p.id_product
                INNER JOIN tb_category as c
                ON p.category = c.id_category
                WHERE DATE(date) BETWEEN '$start' AND  '$end' AND c.name = '$cname'
                ORDER BY date";
        }

        $q = mysqli_query($conn, $sql);
    }
    
?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include './layouts/sidebar.php' ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include './layouts/topbar.php' ?>

                <!-- Begin Page Content -->
                <div class="container-fluid text-dark">

                    <div class="row my-2">
                        <div class="col-2">
                            <a href="./report.php" class="btn btn-info w-100">รายการสินค้าที่สั่งซื้อ</a>
                        </div>
                        <div class="col-2">
                            <a href="./best_seller.php" class="btn btn-secondary w-100">อันดับยอดขายสินค้า</a>
                        </div>
                    </div>

                    <form method="POST" class="mb-3">
                        <div class="row">
                        <div class="col-2">
                                <label>วันที่เริ่มต้น</label>
                                <input type="date" name="start" class="form-control" value="<?=$start?>">
                            </div>
                            <div class="col-2">
                                <label>วันที่สิ้นสุด</label>
                                <input type="date" name="end" class="form-control" value="<?=$end?>">
                            </div>
                            <div class="col-5">
                                <label>ค้นหาด้วยหมวดหมู่สินค้า</label>
                                <select name="category" class="form-control w-100">
                                    <option value="all">-ทั้งหมด-</option>
                                    <?php 
                                        $sql1 = "SELECT * FROM tb_category";
                                        $result1 = mysqli_query($conn, $sql1);
                                        while($row1=mysqli_fetch_assoc($result1)) {?>
                                        <option value="<?=$row1["name"]?>" <?= $row1["name"] == $cname ? 'selected' :''?>><?=$row1["name"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-1" style="margin-top:30px">
                                <input type="submit" name="submit" value="ค้นหา" class="btn btn-success">
                            </div>
                        </div>
                    </form>

                    <div id="printout">
                        <div align="center">
                            <h1>รายการสินค้าที่สั่งซื้อ</h1>
                            <div>ระหว่างวันที่: จาก: 
                                <?php if($start !== "" && $end !== "") {?>
                                    <?=thai_date(strtotime($start))?> - ถึง: <?=thai_date(strtotime($end))?>
                                <?php } ?>
                            </div>
                        </div>

                        <style>
                            table, th, td {
                                border: 1px solid black;
                                border-collapse: collapse;
                                padding: 5px;
                            }
                        </style>  

                        <?php
                            if(mysqli_num_rows($q) > 0) {
                        ?>
                        <!-- .table -->
                        <table width="100%">
                                <thead align="center">
                                    <tr>
                                        <th>วันที่สั่งซื้อ</th>
                                        <th>สินค้า</th>
                                        <th>ราคาทุน</th>
                                        <th>ราคาขาย</th>
                                        <th>กำไร</th>
                                        <th>จำนวน</th>
                                        <th>ยอดขาย</th>
                                        <th>กำไรสุทธิ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($q)){?>
                                    <tr>
                                        <td align="center"><?=thai_date(strtotime($row['date']))?></td>
                                        <td><?=$row['name']?></td>
                                        <td align="end">฿<?=number_format($row['cost'])?></td>
                                        <td align="end">฿<?=number_format($row['price'])?></td>
                                        <td align="end">฿<?=number_format($row['price']-$row['cost'])?></td>
                                        <td align="end"><?=number_format($row['oqty'])?></td>
                                        <td align="end">฿<?=number_format($row['total'])?></td>
                                        <td align="end">฿<?=number_format(($row['price']-$row['cost'])*$row['oqty'])?></td>
                                    </tr>
                                    <?php 
                                        $priceSum+=$row['price'];
                                        $qtySum+=$row['oqty'];
                                        $netSum+=($row['price']-$row['cost'])*$row['oqty'];
                                        $totalSum+=$row['price']*$row['oqty'];
                                    } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-danger">
                                        <td colspan="5" align="center">
                                            <b>รวมทั้งหมด</b>
                                        </td>
                                        <td align="end"><b><?=number_format($qtySum)?></b></td>
                                        <td align="end"><b>฿<?=number_format($totalSum)?></b></td>
                                        <td align="end"><b>฿<?=number_format($netSum)?></b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        <!-- /.table -->
                        <?php } else { ?>
                            <hr>
                            <h4 class="text-danger text-center">ไม่พบรายการสั่งซื้อที่คุณค้นหา</h4>
                        <?php } ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2"> 	
                                <button onclick="tablePrint();" class="btn btn-primary mt-3"><i class="fa fa-print"></i> พิมพ์รายงาน</button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include './layouts/footer.php' ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    
    <!-- Script -->
    <script>
    function tablePrint(){  
        var display_setting="toolbar=no,location=no,directories=no,menubar=no,";  
        display_setting+="scrollbars=no,width=1024, height=768, left=100, top=100";  
        var content_innerhtml = $("#printout").html();  
        var document_print=window.open("","",display_setting); 
        document_print.document.open();  
        document_print.document.close();  
        document_print.document.write('<body style="font-family:Calibri(body);  font-size:16px;" onLoad="self.print();self.close();" >');  
        document_print.document.write(content_innerhtml);  
        document_print.document.write('</body></html>');  
        document_print.document.title = 'ออกรายงาน';
        document_print.print();  
        document_print.close();  
        return false;  
        }
    </script>
    <!-- .Script -->

</body>
</html>
