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
                                    <h5 class="m-0 font-weight-bold text-primary">ตารางผู้ใช้</h5>
                                </div>
                                <div class="col-6 text-right">
                                    <!-- ปุ่มเพิ่มผู้ใช้โดยเรียกใช้ Modal -->
                                    <button class="btn btn-primary" data-toggle='modal' data-target='#UserAddModal'>เพิ่มผู้ใช้</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class='text-center text-product'>
                                        <th>#</th>
                                        <th>ชื่อผู้ใช้งาน</th>
                                        <th>เบอร์โทร</th>
                                        <th>อีเมล</th>
                                        <th>บทบาท</th>
                                        <th>ดำเนินการ</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                            $uname = $_SESSION["uname"];
                                            $sql = "SELECT * 
                                                    FROM tb_users
                                                    WHERE username != '$uname'
                                                    ORDER BY id_user";
                                            $result = mysqli_query($conn, $sql);
                                            while($row=mysqli_fetch_assoc($result)){ ?>
                                            <tr>
                                                <th class='text-center'><?=$i?></th>
                                                <td><?=$row['username']?></td>
                                                <td><?=$row['tel']?></td>
                                                <td><?=$row['email']?></td>
                                                <td><?=strtoupper($row['role'])?></td>
                                                <td class='text-center'>
                                                    <!-- ปุ่มแก้ไขผู้ใช้โดยเรียกใช้ Modal -->
                                                    <button type="button" class="btn btn-success btn-sm w-50 rounded-pill" onclick="modal_edit_user(<?=$row['id_user']?>)">
                                                        แก้ไข
                                                    </button>

                                                    <!-- ปุ่มลบผู้ใช้โดยเรียกใช้ Modal -->
                                                    <button type="button" class="btn btn-danger btn-sm w-50 rounded-pill my-1" onclick="modal_del_user(<?=$row['id_user']?>)">
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

    <!-- Modal เพิ่มผู้ใช้ -->
    <div class='modal fade' id='UserAddModal' tabindex='-1' aria-hidden='true'>
        <div class="modal-dialog modal-dialog-centered">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-pname' id='exampleModalLabel'>เพิ่มผู้ใช้</h5>
                </div>
            <div class='modal-body'>
                <form action="user_db.php" method="post" > 
                    <div class="my-2">
                        <label>ชื่อผู้ใช้งาน</label>
                        <input class="form-control" type="text" name="username" maxlength="50" required>
                    </div>
                    <div class="my-2">
                        <label>รหัสผ่าน</label>
                        <input class="form-control" type="password" name="password" maxlength="50" required>
                    </div>
                    <div class="my-2">
                        <label>เบอร์โทร</label>
                        <input class="form-control" type="tel" name="tel" maxlength="10" required>
                    </div>
                    <div class="my-2">
                        <label>อีเมล</label>
                        <input class="form-control" type="email" name="email" maxlength="50" required>
                    </div>
                    <div class="my-2">
                        <label>บทบาท</label>
                        <select name="role" class="form-control">
                            <option value="member">MEMBER (ลูกค้า)</option>
                            <option value="admin">ADMIN (ผู้ดูแลระบบ)</option>
                        </select>
                    </div>
            </div>
            <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>ปิด</button>
                    <button name='add_user' class='btn btn-primary' type='submit'>เพิ่ม</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal แก้ไขข้อมูลผู้ใช้ -->
    <div class="modal fade" id="UserEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-pname" id="exampleModalLabel">แก้ไขข้อมูลผู้ใช้</h5>
            </div>
            <div class="modal-body">
                <form action="user_db.php" method="post" > 
                    <div class="my-2">
                        <label>ชื่อผู้ใช้งาน</label>
                        <input class="form-control" type="text" id="username" name="username" disabled>
                    </div>
                    <div class="my-2">
                        <label>เบอร์โทร</label>
                        <input class="form-control" type="tel" id="tel" name="tel" maxlength="10" required>
                    </div>
                    <div class="my-2">
                        <label>อีเมล</label>
                        <input class="form-control" type="email" id="email" name="email" maxlength="50" required>
                    </div>
                    <div class="my-2">
                        <label>บทบาท</label>
                        <select name="role" id="role" class="form-control">
                            <option value="member">MEMBER (ลูกค้า)</option>
                            <option value="admin">ADMIN (ผู้ดูแลระบบ)</option>
                        </select>
                    </div>
            </div>
            <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>ปิด</button>
                    <button name='edit_user' class='btn btn-success' type='submit'>บันทึก</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ลบผู้ใช้ -->
    <div class="modal fade" id="UserDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ลบผู้ใช้: <b id="uname"></b></h5>
                </div>
                <div class="modal-body text-center">
                    <b class="text-danger">คุณแน่ใจไหม ว่าต้องการลบผู้ใช้คนนี้.</b>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <a id="link" class="btn btn-primary">ตกลง</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script type='text/javascript'>

        // ถ้ากด submit disabled จะโดนลบ
        $('form').submit(function(e){
            $(':disabled').each(function(e) {
                $(this).removeAttr('disabled');
            });
        });

        //กดเพื่อแก้ไขผู้ใช้
        function modal_edit_user(aid){
            $.ajax({
                url:"userFetch.php",
                method:"post",
                data:{id:aid},
                dataType:"json",
                success:function(response){
                    $('#user').val(response.username);
                    $('#username').val(response.username);
                    $('#tel').val(response.tel);
                    $('#email').val(response.email);
                    $('#role').val(response.role);
                    $('#UserEditModal').modal('show');
                }
            });
        }

        //กดเพื่อลบผู้ใช้
        function modal_del_user(aid){
            $.ajax({
                url:"userFetch.php",
                method:"post",
                data:{id:aid},
                dataType:"json",
                success:function(response){
                    $('#uname').html(response.username);
                    $('#link').attr("href", "user_db.php?del_user="+response.id_user);
                    $('#UserDeleteModal').modal('show');
                }
            });
        }
    </script>
    <!-- .Script -->

</body>
</html>
