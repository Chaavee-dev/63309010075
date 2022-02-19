<?php
    include './layouts/head.php';

    $out_of_stock=$_GET['out_of_stock'];
    $select_category=$_GET['category'];
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
                <div class="container-fluid">

                    <div class="row justify-content-start mb-3">
                        <div class="col-2">
                            <a href="./products.php" class="btn btn-info w-100">สินค้าทั้งหมด</a>
                        </div>
                        <div class="col-2">
                            <a href="?out_of_stock" class="btn btn-danger w-100">สินค้าที่กำลังหมด</a>
                        </div>
                        <div class="col-2">
                            <select name="category" class="form-control w-100" onchange="location = this.value">
                                <option value="">-เลือกค้นหาตามหมวดหมู่-</option>
                                <?php 
                                    $sql1 = "SELECT * FROM tb_category";
                                    $result1 = mysqli_query($conn, $sql1);
                                    while($row1=mysqli_fetch_assoc($result1)) {
                                        ?>
                                    <option value="?category=<?=$row1["name"]?>" <?= $row1["name"] == $select_category ? 'selected' :''?>><?=$row1["name"]?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row m-0">
                                <div class="col-6">
                                    <h5 class="font-weight-bold text-primary">ตารางรายการสินค้า</h5>
                                </div>
                                <div class="col-6 text-right">
                                    <!-- ปุ่มเพิ่มสินค้าโดยเรียกใช้ Modal -->
                                    <button class="btn btn-primary" data-toggle='modal' data-target='#ProductAddModal'>เพิ่มสินค้า</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class='text-center text-product'>
                                        <th>#</th>
                                        <th>รูปสินค้า</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>หมวดหมู่</th>
                                        <th>ราคาทุน</th>
                                        <th>ราคาขาย</th>
                                        <th>จำนวน</th>
                                        <!-- <th>แนะนำ</th> -->
                                        <th>ดำเนินการ</th>
                                    </thead>
                                    <tbody>
                                <?php
                                    $i=1;
                                    if(isset($out_of_stock)){
                                        $sql2 = "SELECT p.id_product as pid, p.img as img,
                                                    p.name as pname, p.price as price,
                                                    p.qty as qty, p.spec as sp,
                                                    c.name as cn, p.cost as cost
                                            FROM tb_products as p, tb_category as c
                                            WHERE p.category = c.id_category AND
                                                    p.qty <= 10
                                            ORDER BY p.id_product";
                                    }else if(isset($select_category)){
                                        $sql2 = "SELECT p.id_product as pid, p.img as img,
                                                    p.name as pname, p.price as price,
                                                    p.qty as qty, p.spec as sp,
                                                    c.name as cn, p.cost as cost
                                            FROM tb_products as p, tb_category as c
                                            WHERE p.category = c.id_category AND
                                                    c.name = '$select_category'
                                            ORDER BY p.id_product";
                                    }else{
                                        $sql2 = "SELECT p.id_product as pid, p.img as img,
                                                    p.name as pname, p.price as price,
                                                    p.qty as qty, p.spec as sp,
                                                    c.name as cn, p.cost as cost
                                            FROM tb_products as p, tb_category as c
                                            WHERE p.category = c.id_category
                                            ORDER BY p.id_product";
                                    }
                                    
                                    $result2 = mysqli_query($conn, $sql2);
                                    while($row2=mysqli_fetch_assoc($result2)){ ?>
                                        <tr>
                                            <th class='text-center'><?=$i?></th>
                                            <td width='120px' class='text-center'>
                                                <img src="../images/Products/<?=$row2['img']?>" class='img-product'>
                                            </td>
                                            <td>
                                                <p class='text-product'><?=$row2['pname']?></p>
                                                <button type='button' class='btn btn-secondary btn-sm rounded-pill text-product' onclick="modal_product_spec(<?=$row2['pid']?>)">
                                                    กดเพื่อดูรายละเอียด
                                                </button>
                                                
                                            </td>
                                            <td><p class='text-product'><?=$row2['cn']?></p></td>
                                            <td width='100px' class='text-end text-product'><p><?=number_format($row2['cost'])?></p></td>
                                            <td width='100px' class='text-end text-product'><p><?=number_format($row2['price'])?></p></td>
                                            <td width='100px' class='text-end text-product'><p><?=number_format($row2['qty'])?></p></td>
                                            <!-- <td class='text-center text-product'>
                                                <p>($row2['recommend'] == 1 ?"<i class='fa fa-check' aria-hidden='true'></i>":"<i class='fa fa-times' aria-hidden='true'></i>")?></p>
                                            </td> -->
                                            <td class='text-center'>

                                                <!-- ปุ่มแก้ไขสินค้าโดยเรียกใช้ Modal -->
                                                <button type="button" class="btn btn-success btn-sm w-50 rounded-pill text-product" onclick="modal_product_edit(<?=$row2['pid']?>)">
                                                แก้ไข
                                                </button>

                                                <!-- ปุ่มลบสินค้าโดยเรียกใช้ Modal -->
                                                <button type="button" class="btn btn-danger my-1 w-50 btn-sm rounded-pill text-product" onclick="modal_product_del(<?=$row2['pid']?>)">
                                                ลบ
                                                </button>
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
            <?php include './layouts/footer.php' ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Modal เพิ่มสินค้า -->
    <div class='modal fade' id='ProductAddModal' tabindex='-1' aria-hidden='true'>
        <div class="modal-dialog modal-xl">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-pname' id='exampleModalLabel'>เพิ่มสินค้า</h5>
                </div>
            <div class='modal-body'>
                <form action="product_db.php" method="post" enctype="multipart/form-data"> 
                    <div class="row mb-2">
                        <div class="col-5">
                            <label>หมวดหมู่สินค้า</label>
                            <select class="form-control" name="category">
                                <?php 
                                    $sql3 = "SELECT id_category as cid,name as cname FROM tb_category";
                                    $result3 = mysqli_query($conn, $sql3);
                                    while($row3=mysqli_fetch_assoc($result3)){
                                        echo "<option value='".$row3['cid']."'>".$row3['cname']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-7">
                            <label>ชื่อสินค้า</label>
                            <input class="form-control" type="text" name="name" maxlength="100" required>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-3">
                            <label>ราคาต้นทุน</label>
                            <input class="form-control" type="number" name="cost" required><br>
                       </div>
                       <div class="col-3">
                            <label>ราคาขาย</label>
                            <input class="form-control" type="number" name="price" required><br>
                       </div>
                        <div class="col-3">
                            <label>จำนวนสินค้า</label>
                            <input class="form-control" type="number" name="qty" min="0" required><br>
                        </div>
                        <div class="col-3">
                            <label>ภาพสินค้า</label>
                            <input type="file" name="upload" class="form-control" accept="image/png, image/jpeg" required>
                        </div>
                    </div>
                        <label>รายละเอียดสินค้า</label>
                        <textarea class="form-control" id="editor1" name="spec" cols="50" rows="10"></textarea>
            </div>
            <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>ปิด</button>
                    <button name='add_product' class='btn btn-primary' type='submit'>เพิ่ม</button>
                </form>
            </div>
            </div>
        </div>
    </div>                                        

    <!-- Modal ดูรายละเอียดสินค้า -->
    <div class='modal fade' id='ProductDetailModal' tabindex="-1" aria-hidden="true">
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-pname' id='exampleModalLabel'>รายละเอียดของ <span id="product-name"></span></h5>
                </div>
                <div class='modal-body'>
                    <div id="detail"></div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal แก้ไขข้อมูลสินค้า -->
    <div class="modal fade" id="ProductEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-pname" id="exampleModalLabel">แก้ไขข้อมูลสินค้า</h5>
                </div>
                <div class="modal-body">
                    <form id="edit-product-form" action="product_db.php" method="post" enctype="multipart/form-data"> 
                            <input type="hidden" id="pid" name="pid">
                            <center><img id="img" width="150px"></center><br>
                            <div class="row mb-2">
                                <div class="col-5">
                                    <label>หมวดหมู่สินค้า</label>
                                    <select class="form-control" id="category" name="category">
                                        <?php
                                            $sql2 = "SELECT id_category as cid,name as cname FROM tb_category";
                                            $result2 = mysqli_query($conn, $sql2);
                                            while($rcg=mysqli_fetch_assoc($result2)){
                                                echo "<option value='".$rcg["cid"]."'>".$rcg['cname']."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-7">
                                    <label>ชื่อสินค้า</label>
                                    <input class="form-control" type="text" id="name" name="name">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label>ราคาต้นทุน</label>
                                    <input class="form-control" type="number" id="cost" name="cost">
                                </div>
                                <div class="col-3">
                                    <label>ราคาขาย</label>
                                    <input class="form-control" type="number" id="price" name="price">
                                </div>
                                <div class="col-3">
                                    <label>จำนวนสินค้า</label>
                                    <input class="form-control" type="number" id="qty" name="qty" min="0">
                                </div>
                                <div class="col-3">
                                    <label>อัพโหลดรูปภาพสินค้าใหม่</label>
                                    <input class="form-control" type="file" id="upload" name="upload">
                                </div>
                            </div>
                                <label>รายละเอียดสินค้า</label>
                                <textarea class="form-control" id="editor2" name="spec"></textarea>
                        </div>
                    <div class="modal-footer">
                            <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button name="edit_product" class="btn btn-success" type="submit">บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ลบสินค้า -->
    <div class="modal fade" id="ProductDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ลบสินค้า: <b id="pname"></b></h5>
                </div>
                <div class="modal-body text-center">
                    <b class="text-danger">คุณแน่ใจไหม ว่าต้องการลบสินค้าชิ้นนี้.</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <a id="link" class="btn btn-danger">ตกลง</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script type='text/javascript'>
        $(document).ready(function(){
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2');
        });
            
        //กดเพื่อดูรายะเอียดสินค้า
        function modal_product_spec(pid){
            $.ajax({
                url:"productFetch.php",
                method:"post",
                data:{id:pid},
                dataType:"json",
                success:function(response){
                    $('#product-name').html(response.name);
                    $('#detail').html(response.spec);
                    $('#ProductDetailModal').modal('show');
                }
            });
        }

        //กดเพื่อแก้ไขสินค้า
        function modal_product_edit(pid){
            $.ajax({
                url:"productFetch.php",
                method:"post",
                data:{id:pid},
                dataType:"json",
                success:function(response){
                    $('#pid').val(response.id_product);
                    $('#img').attr("src", "../images/Products/"+response.img);
                    $('#category').val(response.category)
                    $('#name').val(response.name);
                    $('#cost').val(response.cost);
                    $('#price').val(response.price);
                    $('#qty').val(response.qty);
                    CKEDITOR.instances['editor2'].setData(response.spec);
                    $('#ProductEditModal').modal('show');
                }
            });
        }

        //กดเพื่อลบสินค้า
        function modal_product_del(pid){
            $.ajax({
                url:"productFetch.php",
                method:"post",
                data:{id:pid},
                dataType:"json",
                success:function(response){
                    $('#pname').html(response.name);
                    $('#link').attr("href", "product_db.php?del_product="+response.id_product);
                    $('#ProductDeleteModal').modal('show');
                }
            });
        }
    </script>
    <!-- .Script -->

</body>
</html>
