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
    <link rel="icon" href="../img/bkicon.png" type="image/png">
    <title>Client | Log in</title>
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

<body class="hold-transition login-page" style="background-image: url(pages/img/client-cover.png); background-size:100% 100%; background-repeat:no-repeat;">
    <div class="login-box" >
        <a href="../index.php"><div class="login-logo" style="color: white;"><b>Welcome</b>Client</div><a>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body" >
                <p class="login-box-msg" >Sign in to start your session</p>
                <!-- form post -->
                <form method="post">
                    <!-- email -->
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text" >
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <!-- password -->
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text" >
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div><br><br>
                    <!-- remember -->
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember" >
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" value="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- php for login -->
                <?php
                if (isset($_POST['submit'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $sql = "select * from client where Email = '$email' AND Password = '$password';";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $ClientSessionID = $row["ClientId"];
                            $_SESSION['ClientSessionID']=$ClientSessionID;
                            echo "<script> location.replace('client-profile.php'); </script>";
                        }
                        // header("Location: index.php");
                    } else {
                        echo '<br><div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h6><i class="icon fas fa-ban"></i> Wrong email or password</h6>
                        </div>';
                    }
                }
                ?>
                <!-- /.social-auth-links -->
                <br><br>
                <p class="mb-1">
                    <a href="client-forgot-password.html">I forgot my password</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

</body>

</html>