<?php
include('config.php');
include('includes/ar-header.php');
include('includes/ar-sidebar.php');
include('includes/ar-navbar.php');
include('includes/footer.php');
// session_start();
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>

<head>
    <style>
        .container {
            position: relative;
        }

        .container img {
            display: block;
        }

        .container .fa-pen-square {
            position: absolute;
            bottom: 1px;
            left: 135px;
            /* height: 90px;
            width: 90px; */
        }
    </style>
</head>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="architect.php">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- php -->
                    <?php
                    // $ClientID = $_SESSION['ClientSessionID'];
                    $EmpId = $_SESSION['EmpId'];
                    $sql = "SELECT * FROM employee WHERE EmpId = '$EmpId';";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);

                    ?>
                    <!-- php -->

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center container">
                            <?php
                                if (empty($row['image'])) {
                                    echo "<img src='images/default-user-image.png' class='profile-user-img img-circle' style='object-fit: cover;height: 110px;width: 110px;'>";
                                } else {
                                    echo "<img class='profile-user-img img-circle' style='object-fit: cover;height: 110px;width: 110px;' src='images/$row[image]' alt='User profile picture'>";
                                }
                                ?>
                                <a href="#UpdatePhoto" data-toggle="modal" data-target="#UpdatePhoto"><i class="fas fa-pen-square fa-lg" style="color: #adb5bd;"></i></a>
                            </div>
                            <h3 class="profile-username text-center"><?php echo $row['EmpFirstName'] ?> <?php echo $row['EmpLastName'] ?></h3>
                            <p class="text-muted text-center">Architect</p>

                            <!-- modal -->
                            <div class="modal fade" id="UpdatePhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update photo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <!-- text input -->
                                                        <div class="callout callout-success">
                                                            <h5>Update your display photo</h5>
                                                            <!-- <p>Please change the default password we've given to you.</p> -->
                                                            <!-- <p>To protect the security and privacy of our employees, we're asking you to update the default password given by project manager. If you already changed your default password, ignore this message. Thank you!</p> -->
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" accept="image/x-png,image/gif,image/jpeg" name="image">
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" name="UploadPhoto">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- php photo -->
                                        <?php
                                        if (isset($_POST['UploadPhoto'])) {
                                            // $target = "images/".basename($_FILES['image']['name']);
                                            $ImageName = $_FILES['photo']['name'];
                                            $fileElementName = 'image';
                                            $path = 'images/';
                                            $location = $path . $_FILES['image']['name'];
                                            move_uploaded_file($_FILES['image']['tmp_name'], $location);
                                            $image = $_FILES['image']['name'];
                                            if (!empty($_FILES['image']['name'])) {
                                                $sqlUploadPhoto = "UPDATE employee SET image='$image' WHERE EmpId = '$EmpId'";
                                            }
                                            mysqli_query($con, $sqlUploadPhoto);
                                            $page = $_SERVER['REQUEST_URI'];
                                            echo '<script type="text/javascript">';
                                            echo 'window.location.href="ar-profile.php";';
                                            echo '</script>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <!-- <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Edit Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#update-password" data-toggle="tab">Update Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- /.profile tab -->
                                <div class="active tab-pane" id="profile">
                                    <form class="form-horizontal" method="POST">

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="none" class="form-control" name="Username" value="<?php echo $row['Username'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="none" class="form-control" name="EmpFirstName" value="<?php echo $row['EmpFirstName'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="none" class="form-control" name="EmpLastName" value="<?php echo $row['EmpLastName'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" autocomplete="none" class="form-control" name="Address" value="<?php echo $row['Address'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Contact Number</label>
                                            <div class="col-sm-10">
                                                <input type="number" autocomplete="none" class="form-control" name="ContactNum" value="<?php echo $row['ContactNum'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="Email" value="<?php echo $row['Email'] ?>" autocomplete="false">
                                            </div>
                                        </div>

                                        <div>
                                            <button type="button" data-toggle="modal" data-target="#updateModal" class="btn btn-primary shadow-lg offset-sm-2">Edit Profile</button>
                                        </div>

                                        <!-- Modal for profile update -->
                                        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update profie</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you want to save all the changes to your profile?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" name="UpdateProfile">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal -->
                                    </form>
                                </div>

                                <?php
                                if (isset($_POST['UpdateProfile'])) {

                                    $Username = $_POST['Username'];
                                    $EmpFirstName = $_POST['EmpFirstName'];
                                    $EmpLastName = $_POST['EmpLastName'];
                                    $Address = $_POST['Address'];
                                    $ContactNum = $_POST['ContactNum'];
                                    $Email = $_POST['Email'];

                                    $sqlUpdateUsername = "UPDATE employee SET Username='$Username' WHERE EmpId = '$EmpId'";
                                    $sqlUpdateFirstName = "UPDATE employee SET EmpFirstName='$EmpFirstName' WHERE EmpId = '$EmpId'";
                                    $sqlUpdateLastName = "UPDATE employee SET EmpLastName='$EmpLastName' WHERE EmpId = '$EmpId'";
                                    $sqlUpdateAddress = "UPDATE employee SET Address='$Address' WHERE EmpId = '$EmpId'";
                                    $sqlUpdateContactNum = "UPDATE employee SET ContactNum='$ContactNum' WHERE EmpId = '$EmpId'";
                                    $sqlUpdateEmail = "UPDATE employee SET Email='$Email' WHERE EmpId = '$EmpId'";

                                    mysqli_query($con, $sqlUpdateUsername);
                                    mysqli_query($con, $sqlUpdateFirstName);
                                    mysqli_query($con, $sqlUpdateLastName);
                                    mysqli_query($con, $sqlUpdateAddress);
                                    mysqli_query($con, $sqlUpdateContactNum);
                                    mysqli_query($con, $sqlUpdateEmail);

                                    $page = $_SERVER['REQUEST_URI'];
                                    echo '<script type="text/javascript">';
                                    echo 'window.location.href="ar-profile.php";';
                                    echo '</script>';
                                }
                                ?>


                                <!-- /.profile -->
                                <!-- password -->
                                <div class="tab-pane" id="update-password">
                                    <form method="POST">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <!-- text input -->
                                                    <div class="callout callout-warning">
                                                        <h5>Attention: Update your password</h5>
                                                        <!-- <p>Please change the default password we've given to you.</p> -->
                                                        <p>To protect the security and privacy of our employees, we're asking you to update the default password given by the project manager. If you already changed your default password, ignore this message. Thank you!</p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input type="text" name="Password" placeholder="New password" class="form-control">
                                                    </div>

                                                    <div>
                                                        <button type="button" name="ChangePass" data-toggle="modal" data-target="#updatePass" class="btn btn-primary shadow-lg">Change Password</button>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Modal for update password -->
                                            <div class="modal fade" id="updatePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update password</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Do you want to save the changes to your password?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary" name="UpdatePassword">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- php pasword -->
                                    <?php
                                    if (isset($_POST['UpdatePassword'])) {
                                        $Password = $_POST['Password'];
                                        $sqlUpdatePassword = "UPDATE employee SET Password='$Password' WHERE EmpId = '$EmpId'";
                                        mysqli_query($con, $sqlUpdatePassword);
                                        $page = $_SERVER['REQUEST_URI'];
                                        echo '<script type="text/javascript">';
                                        echo 'window.location.href="ar-profile.php";';
                                        echo '</script>';
                                    }
                                    ?>
                                </div>
                                <!-- password -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
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
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
<!-- ./wrapper -->