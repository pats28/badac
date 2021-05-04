<?php 
include('includes/ar-sidebar.php');
include('includes/ar-header.php'); 
include('includes/ar-navbar.php');
include('includes/footer.php');

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Architect</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="architect.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <?php
                    // $ClientID = $_SESSION['ClientSessionID'];
        $EmpId = $_SESSION['EmpId'];
        $sql = "SELECT * FROM employee WHERE EmpId = '$EmpId';";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
         
        $queryConstruction = "SELECT COUNT(ServiceTypeId) from project where ServiceTypeId = 1 AND EmpId = '$EmpId' AND Progress < 100";
        $sqlConstruction = mysqli_query($con, $queryConstruction);
        $count_construction = mysqli_fetch_assoc($sqlConstruction);

        $queryFitout = "SELECT COUNT(ServiceTypeId) from project where ServiceTypeId = 3 AND EmpId = '$EmpId' AND Progress < 100";
        $sqlFitout = mysqli_query($con, $queryFitout);
        $count_fitout = mysqli_fetch_assoc($sqlFitout);

        $queryInterior = "SELECT COUNT(ServiceTypeId) from project where ServiceTypeId = 2 AND EmpId = '$EmpId' AND Progress < 100";
        $sqlInterior = mysqli_query($con, $queryInterior);
        $count_interior = mysqli_fetch_assoc($sqlInterior);

        $queryConstruction2 = "SELECT AVG(Progress) from project where ServiceTypeId = 1 AND EmpId = '$EmpId' AND Progress < 100";
        $sqlConstruction2 = mysqli_query($con, $queryConstruction2);
        $count_construction2 = mysqli_fetch_assoc($sqlConstruction2);

        $queryFitout2 = "SELECT AVG(Progress) from project where ServiceTypeId = 3 AND EmpId = '$EmpId' AND Progress < 100";
        $sqlFitout2 = mysqli_query($con, $queryFitout2);
        $count_fitout2 = mysqli_fetch_assoc($sqlFitout2);

        $queryInterior2 = "SELECT AVG(Progress) from project where ServiceTypeId = 2 AND EmpId = '$EmpId' AND Progress < 100";
        $sqlInterior2 = mysqli_query($con, $queryInterior2);
        $count_interior2 = mysqli_fetch_assoc($sqlInterior2);

        $queryConstruction3 = "SELECT COUNT(ServiceTypeId) from project where ServiceTypeId = 1 AND EmpId = '$EmpId' AND Progress = 100";
        $sqlConstruction3 = mysqli_query($con, $queryConstruction3);
        $count_construction3 = mysqli_fetch_assoc($sqlConstruction3);

        $queryFitout3 = "SELECT COUNT(ServiceTypeId) from project where ServiceTypeId = 3 AND EmpId = '$EmpId' AND Progress = 100";
        $sqlFitout3 = mysqli_query($con, $queryFitout3);
        $count_fitout3 = mysqli_fetch_assoc($sqlFitout3);

        $queryInterior3 = "SELECT COUNT(ServiceTypeId) from project where ServiceTypeId = 2 AND EmpId = '$EmpId' AND Progress = 100";
        $sqlInterior3 = mysqli_query($con, $queryInterior3);
        $count_interior3 = mysqli_fetch_assoc($sqlInterior3);
      ?>

      <div class="container-fluid">
        <div class="row">
        
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon elevation-1" style="background-color:#0080FF"><i class="fas fa-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Building</span>
                <span class="info-box-number"><?php echo $count_construction ['COUNT(ServiceTypeId)']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon elevation-1" style="background-color:#588BAE"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Fit-Out</span>
                <span class="info-box-number"><?php echo $count_fitout ['COUNT(ServiceTypeId)']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon elevation-1" style="background-color:#0080FF"><i class="fas fa-folder-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Interior Design</span>
                <span class="info-box-number"><?php echo $count_interior ['COUNT(ServiceTypeId)']; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        <!-- </div> -->       <!-- row -->
        </div>
        <!-- /.row -->


   <!--  <section class="content">
      <div class="container-fluid"> -->
         <!-- row -->
        <div class="row">
          <div class="col-6" >
            <!-- jQuery Knob -->
            <div class="card">
              <div class="card-header" style="background-color:#0080FF">
                <h3 class="card-title" style="color:white">
                  <i class="far fa-chart-bar" style="color:white"></i>
                  Project Status (%)
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body"style="height: 330px">
                <div class="row">
                  <div class="col-6 col-md-6 text-center">
                    <input type="text" class="knob" value="<?php echo number_format($count_construction2 ['AVG(Progress)'], 2); ?>" data-width="90" data-height="90" data-fgColor="#3c8dbc">

                    <div class="knob-label">On-going Building Projects</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-6 col-md-6 text-center">
                    <input type="text" class="knob" value="<?php echo number_format($count_interior2 ['AVG(Progress)'], 2); ?>" data-width="90" data-height="90" data-fgColor="#f56954">

                    <div class="knob-label">On-going Interior Design Projects</div>
                  </div>
                  <!-- ./col -->
              
                </div>
                <!-- /.row -->


                <div class="row" >
                  <div class="col-12 text-center">
                    <input type="text" class="knob" value="<?php echo number_format($count_fitout2 ['AVG(Progress)'], 2); ?>" data-width="90" data-height="90" data-fgColor="#932ab6">

                    <div class="knob-label">On-going Fit-Out Projects</div>
                  </div>
                  <!-- ./col -->

                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        

          



        <!-- <div class="row"> -->
          <div class="col-6">
            <div class="card">
              <div class="card-header" style="background-color:#0080FF">
                <h3 class="card-title" style="color:white">
                  <i class="far fa-chart-bar" style="color:white"></i>
                  Project Completed
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

          
                <canvas id="barChart" style="height: 100px"></canvas>
              </div>
          </div>
        </div>
      </div>  
        



        
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  
<!-- </div> -->
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- jQuery Knob -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->

<!-- OPTIONAL SCRIPTS -->
<!--<script src="plugins/chart.js/Chart.min.js"></script>-->
<!--<script src="dist/js/demo.js"></script>-->
<!--<script src="dist/js/pages/dashboard3.js"></script>-->

<!-- jQuery Knob -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>

<script>
  $(function () {
    /* jQueryKnob */

    $('.knob').knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
      draw: function () {

        // "tron" case
        if (this.$.data('skin') == 'tron') {

          var a   = this.angle(this.cv)  // Angle
            ,
              sa  = this.startAngle          // Previous start angle
            ,
              sat = this.startAngle         // Start angle
            ,
              ea                            // Previous end angle
            ,
              eat = sat + a                 // End angle
            ,
              r   = true

          this.g.lineWidth = this.lineWidth

          this.o.cursor
          && (sat = eat - 0.3)
          && (eat = eat + 0.3)

          if (this.o.displayPrevious) {
            ea = this.startAngle + this.angle(this.value)
            this.o.cursor
            && (sa = ea - 0.3)
            && (ea = ea + 0.3)
            this.g.beginPath()
            this.g.strokeStyle = this.previousColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
            this.g.stroke()
          }

          this.g.beginPath()
          this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
          this.g.stroke()

          this.g.lineWidth = 2
          this.g.beginPath()
          this.g.strokeStyle = this.o.fgColor
          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
          this.g.stroke()

          return false
        }
      }
    })
    /* END JQUERY KNOB */

  })

</script>



    <!-- BAR GRAPH -->
<script>
  //bar
var ctxB = document.getElementById("barChart").getContext('2d');
var myBarChart = new Chart(ctxB, {
type: 'bar',
data: {
labels: [ "Building", "Fit-Out", "Interior Design"],
datasets: [{
label: '# of Projects',
data: [<?php echo json_encode($count_construction3 ['COUNT(ServiceTypeId)']);?>,
<?php echo json_encode($count_fitout3 ['COUNT(ServiceTypeId)']);?>, 
<?php echo json_encode($count_interior3 ['COUNT(ServiceTypeId)']);?>],
backgroundColor: [

'rgba(54, 162, 235, 0.2)',


'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)'
],
borderColor: [

'rgba(54, 162, 235, 1)',

'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
borderWidth: 1
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero: true
}
}]
}
}
});
</script>