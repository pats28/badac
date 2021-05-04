<?php
include_once 'config.php';
session_start();
$remove = $_GET['MaterialsId'];
    // acceptproject totalprict
    $acceptid = $_SESSION['ProjectId'];
    $query_accept = "SELECT MaterialsCost FROM acceptproject WHERE AcceptId = $acceptid";
    $res_accept = mysqli_query($con, $query_accept);
    $row_accept = mysqli_fetch_assoc($res_accept);
    // select material
    $query_getprice = "SELECT TotalPrice FROM materialsneeded WHERE MaterialsId = $remove";
    $res_getprice = mysqli_query($con, $query_getprice);
    $row_getprice = mysqli_fetch_assoc($res_getprice);
    // remove query
    $sqlRemove = "UPDATE materialsneeded SET IsDelete = 1 WHERE MaterialsId = '$remove'";
    mysqli_query($con, $sqlRemove);
    // update materialcost
    $newTotalPrice = $row_accept['MaterialsCost'] - $row_getprice['TotalPrice'];
    $query_update = "UPDATE acceptproject SET MaterialsCost = $newTotalPrice WHERE AcceptId = $acceptid";
    $res_update = mysqli_query($con, $query_update);

$_SESSION['removed'] = 1;
header("Location: shop-cart.php");

