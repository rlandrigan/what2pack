<?php
include('inc/creds.php');
  session_start();
 $db = mysqli_connect($DB_host, $DB_user, $DB_pass, $DB_name);
 try
 {
	 $DBcon = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass); 
	 $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e)
 {
	 echo "ERROR : ".$e->getMessage();
 }
 

 ?>
<html lang="en" data-bs-theme="dark">
  <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>QBranch - Checkin/Checkout</title>
	  <?php 
	  
	  function generateRandomString($length = 10) {
		  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	  
	   }
	   
	   function isAvailable($ItemID=0, $type) {
			  
			  if($type=="box"){
				 $avail = "	
				 <div class='form-check form-switch mx-auto'>
				 <input class='form-check-input' type='checkbox' name='checkout[]' value='".$ItemID."' role='switch' id='flexSwitchCheckDefault'/>
				   <label class='form-check-label' for='flexSwitchCheckDefault'><h4>Check Out?</h4></label>
				 </div>";
			  } else if($type=="label") {
				$avail = "<h4><span class='badge mx-auto rounded-pill text-bg-success'>Available</span></h4>";  
				  } else if($type=="top") {
				   $avail = "<b class='avail'>Available</b>
						<input type='hidden' name='checkout[]' value='".$ItemID."'/> 
					  ";  
			  } else {
				  $avail = 'y';
			  }
			  $DB_host = 'mysql.scouts13.org';
			  $DB_user = 'scouts13org';
			  $DB_pass = 'SN^TcTAx';
			  $DB_name = 'scouts13_org';
				session_start();
			   $db = mysqli_connect($DB_host, $DB_user, $DB_pass, $DB_name);
			   try
			   {
				   $DBcon = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass); 
				   $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			   }
			   catch(PDOException $e)
			   {
				   echo "ERROR : ".$e->getMessage();
			   }
			 
				$stmtx = $DBcon->prepare("select * from qbranch_checklist_items where itemID = '".$ItemID."' and checkOutDate is NOT NULL ORDER BY checkOutDate DESC LIMIT 1");
				$stmtx->execute();
			   
				if($stmtx->rowCount() > 0)
				{
				 while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
				 {
				  
			   if (is_null($rowx['checkInDate'])) {
				   if($type=='box'){
						  $avail = "<label class='form-control noprint' for='checkin[]'>
							  <input type='checkbox' name='checkin[]' value='".$rowx['id']."'/> &nbsp;Check In?
							</label>";
					  } else if($type=="label") {
					   $avail = "<h4><span class='badge mx-auto rounded-pill text-bg-warning'>Checked Out<br>".$rowx['checkOutDate']."<br>by: ".$rowx['checkOutName']."</span></h4>"; 
						} else if($type=="top") {
						 $avail = "<b class='avail'>Available</b>
							  <input type='hidden' name='checkin[]' value='".$ItemID."'/> 
							";  
					  } else {
						  $avail = "n";
					  }
				   
			   };
			  
				}
			   }
			   else
			   {
				
			   }
		   
			   return $avail;
		  }
	  
	   ?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
	  <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
		<script src="/js/qrcode/qrcode.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
			<script>
			
		  $(document).ready(function() {
			$('#notes').summernote();
		   
		  });
			</script>
	  </head>
	  <body>
		 
		  
	<div class="card secondary m-3 mx-auto" style="max-width:70rem" >
		<div class="card-body p-0">
	<div class="card-header tertiary">
	
		  
	 <?php 
			  $stmt = $DBcon->prepare("SELECT * FROM qbranch_master WHERE labelID = '".$params['id']."'  ORDER BY id ASC ");
			  $stmt->execute();
			  ?>
			  
			  <?php
			 
			  if($stmt->rowCount() > 0)
			  {?>
				  <form action="/checkinout" method="POST" id="editForm" >
				 
				 
						 
					<h2> <?php while($rowa=$stmt->FETCH(PDO::FETCH_ASSOC))
						   {print("<a class='link-light' href='/unit/".$rowa['unitId']."'>".$rowa['unitName']."</a>"); }
						   $stmt->execute();
						   ?>: Edit Item</h2>
						  
				
						  <?php
				  
			   while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
			   {
				   $mainID = $row['id'];
				?>
				  </div>
				  <div class="container m-1">
	<div class="row">
		<div class="col-8">
			<input type='text' name='name' class="form-control form-control-lg" value='<?php print($row['name']); ?>'>
		</div>	
		<div class="col text-center">
			<h1 class="py-2 m-0"><span class="badge  rounded-pill text-bg-success"><?php print($row['labelID']); ?></span></h1>
		</div>
	</div>
			<div class="input-group mb-3">
			   <span class="input-group-text" id="inputGroup-sizing-default">Unit</span>
			<select name="unit" id="unit"  class="form-select">
				   <optgroup label ="Unit">
					   <option value ="" >Please select a Unit</option>
			   <?php
			
			   $stmta = $DBcon->prepare("SELECT * FROM qbranch_units ORDER BY unitName ASC");
			   $stmta->execute();
			   ?>
			   <?php
			   if($stmta->rowCount() > 0)
			   {
				while($row_ex=$stmta->FETCH(PDO::FETCH_ASSOC))
				{
				 ?>
				   <option value="<?php print($row_ex['id']); ?>" <?php if($row['unitName'] == $row_ex['unitName']){ print('selected');}?>><?php print($row_ex['unitName']); ?></option>
			   <?php
				 }}
				 ?></optgroup>
			   </select></div>
		
		<div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Description </span>
		<textarea class="form-control" name="description" placeholder="Description"><?php print($row['description']); ?></textarea>
		</div>
		<div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Notes </span>
		<textarea  class="form-control" name="notes"  id="notes" placeholder="Notes"><?php print($row['notes']); ?> </textarea></div>
		<div class="input-group mb-3">
			<span class="input-group-text" id="inputGroup-sizing-default">Type </span>
		<select name="type" id="type"  class="form-select">
			   <optgroup label="Type">
				   <option value ="item" <?php if($row['type'] == 'item'){ print('selected');}?>>Item</option>
				   <option value ="container" <?php if($row['type'] == 'container'){ print('selected');}?>>Container</option>
				   </optgroup>
					 </select></div>
					 <div class="input-group mb-3">
					 <span class="input-group-text" id="inputGroup-sizing-default">Container</span>
		 <select name="container" id="container"  class="form-select">
			   <optgroup label ="Container">
				   <option value="">Top Level Container</option>
		   <?php
		 
		   $stmtc = $DBcon->prepare("SELECT * FROM qbranch_inventory WHERE type = 'container'");
		   $stmtc->execute();
		   ?>
		   <?php
		   if($stmtc->rowCount() > 0)
		   {
			while($row_con=$stmtc->FETCH(PDO::FETCH_ASSOC))
			{
			 ?>
			   <option value="<?php print($row_con['id']); ?>" <?php if($row['container'] == $row_con['id']){ print('selected');}?>><?php print($row_con['name']); ?></option>
		   <?php
			 }}
			 ?></optgroup>
		   </select></div>
		   <div class="input-group mb-3">
		   <span class="input-group-text" id="inputGroup-sizing-default">Status</span>
		   <select class="form-select" name="status" id="status" >
					 <optgroup label ="Status">
						 <option value ="" >Please select Status</option>
				 <?php
				 
				 $stmtb = $DBcon->prepare("SELECT * FROM qbranch_status ORDER BY label ASC");
				 $stmtb->execute();
				 ?>
				 <?php
				 if($stmtb->rowCount() > 0)
				 {
				  while($row_st=$stmtb->FETCH(PDO::FETCH_ASSOC))
				  {
				   ?>
					 <option value="<?php print($row_st['id']); ?>" <?php if($row['label'] == $row_st['label']){ print('selected');}?>><?php print($row_st['label']); ?></option>
				 <?php
				   }}
				   ?></optgroup>
				 </select></div>
	
		<div class="row"><div class="col text-center"><?php print(isAvailable($row['id'], 'label')); ?></div></div>
	

		 
		 
		  
	  <?php 
			  }?>
			  
			
					
							<input type="hidden" name="labelID" value="<?php print($params['id'])?>">
				
							<input name="date" type="hidden" value="<?php print(date('Y-m-d H:i:s'));?>">
					<input type="submit" name="edit" value="Update Item" class="btn form-control btn-primary" form="editForm">
						
			</form>
			
				<?php }
			 else
			 {
			  ?>
		<div class="card-header tertiary">	
		  <h1>Add an Item</h1></div>
		 <form action="/itemsubmit" method="POST" id="form">
		<div class="input-group mb-3">
		   <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
		   <input type="text" name="name" placeholder="Name" class="form-control"/></div>
		<div class="input-group mb-3">
		   <span class="input-group-text" id="inputGroup-sizing-default">Label ID</span><input type="text" class="form-control" name="labelId" value="<?php print($params['id'])?>" style="width:5em"/></div>
		   <div class="input-group mb-3">
			  <span class="input-group-text" id="inputGroup-sizing-default">Unit</span>
		<select name="unit" id="unit" class="form-control">
			   <optgroup label ="Unit">
				   <option value ="" >Please select a Unit</option>
		   <?php
		
		   $stmta = $DBcon->prepare("SELECT * FROM qbranch_units ORDER BY unitName ASC");
		   $stmta->execute();
		   ?>
		   <?php
		   if($stmta->rowCount() > 0)
		   {
			while($row_ex=$stmta->FETCH(PDO::FETCH_ASSOC))
			{
			 ?>
			   <option value="<?php print($row_ex['id']); ?>"><?php print($row_ex['unitName']); ?></option>
		   <?php
			 }}
			 ?></optgroup>
		   </select></div>
		<div class="input-group mb-3">
		   <span class="input-group-text" id="inputGroup-sizing-default">Description</span><textarea name="description"  class="form-control" placeholder="Description"></textarea>
		</div>
		<div class="input-group mb-3">
		   <span class="input-group-text" id="inputGroup-sizing-default">Notes</span><textarea name="notes"  class="form-control" placeholder="Notes" id="notes"></textarea></div>
		<div class="input-group mb-3">
		   <span class="input-group-text" id="inputGroup-sizing-default">Type</span>
		<select name="type" id="type" class="form-control"">
					   <optgroup label ="type">
						   <option value ="item" >Item</option>
						   <option value ="container" >Container</option>
						   </optgroup>
							 </select> 
				 <select name="container" id="container" class="form-control">
					   <optgroup label ="container">
						   <option  >Container</option>
				   <?php
				 
				   $stmtc = $DBcon->prepare("SELECT * FROM qbranch_inventory WHERE type = 'container'");
				   $stmtc->execute();
				   ?>
				   <?php
				   if($stmtc->rowCount() > 0)
				   {
					while($row_con=$stmtc->FETCH(PDO::FETCH_ASSOC))
					{
					 ?>
					   <option value="<?php print($row_con['id']); ?>"><?php print($row_con['name']); ?></option>
				   <?php
					 }}
					 ?></optgroup>
				   </select></div>
				   <div class="input-group mb-3">
					  <span class="input-group-text" id="inputGroup-sizing-default">Status</span>
				   <select class="form-control" name="status" id="status" >
							 <optgroup label ="Status">
								 <option value ="" >Please select Status</option>
						 <?php
						 
						 $stmtb = $DBcon->prepare("SELECT * FROM qbranch_status ORDER BY label ASC");
						 $stmtb->execute();
						 ?>
						 <?php
						 if($stmtb->rowCount() > 0)
						 {
						  while($row_st=$stmtb->FETCH(PDO::FETCH_ASSOC))
						  {
						   ?>
							 <option value="<?php print($row_st['id']); ?>"><?php print($row_st['label']); ?></option>
						 <?php
						   }}
						   ?></optgroup>
						 </select> </div><input type="submit" class="form-control btn btn-primary" name="Save" value="Save" form="form">
		   <?php
		 } ?></div><div class="card-footer"><img src="../img/what2packBackInv.png" class="mx-auto d-block" style="width: 3em;transform: rotate(-35deg);">
		   </div></div>
  </body>
</html>