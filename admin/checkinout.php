<?php
	// Session start & Connect the MySql

	  session_start();
include('inc/creds.php');

 // Initialize Variables

		$values ='';
	
		 
	
		 // POST Add new data
		 if (isset($_POST['save'])) {
			if (isset($_POST['checkout'])) {
			foreach ($_POST['checkout'] as $value) {
			   $values = $values."('".$value."', '".$_POST['checklistID']."', '".$_POST['date']."', '".$_POST['responsibleParty']."'),";
			 }
		 
			 $values = rtrim($values, ',');
			 mysqli_query($db, "INSERT INTO qbranch_checklist_items (itemID, checklistID, checkOutDate, checkOutName)  VALUES ".$values);
			 }
		   if (isset($_POST['checkin'])) {
			   foreach ($_POST['checkin'] as $value) {
					
					mysqli_query($db, "UPDATE qbranch_checklist_items SET checkInDate = '".$_POST['date']."', checkInName = '".$_POST['responsibleParty']."' where id ='".$value."'");
				   
				  }
		   }
			 if(isset($_POST['labelID'])){
			   header("location: ../item/".$_POST['labelID']);
			   }
			   if(isset($_POST['unitID'])){
				 header("location: ../unit/".$_POST['unitID']);
				 }
		 }
		
		  // POST Add new data
		  if (isset($_POST['update'])) {
			 if (isset($_POST['checkin'])) {
			 foreach ($_POST['checkin'] as $value) {
				
				 
				 mysqli_query($db, "UPDATE qbranch_checklist_items SET checkInDate = '".$_POST['date']."', checkInName = '".$_POST['responsibleParty']."' where id ='".$value."'");
				
			   }}
			   if (isset($_POST['checkout'])) {
			   foreach ($_POST['checkout'] as $value) {
				  $values = $values."('".$value."','".$_POST['checklistID']."', '".$_POST['date']."', '".$_POST['responsibleParty']."'),";
				}
				$values = rtrim($values, ',');
				mysqli_query($db, "INSERT INTO qbranch_checklist_items (itemID, checklistID,  checkOutDate, checkOutName)  VALUES ".$values);
			 }
			if(isset($_POST['labelID'])){
			  header("location: ../item/".$_POST['labelID']);
		  	}
			  if(isset($_POST['unitID'])){
				header("location: ../unit/".$_POST['unitID']);
				}
		  }
		
		// POST Add new data
		 if (isset($_POST['edit'])) {
			mysqli_query($db, "UPDATE qbranch_inventory SET name = '".$_POST['name']."', unit = '".$_POST['unit']."', status = '".$_POST['status']."', container = '".$_POST['container']."', type = '".$_POST['type']."', notes = '".$_POST['notes']."', description = '".$_POST['description']."' where labelID ='".$_POST['labelID']."'");
			
			 if(isset($_POST['labelID'])){
			   header("location: ../item/".$_POST['labelID']);
			   }
			   if(isset($_POST['unitID'])){
				 header("location: ../unit/".$_POST['unitID']);
				 }
		 }
	
?>
