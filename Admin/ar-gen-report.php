<?php

include('config.php');
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Architect General Report</title>
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
                            <h5 class="brand-text font-weight-bold" style="color: #708090;margin-left: 30px;">Architect General Report</h5>
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

            <div class="container px-5">

                <?php
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
                                        <div class="col-4">
                                            <!-- <p class="lead">Construction</p> -->
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
                                        <div class="col-4">
                                            <!-- <p class="lead">Interior Design</p> -->
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
                                            <!-- <p class="lead">Fit-out</p> -->
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $allprojects = "SELECT COUNT(ProjectId) as AllProjects FROM `project` WHERE BlueprintStatusId BETWEEN 2 and 4 AND isdelete = 0";
                $sqlallprojects = mysqli_query($con, $allprojects);
                $tot_allprojects = mysqli_fetch_assoc($sqlallprojects);

                $newprojects = "SELECT COUNT(ProjectId) as NewProjects FROM `project` WHERE BlueprintStatusId = 1 AND isdelete = 0";
                $sqlnewprojects = mysqli_query($con, $newprojects);
                $tot_newprojects = mysqli_fetch_assoc($sqlnewprojects);

                $approved = "SELECT COUNT(ProjectId) as Approved FROM `project` WHERE BlueprintStatusId = 3 AND isdelete = 0";
                $sqlapproved = mysqli_query($con, $approved);
                $tot_approved = mysqli_fetch_assoc($sqlapproved);

                $proposed = "SELECT COUNT(ProjectId) as Proposed FROM `project` WHERE BlueprintStatusId = 2 AND isdelete = 0";
                $sqlproposed = mysqli_query($con, $proposed);
                $tot_proposed = mysqli_fetch_assoc($sqlproposed);

                $declined = "SELECT COUNT(ProjectId) as Declined FROM `project` WHERE BlueprintStatusId = 4 AND isdelete = 0";
                $sqldeclined = mysqli_query($con, $declined);
                $tot_declined = mysqli_fetch_assoc($sqldeclined);

                $dataPoints = array(
                    array("label" => "Approved", "symbol" => "Approved", "y" => $tot_approved['Approved']),
                    array("label" => "Proposed", "symbol" => "Proposed", "y" => $tot_proposed['Proposed']),
                    array("label" => "Declined", "symbol" => "Declined", "y" => $tot_declined['Declined']),
                    // array("label" => "Not Fully Paid", "symbol" => "Not Fully Paid", "y" => $tot_approved['Approved']),
                )
                ?>
                <div class="row">
                    <div class="col-8">
                        <div id="chartContainer" style="height: 170px; width: 100%;">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="info-box mb-3 bg-blue">
                            <span class="info-box-icon"><i class="fas fa-sticky-note"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total blueprints submitted</span>
                                <span class="info-box-number"><?php echo number_format($tot_allprojects['AllProjects']); ?> blueprints</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box mb-3 bg-warning">
                            <span class="info-box-icon"><i class="fas fa-file"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">New projects ( no blueprints yet )</span>
                                <span class="info-box-number"><?php echo number_format($tot_newprojects['NewProjects']); ?> blueprints</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
                <br>
                <?php
                $NoOfProjects = "SELECT employee.EmpFirstName,employee.EmpLastName,COUNT(ProjectId) as NoProjects FROM `project` JOIN employee ON project.EmpId = employee.EmpId WHERE project.isdelete = 0 GROUP BY project.EmpId ORDER BY employee.EmpLastName ASC";
                $sqlNoOfProjects = mysqli_query($con, $NoOfProjects);

                $TotalProjects = "SELECT COUNT(ProjectId) as TotalProjects FROM `project` WHERE isdelete = 0";
                $sqlTotalProjects = mysqli_query($con, $TotalProjects);
                $tot_TotalProjects = mysqli_fetch_assoc($sqlTotalProjects);

                $TotalStores = "SELECT COUNT(StoreId) as TotalStores FROM `store` WHERE isdelete = 0";
                $sqlTotalStores = mysqli_query($con, $TotalStores);
                $tot_TotalStores = mysqli_fetch_assoc($sqlTotalStores);

                $TotalMaterials = "SELECT COUNT(EquipId) as TotalMaterials FROM `materialslist` WHERE IsDelete = 0";
                $sqlTotalMaterials = mysqli_query($con, $TotalMaterials);
                $tot_TotalMaterials = mysqli_fetch_assoc($sqlTotalMaterials);

                ?>
                <div class="row">
                    <div class="col-4">
                        <div class="small-box bg-gradient-green">
                            <div class="inner">
                                <h3><?php echo $tot_TotalStores['TotalStores']; ?></h3>
                                <p>Partner Stores</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                        <div class="small-box bg-gradient-indigo">
                            <div class="inner">
                                <h3><?php echo $tot_TotalMaterials['TotalMaterials']; ?></h3>
                                <p>No. of materials available on Badac store</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-hammer"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>

                    </div>
                    <?php
                    $store = "SELECT * FROM `store` WHERE isdelete = 0";
                    $sqlStore = mysqli_query($con, $store);
                    ?>
                    <div class="col-4">
                        <div class="cadsdrd">
                            <div class="card-bsdsody p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Store Name</th>
                                                <!-- <th>Email</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($sqlStore)) :
                                                $StoreName = $row['StoreName'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $StoreName; ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <p class="text-center">
                            <strong>No. of projects per Architect</strong>
                        </p>
                        <?php while ($row = mysqli_fetch_assoc($sqlNoOfProjects)) :
                            $EmpFirstName = $row['EmpFirstName'];
                            $EmpLastName = $row['EmpLastName'];
                            $NoProjects = $row['NoProjects'];
                            $percentage = $NoProjects / $tot_TotalProjects['TotalProjects'] * 100;

                        ?>
                            <div class="progress-group text-capitalize">
                                <?php echo $EmpFirstName . ' ' . $EmpLastName; ?>
                                <span class="float-right"><b><?php echo $NoProjects; ?></b>/<?php echo $tot_TotalProjects['TotalProjects']; ?></span>
                                <div class="progress">
                                    <div class="progress-bar bg-blue progress-bar-striped" style="width: <?php echo $percentage; ?>%"></div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <h3 class="card-title">Clients with Outstanding Balance</h3> -->
                                <div class="card-title font-weight-bold">Projects expected to finish this month of <?php echo date('F'); ?></div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px">Project Id</th>
                                            <th>Project Name</th>
                                            <th>Service Type</th>
                                            <th>Estimated Finish Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $projthismonth = "SELECT project.ProjectId,project.ProjectName,servicetype.ServiceDesc,project.Estimated_Finish_Date FROM `project` JOIN servicetype ON project.ServiceTypeId = servicetype.ServiceTypeId WHERE month(Estimated_Finish_Date) = month(CURRENT_DATE)";
                                        $sqlprojthismonth = mysqli_query($con, $projthismonth);

                                        while ($row = mysqli_fetch_assoc($sqlprojthismonth)) :
                                            $ProjectId = $row['ProjectId'];
                                            $ProjectName = $row['ProjectName'];
                                            $ServiceDesc = $row['ServiceDesc'];
                                            $Estimated_Finish_Date = $row['Estimated_Finish_Date'];
                                        ?>
                                            <tr>
                                                <td><?php echo $ProjectId; ?></td>
                                                <td class="text-capitalize"><?php echo $ProjectName; ?></td>
                                                <td><?php echo $ServiceDesc; ?></td>
                                                <td><?php echo $Estimated_Finish_Date; ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
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
</body>
<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            animationEnabled: true,
            title: {

            },
            data: [{
                type: "pie",
                indexLabel: "{symbol} - {y}",
                yValueFormatString: "#,##0 Blueprints\"\"",
                showInLegend: true,
                legendText: "{label} : {y}",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();


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