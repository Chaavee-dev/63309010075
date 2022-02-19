<?php

    // ตั้งค่าเวลาเป็นประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
    
    $servername = "localhost"; // ชื่อเซิร์ฟเวอร์
    $username = "root"; // ชื่อผู้ใช้
    $password = ""; // รหัสผ่าน
    $dbname = "6375_db"; // ชื่อฐานข้อมูล

    // สร้างการเชื่อมต่อ
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // เช็คการเชื่อมต่อ
    if (!$conn) {
        die("การเชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . mysqli_connect_error());
    }
    // echo "การเชื่อมฐานข้อมูลต่อสำเร็จ";


    $day = date('d');
    $week = date('W');

    // ลบรายการสั่งซื้ออัตโนมัติถ้าไม่ชำระเงินภายใน 7 วัน
    $delete_order_auto_sql = "DELETE FROM tb_orders 
                                WHERE Week(date)<$week OR 
                                        $day-Day(date)>=7 AND
                                        status BETWEEN 1 AND 2";
    mysqli_query($conn, $delete_order_auto_sql);
?>