<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <title>Interior Design | Badac Konstruk Inc</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
        integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
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

</head>

<body>

    <?php include('menu.php'); ?>

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay_fit bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
                data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h1 class="display-1">Interior Design</h1>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Design Area =================-->
    <section class="design_area p_120">
      <form method="post">
        <div class="container">
            <h4> Client Information</h4>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    
                        <div class="mt-10">
                            <input type="text" class="form-control" name="FirstName" placeholder="First Name"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'" required
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="email" class="form-control" name="Email" placeholder="Email Address"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'" required
                                class="single-input">
                        </div>

                    
                </div>
                <div class="col-lg-6 col-md-4 mt-sm-30 element-wrap">
                    <div class="single-element-widget">
                        <div class="mt-10">
                            <input type="text" class="form-control" name="LastName" placeholder="Last Name"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" required
                                class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="number" class="form-control" name="ContactNum" placeholder="Contact Number"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Contact Number'" required
                                class="single-input">
                        </div>
                         <div class="mt-10">
                            <input type="text" class="form-control" name="Address" placeholder="Address"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'" required
                                class="single-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <!-- <h4> Tell us more???</h4> -->
            <div class="row">
                <!-- <div class="col-lg-6 mt-10">
                    <label for="exampleFormControlSelect1">Visitation Date
                        <input type="date" name="VisitationDate" width="100%" class="form-control col-lg-12 mt-1" id="">
                    </label>
                </div> -->
                <div class="col-lg-6">
                    <label for="Date">Preferred Visitation Date</label> 
                    <input type="date" class="form-control" name="VisitationDate" placeholder="Visitation Date" required="">
                </div>
                <div class="col-lg-6">
                    <label for="Date">Site Location</label>
                    <input type="text" class="form-control" name="SiteLocation" placeholder="Site Location" required="">
                </div>
                <div class="col-lg-12 mt-10">
                    <label for="Date">Design Description</label>
                    <textarea name="OverviewDescription" id="" class="form-control" rows="6"
                        placeholder="Tell us more about the project."></textarea>
                </div>
                <br><br><br>
                <div class="col-md-12 d-flex mt-10">
                    <button type="submit" name="submitinterior" style="background-color: #0080ff;color: white;border: none;"
                        class="btn btn-primary mr-2 ml-auto">Submit Inquiry<i
                            class="fas fa-arrow-right ml-2"></i></button>
                </div>

            </div>
      </form>
    </section>
    
    <!--================Interior Process =================-->
    <?php include('process.php'); ?>
    
    <!--================End Design Area =================-->

    <!--================Post Slider Area =================-->
    
    <!--================End Post Slider Area =================-->


    <!--================Footer Area =================-->
    <?php include('footer.php'); ?>
    <!--================End Footer Area =================-->


    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <script>
        $(function () {
            $("#datepicker").datepicker();
        });
    </script>
</body>

</html>