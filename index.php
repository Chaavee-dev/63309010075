<?php
    // แทรก head
    include('./layouts/head.php');
    // แทรก Navigationbar
    include('./layouts/navbar.php');

    // ถ้ามีการค้นหา || Get-search
    if(isset($_GET['search'])){
        //ดึงข้อมูลสินค้าเป็นหมวดหมู่จากฐานข้อมูล
        $keyword = $_GET['search'];
        $title = $keyword;

        $sql = "SELECT p.*
                    FROM tb_products as p
                    INNER JOIN tb_category as c
                    ON p.category = c.id_category
                    WHERE p.name like '%$keyword%' or 
                            c.name like '%$keyword%' or 
                            p.spec like '%$keyword%' ";
        $q = mysqli_query($conn, $sql);

        // ถ้า row เท่ากับ 0
        if(mysqli_num_rows($q) == 0){
            $title = "ไม่พบสินค้าที่คุณต้องการ";
        }

    // ถ้ามีการเลือกหมวดหมู่ || Get-category
    }else if(isset($_GET['category'])){
        //ดึงข้อมูลสินค้าเป็นหมวดหมู่จากฐานข้อมูล
        $ctg = $_GET['category'];
        $title = $ctg;

        $sql = "SELECT p.* 
                FROM tb_products as p
                INNER JOIN tb_category as c 
                ON c.id_category = p.category
                WHERE c.name = '$ctg'";
        $q = mysqli_query($conn, $sql);

    // ถ้ามีอะไรเลย
    }else{
        //ดึงข้อมูลสินค้าทั้งหมดจากฐานข้อมูล
        $sql = "SELECT * FROM tb_products ORDER BY name";
        $q = mysqli_query($conn, $sql);

        $title = "สินค้าทั้งหมด";
    }

    // ถ้ามี session welcome ให้แสดงบนขวา
    if($_SESSION['welcome']){ ?>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 800,
                timerProgressBar: true,
            })

            Toast.fire({
                icon: 'success',
                title: 'ยินดีตอนรับคุณ <?=$_SESSION['uname']?>'
            })
        </script>
<?php 
    // ล้างค่า session welcome
    unset($_SESSION['welcome']);

    
    }
?>
    <!-- Header-->
    <header class="bg-dark">
        <!-- Carousel-Banner Slide -->
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./images/Banner/Banner1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/Banner/Banner2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./images/Banner/Banner3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </header>
    <!-- .Header -->
    
    <!-- container -->
    <div class="container h-80vh p-1">
        <div class="p-4">
            <h2 class="mt-2"><?=$title?></h2><hr>
                <!-- โชว์สินค้าโดยใช้ Card -->
                <div class="row row-cols-1 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 g-4">
                <?php while($row = mysqli_fetch_assoc($q)) {?>
                    <div class="col">
                        <div class="card card-product h-100">

                            <?php
                                $month = date('m');
                                $year = date('Y');
                                $new_q = mysqli_query($conn, "SELECT *
                                                        FROM tb_products
                                                        WHERE MONTH(created_at) = $month AND
                                                                YEAR(created_at) = $year AND 
                                                                id_product=".$row['id_product']);
                                $count_new=mysqli_num_rows($new_q);


                                $best_q=mysqli_query($conn, "SELECT SUM(qty) as count
                                                                FROM tb_orders 
                                                                WHERE id_product=".$row['id_product']);
                                $row_best=mysqli_fetch_assoc($best_q);

                                if($row['qty'] == 0){ ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        หมด
                                        <span class="visually-hidden">unread messages</span>
                                    </span>                            
                            <?php 
                                }else if($row_best['count'] >= 50) {
                            ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                                    ขายดี
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            <?php }else if($count_new == 1){ ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                    ใหม่
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            <?php }?>

                            <a class="text-decoration-none text-dark" href="product.php?pid=<?=$row['id_product']?>">
                                <!-- Product image-->
                                <img class="card-img-top" src="./images/Products/<?=$row['img']?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <b class="fw-bolder text-wrap"><?=$row['name']?></b>
                                        <!-- Product price-->
                                        <p class="text-danger">฿<?=number_format($row['price'])?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> <?php }?>
                </div>
            </div>
        </div>
    </div>
    <!-- .container -->
    
<?php
    // แทรก Footer
    include('./layouts/footer.php');
?>