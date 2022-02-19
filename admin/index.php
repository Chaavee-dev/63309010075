<?php
    include './layouts/head.php';

    $day = date('d');
    $week = date('W');
    $month = date('m');
    $year = date('Y');

    // ดึงข้อมูลรายได้(วัน)
    $sql = "SELECT SUM(total) as sales
            FROM tb_orders
            WHERE DAY(Date) = $day AND 
                    MONTH(Date) = $month AND
                    YEAR(Date) = $year AND 
                    status BETWEEN 4 AND 6";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    $salesDay = $result['sales'];

    // ดึงข้อมูลรายได้(สัปดาห์)
    $sql = "SELECT SUM(total) as sales
            FROM tb_orders
            WHERE WEEK(Date) = $week AND
                    YEAR(Date) = $year AND 
                    status BETWEEN 4 AND 6";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    $salesWeek = $result['sales'];

    // ดึงข้อมูลรายได้(เดือน)
    $sql = "SELECT SUM(total) as sales
            FROM tb_orders
            WHERE MONTH(Date) = $month AND 
                    YEAR(Date) = $year AND 
                    status BETWEEN 4 AND 6";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    $salesMonth = $result['sales'];

    // ดึงข้อมูลรายได้(ปี)
    $sql = "SELECT SUM(total) as sales
            FROM tb_orders
            WHERE YEAR(Date) = $year AND
                    status BETWEEN 4 AND 6";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    $salesYear = $result['sales'];

    // การสั่งซื้อ (วันนี้)
    $sql = "SELECT COUNT(id_order) as count
            FROM tb_orders
            WHERE DAY(date) = $day AND
                    MONTH(date) = $month AND 
                    YEAR(date) = $year";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    $orderDay = $result['count'];

    // จำนวนลูกค้า (เดือน)
    $sql = "SELECT COUNT(id_user) as count
            FROM tb_users
            WHERE MONTH(created_at) = $month AND 
                    YEAR(created_at) = $year";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    $memMonth = $result['count'];
    
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

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card bg-info shadow h-100 py-2 text-center">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h3 font-weight-bold text-white text-uppercase mb-1">
                                                รายชื่อผู้ใช้
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-white">
                                    <a href="users.php" class="text-white">
                                        คลิกจัดการระบบ
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card bg-success shadow h-100 py-2 text-center">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h3 font-weight-bold text-white text-uppercase mb-1">
                                                รายการสินค้า
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-white">
                                    <a href="products.php" class="text-white">
                                        คลิกจัดการระบบ
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card bg-danger shadow h-100 py-2 text-center">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h3 font-weight-bold text-white text-uppercase mb-1">
                                                รายการสั่งซื้อ
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-white">
                                    <a href="orders.php" class="text-white">
                                        คลิกจัดการระบบ
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-info text-uppercase mb-1">
                                                ยอดขาย (วันนี้)
                                            </div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800"><?=number_format($salesDay)?> บาท</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-success text-uppercase mb-1">
                                                ยอดขาย (สัปดาห์นี้)
                                            </div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800"><?=number_format($salesWeek)?> บาท</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                                                ยอดขาย (เดือนนี้)
                                            </div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800"><?=number_format($salesMonth)?> บาท</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-warning text-uppercase mb-1">
                                                ยอดขาย (ปีนี้)
                                            </div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800"><?=number_format($salesYear)?> บาท</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-wallet fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-danger text-uppercase mb-1">
                                                การสั่งซื้อ (วันนี้)
                                            </div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800"><?=number_format($orderDay)?> รายการ</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-dark text-uppercase mb-1">
                                                ลูกค้า (เดือนนี้)
                                            </div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800"><?=number_format($memMonth)?> คน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
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

</body>
</html>