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
    <link rel="stylesheet" href="dist/css/timelineNew.css">
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
                        <a href="" class="nav-link">Badac Homepage</a>
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

            $sqlProgress = "SELECT * FROM project JOIN progressdescription ON project.Progress = progressdescription.ProgressId WHERE project.ClientId = '$ClientID';";
            $resultProgress = mysqli_query($con, $sqlProgress);
            $rowProgress = mysqli_fetch_assoc($resultProgress);

            $sqlPayment = "SELECT * FROM payment JOIN project ON payment.ProjectId = project.ProjectId WHERE project.ClientId = '$ClientID';";
            $resultPayment = mysqli_query($con, $sqlPayment);
            $rowPayment = mysqli_fetch_assoc($resultPayment);

            $sqlTimeline = "SELECT * FROM `timeline` JOIN project ON timeline.ProjectId = project.ProjectId JOIN client ON client.ClientId = project.ClientId WHERE client.ClientId = '$ClientID' ORDER BY TimelineId desc;";
            $resultTimeline = mysqli_query($con, $sqlTimeline);
            // $rowTimeline = mysqli_fetch_assoc($resultTimeline);

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


                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <!-- About Me Box -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <strong><i class="fas fa-envelope mr-1"></i> Email Address</strong>
                                    <p class="text-muted">
                                        <?php echo $row['Email'] ?>
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                                    <p class="text-muted"><?php echo $row['Address'] ?></p>
                                    <hr>
                                    <strong><i class="fas fa-phone mr-1"></i> Mobile Number</strong>
                                    <p class="text-muted"><?php echo $row['ContactNum'] ?></p>
                                    <hr>
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
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#payment" data-toggle="tab">Payment History</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- /.tab-pane -->
                                        <div class="active tab-pane" id="timeline">
                                            <!-- The timeline -->
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="info-box" style="background-color: #0080ff;">
                                                        <span class="info-box-icon"><i class="fa fa-hard-hat text-white"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-white">Project Tracking</span>
                                                            <span class="info-box-number text-white"><?php echo $rowProgress['Description'] ?></span>
                                                            <div class="progress">
                                                                <div class="progress-bar text-white" style="width: <?php echo $rowProject['Progress'] ?>%"></div>
                                                            </div>
                                                            <span class="progress-description text-white">
                                                                <?php echo $rowProject['Progress'] ?>% done with the project
                                                            </span>
                                                        </div>
                                                        <!-- /.info-box-content -->
                                                    </div>
                                                    <!-- /.info-box -->
                                                </div>
                                            </div>
                                            <!-- timeline -->
                                            <div class="container">
                                                <!--<div class="page-header">-->
                                                <!--    <h1 id="timeline">Timeline</h1>-->
                                                <!--</div>-->
                                                <ul class="timeline">
                                                    <?php
                                                    while ($rowTimeline = mysqli_fetch_array($resultTimeline)) :
                                                        $Description = $rowTimeline['Description'];
                                                        $originalDate = $rowTimeline['Date'];
                                                        $newDate = date("F j, Y", strtotime($originalDate));
                                                    ?>
                                                        <li class="timeline-inverted">
                                                            <div class="timeline-badge bg-success"><i class="fa fa-hard-hat text-white"></i></div>
                                                            <div class="timeline-panel" style="padding-bottom: 5px;">
                                                                <div class="timeline-heading">
                                                                    <h4 class="timeline-title"><?php echo $newDate; ?></h4>
                                                                    <!-- <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11 hours ago via Twitter</small></p> -->
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <blockquote>
                                                                        <p><?php echo $Description; ?></p>
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endwhile; ?>
                                                    <li class="timeline-inverted">
                                                        <div class="timeline-badge bg-secondary"><i class="fas fa-tools text-white"></i></div>
                                                        
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- timeline -->
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="payment">
                                            <div class="card">
                                                <div class="d-flex justify-content-between card-header">
                                                    <!--<h3 class="card-title">Payment History</h3>-->
                                                    <span>Total Assessment: <span class="badge badge-success" class="font-weight-bolder">₱ <?php echo number_format($rowPayment['Assessment']); ?></span></span>
                                                    <span class="ml-auto">Total Payment: <span class="badge badge-success" class="font-weight-bolder">₱ <?php echo number_format($rowPayment['Initial_Payment']); ?></span></span>
                                                    <span class="ml-auto">Balance: <span class="badge badge-danger" class="font-weight-bolder">₱ <?php echo number_format($rowPayment['Balance']); ?></span></span>
                                                </div>
                                                <!-- /.card-header -->
                                                <!-- php for payment history -->
                                                <?php
                                                $sqlHistory = "SELECT * FROM payment JOIN paymentbreakdown ON payment.PaymentId = paymentbreakdown.PaymentId JOIN project ON project.ProjectId = payment.ProjectId WHERE project.ClientId ='$ClientID'; ";
                                                $resultHistory = mysqli_query($con, $sqlHistory);
                                                ?>

                                                <div class="card-body p-0">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Transaction Number</th>
                                                                <th>Payment Method</th>
                                                                <th>Transaction Date</th>
                                                                <th>Amount</th>
                                                                <!--<th>Balance</th>-->
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <?php while ($rowHistory = mysqli_fetch_array($resultHistory)) :
                                                                $Amount = $rowHistory['Amount'];
                                                                $TransactionNum = $rowHistory['TransactionNum'];
                                                                $Mode_Payment = $rowHistory['Mode_Payment'];
                                                                $originalDatePayment = $rowHistory['Date_Payment'];
                                                                $newDatePayment = date("F j, Y", strtotime($originalDatePayment));


                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $TransactionNum; ?></td>
                                                                    <td><?php echo $Mode_Payment; ?></td>
                                                                    <td><?php echo $newDatePayment; ?></td>
                                                                    <td>₱ <?php echo  number_format($Amount); ?></td>

                                                                </tr>
                                                            <?php endwhile; ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
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