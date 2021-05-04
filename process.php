<?php
	include('Admin/config.php');

	// ESTIMATE PROCESS
	if(isset($_POST['submitestimate']))
    {
    	$FirstName = $_POST['FirstName'];
       	$LastName = $_POST['LastName'];
        $Email = $_POST['Email'];
       	$ContactNum = $_POST['ContactNum'];      
       	$Address = $_POST['Address'];
       	$e_Property_Loc = $_POST['e_Property_Loc'];                
        $e_Lot_Area = $_POST['e_Lot_Area'];
        $e_Length = $_POST['e_Length'];
        $e_Width = $_POST['e_Width'];
        $e_Floor_Area = $_POST['e_Floor_Area'];
        $e_Classification = $_POST['e_Classification'];
        $e_Floor_Levels = $_POST['e_Floor_Levels'];
        $e_Preferred_Design = $_POST['e_Preferred_Design'];
        $e_Rooms = $_POST['e_Rooms'];
        $e_Preferred_Finish = $_POST['e_Preferred_Finish'];
        $e_Toilet_Bath = $_POST['e_Toilet_Bath'];
        $e_Car_Garage = $_POST['e_Car_Garage'];
        //$Drawing = $_POST['Drawing'];
        $Description = $_POST['Description'];
        $Password = " ";

       	$sql = "INSERT INTO client (FirstName, LastName, Email, Address, ContactNum, StatusId, Password)VALUES ('$FirstName','$LastName','$Email','$Address','$ContactNum', 1, '$Password')";
       if ($con->query($sql) === TRUE) 
       {
       		$query = "SELECT MAX(ClientId) as ClientId FROM `client` order by MAX(ClientId) DESC";
            $result = mysqli_query($con, $query);
            $MaxClientId = mysqli_fetch_assoc($result);
            $ClientId = $MaxClientId['ClientId'];
            
            $Drawing = $_FILES["Drawing"]["name"];
            $tmp_name = $_FILES["Drawing"]["tmp_name"];
            $path = "Admin/drawing/".$Drawing;
            $Drawing1 = explode(".",$Drawing);
            $ext = $Drawing1[1];
            $allowed = array("jpg","png","jpeg","pdf","docx");
            if(in_array($ext, $allowed))
            {
                move_uploaded_file($tmp_name, $path);  
            }

            $sql2 = "INSERT INTO estimate (ClientId, e_Floor_Area, e_Floor_Levels, e_Rooms, e_Toilet_Bath, e_Car_Garage, Description, Drawing, e_Property_Loc, e_Lot_Area, e_Length, e_Width, e_Classification, e_Preferred_Design, e_Preferred_Finish) VALUES ('$ClientId', '$e_Floor_Area','$e_Floor_Levels','$e_Rooms', '$e_Toilet_Bath', '$e_Car_Garage', '$Description', '$Drawing', '$e_Property_Loc','$e_Lot_Area','$e_Length', '$e_Width', '$e_Classification', '$e_Preferred_Design', '$e_Preferred_Finish' )";
            if ($con->query($sql2) === TRUE)
            {
            	echo '<script type="text/javascript">';
		   		echo ' alert("Submitted successfully!")';  
		   		echo '</script>';
            }
            else
            {
            	echo "Error2: " . $sql2 . "<br>" . $con->error;
            }
       } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
                 
    }
    
    
    // FITOUT ESTIMATE PROCESS
    if(isset($_POST['submitfitout']))
    {
        $FirstName = $_POST['FirstName'];
       	$LastName = $_POST['LastName'];
        $Email = $_POST['Email'];
       	$ContactNum = $_POST['ContactNum'];      
       	$Address = $_POST['Address'];
       	$f_Length = $_POST['f_Length'];
        $f_Width = $_POST['f_Width'];
        $f_Description = $_POST['f_Description'];
        $f_FurnitureType = $_POST['f_FurnitureType'];
        $Quantity = $_POST['Quantity'];
        $Password = " ";
        
        $sql = "INSERT INTO client (FirstName, LastName, Email, Address, ContactNum, StatusId, Password)VALUES ('$FirstName','$LastName','$Email','$Address','$ContactNum', 1, '$Password')";
        if ($con->query($sql) === TRUE) 
        {
            $query = "SELECT MAX(ClientId) as ClientId FROM `client` order by MAX(ClientId) DESC";
            $result = mysqli_query($con, $query);
            $MaxClientId = mysqli_fetch_assoc($result);
            $ClientId = $MaxClientId['ClientId'];
            
            $f_Drawing = $_FILES["f_Drawing"]["name"];
            $tmp_name = $_FILES["f_Drawing"]["tmp_name"];
            $path = "Admin/drawing/".$f_Drawing;
            $f_Drawing1 = explode(".",$f_Drawing);
            $ext = $f_Drawing1[1];
            $allowed = array("jpg","png","jpeg","pdf","docx");
            if(in_array($ext, $allowed))
            {
                move_uploaded_file($tmp_name, $path);  
            }
            
            $sql2 = "INSERT INTO fitoutestimate (ClientId, f_Description, f_Drawing, f_Length, f_Width,  f_FurnitureType, Quantity) VALUES ('$ClientId', '$f_Description', '$f_Drawing','$f_Length', '$f_Width', '$f_FurnitureType', '$Quantity' )";
            
            if ($con->query($sql2) === TRUE)
            {
            	echo '<script type="text/javascript">';
		   		echo ' alert("Submitted successfully!")';  
		   		echo '</script>';
            }
            else
            {
            	echo "Error2: " . $sql2 . "<br>" . $con->error;
            }
        }
        
        else 
        {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
    
    // INTERIOR DESIGN PROCESS
    if(isset($_POST['submitinterior']))
    {
        $FirstName = $_POST['FirstName'];
       	$LastName = $_POST['LastName'];
        $Email = $_POST['Email'];
       	$ContactNum = $_POST['ContactNum'];      
       	$Address = $_POST['Address'];
       	$VisitationDate = $_POST['VisitationDate'];
        $SiteLocation = $_POST['SiteLocation'];
        $OverviewDescription = $_POST['OverviewDescription'];
        
        $sql = "INSERT INTO client (FirstName, LastName, Email, Address, ContactNum, StatusId, Password)VALUES ('$FirstName','$LastName','$Email','$Address','$ContactNum', 1, '$Password')";
        
        if ($con->query($sql) === TRUE) 
        {
            $query = "SELECT MAX(ClientId) as ClientId FROM `client` order by MAX(ClientId) DESC";
            $result = mysqli_query($con, $query);
            $MaxClientId = mysqli_fetch_assoc($result);
            $ClientId = $MaxClientId['ClientId'];
            
            $sql2 = "INSERT INTO interiordesign (ClientId, VisitationDate, SiteLocation, OverviewDescription) VALUES ('$ClientId', '$VisitationDate', '$SiteLocation','$OverviewDescription')";
            
            if ($con->query($sql2) === TRUE)
            {
            	echo '<script type="text/javascript">';
		   		echo ' alert("Submitted successfully!")';  
		   		echo '</script>';
            }
            else
            {
            	echo "Error2: " . $sql2 . "<br>" . $con->error;
            }
            
        }
        
        else 
        {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
?>