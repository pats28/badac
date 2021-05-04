<?php 
include('includes/fm-sidebar.php');
include('includes/fm-header.php'); 
include('includes/fm-navbar.php');
include('includes/footer.php');
include ('config.php');
?>

<?php

  $query = "SELECT SUM(Balance) from payment";
  $sql = mysqli_query($con, $query);
  $totalbalance = mysqli_fetch_assoc($sql);

  $query2 = "SELECT SUM(Amount) from expenses";
  $sql2 = mysqli_query($con, $query2);
  $totalamount = mysqli_fetch_assoc($sql2);

  $query3 = "SELECT SUM(Initial_Payment) from payment";
  $sql3 = mysqli_query($con, $query3);
  $totalpayment = mysqli_fetch_assoc($sql3);

  $query4 = "SELECT COUNT(ClientId) from client where StatusId = 3";
  $sql4 = mysqli_query($con, $query4);
  $count_client = mysqli_fetch_assoc($sql4);
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Financial Manager | Dashboard</title>
  <meta http-equiv="x-ua-compatible" content="ie=edge">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Financial Manager</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="financialmanager.php">Home</a></li>
              <li class="breadcrumb-item">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon elevation-1" style="background-color:#0080FF"><i class="fab fa-amazon-pay"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Payment</span>
                <span class="info-box-number">
                  <?php echo number_format($totalpayment ['SUM(Initial_Payment)']); ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon elevation-1" style="background-color:#588BAE"><i class="fa fa-credit-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Balance</span>
                <span class="info-box-number">
                  <?php echo number_format($totalbalance ['SUM(Balance)']); ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon elevation-1" style="background-color:#0080FF"><i class="far fa-money-bill-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Expenses</span>
                <span class="info-box-number">
                  <?php echo number_format($totalamount ['SUM(Amount)']); ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          
          
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon elevation-1" style="background-color:#588BAE"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Client</span>
                <span class="info-box-number">
                  <?php echo $count_client ['COUNT(ClientId)']; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
         
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            
          <!--<div class="col-lg-6">-->
          <!-- <div class="card">-->
          <!--    <div class="card-header border-0">-->
          <!--      <div class="d-flex justify-content-between">-->
          <!--        <h3 class="card-title">Profit</h3>-->
          <!--        <a href="javascript:void(0);">View Report</a>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--    <div class="card-body">-->
          <!--      <div class="d-flex">-->
          <!--         <p class="d-flex flex-column">-->
          <!--          <span class="text-bold text-lg">820</span>-->
          <!--          <span>Visitors Over Time</span>-->
          <!--        </p> -->
          <!--      </div>-->
          <!--       /.d-flex -->
          <!--      <br> <br> <br>-->

          <!--      <div class="position-relative mb-4">-->
          <!--        <canvas id="visitors-chart" height="200"></canvas>-->
          <!--      </div>-->

          <!--      <div class="d-flex flex-row justify-content-end">-->
          <!--        <span class="mr-2">-->
          <!--          <i class="fas fa-square text-primary"></i> This Week-->
          <!--        </span>-->

          <!--        <span>-->
          <!--          <i class="fas fa-square text-gray"></i> Last Week-->
          <!--        </span>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--  </div>-->

         <section class="col-lg-12">
            <div class="card">
              <div class="card-header" style="background-color:#588BAE">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Profit</h3>
                  <!-- <a href="javascript:void(0);">View Report</a> -->
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  
                  
                </div>
                <!-- /.d-flex -->
                  <br><br><br>
                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="260"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div>
              </div>
            </section>

            

          
            <!-- /.card -->
            
          </div>

          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>
    $(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, <?php echo json_encode($totalpayment ['SUM(Initial_Payment)']);?>]
        },
        {
          backgroundColor: '#ced4da',
          borderColor    : '#ced4da',
          data           : [0, 0, 0, 0, 0, 0,0, 0, 0, 0, 0, 0]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect

      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }
              return '₱' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})
</script>
