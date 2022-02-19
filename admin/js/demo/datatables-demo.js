// Call the dataTables jQuery plugin
$(document).ready(function() {
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
    },"pageLength": 100,
    
  });
});
