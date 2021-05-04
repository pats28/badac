<?php 
// session_start();
include('includes/header.php'); 
include('includes/sidebar.php');
include ('config.php');
?>

<?php
  $query = "SELECT COUNT(StoreId) from store";
  $sql = mysqli_query($con, $query);
  $count_store = mysqli_fetch_assoc($sql);

  $query2 = "SELECT COUNT(ClientId) from project where Progress < 100";
  $sql2 = mysqli_query($con, $query2);
  $count_client = mysqli_fetch_assoc($sql2);

  $query3 = "SELECT COUNT(ProjectId) from project where Progress < 100";
  $sql3 = mysqli_query($con, $query3);
  $count_project = mysqli_fetch_assoc($sql3);
  
  $query4 = "SELECT COUNT(ClientId) from client where StatusId = 1";
  $sql4 = mysqli_query($con, $query4);
  $count_regi = mysqli_fetch_assoc($sql4);

  $queryConstruction = "SELECT COUNT(ServiceTypeId) from project where ServiceTypeId = 1 and Progress < 100";
  $sqlConstruction = mysqli_query($con, $queryConstruction);
  $count_construction = mysqli_fetch_assoc($sqlConstruction);

  $queryFitout = "SELECT COUNT(ServiceTypeId) from project where ServiceTypeId = 3 and Progress < 100";
  $sqlFitout = mysqli_query($con, $queryFitout);
  $count_fitout = mysqli_fetch_assoc($sqlFitout);

  $queryInterior = "SELECT COUNT(ServiceTypeId) from project where ServiceTypeId = 2 and Progress < 100";
  $sqlInterior = mysqli_query($con, $queryInterior);
  $count_interior = mysqli_fetch_assoc($sqlInterior);
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Project Manager</h1>
          </div><!-- /.col -->
         <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#0080FF">
              <div class="inner" style="color:#ffffff">
                <h3><?php echo $count_store ['COUNT(StoreId)']; ?></h3>

                <p>Vendors</p>
              </div>
              <div class="icon">
                <i class="ionicons ion-home"></i>
              </div>
              <!--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
            <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#588BAE">
              <div class="inner" style="color:#ffffff">
                <h3><?php echo $count_client ['COUNT(ClientId)']; ?></h3>

                <p>Clients</p>
              </div>
              <div class="icon">
                <i class="ionicons ion-person-stalker"></i>
              </div>
              <!--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#0080FF">
              <div class="inner" style="color:#ffffff">
                <h3><?php echo $count_project ['COUNT(ProjectId)']; ?></h3>

                <p>Projects</p>
              </div>
              <div class="icon">
                <!--<i class="ionicons ion-stats-bars"></i>-->
                <i class="ionicons ion-folder"></i>
              </div>
              <!--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#588BAE">
              <div class="inner" style="color:#ffffff">
                <h3><?php echo $count_regi ['COUNT(ClientId)']; ?></h3>

                <p>Registrations</p>
              </div>
              <div class="icon">
                <i class="ionicons ionicons ion-person-add"></i>
              </div>
              <!--<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
         <div class="row">
          <!-- Left col -->

          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header" style="background-color:#0080FF">
                <h3 class="card-title" style="color:white">
                  <i class="ion ion-clipboard mr-1" style="color:white"></i>
                  Projects
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- BAGONG GRAPH -->
                <canvas id="canvas" style="height: 650px; display: block; width: 1028px;"></canvas>
        

              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              <!-- <button id="randomizeData">Randomize Data</button> -->
              </div>
            </div>
            <!-- /.card -->
            <!-- Calendar -->
          
            <!-- /.card -->
          </section>

          <section class="col-lg-6 connectedSortable">
            <div class="card" >
              <div class="card-header" style="background-color:#0080FF">
                <h3 class="card-title" style="color:white">
                  <i class="ion ion-clipboard mr-1" style="color:white"></i>
                  Projects
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- BAGONG GRAPH -->
                <canvas id="myChart" style="height: 650px; display: block; width: 1028px;"></canvas>
        

              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              <!-- <button id="randomizeData"></button> -->
              </div>
            </div>
            
          </section>
          <!-- right col -->
        </div>
            <!-- /.card -->
            <!-- Calendar -->
          
            <!-- /.card -->
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
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

<?php

$sqlData = sprintf("SELECT ")

?>
<?php include('includes/footer.php'); ?>
