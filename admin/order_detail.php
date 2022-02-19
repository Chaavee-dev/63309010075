<?php
    include './layouts/head.php';

    $oid = $_GET['id'];
    $sql = "SELECT o.*, p.*, o.qty as oqty
                    FROM tb_orders as o
                    INNER JOIN tb_products as p
                    ON o.id_product = p.id_product
                    WHERE id_order = $oid";
    $order = mysqli_query($conn, $sql);

    $total = 0;

    echo "<script>document.title='รายละเอียดรายการสั่งซื้อ: $oid'</script>";
?>
    
<div class="container p-5">

<div id="printout">
    <h4><b>รายละเอียดรายการสั่งซื้อ: <span><?=$oid?></span></b></h4><hr>
        <div class="row">
            <!-- <div class="col-6">
                <h6><b>ใบสั่งซื้อ</b></h6><hr>
                <div class="row">
                    <div class="col-3">
                        วันที่สั่งซื้อ: 
                    </div>
                    <div class="col-9">
                        2020-12-06 00:24
                    </div>
                </div>
            </div> -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <b>ชื่อผู้สั่งซื้อ: </b>
                        <span>สมยศ ทองมาก</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <b>เบอร์โทร: </b>
                        <span>0917837648</span> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <b>ที่อยู่: </b>
                        <span>416/27 ถ.ยอสนยา ต.ในเมือง อ.เมือง จ.นครราชสีมา 99858</span> 
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <table class="table table-bordered" width="100%">
            <thead align="center">
                <th>รหัสสินค้า</th>
                <th>รายการสินค้า</th>
                <th>ราคาต่อชิ้น</th>
                <th>จำนวน</th>
                <th>ราคารวม</th>
            </thead>
            <tbody>       
                <?php while($row=mysqli_fetch_assoc($order)) { ?>
                    <tr>
                        <td align="center"><?=$row['id_product']?></td>
                        <td>
                            <!-- <img src="../images/Products/<?=$row['img']?>" alt="" height='75px'> -->
                            <?=$row['name']?>
                        </td>
                        <td align="end">฿<?=number_format($row['price'])?></td>
                        <td align="end"><?=$row['oqty']?></td>
                        <td align="end">฿<?=number_format($row['total'])?></td>
                    </tr>
                <?php
                    $total += $row['price']*$row['oqty'];
                    } 
                ?>
                    <tr>
                        <td align="center" colspan="4"><b>รวมเงินทั้งหมด:</b></td>
                        <td align="end"><b>฿<?=number_format($total)?></b></td>
                    </tr>
            </tbody>
        </table>
    </div>

    <button onclick="tablePrint()" class="btn btn-secondary">พิมพ์</button>
</div>

<script type='text/javascript'>
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