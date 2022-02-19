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
                                    <h5 class="m-0 font-weight-bold text-primary">ตารางบัญชีธนาคาร</h5>
                                </div>
                                <div class="col-6 text-right">
                                    <!-- ปุ่มเพิ่มบัญชีธนาคารโดยเรียกใช้ Modal -->
                                    <button class="btn btn-primary" data-toggle='modal' data-target='#add'>เพิ่มบัญชีธนาคาร</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class='text-center text-product'>
                                        <th>#</th>
                                        <th>ธนาคาร</th>
                                        <th>ชื่อบัญชีธนาคาร</th>
                                        <th>เลขที่บัญชีธนาคาร</th>
                                        <th>ดำเนินการ</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                            $sql = "SELECT b.*, th.name as th
                                                    FROM tb_banks as b, tb_banks_th as th
                                                    WHERE b.id_bankth = th.id_bankth
                                                    ORDER BY id_bank";
                                            $result = mysqli_query($conn, $sql);
                                            while($row=mysqli_fetch_assoc($result)){ ?>
                                            <tr>
                                                <th class='text-center'><?=$i?></th>
                                                <td><?=$row['th']?></td>
                                                <td><?=$row['name']?></td>
                                                <td><?=$row['number']?></td>
                                                <td class='text-center'>
                                                    
                                                    <!-- ปุ่มแก้ไขบัญชีธนาคารโดยเรียกใช้ Modal -->
                                                    <button type="button" class="btn btn-success btn-sm w-50 rounded-pill" onclick="modal_edit_bank(<?=$row['id_bank']?>)">
                                                        แก้ไข
                                                    </button>

                                                    <!-- ปุ่มลบบัญชีธนาคารโดยเรียกใช้ Modal -->
                                                    <button type="button" class="btn btn-danger btn-sm w-50 rounded-pill my-1" onclick="modal_del_bank(<?=$row['id_bank']?>)">
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

    <!-- Modal เพิ่มบัญชีธนาคาร -->
    <div class='modal fade' id='add' tabindex='-1' aria-hidden='true'>
        <div class="modal-dialog modal-dialog-centered">
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-pname' id='exampleModalLabel'>เพิ่มบัญชีธนาคาร</h5>
                </div>
            <div class='modal-body'>
                <form action="banks_db.php" method="post" > 
                    <label>เลือกธนาคาร</label>
                        <select name="bank"  class="form-control">
                            <?php 
                            $sql = "SELECT * FROM tb_banks_th";
                            $bankTH = mysqli_query($conn, $sql); 
                            while($rowTH = mysqli_fetch_assoc($bankTH)){ ?>
                                <option value="<?=$rowTH['id_bankth']?>"><?=$rowTH['name']?></option>
                            <?php } ?>
                        </select><br>
                    <label>ชื่อบัญชีธนาคาร</label>
                        <input class="form-control" type="text" name="name" maxlength="50" required><br>
                    <label>เลขที่บัญชีธนาคาร</label>
                        <input class="form-control" type="text" name="number" maxlength="15" required>
                        <span class="text-danger">*กรอกเฉพาะตัวเลขเท่านั้น</span>
            </div>
            <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>ปิด</button>
                    <button name='add_bank' class='btn btn-primary' type='submit'>เพิ่ม</button>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal แก้ไขข้อมูลบัญชีธนาคาร -->
    <div class="modal fade" id="BankEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-pname" id="exampleModalLabel">แก้ไขข้อมูลบัญชีธนาคาร</h5>
                </div>
                <div class="modal-body">
                    <form action="banks_db.php" method="post" > 
                            <input type="hidden" id="bid" name="bid">
                        <label>เลือกธนาคาร</label>
                            <select id="banksTH" name="bank"  class="form-control">
                                <?php
                                $sql = "SELECT * FROM tb_banks_th";
                                $banksTH = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($banksTH)){ ?>
                                    <option value="<?=$row['id_bankth']?>"><?=$row['name']?></option>
                                <?php } ?>
                            </select>
                        <label>ชื่อบัญชีธนาคาร</label>
                            <input class="form-control" type="text" id="name" name="name" maxlength="50" required><br>
                        <label>เลขที่บัญชีธนาคาร</label>
                            <input class="form-control" type="text" id="number" name="number" maxlength="50" required><br>
                </div>
                <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>ปิด</button>
                        <button name='edit_bank' class='btn btn-success' type='submit'>บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ลบบัญชีธนาคาร -->
    <div class="modal fade" id="BankDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ลบบัญชีธนาคาร: <b id="bname"></b></h5>
                </div>
                <div class="modal-body text-center">
                    <b class="text-danger">คุณแน่ใจไหม ว่าต้องการลบบัญชีธนาคารนี้.</b>
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

        //กดเพื่อแก้ไขบัญชีธนาคาร
        function modal_edit_bank(bid){
            $.ajax({
                url:"bankFetch.php",
                method:"post",
                data:{id:bid},
                dataType:"json",
                success:function(response){
                    $('#bid').val(response.id_bank);
                    $('#banksTH').val(response.id_bankth);
                    $('#name').val(response.name);
                    $('#number').val(response.number);
                    $('#BankEditModal').modal('show');
                }
            });
        }
        //กดเพื่อลบบัญชีธนาคาร
        function modal_del_bank(bid){
            $.ajax({
                url:"bankFetch.php",
                method:"post",
                data:{id:bid},
                dataType:"json",
                success:function(response){
                    $('#bname').html(response.name);
                    $('#link').attr("href", "banks_db.php?del_bank="+response.id_bank);
                    $('#BankDeleteModal').modal('show');
                }
            });
        }
    </script>
    <!-- .Script -->

</body>
</html>
