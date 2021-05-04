<?php
include('config.php');
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project Contract</title>
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
    <div class="container">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="container">
                <div class="row ml-5">
                    <div class="col-6 mt-4">
                        <h2 class="page-header">
                            <!--<a href="" class="brand-link" style= "background-color: white">-->
                            <img src="dist/img/BKIlogo.png" class="brand-image img-rectangle" style="opacity: .8;height: 65px;width: 100px;margin-left: 90px;">
                            <h2 class="brand-text font-weight-bold" style="color: #708090;">Badac Konstruk Inc.</h2>
                            <!-- <h5 class="brand-text font-weight-bold" style="color: #708090;margin-left: 75px;">Project Contract</h5> -->
                            <!-- <small class="float-right mt-1 text-xs">Date: <?php echo date("l, F d, Y g:i A"); ?></small> -->
                        </h2>
                    </div>
                    <!-- /.col -->
                    <div class="col-6 mt-5">
                        <h6 class="float-right mr-5"><strong>Address:</strong> Lot 24/23 Navarro Compound,</h6>
                        <h6 class="float-right mr-5">Rose Ann Subdivision, San Roque, Cainta, Rizal</h6>
                        <!-- <h6 class="float-right mr-5"><strong>Phone:</strong>(865) 33-791</h6><br> --><br>
                        <h6 class="float-right mr-5"><strong>Email:</strong> badackonstrukinc@yahoo.com</h6>
                        <h6 class="float-right mr-1"><strong>Phone:</strong>(865) 33-791</h6>
                    </div>
                </div>
                <hr style="width: 85%;background-color: #708090;height: 1px;">
            </div>

            <br><br>
            <div class="container px-5">
                <!-- insert query hereeee -->
                <?php
                // get client info
                $client = $_GET['ClientId'];
                // 
                $q_client = "SELECT * FROM client WHERE ClientId = $client";
                $res_client = mysqli_query($con, $q_client);
                $row_client = mysqli_fetch_assoc($res_client);
                // get acceptproj info
                $q_accept = "SELECT * FROM acceptproject WHERE ClientId = $client";
                $res_accept = mysqli_query($con, $q_accept);
                $row_accept = mysqli_fetch_assoc($res_accept);

                // new date
                $StartDate = strtotime($row_accept['StartDate']);
                $newStartDate = date('F jS Y', $StartDate);
                $DueDate = strtotime($row_accept['DueDate']);
                $newDueDate = date('F jS Y', $DueDate);

                // get floorarea
                $q_floor = "SELECT e_Floor_Area FROM estimate WHERE ClientId = $client";
                $res_floor = mysqli_query($con, $q_floor);
                $row_floor = mysqli_fetch_assoc($res_floor);
                $floor_area = $row_floor['e_Floor_Area']; //Floor Area

                // get material cost
                $material_cost = $row_accept['MaterialsCost'];

                //start of week
                $s_week = date("W", $StartDate);

                // due date week
                $d_week = date("W", $DueDate);

                //week difference
                $week_diff = $d_week - $s_week;

                // get number of days
                $q_s_days = "SELECT DATEDIFF('$row_accept[DueDate]','$row_accept[StartDate]') AS dayyss";
                $res_s_days = mysqli_query($con, $q_s_days);
                $row_s_days = mysqli_fetch_assoc($res_s_days);
                $days_diff = $row_s_days['dayyss'];

                // Final number of project days
                $ProjectDays = $days_diff - $week_diff;

                // Direct Cost
                $Direct_Cost = ($material_cost * $floor_area) + (9500 * $ProjectDays);

                // Final est project cost
                $Project_Cost = $Direct_Cost + ($Direct_Cost * .18);

                // initial payment
                $Initial_Cost = $Project_Cost / 2;

                // Update project cost
                $q_update = "UPDATE acceptproject SET ProjectCost = $Project_Cost WHERE ClientId = $client";
                $res_update = mysqli_query($con, $q_update);
                
                ?>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
        <div class="row">
            <div class="col-12 text-center">
                <h2 style="font-size: 30px;font-weight: bold;">PROJECT CONTRACT</h2><br>
            </div>
        </div>
        <div class="container">
            <div class="text-justify" style="font-size: 18px;font-family: Arial, Helvetica, sans-serif;color: black;">
                <!-- <h5>I. The Parties. This Construction Agreement  (“Agreement”) is made between:</h5><br> -->
                <p><strong>I. The Parties.</strong> This Construction Agreement (“Agreement”) is made between:</p>

                <p><strong>Client:</strong> <u><?php echo $row_client['FirstName']." ".$row_client['LastName'];  ?></u> with a mailing address of <u><?php echo $row_client['Address']; ?></u>, (“Client”) </p>

                <p>AND</p>

                <p><strong>Contractor:</strong> <u>Badac Konstruk Inc.</u> with a mailing address of <u>Lot 24/23 Navarro
                        Compound,Rose Ann Subdivision</u> of <u>San Roque Cainta</u>, City of <u>Rizal</u> (“Contractor”).</p>

                <p>WHEREAS the Client intends to pay the Contractor for Services provided, effective <u><?php echo $newStartDate; ?></u>
                    under the following terms and conditions:</p>

                <p><strong>II. The Services.</strong> The Contractor agrees to perform the following: <u><?php echo $row_accept['ProjectName']; ?>.</u></p>

                <p>Hereinafter known as the “Services”.</p>

                <p><strong>III. Payment.</strong> In consideration for the Services to be performed by the Contractor, the
                    Client agrees to pay the following: </p>

                <p style="text-indent: 5%;"><input class="mr-2" type="checkbox" checked>Atleast 50% of the estimated project
                    cost.</p>
                <p style="text-indent: 5%;"><input class="mr-2" type="checkbox" checked>Total estimated project cost of <u>Php. <?php echo number_format($Project_Cost); ?></u>.</p>

                <p>Completion shall be defined as the fulfillment of Services as described in Section II in accordance with
                    industry standards and to the approval of the Client, not to be unreasonably withheld.</p>

                <p>The Contractor agrees to be paid: </p>

                <p style="text-indent: 5%;"><input class="mr-2" type="checkbox" checked>50% at the start of Services and 50% at
                    the end.<u>(Php. <?php echo number_format($Initial_Cost); ?>)</u></p>

                <p><strong>IV. Due Date.</strong> The Services provided by the Contractor shall: </p>

                <p style="text-indent: 5%;"><input class="mr-2" type="checkbox" checked>Be completed by <u><?php echo $newDueDate; ?></u>.</p>

                <p><strong>V. Expenses.</strong> The Contractor shall be: </p>

                <p style="text-indent: 5%;"><input class="mr-2" type="checkbox" checked>Responsible for all expenses related to
                    providing the Services under this Agreement. This includes, but is not limited to, supplies, equipment,
                    operating costs, business costs, employment costs, taxes, Social Security contributions/payments, disability
                    insurance, unemployment taxes, and any other cost that may or may not be in connection with the Services
                    provided Contractor.</u>.</p>

                <p><strong>VI. Independent Contractor Status.</strong> The Contractor, under the code of the Internal Revenue
                    Service (IRS), is an independent contractor, and neither the Contractor's employees or contract personnel are,
                    or shall be deemed, the Client's employees.

                    In its capacity as an independent contractor, Contractor agrees and represents: Contractor has the right to
                    perform services for others during the term of this Agreement; Contractor has the sole right to control and
                    direct the means, manner, and method by which the Services required by this Agreement will be performed.
                    Contractor shall select the routes taken, starting and ending times, days of work, and order the work is
                    performed; Contractor has the right to hire assistant(s) as subcontractors or to use employees to provide the
                    Services required under this Agreement. Neither Contractor, nor the Contractor’s employees or personnel, shall
                    be required to wear any uniforms provided by the Client; The Services required by this Agreement shall be
                    performed by the Contractor, Contractor’s employees or personnel, and the Client will not hire, supervise, or
                    pay assistants to help the Contractor; Neither Contractor nor Contractor’s employees or personnel shall
                    receive any training from the Client in the professional skills necessary to perform the Services required by
                    this Agreement; and Neither the Contractor nor Contractor’s employees or personnel shall be required by the
                    Client to devote full-time to the performance of the Services required by this Agreement.
                </p>

                <p><strong>VII. Business Licenses, Permits, and Certificates.</strong> The Contractor represents and warrants that
                    all employees and personnel associated shall comply with federal, state, and local laws requiring any required
                    licenses, permits, and certificates necessary to perform the Services under this Agreement.</p>

                <p><strong>VIII. Benefits of Contractor’s Employees.</strong> The Contractor understands and agrees that they are
                    solely responsible for shall be liable to all benefits that are provided to their employees, including but not
                    limited to, retirement plans, health insurance, vacation time-off, sick pay, personal leave, or any other
                    benefit provided.</p>

                <p><strong>IX. Unemployment Compensation.</strong> The Contractor shall be solely responsible for the
                    unemployment compensation payments on behalf of their employees and personnel. The Contractor shall not be
                    entitled to unemployment compensation in connection with the Services performed under this Agreement.</p>

                <p><strong>X. Workers’ Compensation.</strong> The Contractor shall be responsible for providing all workers’
                    compensation insurance on behalf of their employees. If the Contractor hires employees to perform any work
                    under this Agreement, the Contractor agrees to grant workers’ compensation coverage to the extent required by
                    law. Upon request by the Client, the Contractor must provide certificates proving workers’ compensation
                    insurance at any time during the performance of the Service.</p>

                <p><strong>XI. Indemnification.</strong> The Contractor shall indemnify and hold the Client harmless from any
                    loss or liability from performing the Services under this Agreement. </p>

                <p><strong>XII. Confidentiality. </strong> The Contractor acknowledges that it will be necessary for the Client
                    to disclose certain confidential and proprietary information to the Contractor in order for the Contractor to
                    perform their duties under this Agreement. The Contractor acknowledges that disclosure to a third party or
                    misuse of this proprietary or confidential information would irreparably harm the Client. Accordingly, the
                    Contractor will not disclose or use, either during or after the term of this Agreement, any proprietary or
                    confidential information of the Client without the Client's prior written permission except to the extent
                    necessary to perform Services on the Client's behalf. </p>

                <p>Proprietary or confidential information includes, but is not limited to: The written, printed, graphic, or
                    electronically recorded materials furnished by Client for Contractor to use; Any written or tangible
                    information stamped “confidential,” “proprietary,” or with a similar legend, or any information that Client
                    makes reasonable efforts to maintain the secrecy of business or marketing plans or strategies, customer lists,
                    operating procedures, trade secrets, design formulas, know-how and processes, computer programs and
                    inventories, discoveries, and improvements of any kind, sales projections, and pricing information; and
                    information belonging to customers and suppliers of the Client about whom the Contractor gained knowledge as a
                    result of the Contractor's Services to the Client. Upon termination of the Contractor's Services to the
                    Client, or at the Client's request, the Contractor shall deliver to the Client all materials in the
                    Contractor's possession relating to the Client's business. The Contractor acknowledges any breach or
                    threatened breach of confidentiality that this Agreement will result in irreparable harm to the Client for
                    which damages would be an inadequate remedy. Therefore, the Client shall be entitled to equitable relief,
                    including an injunction, in the event of such breach or threatened breach of confidentiality. Such equitable
                    relief shall be in addition to the Client's rights and remedies otherwise available at law.</p>

                <p><strong>XIII. Proprietary Information.</strong> Proprietary information, under this Agreement, shall include:
                </p>

                <p>The product of all work performed under this Agreement (“Work Product”), including without limitation all
                    notes, reports, documentation, drawings, computer programs, inventions, creations, works, devices, models,
                    work-in-progress and deliverables will be the sole property of the Client, and Contractor hereby assigns to
                    the Client all right, title and interest therein, including but not limited to all audiovisual, literary,
                    moral rights and other copyrights, patent rights, trade secret rights and other proprietary rights therein.
                    Contractor retains no right to use the Work Product and agrees not to challenge the validity of the Client’s
                    ownership in the Work Product;

                    Contractor hereby assigns to the Client all right, title, and interest in any and all photographic images and
                    videos or audio recordings made by the Client during Contractor’s work for them, including, but not limited
                    to, any royalties, proceeds, or other benefits derived from such photographs or recordings; and The Client
                    will be entitled to use Contractor's name and/or likeness in advertising and other materials.
                </p>

                <p><strong>XIV. No Partnership.</strong> This Agreement does not create a partnership relationship between the
                    Client and the Contractor. Unless otherwise directed, the Contractor shall have no authority to enter into
                    contracts on the Client's behalf or represent the Client in any manner.</p>

                <p><strong>XV. Assignment and Delegation.</strong> The Contractor may assign rights and may delegate duties
                    under this Agreement to other individuals or entities acting as a subcontractor (“Subcontractor”). The
                    Contractor recognizes that they shall be liable for all work performed by the Subcontractor and shall hold the
                    Client harmless of any liability in connection with their performed work.</p>

                <p>The Contractor shall be responsible for any confidential or proprietary information that is shared with the
                    Subcontractor in accordance with Sections XVI & XVII of this Agreement. If any such information is shared by
                    the Subcontractor to third (3rd) parties, the Contractor shall be made liable.</p>

                <p><strong>XVI. Severability.</strong> This Agreement shall remain in effect in the event a section or provision
                    is unenforceable or invalid. All remaining sections and provisions shall be deemed legally binding unless a
                    court rules that any such provision or section is invalid or unenforceable, thus, limiting the effect of
                    another provision or section. In such case, the affected provision or section shall be enforced as so limited.
                </p>

                <p><strong>XVII. Breach Waiver.</strong> Any waiver by the Client of a breach of any section of this Agreement
                    by the Contractor shall not operate or be construed as a waiver of any subsequent breach by the Contractor.
                </p>

                <p><strong>XVIII. Entire Agreement.</strong> This Agreement, along with any attachments or addendums, represents
                    the entire agreement between the parties. Therefore, this Agreement supersedes any prior agreements, promises,
                    conditions, or understandings between the Employer and Employee. </p>
                    <br>
                    <br>

                <p><strong>Client's Signature:</strong> ______________________ Date: ___________________________</p>
                <p>Print Name: <u><?php echo $row_client['FirstName']." ".$row_client['LastName'];  ?></u></p>

                <p><strong>Contractor's Signature:</strong> ______________________ Date: ___________________________</p>
                <p>Company: <u>Badac Konstruk Inc.</u></p>
                <p>Print Name: <u>Fatima Macud</u></p>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->
    <script type="text/javascript">
    window.addEventListener("load", window.print());
  </script>
</body>

</html>