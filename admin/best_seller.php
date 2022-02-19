<?php
    include './layouts/head.php';
    include '../includes/thaidate.php';

    $start="";
    $end="";
    $priceSum=0;
    $qtySum=0;
    $netSum=0;
    $totalSum=0;

    if(isset($_POST['submit'])){
        $start=$_POST['start'];
        $end=$_POST['end'];

        $sql = "SELECT p.name, p.price,o.qty as oqty, SUM(p.price*o.qty) as sum,p.cost as cost
                FROM tb_products as p
                INNER JOIN tb_orders as o
                ON p.id_product = o.id_product
                WHERE DATE(date) BETWEEN '$start' AND '$end'
                GROUP BY o.id_order
                ORDER BY o.qty DESC";
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
                    <form method="post">
                        <div class="row">
                            <div class="col-2">
                                <label for="">วันที่เริ่มต้น</label>
                                <input type="date" name="start" class="form-control" value="<?=$start?>">
                            </div>
                            <div class="col-2">
                                <label for="">วันที่สิ้นสุด</label>
                                <input type="date" name="end" class="form-control" value="<?=$end?>">
                            </div>
                            <div class="col-1" style="margin-top:30px">
                                <input type="submit" name="submit" value="ค้นหา" class="btn btn-success">
                            </div>
                        </div>
                    </form>

                    <div id="printout">
                        <div align="center">
                            <h1>อันดับยอดขายสินค้า</h1>
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

                            <!-- .table -->
                                <table width="100%">
                                    <thead class='text-center text-product'>
                                        <th>อันดับ</th>
                                        <th>สินค้า</th>
                                        <th>ราคาทุน</th>
                                        <th>ราคาขาย</th>
                                        <th>กำไร</th>
                                        <th>จำนวน</th>
                                        <th>ยอดขาย</th>
                                        <th>กำไรสุทธิ</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                            while($row=mysqli_fetch_assoc($q)){ ?>
                                            <tr>
                                                <th class='text-center'><?=$i?></th>
                                                <td><?=$row['name']?></td>
                                                <td align="end">฿<?=number_format($row['cost'])?></td>
                                                <td align="end">฿<?=number_format($row['price'])?></td>
                                                <td align="end">฿<?=number_format($row['price']-$row['cost'])?></td>
                                                <td align="end"><?=number_format($row['oqty'])?></td>
                                                <td align="end">฿<?=number_format($row['sum'])?></td>
                                                <td align="end">฿<?=number_format(($row['price']-$row['cost'])*$row['oqty'])?></td>
                                            </tr>
                                        <?php 
                                            $i++;
                                            // $priceSum+=$row['price'];
                                            $qtySum+=$row['oqty'];
                                            $totalSum+=$row['sum'];
                                            $netSum+=($row['price']-$row['cost'])*$row['oqty'];
                                        } ?>
                                            <tr class="text-danger">
                                                <td colspan="5" align="center"><b>รวมทั้งหมด</b></td>
                                                <td align="end"><b><?=number_format($qtySum)?></b></td>
                                                <td align="end"><b>฿<?=number_format($totalSum)?></b></td>
                                                <td align="end"><b>฿<?=number_format($netSum)?></b></td>
                                            </tr>
                                    </tbody>
                                </table>
                        <!-- /.table -->
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

</body>
</html>
