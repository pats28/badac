<?php 
 
include ('config.php');
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Generate Report | Construction</title>
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
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <!--<a href="" class="brand-link" style= "background-color: white">-->
      <img src="dist/img/BKIlogo.png"  class="brand-image img-rectangle elevation-3"
          style="opacity: .8;  width: 1.60cm; height: 1cm">
      <span class="brand-text font-weight-bold" style="color: #708090">Badac Konstruk Inc.</span>
    </a>
          <small class="float-right">Date: 2/10/2014</small>
        </h2>
      </div>
      <!-- /.col -->
    </div> <br>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Office Address:
        <address>
          Lot 24/23 Navarro Compound,<br>
          Rose Ann Subdivision,<br>
          San Roque, Cainta, Rizal<br>
          <b>Phone:</b> (865) 33-791<br>
          <b>Email:</b> badackonstrukinc@yahoo.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Project Name: </b>#007612<br>
        <br>
        <b>Client:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Managed by:</b> 968-34567
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
<br><br>
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Date</th>
            
            <th>Description</th>
            <th>Qty</th>
            <th>Amount</th>
            <th>Total</th>
          </tr>
          </thead>
          <tbody>
          <tr>
             <td>2/10/2014</td>
             <td>Hollow Blocks - 8</td>
             <td>1</td>
             <td>$265.24</td>
             <td>$64.50</td>
          </tr>
          <tr>
              <td>2/10/2014</td>
             <td>Bistay</td>
             <td>1</td>
             <td>$265.24</td>
             <td>$50.00</td>
          </tr>
          <tr>
             <td>2/10/2014</td>
            <td>Chichibu White Cement</td>
            <td>1</td>
            <td>$265.24</td>
            <td>$10.70</td>
          </tr>
          <tr>
             <td>2/10/2014</td>
             <td>Apo Panda Yero - 8ft</td>
             <td>1</td>
             <td>$265.24</td>
             <td>$25.99</td>
          </tr>
          <tr><br></tr>
          <tr>
              <td></td>
              <th>TOTAL SERVICES</th>
              <td><b>5</b></td>
              <td></td>
              <td><b>$265.24</b></td>
            </tr>
            
            <tr>
              <td></td>
              <th></th>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <th>SUBTOTAL</th>
              <td><b>$265.24</b></td>
            </tr>
            
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
      </div>
      <!-- /.col -->
      
      <!-- /.col -->
    </div>

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
      </div>
      <!-- /.col -->
      <div class="col-6" >
        <p class="lead">Account Summary</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Billed to Date:</th>
              <td> $250.30</td>
            </tr>
            <tr>
              <th>Paid to Date:</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Balance Due:</th>
              <td>$5.80</td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</body>
</html>
