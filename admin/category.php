<?php
    include './layouts/head.php';
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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row m-0">
                                <div class="col-6">
                                    <h5 class="font-weight-bold text-primary">ตารางหมวดหมู่สินค้า</h5>
                                </div>
                                <div class="col-6 text-right">
                                    <!-- ปุ่มเพิ่มหมวดหมู่สินค้าโดยเรียกใช้ Modal -->
                                    <button class="btn btn-primary" data-toggle='modal' data-target='#CategoryAddModal'>เพิ่มหมวดหมู่สินค้า</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class='text-center text-product'>
                                        <th>#</th>
                                        <th>ชื่อหมวดหมู่สินค้า</th>
                                        <th width="12%">ดำเนินการ</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                            $sql = "SELECT * FROM tb_category ORDER BY id_category";
                                            $result = mysqli_query($conn, $sql);
                                            while($row=mysqli_fetch_assoc($result)){ ?>
                                            <tr>
                                                <th class='text-center'><?=$i?></th>
                                                <td><?=$row['name']?></td>
                                                <td class='text-center'>
                                                    <!-- ปุ่มแก้ไขหมวดหมู่สินค้าโดยเรียกใช้ Modal -->
                                                    <button type="button" class="btn btn-success btn-sm w-50 rounded-pill" onclick="modal_category_edit(<?=$row['id_category']?>)">
                                                        แก้ไข
                                                    </button>

                                                    <!-- ปุ่มลบหมวดหมู่สินค้าโดยเรียกใช้ Modal -->
                                                    <button type="button" class="btn btn-danger btn-sm w-50 rounded-pill my-1" onclick="modal_category_delete(<?=$row['id_category']?>)">
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

    <!-- Modal เพิ่มหมวดหมู่สินค้า -->
    <div class='modal fade' id='CategoryAddModal' tabindex='-1' aria-hidden='true'>
        <div class="modal-dialog modal-dialog-centered">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-pname' id='exampleModalLabel'>เพิ่มหมวดหมู่สินค้า</h5>
                </div>
            <div class='modal-body'>
                <form action="category_db.php" method="post" > 
                    <label>ชื่อหมวดหมู่สินค้า</label>
                        <input class="form-control" type="text" name="name" maxlength="50" required><br>
            </div>
            <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>ปิด</button>
                    <button type='submit' name='add_category' class='btn btn-primary'>เพิ่ม</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal แก้ไขข้อมูลหมวดหมู่สินค้า -->
    <div class="modal fade" id="CategoryEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-pname" id="exampleModalLabel">แก้ไขข้อมูลหมวดหมู่สินค้า</h5>
                </div>
                <div class="modal-body">
                    <form action="category_db.php" method="post" > 
                        <input type="hidden" id="cid" name="cid">
                        <label>ชื่อหมวดหมู่สินค้า</label>
                        <input class="form-control" type="text" id="name" name="name" maxlength="50" required>
                </div>
                <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>ปิด</button>
                        <button name='edit_category' class='btn btn-success' type='submit'>บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ลบหมวดหมู่สินค้า -->
    <div class="modal fade" id="CategoryDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ลบหมวดหมู่สินค้า: <b id="cname"></b></h5>
                </div>
                <div class="modal-body text-center">
                    <b class="text-danger">คุณแน่ใจไหม ว่าต้องการหมวดหมู่สินค้านี้.</b>
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
            
        //กดเพื่อแก้ไขสินค้า
        function modal_category_edit(cid){
            $.ajax({
                url:"categoryFetch.php",
                method:"post",
                data:{id:cid},
                dataType:"json",
                success:function(response){
                    $('#cid').val(response.id_category);
                    $('#name').val(response.name);
                    $('#CategoryEditModal').modal('show');
                }
            });
        }
        
        //กดเพื่อลบสินค้า
        function modal_category_delete(cid){
            $.ajax({
                url:"categoryFetch.php",
                method:"post",
                data:{id:cid},
                dataType:"json",
                success:function(response){
                    $('#cname').html(response.name);
                    $('#link').attr("href", "category_db.php?del_category="+response.id_category);
                    $('#CategoryDeleteModal').modal('show');
                }
            });
        }
    </script>
    <!-- .Script -->

</body>
</html>
