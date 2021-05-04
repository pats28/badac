<?php
include('includes/shop-header.php');
include('config.php');
$Product = $_GET['product'];
$sqlProduct = "SELECT * FROM materialslist WHERE EquipId = '$Product';";
$resultProduct = mysqli_query($con, $sqlProduct);
$rowProduct = mysqli_fetch_assoc($resultProduct);
$ProductName = $rowProduct['EquipName'];
$ProductImage = $rowProduct['EquipImage'];
$Price = $rowProduct['Price'];
$ProductDescription = $rowProduct['Description'];
$CategoryId = $rowProduct['CategoryId'];

// query for Aceeptproject
$acceptid = $_SESSION['ProjectId'];
$query_accept = "SELECT MaterialsCost FROM acceptproject WHERE AcceptId = $acceptid";
$res_accept = mysqli_query($con, $query_accept);
$row_accept = mysqli_fetch_assoc($res_accept);
?>
<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
    .box {
        background-color: #f4f4f4;
        width: 100%;
        height: 50px;
        padding: 10px;
        padding-left: 20px;
        margin: 10px;
    }

    .name {
        background-color: black;
        color: white;
        /* width: auto; */
        /* text-align: center; */
        margin-left: 20px;
        padding: 8px;
        /* margin: auto; */
        position: relative;
        top: 90px;
    }
</style>
</head>
<?php
if (isset($_SESSION['added']) == 1) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Added to material list!',
            showConfirmButton: false,
            timer: 2500
        })
    </script>
<?php unset($_SESSION['added']);
} ?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand text-capitalize" href="shop-index.php?category=1">Badac Konstruk Inc. | <?php echo $ProductName; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a onclick="history.go(-1);" class="nav-link">Home</a></li>
                <li class="nav-item cta cta-colored"><a href="shop-cart.php" class="nav-link"><span class="icon-shopping_cart"></span>Materials List</a></li>
            </ul>
        </div>
    </div>
</nav>
<br>
<br>
<section class="ftco-section" style="padding: 6em 0 0 0;">
    <form method="post">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="../Admin/images/<?php echo $ProductImage; ?>" class="image-popup prod-img-bg"><img style="object-fit: cover;height: 450px;width: 550px;" src="../Admin/images/<?php echo $ProductImage; ?>" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3 class="text-capitalize"><?php echo $ProductName; ?></h3>
                <p class="price font-weight-bold"><span>₱<?php echo number_format($Price, 2, '.', ''); ?></span></p>
                <div class="row mt-4">
                    <div class="w-100"></div>
                    <div class="input-group col-md-6 d-flex mb-3">
                        <span class="input-group-btn mr-2">
                            <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                <i class="ion-ios-remove"></i>
                            </button>
                        </span>
                        <input type="number" id="quantity" name="Quantity" class="quantity form-control input-number" value="1" min="1" >
                        <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                <i class="ion-ios-add"></i>
                            </button>
                        </span>
                    </div>
                    <!-- <div class="w-100"></div> -->
                    <br>
                    <div class="box">
                        <p><?php echo $ProductDescription; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p style="color: #FF0000;"><i>Product images are for illustrative purposes only. The actual product may vary.</i></p>
                    </div>
                </div>
                <!-- <p><a href="shop-add-to-list.php?ProductId=<?php echo $Product;?>" style="font-size: 13px;" class="btn py-3 px-2 btn-black btn-block font-weight-bold mr-2">Add to List</a></p> -->
                <input type="submit" name="AddToList" value="Add to list" style="font-size: 13px;" class="btn btn-block btn-black py-2 px-2 font-weight-bold">
            </div>
        </div>
    </div>
    </form>
</section>
<?php
    if (isset($_POST['AddToList'])) {
        $ProjectId = $_SESSION['ProjectId'];
        $EquipId = $_GET['product'];
        $Quantity = $_POST['Quantity'];
        $TotalPrice = $Quantity * $Price;
        // echo $TotalPrice . '-';
        // echo $ProjectId . '-';
        // echo $EquipId . '-';
        // echo $Quantity . '-';
        $sqlAddToList = "INSERT INTO materialsneeded (ProjectId,EquipId,Quantity,TotalPrice) VALUES ('$ProjectId','$EquipId','$Quantity','$TotalPrice')";

        if (mysqli_query($con,$sqlAddToList)==1) {
            $newTotalPrice = $TotalPrice + $row_accept['MaterialsCost'];
            $query_update = "UPDATE acceptproject SET MaterialsCost = $newTotalPrice WHERE AcceptId = $ProjectId";
            $res_update = mysqli_query($con, $query_update);
        }

        $_SESSION['added'] = 1;
        echo '<script>window.location.href="shop-product-view.php?product='.$EquipId.'"</script>';
    }
?>
<!-- suggestions -->
<section class="ftco-gallery">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 heading-section text-center mb-4 ftco-animate">
                <h2 class="mb-4">Related Products</h2>
                <!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p> -->
            </div>
        </div>
    </div>
    <?php
    $sqlRelated = "SELECT * FROM materialslist WHERE IsDelete = 0 AND CategoryId = '$CategoryId' ORDER by rand() LIMIT 6;";
    $resultRelated = mysqli_query($con, $sqlRelated);
    ?>
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <?php while ($rowRelated = mysqli_fetch_assoc($resultRelated)) :
                $EquipId = $rowRelated['EquipId'];
                $EquipImage2 = $rowRelated['EquipImage'];
                $EquipName = $rowRelated['EquipName'];
            ?>
                <div class="col-md-4 col-lg-2 ftco-animate">
                    <a href="shop-product-view.php?product=<?php echo $EquipId; ?>" class="gallery img d-flex align-items-center" style="background-image: url(../Admin/images/<?php echo $EquipImage2; ?>);">
                        <div class=" mb-4 d-flex justify-content-center align-items-center">
                            <h6 class="name"><?php echo $EquipName; ?></h6>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<!-- end suggestions -->
<footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row">
            <div class="mouse">
                <a href="#" class="mouse-icon">
                    <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                </a>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Badac Konstruk Inc. | Minishop</h2>
                    <p>BROAD VISION. CAREFUL THOUGHT.
                        HAND-CRAFTED DESIGN.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Menu</h2>
                    <ul class="list-unstyled">
                        <li><a href="#" class="py-2 d-block">Shop</a></li>
                        <li><a href="#" class="py-2 d-block">Badac Site</a></li>
                        <li><a href="#" class="py-2 d-block">Login</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Info</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text">Lot 24/23 Navarro Compound, Rose Ann Subdivision, San Roque, Cainta, Rizal</span></li>
                            <li><a href="#"><span class="icon icon-phone"></span><span class="text">86533791</span></a></li>
                            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">badackonstrukinc@yahoo.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | Badac Konstruk Inc. <i class="icon-heart color-danger" aria-hidden="true"></i>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

<script>
    $(document).ready(function() {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function(e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                $('#quantity').val(quantity - 1);
            }
        });

    });
</script>