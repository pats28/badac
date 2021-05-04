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

                
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <br>
            <!-- php -->
            <?php
            $ClientID = $_SESSION['ClientSessionID'];
            $sql = "SELECT * FROM client WHERE ClientId = '$ClientID';";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            
             $sqlType = "SELECT * from project where ClientId = '$ClientID'";
            $resultType = mysqli_query($con, $sqlType);
            $rowType = mysqli_fetch_assoc($resultType);

            if ($rowType['ServiceTypeId']==1)
            {
                $sqlProject = "SELECT * FROM project JOIN desiredspecs ON project.ProjectId = desiredspecs.ProjectId WHERE project.ClientId = '$ClientID';";
                $resultProject = mysqli_query($con, $sqlProject);
                $rowProject = mysqli_fetch_assoc($resultProject);
            }
            else if ($rowType['ServiceTypeId']==3)
            {
                $sqlProject = "SELECT * FROM project JOIN fitout ON project.ProjectId = fitout.ProjectId WHERE project.ClientId = '$ClientID';";
                $resultProject = mysqli_query($con, $sqlProject);
                $rowProject = mysqli_fetch_assoc($resultProject);
            }
            else if ($rowType['ServiceTypeId']==2)
            {
                $sqlProject = "SELECT * FROM project JOIN interiordesign ON project.ClientId = interiordesign.ClientId WHERE project.ClientId = '$ClientID';";
                $resultProject = mysqli_query($con, $sqlProject);
                $rowProject = mysqli_fetch_assoc($resultProject);
            }

            $sqlArchi = "SELECT * FROM project JOIN employee ON project.EmpId = employee.EmpId WHERE project.ClientId = '$ClientID';";
            $resultArchi = mysqli_query($con, $sqlArchi);
            $rowArchi = mysqli_fetch_assoc($resultArchi);

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
                                        <img class="profile-user-img img-fluid img-circle" src="images/default-user-image.png" alt="User profile picture">
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
                                        <?php
                                            if ($rowType['ServiceTypeId'] == 1)
                                            {
                                        ?>
                                                <a href="client-project-details.php" class="btn btn-primary btn-block"><b>Project Details</b></a>
                                            <?php
                                            }
                                            else if (($rowType['ServiceTypeId'] == 3)) 
                                            {
                                             ?>   
                                                <a href="client-fitout-details.php" class="btn btn-primary btn-block"><b>Project Details</b></a>
                                            <?php
                                            }
                                            else if (($rowType['ServiceTypeId'] == 2)) 
                                            {
                                             ?>   
                                                <a href="client-interior-details.php" class="btn btn-primary btn-block"><b>Project Details</b></a>
                                            <?php
                                            }

                                            ?>
                                        <!--<a href="client-project-details.php" class="btn btn-primary btn-block"><b>Project Details</b></a>-->
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
                                    <!-- <a href="#" class="btn btn-primary btn-block"><b>Change Password</b></a> -->
                                    <a href="client-logout.php" class="btn btn-danger btn-block"><b>Sign out</b></a>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <!-- php -->

                        <!-- php -->
                        <div class="col-md-9">
                            <?php
                            if (!empty($_SESSION['SuccessProfile'])) {
                                echo '<div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Profile successfully updated</h5>
                                    </div>';
                                $_SESSION['SuccessProfile'] = 0;
                            }
                            
                            ?>

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Profile</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" name="FirstName" value="<?php echo $row['FirstName'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" name="LastName" value="<?php echo $row['LastName'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address</label>
                                                    <input type="email" class="form-control" id="exampleInputEmail1" name="Email" value="<?php echo $row['Email'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Contact Number</label>
                                                    <input type="number" class="form-control" id="exampleInputEmail1" name="ContactNum" value="<?php echo $row['ContactNum'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Address</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" autocomplete="none" name="Address" value="<?php echo $row['Address'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" data-toggle="modal" data-target="#updateModal" class="btn btn-primary">Update Profile</button>
                                        </div>


                                        <!-- Modal for profile update -->
                                        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update profie</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you want to save all the changes to your profile?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" name="UpdateProfile">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </form>
                            </div><!-- /.card-body -->
                            <!-- php -->
                            <?php
                            if (isset($_POST['UpdateProfile'])) {
                                $ClientId = $_SESSION['ClientSessionID'];
                                $FirstName = $_POST['FirstName'];
                                $LastName = $_POST['LastName'];
                                $Email = $_POST['Email'];
                                $ContactNum = $_POST['ContactNum'];
                                $Address = $_POST['Address'];
                                $sqlUpdateFirstName = "UPDATE client SET FirstName='$FirstName' WHERE ClientId = '$ClientId'";
                                $sqlUpdateLastName = "UPDATE client SET LastName='$LastName' WHERE ClientId = '$ClientId'";
                                $sqlUpdateEmail = "UPDATE client SET Email='$Email' WHERE ClientId = '$ClientId'";
                                $sqlUpdateContactNum = "UPDATE client SET ContactNum='$ContactNum' WHERE ClientId = '$ClientId'";
                                $sqlUpdateAddress = "UPDATE client SET Address='$Address' WHERE ClientId = '$ClientId'";
                                mysqli_query($con, $sqlUpdateFirstName);
                                mysqli_query($con, $sqlUpdateLastName);
                                mysqli_query($con, $sqlUpdateEmail);
                                mysqli_query($con, $sqlUpdateContactNum);
                                mysqli_query($con, $sqlUpdateAddress);
                                $_SESSION['SuccessProfile'] = 1;
                                $page = $_SERVER['REQUEST_URI'];
                                echo '<script type="text/javascript">';
                                echo 'window.location.href="client-edit-profile.php";';
                                echo '</script>';
                            }
                            ?>
                            <!-- php end -->
                            <!-- alert for change of password -->
                            <?php
                            if (!empty($_SESSION['SuccessPassword'])) {
                                echo '<div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Password successfully updated</h5>
                                    </div>';
                                $_SESSION['Success'] = 0;
                            }
                            if (empty($_SESSION['SuccessPassword'])) {
                                // sdsd
                            }
                            ?>
                            <!-- alert end -->
                            <div class="card card-primary" id="ChangePass">
                                <div class="card-header">
                                    <h3 class="card-title">Change Password</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- text input -->
                                                <div class="callout callout-warning">
                                                    <h5>Attention: Update your password</h5>
                                                    <!-- <p>Please change the default password we've given to you.</p> -->
                                                    <p>To protect the security and privacy of our customers, we're asking you to update the default password we've given to you.</p>
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="text" name="Password" placeholder="New password" class="form-control" required>
                                                </div>
                                                <div>
                                                    <button type="button" name="ChangePass" data-toggle="modal" data-target="#updatePass" class="btn btn-primary">Change Password</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal for update password -->
                                        <div class="modal fade" id="updatePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update password</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you want to save the changes to your password?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" name="UpdatePassword">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.card-body -->
                        </div>
                        <?php
                        if (isset($_POST['UpdatePassword'])) {
                            $ClientId = $_SESSION['ClientSessionID'];
                            $Password = $_POST['Password'];
                            $sqlUpdatePassword = "UPDATE client SET Password='$Password' WHERE ClientId = '$ClientId'";
                            mysqli_query($con, $sqlUpdatePassword);
                            $_SESSION['SuccessPassword'] = 2;
                            $page = $_SERVER['REQUEST_URI'];
                            echo '<script type="text/javascript">';
                            echo 'window.location.href="client-edit-profile.php";';
                            echo '</script>';
                        }
                        ?>
                        <!-- /.nav-tabs-custom -->
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