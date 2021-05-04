<?php
include('config.php');
session_start();
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Badac | Client Profile</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <a class="navbar-brand logo" href="client-profile.php"><img src="BKIlogo.png" width="83px" height="55px" alt=""></a><br>
            <span class="brand-text font-weight-heavy">Badac Konstruk Inc.</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="C:\Users\Gerald\Desktop\UpdatedAdmin\Client\client-index.html" class="nav-link">Badac Homepage</a>
                    </li>
                    <!-- <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li> -->
                </ul>
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-comments"></i>
                            <span class="badge badge-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li>

                </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <br>
            <!-- php -->
            <?php
            $ClientID = $_SESSION['ClientSessionID'];
            $sql = "SELECT * FROM client WHERE ClientId = '$ClientID'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            $sqlProject = "SELECT * FROM project JOIN desiredspecs ON project.ProjectId = desiredspecs.ProjectId WHERE project.ClientId = '$ClientID';";
            $resultProject = mysqli_query($con, $sqlProject);
            $rowProject = mysqli_fetch_assoc($resultProject);

            $sqlArchi = "SELECT * FROM project JOIN employee ON project.EmpId = employee.EmpId WHERE project.ClientId = '$ClientID';";
            $resultArchi = mysqli_query($con, $sqlArchi);
            $rowArchi = mysqli_fetch_assoc($resultArchi);

            $sqlDesired = "SELECT * FROM desiredspecs JOIN project ON desiredspecs.ProjectId = project.ProjectId WHERE project.ClientId = '$ClientID';";
            $resultDesired = mysqli_query($con, $sqlDesired);
            $rowDesired = mysqli_fetch_assoc($resultDesired);
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle" src="images/default-user-image.png"  alt="User profile picture">
                                    </div>
                                    <h3 class="profile-username text-center"><?php echo $row['FirstName'] ?> <?php echo $row['LastName'] ?></h3>
                                    <p class="text-muted text-center">Client</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Project</b> <a class="float-right"><?php echo $rowProject['ProjectName'] ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Architect</b> <a class="float-right"><?php echo $rowArchi['EmpFirstName'] ?> <?php echo $rowArchi['EmpLastName'] ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Location</b> <a class="float-right"><?php echo $row['Address'] ?></a>
                                        </li>
                                        <!-- <li class="list-group-item">
                                            <b>Project Manager</b> <a class="float-right">Fatima Macud</a>
                                        </li> -->
                                        
                                        <li class="list-group-item">
                                            <b>Start Date</b> <a class="float-right"><?php echo $rowProject['Date_Started'] ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Completion Date</b> <a class="float-right"><?php echo $rowProject['Estimated_Finish_Date'] ?></a>
                                        </li>
                                        <hr>
                                        <a href="client-profile.php" class="btn btn-primary btn-block"><b>Timeline</b></a>
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <!-- About Me Box -->
                            <div class="card card-primary">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <a href="client-edit-profile.php" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                                    <a href="client-edit-profile.php#ChangePass" class="btn btn-primary btn-block"><b>Change Password</b></a>
                                    <a href="client-logout.php" class="btn btn-danger btn-block"><b>Sign out</b></a>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <!-- property info -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Property Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Property Location</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" autocomplete="none" name="Address" value="<?php echo $rowDesired['Property_Loc'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Lot Area</label>
                                                <input type="text" class="form-control" name="FirstName" value="<?php echo $rowDesired['Lot_Area'] ?> sqm" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Length</label>
                                                <input type="text" class="form-control" name="LastName" value="<?php echo $rowDesired['Length'] ?> meters" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Width</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1" name="Email" value="<?php echo $rowDesired['Width'] ?> meters" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- desired specs -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Desired Specifications</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Floor Area</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" autocomplete="none" value="<?php echo $rowDesired['Floor_Area'] ?> sqm" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Classification</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" autocomplete="none" value="<?php echo $rowDesired['Classification'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Number of Floors</label>
                                                <input type="text" class="form-control" value="<?php echo $rowDesired['Floor_Levels'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Number of Rooms</label>
                                                <input type="text" class="form-control" value="<?php echo $rowDesired['Rooms'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Number of Toilets and Baths</label>
                                                <input type="text" class="form-control" value="<?php echo $rowDesired['Toilet_Bath'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Number of Car Garage</label>
                                                <input type="text" class="form-control" value="<?php echo $rowDesired['Car_Garage'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Preferred Design</label>
                                                <input type="text" class="form-control" value="<?php echo $rowDesired['Preferred_Design'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Preferred Finish</label>
                                                <input type="text" class="form-control" value="<?php echo $rowDesired['Preferred_Finish'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description / Project Notes</label>
                                                <textarea class="form-control" rows="5" disabled><?php echo $rowDesired['Description'] ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020 <a href="Badac.html">Badac Konstruk Inc.</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
</body>

</html>