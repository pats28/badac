<?php
include('includes/shop-header.php');
// include('shop-navbar.php');
// include('includes/shop-sidebar.php');
// include('includes/shop-footer.php');
include('config.php');
$CategoryId = $_GET['category'];
$sqlProducts = "SELECT * FROM materialslist JOIN store ON materialslist.StoreId = store.StoreId WHERE materialslist.IsDelete = 0 AND store.isdelete = 0 AND materialslist.CategoryId = '$CategoryId' ORDER BY materialslist.EquipId ASC";
$resultProducts = mysqli_query($con, $sqlProducts);
if (isset($_GET['ProjectId'])) {
    $_SESSION['ProjectId'] = $_GET['ProjectId'];
}
?>

<head>
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<?php
if (empty($_GET['ProjectId']) && empty($_SESSION['ProjectId'])) { ?>
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Oops...you got excited',
            text: 'Choose a project first',
            showConfirmButton: false,
            footer: '<a href="../Admin/ar-projects.php">Choose project</a>'
        })
    </script>
<?php unset($_SESSION['removed']);
} ?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a href="index.html"><img src="BKIlogo.png" width="83px" height="55px"></a>
        <span class="navbar-brand"> &nbsp; Badac Konstruk Inc.</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item cta cta-colored"><a href="shop-cart.php" class="nav-link"><span class="icon-shopping_cart"></span>Material List</a></li>
            </ul>
        </div>
    </div>
</nav>
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-10 order-md-last">
                <div class="row">
                    <!-- item -->
                    <?php while ($rowProducts = mysqli_fetch_assoc($resultProducts)) :
                        $ProductId = $rowProducts['EquipId'];
                        $ProductName = $rowProducts['EquipName'];
                        $StoreName = $rowProducts['StoreName'];
                        $Price = $rowProducts['Price'];
                        $EquipImage = $rowProducts['EquipImage'];
                    ?>
                        <div class="col-sm-12 col-md-12 col-lg-3 ftco-animate d-flex">
                            <div class="product d-flex flex-column shadow-sm">
                                <a href="shop-product-view.php?product=<?php echo $ProductId; ?>" class="img-prod"><img class="img-fluid" src="../Admin/images/<?php echo $EquipImage; ?>">
                                </a>
                                <div class="text py-3 pb-4 px-3">
                                    <span class="subheading" style="font-size: smaller;"><?php echo $StoreName; ?></span>
                                    <!-- <div class="cat">
                        <span><?php echo $StoreName; ?></span>
                    </div> -->
                                    <h3><a href="shop-product-view.php?product=<?php echo $ProductId; ?>"><?php echo $ProductName; ?></a></h3>
                                    <div class="pricing">
                                        <h5 class="price "><span>₱<?php echo number_format($Price, 2, '.', ''); ?></span></h5>
                                    </div>
                                    <p class="bottom-area d-flex px-3">
                                        <a href="shop-product-view.php?product=<?php echo $ProductId; ?>" style="margin-top: 55px;" class="add-to-cart btn-block py-1 text-center mr-1"><span>View item</span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <!-- end of item -->
                </div>
            </div>

            <?php
            include('includes/shop-sidebar.php');
            include('includes/shop-footer.php');
            ?>
        </div>
    </div>
</section>