<?php
include('includes/shop-header.php');
include('config.php');
$ProjectId = $_SESSION['ProjectId'];
$sqlMaterialList = "SELECT * FROM materialsneeded JOIN materialslist ON materialslist.EquipId = materialsneeded.EquipId JOIN store ON store.StoreId = materialslist.StoreId WHERE materialsneeded.ProjectId = '$ProjectId' AND materialsneeded.IsDelete = 0 ORDER by materialslist.StoreId";
$resultMaterialList = mysqli_query($con, $sqlMaterialList);
// $rowProduct = mysqli_fetch_assoc($resultProduct);
// $ProductName = $rowProduct['EquipName'];
// $ProductImage = $rowProduct['EquipImage'];
// $Price = $rowProduct['Price'];
// $ProductDescription = $rowProduct['Description'];
// $CategoryId = $rowProduct['CategoryId'];
?>
<head>
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="shop-index.php?category=1">Badac Minishop | Materials List</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="shop-index.php?category=1" class="nav-link">go to minishop</a></li>
                <!-- <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-shopping_cart"></span>Materials List</a></li> -->
            </ul>
        </div>
    </div>
</nav>
<?php
if (isset($_SESSION['removed']) == 1) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Removed from material list!',
            showConfirmButton: true,
            timer: 2500
        })
    </script>
<?php unset($_SESSION['removed']);
} ?>
<section class="ftco-section ftco-cart">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<table class="table">
							<thead class="thead-primary">
								<tr class="text-center">
									<th>&nbsp;</th>
									<th>Product</th>
									<th>Product Name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
                            <?php
                                while ($rowMaterialList = mysqli_fetch_assoc($resultMaterialList)):
                                    $ProductId = $rowMaterialList['EquipId'];
                                    $MaterialsId = $rowMaterialList['MaterialsId'];
                                    $ProductImage = $rowMaterialList['EquipImage'];
                                    $ProductName = $rowMaterialList['EquipName'];
                                    $ProductDescription = $rowMaterialList['Description'];
                                    $ProductPrice = $rowMaterialList['Price'];
                                    $Quantity = $rowMaterialList['Quantity'];
                                    $TotalPrice = $rowMaterialList['TotalPrice'];
                                    $Store = $rowMaterialList['StoreName'];
                            ?>
								<tr class="text-center">
									<td class="product-remove"><a href="shop-remove-product.php?MaterialsId=<?php echo $MaterialsId; ?>"><span class="ion-ios-close text-white"></span></a></td>
									<td class="image-prod">
										<div class="img" style="background-image:url(../Admin/images/<?php echo $ProductImage; ?>);object-fit: cover;height: 70px;width: 70px;"></div>
									</td>
									<td class="product-name text-center">
										<h3 style="margin-bottom: -5px;"><?php echo $ProductName; ?></h3>
										<p style="margin-bottom: 0;font-size: 13px;" class="text-muted"><?php echo $ProductDescription .' - '. $Store; ?></p>
									</td>
									<td class="price">₱<?php echo number_format($ProductPrice,2,'.',''); ?></td>
									<td class="quantity"><?php echo $Quantity; ?></td>
									<td class="total">₱<?php echo number_format($TotalPrice,2,'.',''); ?></td>
								</tr><!-- END TR-->
								<!-- modal for remove -->
								<div id="remove<?php echo $ProductId; ?>" class="modal fade" role="dialog">
                                        <form method="post">
                                            <div class="modal-dialog modal-md">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h4 class="modal-title">Remove <?php echo $ProductName; ?></h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="CategoryId" value="<?php echo $ProductId; ?>">
                                                        Do you want to <span class="font-weight-bolder">remove</span> this product category?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                                        <button type="submit" class="btn btn-danger" name="RemoveCategory"><span class="glyphicon glyphicon-edit"></span> Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
            </div>
            <?php
                $sqlGrandTotal = "SELECT SUM(materialsneeded.TotalPrice) as GrandTotal FROM materialsneeded JOIN materialslist ON materialslist.EquipId = materialsneeded.EquipId JOIN store ON store.StoreId = materialslist.StoreId WHERE materialsneeded.ProjectId = '$ProjectId' AND materialsneeded.IsDelete = 0";
                $resultGrandTotal = mysqli_query($con,$sqlGrandTotal);
				$rowGrandTotal = mysqli_fetch_assoc($resultGrandTotal);

				$sqlStore = "SELECT store.StoreName as Storename, SUM(materialsneeded.TotalPrice) as GrandTotal FROM materialsneeded JOIN materialslist ON materialslist.EquipId = materialsneeded.EquipId JOIN store ON store.StoreId = materialslist.StoreId WHERE materialsneeded.ProjectId = '$ProjectId' AND materialsneeded.IsDelete = 0 GROUP by materialslist.StoreId";
				$resultStore = mysqli_query($con,$sqlStore);

				$queryProgress = "SELECT * FROM project where ProjectId = '$ProjectId'";
				$resultProgress = mysqli_query($con,$queryProgress);
				$rowProgress = mysqli_fetch_assoc($resultProgress);
				
				if ($rowGrandTotal['GrandTotal'] > 0 && $rowProgress['Progress'] < 40)
				{
					$sqlProgress = "UPDATE project set Progress = 40 where ProjectId = $ProjectId";
					$sqlTimeline = "INSERT INTO timeline (ProjectId, Description) values ('$ProjectId', 'Materials are listed')";
					if($con->query($sqlTimeline) === true && $con->query($sqlProgress) === true)
                      {
                        // echo $_FILES["file"]["size"];
                        // echo '<script>window.location.href="shop-cart.php"</script>';
                      }
				}

				if($rowGrandTotal['GrandTotal'] > 0 && $rowProgress['Progress'] >= 40)
				{
					$sqlTimeline = "INSERT INTO timeline (ProjectId, Description) values ('$ProjectId', 'Additional materials are listed')";
					if($con->query($sqlTimeline) === true)
                      {
                        // echo $_FILES["file"]["size"];
                        // echo '<script>window.location.href="shop-cart.php"</script>';
                      }
				}
				
            ?>
			<div class="row justify-content-lg-end">
				<div class="col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate" >
					<div class="cart-total mb-3" style="background-color: #f1f1f1;border: 1px solid #ccc;">
						<h3>Grand Total</h3>
						<hr>
						<?php while($rowStore = mysqli_fetch_assoc($resultStore)):
							$StoreName = $rowStore['Storename'];
							$Total = $rowStore['GrandTotal'];
							?>
						<p class="d-flex">
							<span class="text-capitalize"><?php echo $StoreName; ?></span>
							<span>₱ <?php echo number_format($Total); ?></span>
						</p>
						<?php endwhile; ?>
						<p class="d-flex total-price">
							<span class="text-black">Total</span>
							<span style="font-size: 30px;" class="font-weight-bold">₱ <?php echo number_format($rowGrandTotal['GrandTotal']); ?></span>
						</p>
						<hr>
						<p class="text-center"><a href="../pdf/pdf-materials.php" target="_blank" class=" btn-primary py-3 px-4">Print List</a></p>
					</div>
				</div>
			</div>
		</div>
    </section>
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
						<h2 class="ftco-heading-2">Minishop</h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
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
							<li><a href="#" class="py-2 d-block">About</a></li>
							<li><a href="#" class="py-2 d-block">Journal</a></li>
							<li><a href="#" class="py-2 d-block">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Help</h2>
						<div class="d-flex">
							<ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
								<li><a href="#" class="py-2 d-block">Shipping Information</a></li>
								<li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
								<li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
								<li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
							</ul>
							<ul class="list-unstyled">
								<li><a href="#" class="py-2 d-block">FAQs</a></li>
								<li><a href="#" class="py-2 d-block">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Have a Questions?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain
										View, San Francisco, California, USA</span></li>
								<li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929
											210</span></a></li>
								<li><a href="#"><span class="icon icon-envelope"></span><span
											class="text">info@yourdomain.com</span></a></li>
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
						<script>document.write(new Date().getFullYear());</script> All rights reserved | This template
						is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a
							href="https://colorlib.com" target="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>
		</div>
	</footer>
    <!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
				stroke="#F96D00" /></svg></div>


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
	<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>

	

	<script>
		$(document).ready(function () {

			var quantitiy = 0;
			$('.quantity-right-plus').click(function (e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				$('#quantity').val(quantity + 1);


				// Increment

			});

			$('.quantity-left-minus').click(function (e) {
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
