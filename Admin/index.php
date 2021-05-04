<?php
if(!isset($_SESSION))
{
  session_start();
}
else
{
  session_destroy();
  session_start();
}
// session_start();
include ('config.php');




if (isset($_POST['Enter'])) 
  {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password']  = $_POST['password'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $sql = "SELECT * FROM employee WHERE '$username' = Username AND '$password' = Password";

    $result = $con->query($sql);
                 
    if ($result->num_rows > 0)
    {
      while($row=$result->fetch_assoc())
      {                                    
        $_SESSION['EmpId'] = $row['EmpId']; 
        $_SESSION['EmpFirstName'] = $row['EmpFirstName']; 
        $_SESSION['EmpLastName'] = $row['EmpLastName']; 
        $_SESSION['DeptId']=$row['DeptId'];
        $EmpId = $_SESSION['EmpId'];
        $EmpFirstName = $_SESSION['EmpFirstName'];
        $EmpLastName = $_SESSION['EmpLastName'];
        $DeptId = $_SESSION['DeptId'];

        if ($DeptId == 1)
          header("location: projectmanager.php");
        else if ($DeptId == 2) 
          header("location: financialmanager.php");
        else
          header("location: architect.php");
      }
    }else
      {
        $message="Username and/or Password is Incorrect!";
        echo "<script type='text/javascript'>alert('$message');</script>";

      }
    mysqli_close($con);

  }
?>  



<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="../img/bkicon.png" type="image/png">
  <title>Admin | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image: url(pages/img/cover1.jpg); background-size:100% 100%; background-repeat:no-repeat;">
<div class="login-box">
  <div class="login-logo" style="color: white;">
    <a><b>Badac </b>Konstruk Inc.</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body" >
      <p class="login-box-msg" >ADMIN LOGIN</p>

      <form method="post">
        <label >Username</label>
        <div class="input-group mb-3"> 
          <input type="text" class="form-control" placeholder="Username" name = "username" value="fatimajm28">
          <div class="input-group-append">
            <div class="input-group-text" >
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <label >Password</label>
        <div class="input-group mb-3">    
          <input type="password" class="form-control" placeholder="Password" name = "password" value="fatimabadac28">
          <div class="input-group-append">
            <div class="input-group-text" >
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-8">
           
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name = "Enter" id="Enter">Enter</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

     
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>



