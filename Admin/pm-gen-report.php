<?php

include('config.php');
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>General Report</title>
  <!--Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--Bootstrap 4 -->
  <!--Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!--Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!--Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!--Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
  <div class="container">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="container">
        <div class="row ml-5">
          <div class="col-6 mt-4">
            <h2 class="page-header">
              <!--<a href="" class="brand-link" style= "background-color: white">-->
              <img src="dist/img/BKIlogo.png" class="brand-image img-rectangle" style="opacity: .8;height: 65px;width: 100px;margin-left: 90px;">
              <h2 class="brand-text font-weight-bold" style="color: #708090;">Badac Konstruk Inc.</h2>
              <h5 class="brand-text font-weight-bold" style="color: #708090;margin-left: 75px;">General Report</h5>
              <!-- <small class="float-right mt-1 text-xs">Date: <?php echo date("l, F d, Y g:i A"); ?></small> -->
            </h2>
          </div>
          <!-- /.col -->
          <div class="col-6 mt-4">
            <h6 class="float-right mr-5"><strong>Address:</strong> Lot 24/23 Navarro Compound,</h6>
            <h6 class="float-right mr-5">Rose Ann Subdivision, San Roque, Cainta, Rizal</h6>
            <!-- <h6 class="float-right mr-5"><strong>Phone:</strong>(865) 33-791</h6><br> -->
            <h6 class="float-right mr-5"><strong>Email:</strong> badackonstrukinc@yahoo.com</h6>
            <h6 class="float-right mr-5"><strong>Printed:</strong> <?php date_default_timezone_set('Asia/Manila');  echo date("l, F d, Y g:i A"); ?></h6>
            <h6 class="float-right mr-5"><strong>Phone:</strong>(865) 33-791</h6>
          </div>
        </div>
        <hr style="width: 85%;background-color: #708090;height: 1px;">
      </div>

      <br><br>
      <div class="container px-5">

        <?php
        $query = "SELECT COUNT(StoreId) from store";
        $sql = mysqli_query($con, $query);
        $count_store = mysqli_fetch_assoc($sql);

        $query2 = "SELECT COUNT(ClientId) from client where StatusId = 3";
        $sql2 = mysqli_query($con, $query2);
        $count_client = mysqli_fetch_assoc($sql2);

        $query3 = "SELECT COUNT(ProjectId) from project where isdelete = 0";
        $sql3 = mysqli_query($con, $query3);
        $count_project = mysqli_fetch_assoc($sql3);

        $query4 = "SELECT COUNT(ClientId) from client where StatusId = 1";
        $sql4 = mysqli_query($con, $query4);
        $count_regi = mysqli_fetch_assoc($sql4);

        $cons = "SELECT COUNT(ProjectId) FROM project WHERE ServiceTypeId = 1 AND isdelete = 0";
        $sqlcons = mysqli_query($con, $cons);
        $count_cons = mysqli_fetch_assoc($sqlcons);

        $interior = "SELECT COUNT(ProjectId) FROM project WHERE ServiceTypeId = 2 AND isdelete = 0";
        $sqlinterior = mysqli_query($con, $interior);
        $count_interior = mysqli_fetch_assoc($sqlinterior);

        $fit = "SELECT COUNT(ProjectId) FROM project WHERE ServiceTypeId = 3 AND isdelete = 0";
        $sqlfit = mysqli_query($con, $fit);
        $count_fit = mysqli_fetch_assoc($sqlfit);

        $expenses = "SELECT SUM(Amount) FROM expenses";
        $sqlexpenses = mysqli_query($con, $expenses);
        $total_expenses = mysqli_fetch_assoc($sqlexpenses);

        $payments = "SELECT SUM(Amount) FROM paymentbreakdown";
        $sqlpayments = mysqli_query($con, $payments);
        $total_payments = mysqli_fetch_assoc($sqlpayments);

        $assessment = "SELECT SUM(Assessment) FROM payment";
        $sqlassessment = mysqli_query($con, $assessment);
        $total_assessment = mysqli_fetch_assoc($sqlassessment);

        $total_balance = $total_assessment['SUM(Assessment)'] - $total_payments['SUM(Amount)'];

        ?>

        <div class="row">

          <div class="col-md-3 col-sm-3">
            <div class="info-box bg-success">
              <span class="info-box-icon bg-white "><i class="fas fa-store"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Vendors</span>
                <span class="info-box-number"><?php echo $count_store['COUNT(StoreId)']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="info-box bg-success">
              <span class="info-box-icon bg-white "><i class="fas fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Clients</span>
                <span class="info-box-number"><?php echo $count_client['COUNT(ClientId)']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="info-box bg-success">
              <span class="info-box-icon bg-white "><i class="fas fa-briefcase"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Projects</span>
                <span class="info-box-number"><?php echo $count_project['COUNT(ProjectId)']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="info-box bg-success">
              <span class="info-box-icon bg-white "><i class="fas fa-user-plus"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Registrations</span>
                <span class="info-box-number"><?php echo $count_regi['COUNT(ClientId)']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>

        <div class="row">
          
            <div class="col-lg-4 col-sm-4">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>₱ <?php echo number_format($total_payments['SUM(Amount)']); ?></h3>

                  <p>Total Payment Received</p>
                </div>
                <div class="icon">
                  <i class="fas fa-coins"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-sm-4">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                <h3>₱ <?php echo number_format($total_balance); ?></h3>

                  <p>Total Clients Balance</p>
                </div>
                <div class="icon">
                  <i class="fas fa-wallet"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-sm-4">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>₱ <?php echo number_format($total_expenses['SUM(Amount)']); ?></h3>

                  <p>Total Expenses</p>
                </div>
                <div class="icon">
                  <i class="fas fa-store"></i>
                </div>
              </div>
            </div>
          
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title font-weight-bold">Projects per Service Type</div>
              </div>
              <div class="card-body">

                <div class="col-12">
                  <div class="row">
                    <?php
                    $consper = ($count_cons['COUNT(ProjectId)'] / $count_project['COUNT(ProjectId)']) * 100;
                    $interiorper = ($count_interior['COUNT(ProjectId)'] / $count_project['COUNT(ProjectId)']) * 100;
                    $fitper = ($count_fit['COUNT(ProjectId)'] / $count_project['COUNT(ProjectId)']) * 100;
                    ?>
                    <div class="col-md-4 col-sm-4">
                      <div class="info-box bg-primary">
                        <span class="info-box-icon bg-primary"><i class="fa fa-hard-hat"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Construction</span>
                          <span class="info-box-number h5"><?php echo $count_cons['COUNT(ProjectId)']; ?> projects</span>
                          <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $consper; ?>%"></div>
                          </div>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>

                    <div class="col-md-4 col-sm-4">
                      <div class="info-box bg-primary">
                        <span class="info-box-icon bg-primary"><i class="fas fa-ruler-combined"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Interior Design</span>
                          <span class="info-box-number h5"><?php echo $count_interior['COUNT(ProjectId)']; ?> projects</span>
                          <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $interiorper; ?>%"></div>
                          </div>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>

                    <div class="col-md-4 col-sm-4">
                      <div class="info-box bg-primary">
                        <span class="info-box-icon bg-primary"><i class="fas fa-home"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Fit-out</span>
                          <span class="info-box-number h5"><?php echo $count_fit['COUNT(ProjectId)']; ?> projects</span>
                          <div class="progress">
                            <div class="progress-bar" style="width: <?php echo $fitper; ?>%"></div>
                          </div>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <?php
        $comp_cons = "SELECT COUNT(ProjectId) FROM project WHERE Progress = 100 and ServiceTypeId = 1 and isdelete = 0";
        $sqlcomp_cons = mysqli_query($con, $comp_cons);
        $completed_construction = mysqli_fetch_assoc($sqlcomp_cons);

        $ong_cons = "SELECT COUNT(ProjectId) FROM project WHERE Progress < 100 and ServiceTypeId = 1 and isdelete = 0";
        $sqlong_cons = mysqli_query($con, $ong_cons);
        $ongoing_construction = mysqli_fetch_assoc($sqlong_cons);

        $comp_interior = "SELECT COUNT(ProjectId) FROM project WHERE Progress = 100 and ServiceTypeId = 2 and isdelete = 0";
        $sqlcomp_interior = mysqli_query($con, $comp_interior);
        $completed_interior = mysqli_fetch_assoc($sqlcomp_interior);

        $ong_interior = "SELECT COUNT(ProjectId) FROM project WHERE Progress < 100 and ServiceTypeId = 2 and isdelete = 0";
        $sqlong_interior = mysqli_query($con, $ong_interior);
        $ongoing_interior = mysqli_fetch_assoc($sqlong_interior);

        $comp_fit = "SELECT COUNT(ProjectId) FROM project WHERE Progress = 100 and ServiceTypeId = 3 and isdelete = 0";
        $sqlcomp_fit = mysqli_query($con, $comp_fit);
        $completed_fit = mysqli_fetch_assoc($sqlcomp_fit);

        $ong_fit = "SELECT COUNT(ProjectId) FROM project WHERE Progress < 100 and ServiceTypeId = 3 and isdelete = 0";
        $sqlong_fit = mysqli_query($con, $ong_fit);
        $ongoing_fit = mysqli_fetch_assoc($sqlong_fit);
        ?>

        <div class="card">
          <div class="card-body">
            <div class="row">
              <!-- construction column -->
              <div class="col-4">
                <p class="lead">Construction</p>
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Completed Project:</th>
                      <td><?php echo $completed_construction['COUNT(ProjectId)']; ?></td>
                    </tr>
                    <tr>
                      <th>Ongoing Project:</th>
                      <td><?php echo $ongoing_construction['COUNT(ProjectId)']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <p class="lead">Interior Design</p>
                </p>
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Completed Project:</th>
                      <td><?php echo $completed_interior['COUNT(ProjectId)']; ?></td>
                    </tr>
                    <tr>
                      <th>Ongoing Project:</th>
                      <td><?php echo $ongoing_interior['COUNT(ProjectId)']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>

              <div class="col-4">
                <p class="lead">Fit-out</p>
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Completed Project:</th>
                      <td><?php echo $completed_fit['COUNT(ProjectId)']; ?></td>
                    </tr>
                    <tr>
                      <th>Ongoing Project:</th>
                      <td><?php echo $ongoing_fit['COUNT(ProjectId)']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
          </div>
        </div>

        <?php
          $query5 = "SELECT * FROM project WHERE progress < 100 and ServiceTypeId = 1 and isdelete = 0";
          $sqlquery5 = mysqli_query($con, $query5);
          // $ongoing_construction_projects = mysqli_fetch_assoc($sqlquery5);

          $query6 = "SELECT * FROM project WHERE progress < 100 and ServiceTypeId = 2 and isdelete = 0";
          $sqlquery6 = mysqli_query($con, $query6);
          // $ongoing_interior_projects = mysqli_fetch_assoc($sqlquery6);

          $query7 = "SELECT * FROM project WHERE progress < 100 and ServiceTypeId = 3 and isdelete = 0";
          $sqlquery7 = mysqli_query($con, $query7);
          // $ongoing_fitout_projects = mysqli_fetch_assoc($sqlquery7);
        ?>

        <div class="card">
          <div class="card-body">
            <div class="row">
              <!-- construction column -->
              <div class="col-4">
                <p class="lead">Ongoing construction projects</p>
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <?php while ($row = mysqli_fetch_assoc($sqlquery5)) : 
                            $ProjectName = $row['ProjectName'];
                            $Progress = $row['Progress'];
                      ?>
                      <th class="text-capitalize" style="width:60%"><?php echo $ProjectName; ?></th>
                      <td><?php echo $Progress; ?>% complete</td>
                    </tr>
                      <?php endwhile; ?>
                  </table>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <p class="lead">Ongoing interior design projects</p>
                </p>
                <div class="table-responsive">
                <table class="table">
                    <tr>
                      <?php while ($row = mysqli_fetch_assoc($sqlquery6)) : 
                            $ProjectName = $row['ProjectName'];
                            $Progress = $row['Progress'];
                      ?>
                      <th class="text-capitalize" style="width:60%"><?php echo $ProjectName; ?></th>
                      <td><?php echo $Progress; ?>% complete</td>
                    </tr>
                      <?php endwhile; ?>
                  </table>
                </div>
              </div>

              <div class="col-4">
                <p class="lead">Ongoing fit-out projects</p>
                <div class="table-responsive">
                <table class="table">
                    <tr>
                      <?php while ($row = mysqli_fetch_assoc($sqlquery7)) : 
                            $ProjectName = $row['ProjectName'];
                            $Progress = $row['Progress'];
                      ?>
                      <th class="text-capitalize" style="width:60%"><?php echo $ProjectName; ?></th>
                      <td><?php echo $Progress; ?>% complete</td>
                    </tr>
                      <?php endwhile; ?>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->

   <script type="text/javascript">
    window.addEventListener("load", window.print());
  </script> 
</body>

</html>