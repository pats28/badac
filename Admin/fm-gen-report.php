<?php

include('config.php');
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Financial Manager Report</title>
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
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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
                            <h5 class="brand-text font-weight-bold" style="color: #708090;margin-left: 25px;">Financial Manager Report</h5>
                            <!-- <small class="float-right mt-1 text-xs">Date: <?php echo date("l, F d, Y g:i A"); ?></small> -->
                        </h2>
                    </div>
                    <!-- /.col -->
                    <div class="col-6 mt-4">
                        <h6 class="float-right mr-5"><strong>Address:</strong> Lot 24/23 Navarro Compound,</h6>
                        <h6 class="float-right mr-5">Rose Ann Subdivision, San Roque, Cainta, Rizal</h6>
                        <!-- <h6 class="float-right mr-5"><strong>Phone:</strong>(865) 33-791</h6><br> -->
                        <h6 class="float-right mr-5"><strong>Email:</strong> badackonstrukinc@yahoo.com</h6>
                        <h6 class="float-right mr-5"><strong>Printed:</strong> <?php date_default_timezone_set('Asia/Manila');
                                                                                echo date("l, F d, Y g:i A"); ?></h6>
                        <h6 class="float-right mr-5"><strong>Phone:</strong>(865) 33-791</h6>
                    </div>
                </div>
                <hr style="width: 85%;background-color: #708090;height: 1px;">
            </div>

            <br>
            <div class="container px-5">

                <?php
                $query = "SELECT SUM(Assessment) as TotalAssessment FROM `payment` WHERE isdelete = 0";
                $sql = mysqli_query($con, $query);
                $tot_assessment = mysqli_fetch_assoc($sql);

                $query2 = "SELECT SUM(Amount) as Amount FROM `paymentbreakdown`";
                $sql2 = mysqli_query($con, $query2);
                $tot_payments = mysqli_fetch_assoc($sql2);

                $tot_balance = $tot_assessment['TotalAssessment'] - $tot_payments['Amount'];

                $query9 = "SELECT SUM(Amount) as Expenses from expenses";
                $sql9 = mysqli_query($con, $query9);
                $tot_expenses = mysqli_fetch_assoc($sql9);

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

                    <div class="col-lg-3 col-sm-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>₱ <?php echo number_format($tot_assessment['TotalAssessment']); ?></h3>
                                <p>Total Assessment</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-coins"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>₱ <?php echo number_format($tot_payments['Amount']); ?></h3>
                                <p>Total Payments</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-check"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>₱ <?php echo number_format($tot_balance); ?></h3>

                                <p>Total Clients Balance</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>₱ <?php echo number_format($tot_expenses['Expenses']); ?></h3>

                                <p>Total Expenses</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-store"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <!--  -->
                <?php
                $fullypaid = "SELECT COUNT(PaymentId) as FullyPaid FROM `payment` WHERE Balance = 0 and isdelete = 0";
                $sqlfullypaid = mysqli_query($con, $fullypaid);
                $tot_fullypaid = mysqli_fetch_assoc($sqlfullypaid);

                $notfullypaid = "SELECT COUNT(PaymentId) as NotFullyPaid FROM `payment` WHERE Balance > 0 and isdelete = 0";
                $sqlnotfullypaid = mysqli_query($con, $notfullypaid);
                $tot_notfullypaid = mysqli_fetch_assoc($sqlnotfullypaid);

                $dataPoints = array(
                    array("label" => "Fully Paid", "symbol" => "Fully Paid", "y" => $tot_fullypaid['FullyPaid']),
                    array("label" => "Not Fully Paid", "symbol" => "Not Fully Paid", "y" => $tot_notfullypaid['NotFullyPaid']),
                )
                ?>
                <div class="row">
                    <div class="col-8">
                        <div id="chartContainer" style="height: 170px; width: 100%;">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="info-box mb-3 bg-success">
                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Fully Paid Clients</span>
                                <span class="info-box-number"><?php echo number_format($tot_fullypaid['FullyPaid']); ?> clients</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box mb-3 bg-warning">
                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Not Fully Paid Clients</span>
                                <span class="info-box-number"><?php echo number_format($tot_notfullypaid['NotFullyPaid']); ?> clients</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <?php
                    $today = date('m');
                    $thismonth = $today - 1;
                    $last1months = date('F', strtotime('-1 month'));
                    $last2month = date('F', strtotime('-2 month'));
                    $last3month = date('F', strtotime('-3 month'));

                    $thismonth = "SELECT SUM(Amount) as Amount FROM `paymentbreakdown` WHERE month(Date_Payment) = month(CURRENT_DATE)";
                    $sqlthismonth = mysqli_query($con, $thismonth);
                    $tot_thismonth = mysqli_fetch_assoc($sqlthismonth);

                    $last1month = "SELECT SUM(Amount) as Amount FROM `paymentbreakdown` WHERE month(Date_Payment) = month(CURRENT_DATE) - 1";
                    $sqllast1month = mysqli_query($con, $last1month);
                    $tot_last1month = mysqli_fetch_assoc($sqllast1month);

                    $last2months = "SELECT SUM(Amount) as Amount FROM `paymentbreakdown` WHERE month(Date_Payment) = month(CURRENT_DATE) - 2";
                    $sqllast2months = mysqli_query($con, $last2months);
                    $tot_last2months = mysqli_fetch_assoc($sqllast2months);

                    $last3months = "SELECT SUM(Amount) as Amount FROM `paymentbreakdown` WHERE month(Date_Payment) = month(CURRENT_DATE) - 3";
                    $sqllast3months = mysqli_query($con, $last3months);
                    $tot_last3months = mysqli_fetch_assoc($sqllast3months);

                    ?>
                    <div class="col-4">
                        <div class="info-box mb-3 bg-warning">
                            <span class="info-box-icon"><i class="fas fa-coins"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo date('F'); ?></span>
                                <span class="info-box-number"><?php echo '₱ ' . number_format($tot_thismonth['Amount']); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box mb-3 bg-success">
                            <span class="info-box-icon"><i class="fas fa-coins"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo $last1months; ?></span>
                                <span class="info-box-number"><?php echo '₱ ' . number_format($tot_last1month['Amount']); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box mb-3 bg-danger">
                            <span class="info-box-icon"><i class="fas fa-coins"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo $last2month; ?></span>
                                <span class="info-box-number"><?php echo '₱ ' . number_format($tot_last2months['Amount']); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box mb-3 bg-info">
                            <span class="info-box-icon"><i class="fas fa-coins"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo $last3month; ?></span>
                                <span class="info-box-number"><?php echo '₱ ' . number_format($tot_last3months['Amount']); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-8">
                        <?php

                        $dataPoints2 = array(
                            array("y" => $tot_last3months['Amount'], "label" => $last3month),
                            array("y" => $tot_last2months['Amount'], "label" => $last2month),
                            array("y" => $tot_last1month['Amount'], "label" => $last1months),
                            array("y" => $tot_thismonth['Amount'], "label" => date('F')),
                        );

                        ?>
                        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <h3 class="card-title">Clients with Outstanding Balance</h3> -->
                                <div class="card-title font-weight-bold">Clients with Outstanding Balance</div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">ID</th>
                                            <th>Project Name</th>
                                            <th>Total Assessment</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $balance = "SELECT * FROM `payment` JOIN project on project.ProjectId = payment.ProjectId WHERE Balance > 0 and payment.isdelete = 0";
                                        $sqlbalance = mysqli_query($con, $balance);

                                        while ($row = mysqli_fetch_assoc($sqlbalance)) :
                                            $ProjectId = $row['ProjectId'];
                                            $ProjectName = $row['ProjectName'];
                                            $Assessment = $row['Assessment'];
                                            $Balance = $row['Balance'];
                                        ?>
                                            <tr>
                                                <td><?php echo $ProjectId; ?></td>
                                                <td><?php echo $ProjectName; ?></td>
                                                <td>₱ <?php echo number_format($Assessment); ?></td>
                                                <td>₱ <?php echo number_format($Balance); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>
<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            animationEnabled: true,
            title: {

            },
            data: [{
                type: "doughnut",
                indexLabel: "{symbol} - {y}",
                yValueFormatString: "#,##0 Clients\"\"",
                showInLegend: true,
                legendText: "{label} : {y}",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

        var chart2 = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Clients Monthly Payments"
            },
            axisY: {
                title: "Payments (Peso)"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## Pesos",
                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart2.render();
        

    }
    window.print();
    // window.addEventListener("load", window.print());
    // print();
</script>

<!-- <script type="text/javascript">
        window.addEventListener("load", window.print());
</script> -->

</html>
<!-- <script>window.print();</script> -->