<?php
error_reporting(E_ERROR);

include ('config.php');
if (!isset($_SESSION)) {
  session_start();
}
require("config.php");

$EmpId = $_SESSION['EmpId'];
$EmpFirstName = $_SESSION['EmpFirstName'];
$EmpLastName = $_SESSION['EmpLastName'];

$sql = "SELECT * FROM employee as e, department as d WHERE EmpId = '$EmpId' AND e.DeptId = d.DeptId;";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>

 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed; background-color:#708090">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style="background-color: black">
      <img src="dist/img/BKIlogo.png" class="brand-image img-rectangle elevation-3"
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
          echo "<img src='images/$row[image] ' class='img-circle elevation-2' style='object-fit: cover;height: 35px;width: 35px;'>";
        }
        ?>
      </div>
      <div class="info">
        <a href="fm-profile.php" class="d-block" style="color:black" name="<?php echo $EmpFirstName; ?>"><?php echo $row['EmpFirstName'] ?> <?php echo $row['EmpLastName'] ?></a>
        <a href="#" style = "font-weight: bold; color: black;"><?php echo $row[DeptName]; ?></a>
      </div>
    </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item"> <!-- has-treeview menu-open -->
            <a href="financialmanager.php"  class="nav-link " style="color:black"> <!-- active -->
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               <!--  <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/pmlogin.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Manager</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/fmlogin.html" class="nav-link active">
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
          <!--  <a href="fm-mailbox.php" class="nav-link" style="color:black">-->
          <!--    <i class="nav-icon far fa-envelope"></i>-->
          <!--    <p>-->
          <!--      Messages-->
          <!--      <span class="right badge badge-danger">New</span>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--</li>-->
          <li class="nav-item has-treeview">
            <a href="fm-client-payment.php" class="nav-link" style="color:black">
              <i class="nav-icon fa fa-credit-card"></i>
              <p>
                Client's Payment 
                <!--<span class="badge badge-info right">6</span>-->
              </p>
            </a>
            
          </li>
          <li class="nav-item has-treeview">
            <a href="fm-materials.php" class="nav-link" style="color:black">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>Materials Expenses</p>
            </a> 
          </li>
          <li class="nav-item has-treeview">
          <a href="fm-budget-request.php" class="nav-link" style="color:black">
            <i class="nav-icon  fas fa-money-bill-alt"></i>
            <p>Budget Request</p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="fm-expenses.php" class="nav-link" style="color:black">
            <i class="nav-icon  fas fa-money-bill-alt"></i>
            <p>Expenses Record</p>
          </a>
        </li>
          <li class="nav-item has-treeview">
            <a class="nav-link" style="color:black">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Contacts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="fm-contact-vendor.php" class="nav-link" style="color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Store</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="fm-contact-client.php" class="nav-link" style="color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Client</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="fm-contact-employee.php" class="nav-link" style="color:white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee</p>
                </a>
              </li>  
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="fm-gen-report.php" target="_blank" class="nav-link" style="color:black">
              <i class="nav-icon far fa-file-alt"></i>
              <p>Reports</p>
            </a> 
          </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>