<?php
    // ถ้ามี session-alert
    if(isset($_SESSION['alert'])){
        // ถ้า alert-uname เท่ากับ session-uname
        if($_SESSION['alert']['uname'] == $_SESSION['uname']){ ?>
            <script>
                Swal.fire({
                    position: 'center',
                    icon: '<?=$_SESSION['alert']['icon']?>',
                    title: '<h5><?=$_SESSION['alert']['msg']?></h5>',
                    showConfirmButton: false,
                    timer: 1650
                })
            </script>
<?php }
    // ล้างค่า session-alert
    unset($_SESSION['alert']); }
?>