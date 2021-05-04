<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/bkicon.png" type="image/png">
    <title>Project-details | Badac Konstruk Inc.</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

   

    <style>
        .btn:focus,
        .btn:active,
        button:focus,
        button:active {
            outline: none !important;
            box-shadow: none !important;
        }

        #image-gallery .modal-footer {
            display: block;
        }

        .thumb {
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

   
    <?php include('menu.php'); ?>
    

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
                data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h1 class="display-1">Project Details</h1>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Portfolio Details Area =================-->
    <section class="portfolio_details_area p_120">
        <div class="container">
            <div class="portfolio_details_inner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="left_img">
                            <img class="img-fluid" src="http://topnotchconstructionph.com/wp-content/uploads/2020/08/01.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="portfolio_right_text">
                            <h4>Three-Storey Residence</h4>
                            <p>The lightness of having a cosmopolitan life is finally depicted, right here in the three-level posh residence.</p>
                            <ul class="list">
                                <li><span>Project Manager</span>: Fatima Macud</li>
                                <li><span>Architect</span>: Sophie Francisco</li>
                                <li><span>Location</span>: Taytay, Rizal</li>
                                <li><span>Completed</span>: Janaury 2019</li>
                                <li><span>Style</span>: Contemporary</li>
                                <li><span>Lot Area</span>: 420 sq.m</li>
                                <li><span>Floor Area</span>: 302.25 sq.m</li>
                                <li><span>Rooms</span>: 4 Rooms</li>
                                <li><span>Baths</span>: 4 1/2 Baths</li>
                                <li><span>Garage</span>: 1 Garage</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- gallery -->
            <div class="main_title mt-5">
				<h2>Gallery</h2>
			</div>
            <div class="row">
                <div class="row">
                    <!-- img 1 -->
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                            data-image="http://topnotchconstructionph.com/wp-content/uploads/2020/08/04.jpg"
                            data-target="#image-gallery">
                            <img class="img-thumbnail"
                                src="http://topnotchconstructionph.com/wp-content/uploads/2020/08/04.jpg"
                                alt="Another alt text">
                        </a>
                    </div>
                    <!-- img 2 -->
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                            data-image="http://topnotchconstructionph.com/wp-content/uploads/2020/08/05.jpg"
                            data-target="#image-gallery">
                            <img class="img-thumbnail"
                                src="http://topnotchconstructionph.com/wp-content/uploads/2020/08/05.jpg"
                                alt="Another alt text">
                        </a>
                    </div>
                    <!-- img 3 -->
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                            data-image="http://topnotchconstructionph.com/wp-content/uploads/2020/08/06.jpg"
                            data-target="#image-gallery">
                            <img class="img-thumbnail"
                                src="http://topnotchconstructionph.com/wp-content/uploads/2020/08/06.jpg"
                                alt="Another alt text">
                        </a>
                    </div>
                    <!-- img 4 -->
                    
                    <!-- modal -->
                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="image-gallery-title"></h4>
                                <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">×</span><span class="sr-only">Close</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i
                                        class="fa fa-arrow-left"></i>
                                </button>
                                <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i
                                        class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Portfolio Details Area =================-->
    <!--================Footer Area =================-->
    <?php include('footer.php'); ?>
    <!--================End Footer Area =================-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope-min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="vendors/popup/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.js"></script>
    <script src="js/theme.js"></script>
    <script src="js/gallery.js"></script>
</body>

</html>