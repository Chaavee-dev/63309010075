<?php
    $uid = $_SESSION['uid'];
    // จำนวนสินค้าในตะกร้า
    $sql = "SELECT SUM(qty) as qty FROM tb_cart WHERE id_user = '$uid'";
    $q = mysqli_query($conn, $sql);
    $r = mysqli_fetch_assoc($q);
    $qtyCart = $r['qty'];
?>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid px-4 px-lg-5">
            <a class="navbar-brand" href="./">
                <i class="fa fa-shopping-bag" aria-hidden="true">
                    vHAVECPU
                </i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="./">
                            หน้าหลัก
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            หมวดหมู่สินค้า
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                                // ดึงข้อมูลจาก tb_category มาลูปให้เป้น li หรือ dropdown
                                $sql = "SELECT * FROM tb_category ORDER BY name ASC";
                                $result = mysqli_query($conn, $sql);
                                while($row=mysqli_fetch_assoc($result)){
                                    echo "<li><a class='dropdown-item' href='./?category=".$row['name']."'>".$row['name']."</a></li>";
                                }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="./aboutus.php">
                            เกี่ยวกับเรา
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="./contactus.php">
                            ติดต่อเรา
                        </a>
                    </li>
                    <form class="d-flex me-5" action="index.php">
                        <input class="form-control rounded-0 rounded-start shadow-none border border-secondary" type="search" id="search" name="search" placeholder="ค้นหาสินค้า" aria-label="Search" value='<?= $_GET['search'] ?>'>
                        <button class="btn btn-outline-secondary rounded-0 rounded-end shadow-none text-dark" type="submit">
                            ค้นหา
                        </button>
                    </form>
                </ul>
                <!-- ถ้าไม่มี session-isuser -->
                <?php if(empty($_SESSION["isuser"])){ ?>
                    <a class="btn btn-outline-dark width-100 me-1" href="login.php">
                        เข้าสู่ระบบ
                    </a>
                    <a class="btn btn-dark width-100" href="register.php">
                        สมัครสมาชิก
                    </a>
                <!-- ถ้าไม่ใช่ด้านบน -->
                <?php }else{ ?>
                    <a href="cart.php" class="btn btn-outline-dark me-1">
                        <i class="fas fa-shopping-cart"></i>
                            ตะกร้า
                        <span class="badge bg-dark text-white ms-1 rounded-pill">
                            <!-- echo short จำนวนสินค้าในตะกร้า แล้วจัดรูปแบบโดยตัวเลข -->
                            <?=number_format($qtyCart)?>
                        </span>
                    </a>      
                    <div class="dropdown">
                        <button class="btn btn-dark navbar-btn width-100 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <b>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <!-- echo short ชื่อผู่ใช้ -->
                                <?=$_SESSION["uname"]?>
                            </b>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class='dropdown-item' href='./profile.php'>
                                    ข้อมูลส่วนตัว
                                </a>
                            </li>
                            <li>
                                <a class='dropdown-item' href='./cart.php'>
                                    ตะกร้าสินค้า
                                </a>
                            </li>
                            <li>
                                <a class='dropdown-item' href='./purchase.php'>
                                    การซื้อของฉัน
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class='dropdown-item' href='./logout.php'>
                                    ออกจากระบบ
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!-- .Navagationbar -->
    