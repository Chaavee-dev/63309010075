    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">คุณต้องการออกจากระบบใช่ไหม?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ปิด</button>
                    <a class="btn btn-primary" href="./logout.php">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        $('#dataTable').DataTable({
            "language": {
                "decimal": ",",
                "thousands": ".",
                "lengthMenu": "จำนวน _MENU_ แถวต่อหน้า",
                "zeroRecords": "ไม่มีข้อมูลสำหรับการแสดงตาราง - กรุณาเพิ่มข้อมูลใหม่",
                "info": "แสดงหน้าที่ _PAGE_ จากทั้งหมด _PAGES_ หน้า",
                "infoEmpty": "ไม่มีข้อมูล",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "paginate": {
                            "previous": "ก่อนหน้า",
                            "next": "ถัดไป"
                            }
            },
            "oLanguage": {
                "sSearch": "ค้นหา:"
            },"pageLength": 10,
        });
    });
    </script>

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; 2021 : 63309010075</span>
            </div>
        </div>
    </footer>
    <!-- .Footer -->