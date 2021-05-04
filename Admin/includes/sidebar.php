<?php
//error_reporting(E_ERROR);
error_reporting(0);

// include ('config.php');
// require("config.php");
require('config.php');
if (!isset($_SESSION)) {
  session_start();
}

$EmpId = $_SESSION['EmpId'];
$EmpFirstName = $_SESSION['EmpFirstName'];
$EmpLastName = $_SESSION['EmpLastName'];

$sql = "SELECT * FROM employee as e, department as d WHERE e.EmpId = '$EmpId' AND e.DeptId = d.DeptId;";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!--already define sa header -->
<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed; background-color:#708090">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style= "background-color: black">
      <img src="dist/img/BKIlogo.png"  class="brand-image img-rectangle elevation-3"
          style="opacity: .8">
      <span class="brand-text font-weight-bold" style="color: #708090">Badac Konstruk Inc.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php
        if (empty($row['image'])) {
          echo "<img src='images/default-user-image.png' class='img-circle elevation-2' style='object-fit: cover;height: 35px;width: 35px;'>";
        } else {
          echo "<img src='images/$row[image]' class='img-circle elevation-2' style='object-fit: cover;height: 35px;width: 35px;'>";
        }
        ?>
      </div>
        <div class="info" >
          <a href="pm-profile.php" class="d-block" style="color:black" name="<?php echo $EmpFirstName; ?>"><?php echo $EmpFirstName." ".$EmpLastName; ?></a>
          <a href="#" style = "font-weight: bold; color: black;"><?php echo $row[DeptName]; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item " >  <!-- has-treeview menu-open -->
            <a href="projectmanager.php" class="nav-link" style= "color:black">   <!-- class="nav-link active" -->
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/pmlogin.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Manager</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/fmlogin.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Financial Manager</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/archilogin.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Architect</p>
                </a>
              </li>
            </ul> -->
          </li>
          <!--<li class="nav-item">-->
          <!--  <a href="pm-mailbox.php" class="nav-link" style= "color:black">-->
          <!--    <i class="nav-icon far fa-envelope"></i>-->
          <!--    <p>-->
          <!--      Messages-->
          <!--      <span class="right badge badge-primary">New</span>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          <li class="nav-item">
            <a href="pm-clients.php" class="nav-link" style= "color:black">
              <i class="nav-icon far fa-user"></i>
              <p>
                Clients
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a  class="nav-link" style= "color:black">
              <i class="nav-icon fa fa-user-plus"></i>
              <p>
                Registrations
                <i class="right fas fa-angle-left"></i>
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pm-registrations-construction.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Building</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-registrations-fitout.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fit-Out</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-registrations-interiordesign.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Interior Design</p>
                </a>
              </li>  
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" style= "color:black">
              <i class="nav-icon fa fa-image"></i>
              <p>
                Blueprints / Designs
                <i class="right fas fa-angle-left"></i>
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a href="pm-blueprints-construction.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Building</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-blueprints-fitout.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fit-Out</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-blueprints-interiordesign.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Interior Design</p>
                </a>
              </li>  
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" style= "color:black">
              <i class="nav-icon far fa-folder-open"></i>
              <p>
                Projects
                <i class="right fas fa-angle-left"></i>
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a href="pm-projects-construction.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Building</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-projects-fitout.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fit-Out</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-projects-interiordesign.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Interior Design</p>
                </a>
              </li>  
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" style= "color:black">
              <i class="nav-icon fa fa-check-square"></i>
              <p>
                Finished Projects
                <i class="right fas fa-angle-left"></i>
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a href="pm-finished-construction.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Building</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-finished-fitout.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fit-Out</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-finished-interiordesign.php" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Interior Design</p>
                </a>
              </li>  
            </ul>
          </li>


          <li class="nav-item">
            <a href="pm-employees.php" class="nav-link" style= "color:black">
              <i class="nav-icon far fa-user"></i>
              <p>
                Employees
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a  class="nav-link" style= "color:black">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Contacts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pm-contact-vendor.php?q=bki.pm-contact-vendor" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Store</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-contact-client.php?q=bki.pm-contact-client" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Client</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-contact-employee.php?q=bki.pm-contact-employee" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee</p>
                </a>
              </li>  
            </ul>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a class="nav-link" style= "color:black">
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> 
            <ul class="nav nav-treeview">
              <li class="nav-item" >
                <a href="pm-report.php?q=bki.pm-report-construction" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Construction</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-report-fitout.php?q=bki.pm-report-fitout" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fit-Out</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pm-report-interior?q=bki.pm-report-interior" class="nav-link" style= "color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Interior Design</p>
                </a>
              </li>  
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="pm-gen-report.php" target="_blank" class="nav-link" style= "color:black">
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>