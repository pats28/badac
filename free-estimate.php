<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/bkicon.png" type="image/png">
    <title>Estimation | Badac Konstruk Inc</title>
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
    <link rel="stylesheet" href="https://badackonstruck.netlify.app/assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="https://badackonstruck.netlify.app/assets/vendor/hs-megamenu/src/hs.megamenu.css">
    <link rel="stylesheet"
        href="https://badackonstruck.netlify.app/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="https://badackonstruck.netlify.app/assets/vendor/custombox/dist/custombox.min.css">
    <link rel="stylesheet" href="https://badackonstruck.netlify.app/assets/vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="https://badackonstruck.netlify.app/assets/vendor/dzsparallaxer/dzsparallaxer.css">
    <link rel="stylesheet" href="https://badackonstruck.netlify.app/assets/vendor/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="https://badackonstruck.netlify.app/assets/vendor/custombox/dist/custombox.min.css">
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
                    <h1 class="display-1">Estimate</h1>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Design Area =================-->
    <!-- Checkout Form Section -->
    <div class="container space-2 space-4-top--lg ">
        <div class="row">
            <div class="col-lg-12 center">
                <!-- Checkout Form -->
                <form method="post" enctype="multipart/form-data" class="js-validate js-step-form pr-lg-4" data-progress-id="#stepFormProgress"
                    data-steps-id="#stepFormContent" novalidate="novalidate">
                    <!-- Step Form Header -->

                    <!-- End Step Form Header -->
                    <br>
                    <br>

                    <div id="stepFormContent">
                        <!-- Client Info -->
                        <div id="personal_info_step" class="active">
                            <div class="row">
                                <div class="main_title col-md-12">
                                    <h2>Client Information</h2>
                                    <p>Talk to us about whatever you like, as us a question or tell us about an idea you may have. <br>We’re all ears.
                                        Fill the form below and we’ll get back in touch.</p>
                                </div>
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="h6 small d-block text-uppercase">
                                            First name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <input class="form-control form__input" type="text" name="FirstName"
                                                required placeholder="Juan" aria-label="Juan"
                                                data-msg="Please enter your First Name" data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="h6 small d-block text-uppercase">
                                            Last name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <input class="form-control form__input" type="text" name="LastName" required
                                                placeholder="Dela Cruz" aria-label="Dela Cruz"
                                                data-msg="Please enter your Last Name." data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mt-10">
                                        <label class="h6 small d-block text-uppercase">
                                            Email Address
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <input class="form-control form__input" type="email" name="Email" required
                                                placeholder="juandc@example.com" aria-label="juandc@example.com"
                                                data-msg="Please enter a valid Email Address."
                                                data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="col-md-6 mb-10">
                                    <!-- Input -->
                                    <div class="js-form-message mt-10">
                                        <label class="h6 small d-block text-uppercase">
                                            Contact Number
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <input class="form-control form__input" name="ContactNum" type="number" required
                                                placeholder="09211998911" aria-label="09211998911"
                                                data-msg="Please enter your Phone Number."
                                                data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12 mb-10">
                                    <!-- Input -->
                                    <div class="js-form-message mt-10">
                                        <label class="h6 small d-block text-uppercase">
                                            Address
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <input class="form-control form__input" name="Address" type="text" required
                                                placeholder="Culiat, Quezon City" aria-label="Culiat, Quezon City"
                                                data-msg="Please enter your Address."
                                                data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="w-100"></div>
                            </div>
                            <!-- End client info -->
                            <!-- Buttons -->
                            <div class="d-sm-flex justify-content-sm-between align-items-sm-center mt-10">
                                <a class="d-block mb-3 mb-sm-0" href="services.html">Go to other services
                                </a>
                                <button type="button" class="btn btn-primary"
                                    style="background-color: #0080ff;color: white;"
                                    data-next-step="#property_info_step">Next step <i
                                        class="fa fa-arrow-right ml-1"></i></button>
                            </div>
                            <!-- End Buttons -->
                            <br>
                            <hr class="my-9">
                        </div>
                        <!-- End Client Info -->

                        <!-- property info -->
                        <div id="property_info_step" style="display: none;">
                            <div class="row">
                                <div class="main_title col-md-12">
                                    <h2>Property Information</h2>
                                </div>
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="h6 small d-block text-uppercase">
                                            Location of Property
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <input class="form-control form__input" type="text" name="e_Property_Loc" required
                                                placeholder="" data-msg="Please enter the Location of your Property."
                                                data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="h6 small d-block text-uppercase">
                                            Lot Area
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <input class="form-control form__input" type="number" name="e_Lot_Area"
                                                required placeholder="50 sqm." aria-label="50 sqm"
                                                data-msg="Please enter the Lot area." data-error-class="u-has-error"
                                                data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-6 mb-10">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6 mt-10">
                                        <label class="h6 small d-block text-uppercase">
                                            Length
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <input class="form-control form__input" type="number" name="e_Length"
                                                data-msg="Please enter the length" placeholder="30 (use meters)" required
                                                data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="col-md-6 mb-10">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6 mt-10">
                                        <label class="h6 small d-block text-uppercase">
                                            Width
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <input class="form-control form__input" name="e_Width" type="number"
                                                data-msg="Please enter the width." placeholder="45 (use meters)" required
                                                data-error-class="u-has-error" data-success-class="u-has-success">
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                                <a class="d-block mb-3 mb-sm-0" style="color: #588bae;" href="javascript:;"
                                    data-previous-step="#personal_info_step">
                                    <i class="fa fa-arrow-left mr-2"></i>
                                    Back to Client info
                                </a>
                                <button type="button" class="btn btn-primary"
                                    style="background-color: #0080ff;color: white;"
                                    data-next-step="#desired_specs_step">Next step <i
                                        class="fa fa-arrow-right mr-2"></i></button>
                            </div>
                            <!-- Buttons -->
                            <br>
                            <hr class="my-9">
                        </div>
                        <!-- End property info -->
                        <!-- Payment -->
                        <div id="desired_specs_step" style="display: none;">
                            <div class="row">
                                <div class="main_title col-md-12">
                                    <h2>Desired Specifications</h2>
                                </div>
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="h6 small d-block text-uppercase">
                                            Floor Area
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <input class="form-control form__input" name="e_Floor_Area" type="number"
                                                data-msg="Please enter the floor area" placeholder="47 sqm (use meters)"
                                                data-error-class="u-has-error" data-success-class="u-has-success" required>
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="mb-6 js-form-message">
                                        <label class="h6 small d-block text-uppercase">
                                            Classification
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                            <select class=" form__input form-group w-100" name="e_Classification" data-msg="Please choose classification."
                                            data-error-class="u-has-error" data-success-class="u-has-success" required>
                                            <option value="" selected>Select Classification
                                            <!--<option>-->
                                            <option value="Residential">Residential</option>
                                            <option value="Commercial">Commercial</option>
                                            <option value="Industrial">Industrial</option>
                                        </select>
                                        </div>
                                        
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="mb-6 js-form-message">
                                        <label class="h6 small d-block text-uppercase mt-10">
                                            Number of Floors
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                        <select class=" form__input form-group w-100" name="e_Floor_Levels" data-msg="Please select number of floors."
                                            data-error-class="u-has-error" data-success-class="u-has-success" required>
                                            <option value="" selected>Choose Number of Floors
                                            <!--<option>-->
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4 and more</option>
                                        </select>
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="mb-6 js-form-message">
                                        <label class="h6 small d-block text-uppercase mt-10">
                                            Preferred Design
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                        <select class=" form__input form-group w-100" name="e_Preferred_Design" data-msg="Please choose preffered design."
                                            data-error-class="u-has-error" data-success-class="u-has-success" required>
                                            <option value="" selected>Select Design
                                            <!--<option>-->
                                            <option value="Asian">Asian</option>
                                            <option value="Contemporary">Contemporary</option>
                                            <option value="Mediterranean">Mediterranean</option>
                                            <option value="Zen">Zen</option>
                                            <option value="Others">others</option>
                                        </select>
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="mb-6 js-form-message">
                                        <label class="h6 small d-block text-uppercase mt-10">
                                            Number of Rooms
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                        <select class=" form__input form-group w-100" name="e_Rooms" data-msg="Please select number of rooms."
                                            data-error-class="u-has-error" data-success-class="u-has-success" required>
                                            <option value="" selected>Choose Number of Rooms
                                            <!--<option>-->
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5 and more</option>
                                        </select>
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="mb-6 js-form-message">
                                        <label class="h6 small d-block text-uppercase mt-10">
                                            Preferred Finish
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                        <select class=" form__input form-group w-100" name="e_Preferred_Finish" data-msg="Please choose preferred finish."
                                            data-error-class="u-has-error" data-success-class="u-has-success" required>
                                            <option value="" selected>Select Preferred finish
                                            <!--<option>-->
                                            <option value="Basic">Basic</option>
                                            <option value="Standard">Standard</option>
                                            <option value="Semi-Elegant">Semi-Elegant</option>
                                            <option value="Elegant">Elegant</option>
                                        </select>
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="mb-6 js-form-message">
                                        <label class="h6 small d-block text-uppercase mt-10">
                                            Number of Toilets and Baths
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                        <select class=" form__input form-group w-100" name="e_Toilet_Bath" data-msg="Please select number of toilets and baths."
                                            data-error-class="u-has-error" data-success-class="u-has-success" required>
                                            <option value="" selected>Choose Number of Toilets and Baths
                                            <!--<option>-->
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5 and more</option>
                                        </select>
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="mb-6 js-form-message">
                                        <label class="h6 small d-block text-uppercase mt-10">
                                            Car Garage
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="js-focus-state input-group form">
                                        <select class=" form__input form-group w-100" name="e_Car_Garage" data-msg="Please select number of garage."
                                            data-error-class="u-has-error" data-success-class="u-has-success" required>
                                            <option value="" selected>Choose Number of Garage
                                            <!--<option>-->
                                            <option value="0">None</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3 or more</option>
                                        </select>
                                        </div>
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <!-- Input -->
                                <div class="col-md-6">
                                    <label class="h6 small d-block text-uppercase mt-10">
                                        Other descriptions / Project Notes
                                        <div class="js-form-message mb-10">
                                            <div class="js-focus-state input-group form">
                                                <textarea class="form-control form__input" rows="6" name="Description"
                                                    placeholder="Tell us more about your other specifications"
                                                    aria-label="Tell us more about your other specifications"
                                                    data-error-class="u-has-error"
                                                    data-success-class="u-has-success"></textarea>
                                            </div>
                                        </div>
                                </div>
                                <!-- End Input -->

                                <!-- upload file -->
                                <div class="col-md-6 mb-10">
                                    <label class="h6 small d-block text-uppercase mt-10">
                                        Upload your Drawings<br>
                                        <span style="color: red;  font-size: 12px;">Allowed Files Only: JPEG, JPG, PNG, DOCX, and PDF </span>
                                    </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Drawing" id="Drawing" >
                                        <label class="custom-file-label"  name="Drawing" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <!-- end upload -->
                            </div>
                            <!-- Buttons -->
                            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                                <a class="d-block mb-3 mb-sm-0" style="color: #588bae" href="javascript:;"
                                    data-previous-step="#property_info_step">
                                    <i class="fa fa-arrow-left mr-2" style="color: #588bae"></i>
                                    Property Info
                                </a>
                                <button type="submit" name="submitestimate" style="background-color: #0080ff;color: white;border: none;"
                                    class="btn btn-primary mr-2">Submit Inquiry<i
                                    class="fas fa-paper-plane ml-2"></i></button>
                            </div>
                            <!-- End Buttons -->
                        </div>
                        <!-- End Payment -->
                    </div>
                    <!-- End Step Form Content -->
                </form>
                <!-- End Checkout Form -->
            </div>
        </div>
    </div>
    <!-- End Checkout Form Section -->

    <!--================Estimate Process =================-->
    <?php include('process.php'); ?>


    <!--================End Design Area =================-->
    <br>
    <br>
    <br>
    <!--================Post Slider Area =================-->
        <section class="post_slider_area">
		<div class="main_title">
			<h2>Completed Projects</h2>
			<p>We are very happy to present some of our work and deliveries on-site.</p>
		</div>
		<div class="post_slider_inner owl-carousel">
			<div class="item">
				<div class="post_s_item">
					<div class="post_img">
						<img style="object-fit: cover;height: 400px;width: 100%;" src="http://topnotchconstructionph.com/wp-content/uploads/2020/08/01.jpg" alt="">
					</div>
					<div class="post_text">
						<a>
							<h4>Antel, General Trias, Cavite</h4>
						</a>
						
						<!--<a class="main_btn" href="project-details.html">View Details</a>-->
					</div>
				</div>
			</div>
			<div class="item">
				<div class="post_s_item">
					<div class="post_img">
						<img style="object-fit: cover;height: 400px;width: 100%;" src="http://topnotchconstructionph.com/wp-content/uploads/2020/11/80337414_571349987012069_5424087191364042752_n.jpg" alt="">
					</div>
					<div class="post_text">
						<a>
							<h4>Royale Estate, Taytay, Rizal</h4>
						</a>
						
						<!--<a class="main_btn" href="project-details.html">View Details</a>-->
					</div>
				</div>
			</div>
			<div class="item">
				<div class="post_s_item">
					<div class="post_img">
						<img style="object-fit: cover;height: 400px;width: 100%;" src="http://topnotchconstructionph.com/wp-content/uploads/2020/08/86864335_483922772298757_8128882230870147072_n-1.jpg" alt="">
					</div>
					<div class="post_text">
						<a>
							<h4>Town & Country , Cainta, Rizal</h4>
						</a>
						
						<!--<a class="main_btn" href="project-details.html">View Details</a>-->
					</div>
				</div>
			</div>
			<div class="item">
				<div class="post_s_item">
					<div class="post_img">
						<img style="object-fit: cover;height: 400px;width: 100%;" src="http://topnotchconstructionph.com/wp-content/uploads/2019/07/01-1.jpg" alt="">
					</div>
					<div class="post_text">
						<a>
							<h4>Parocruz Residence, Cainta, Rizal</h4>
						</a>
						
						<!--<a class="main_btn" href="project-details.html">View Details</a>-->
					</div>
				</div>
			</div>
		</div>
	</section><br>
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

    <script src="https://badackonstruck.netlify.app/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script
        src="https://badackonstruck.netlify.app/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script
        src="https://badackonstruck.netlify.app/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.validation.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.validation.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="js/js.step-form.js"></script>
    <script src="hs/js.step-form.js"></script>
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

    <!-- JS Global Compulsory -->
    <script src="https://badackonstruck.netlify.app/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/vendor/bootstrap/bootstrap.min.js"></script>

    <!-- JS Implementing Plugins -->
    <script src="https://badackonstruck.netlify.app/assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
    <script
        src="https://badackonstruck.netlify.app/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script
        src="https://badackonstruck.netlify.app/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/vendor/custombox/dist/custombox.min.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/vendor/custombox/dist/custombox.legacy.min.js"></script>
    <script
        src="https://badackonstruck.netlify.app/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>

    <!-- JS Space -->
    <script src="https://badackonstruck.netlify.app/assets/js/hs.core.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.header.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.unfold.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.validation.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/helpers/hs.focus-state.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.malihu-scrollbar.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.modal-window.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.show-animation.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.validation.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.step-form.js"></script>
    <script src="https://badackonstruck.netlify.app/assets/js/components/hs.go-to.js"></script>

    <!-- JS Plugins Init. -->
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <script>
        $(window).on('load', function () {
            // initialization of HSMegaMenu component
            $('.js-mega-menu').HSMegaMenu({
                event: 'hover',
                pageContainer: $('.container'),
                breakpoint: 991,
                hideTimeOut: 0
            });
        });

        $(document).on('ready', function () {
            // initialization of header
            $.HSCore.components.HSHeader.init($('#header'));

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                afterOpen: function () {
                    if (!$('body').hasClass('IE11')) {
                        $(this).find('input[type="search"]').focus();
                    }
                }
            });

            // initialization of form validation
            $.HSCore.components.HSValidation.init('.js-validate', {
                rules: {
                    confirmPassword: {
                        equalTo: '#password'
                    }
                }
            });

            // initialization of forms
            $.HSCore.helpers.HSFocusState.init();

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of autonomous popups
            $.HSCore.components.HSModalWindow.init('[data-modal-target]', '.js-signup-modal', {
                autonomous: true
            });

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // initialization of form validation
            $.HSCore.components.HSValidation.init('.js-validate');

            // initialization of step form
            $.HSCore.components.HSStepForm.init('.js-step-form');

            // initialization of go to
            $.HSCore.components.HSGoTo.init('.js-go-to');
        });
    </script>
</body>

</html>