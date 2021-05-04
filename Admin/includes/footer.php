<!--MODALS-->
    <!-- blueprint - Interiordesign validation modal -->
<div class="modal fade" id="viewBlueprintInterior" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="exampleModalLabel">Validate Blueprint</h4>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="blueprint-interior-details">
                   
                </div>
                <div class="modal-footer">
                    
                    <!-- <button type="submit" class="btn btn-primary" name="addproject">Save</button>   -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
  <!-- blueprint - Fitout validation modal -->
<div class="modal fade" id="viewBlueprintFitout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="exampleModalLabel">Validate Blueprint</h4>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="blueprint-fitout-details">
                   
                </div>
                <div class="modal-footer">
                    
                    <!-- <button type="submit" class="btn btn-primary" name="addproject">Save</button>   -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
  <!-- blueprint - Construction validation modal -->
<div class="modal fade" id="viewBlueprint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="exampleModalLabel">Validate Blueprint</h4>
                    </center>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="blueprint-details">
                   
                </div>
                <div class="modal-footer">
                    
                    <!-- <button type="submit" class="btn btn-primary" name="addproject">Save</button>   -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Project Modal -->
<div class="modal fade" id="viewProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <center>
                        <h4 class="modal-title" id="exampleModalLabel">Project Details</h4>
                    </center>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="project-details">
                    
                </div>

                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary" name="addproject">Save</button>   -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Edit Approve Modal -->
<div id="show-editapprove" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <!-- <h4  class="fas fa-exclamation-triangle"></h4> -->
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ProjectId" value="<?php echo $ProjectId; ?>">
                    <div class="alert alert-default">Are you sure you want to approve <strong>
                            <?php echo $Blueprint; ?>?</strong> </div>


                    <div class="modal-footer">

                        <button type="submit" name="editapprove" class="btn btn-warning"><span class="glyphicon glyphicon-trash"></span> Approve</button>

                        <button type="submit" name="editreject" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Reject</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--END OF MODALS-->

<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="dist/js/pages/dashboard.js"></script>-->

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<!--DASHBOARD-->
<script>
var lineChartData = {
	labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	datasets: [{
		label: 'Previous year dataset',
		borderColor: window.chartColors.gray,
		backgroundColor: window.chartColors.gray,
		fill: false,
		data: [
			0,
  0,
  0,
  0,
  0,
  0,
  0,
  0,
  0,
  0,
  0,
  0
		],
		yAxisID: 'y-axis-1',
	}, {
		label: 'Current year dataset',
		borderColor: window.chartColors.blue,
		backgroundColor: window.chartColors.blue,
		fill: false,
		data: [
			// randomScalingFactor(),
			// randomScalingFactor(),
			// randomScalingFactor(),
//                randomScalingFactor(),
//                randomScalingFactor(),
			// randomScalingFactor(),
//                randomScalingFactor(),
//                randomScalingFactor(),
//                randomScalingFactor(),
//                randomScalingFactor(),
//                randomScalingFactor(),
			// randomScalingFactor()
  0,
  0,
  0,
  0,
  0,
  0,
  0,
  0,
  0,
  0,
  0,
  <?php echo json_encode($count_project ['COUNT(ProjectId)']);?>
		],
		yAxisID: 'y-axis-2'
	}]
};

window.onload = function() {
	var ctx = document.getElementById('canvas').getContext('2d');
	window.myLine = Chart.Line(ctx, {
		data: lineChartData,
		options: {
			responsive: true,
			hoverMode: 'index',
			stacked: false,
			title: {
				display: true,
				text: 'Projects 2021'
			},
			scales: {
				yAxes: [{
					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
					display: true,
					position: 'left',
					id: 'y-axis-1',
				}, {
					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
					display: true,
					position: 'right',
					id: 'y-axis-2',

					// grid line settings
					gridLines: {
						drawOnChartArea: false, // only want the grid lines for one axis to show up
					},
				}],
			}
		}
	});
};

document.getElementById('randomizeData').addEventListener('click', function() {
	lineChartData.datasets.forEach(function(dataset) {
		dataset.data = dataset.data.map(function() {
			return randomScalingFactor();
		});
	});

	window.myLine.update();
});
</script>

<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
type: 'pie',
data: {
labels: ["Building", "Fit-Out", "Interior Design"],
datasets: [{
backgroundColor: [
"#2ecc71",
"#3498db",


"#e74c3c"

],
data: [<?php echo json_encode($count_construction ['COUNT(ServiceTypeId)']);?>, 
<?php echo json_encode($count_fitout ['COUNT(ServiceTypeId)']);?>, 
<?php echo json_encode($count_interior ['COUNT(ServiceTypeId)']);?>]
}]
}
});
</script>



<!-- FOR FINANCIAL MANAGER -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!--<script src="plugins/jquery/jquery.min.js"></script>-->
<!-- Bootstrap -->
<!--<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<!-- overlayScrollbars -->
<!--<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>-->
<!-- AdminLTE App -->
<!--<script src="dist/js/adminlte.js"></script>-->

<!-- OPTIONAL SCRIPTS -->
<!--<script src="dist/js/demo.js"></script>-->

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<!--<script src="plugins/chart.js/Chart.min.js"></script>-->

<!-- PAGE SCRIPTS -->
<!--<script src="dist/js/pages/dashboard2.js"></script>-->
<!--<script src="dist/js/pages/dashboard.js"></script>-->

<!--<script src="dist/js/adminlte.min.js"></script>-->
<!-- AdminLTE for demo purposes -->
<!--<script src="dist/js/demo.js"></script>-->

<!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.2
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
</footer>
 -->
 
<!--Data Table-->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!--NEW JS-->
<script>
    $(function() {
        $("#example1").DataTable({
            "order": [
                [3, "asc"]
            ]
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>

<script>
    /*--
    Display Modal of Blueprint - Interiordesign
    -----------------------------------*/
    $(document).on('click', '.show-blueprint-interior', function(){  
       var ID = $(this).attr("id");  
       if(ID != '')  
       {  
            $.ajax({  
                 url:"modals/modal_blueprint_interior.php",  
                 method:"POST",  
                 data:{ID:ID},
                 success:function(data){  
                      $('#blueprint-interior-details').html(data);  
                      $('#viewBlueprintInterior').modal('show');  
                 }  
            });  
        }            
    });
    /*--
    Display Modal of Blueprint - Fitout
    -----------------------------------*/
    $(document).on('click', '.show-blueprint-fitout', function(){  
       var ID = $(this).attr("id");  
       if(ID != '')  
       {  
            $.ajax({  
                 url:"modals/modal_blueprint_fitout.php",  
                 method:"POST",  
                 data:{ID:ID},
                 success:function(data){  
                      $('#blueprint-fitout-details').html(data);  
                      $('#viewBlueprintFitout').modal('show');  
                 }  
            });  
        }            
    });
    /*--
    Display Modal of Blueprint - Construction
    -----------------------------------*/
    $(document).on('click', '.show-blueprint', function(){  
       var ID = $(this).attr("id");  
       if(ID != '')  
       {  
            $.ajax({  
                 url:"modals/modal_blueprint.php",  
                 method:"POST",  
                 data:{ID:ID},  
                 success:function(data){  
                      $('#blueprint-details').html(data);  
                      $('#viewBlueprint').modal('show');  
                 }  
            });  
        }            
    });
    /*--
    Display Modal of Project
    -----------------------------------*/
    $(document).on('click', '.show-project', function(){  
       var ID = $(this).attr("id");  
       if(ID != '')  
       {  
            $.ajax({  
                 url:"modals/modal_project.php",  
                 method:"POST",  
                 data:{ID:ID},  
                 success:function(data){  
                      $('#project-details').html(data);  
                      $('#viewProject').modal('show');  
                 }  
            });  
        }            
    });
</script>
<!--END NEW JS-->
</body>
</html>