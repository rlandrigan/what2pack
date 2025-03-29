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

 $DB1_host = 'mysql.where2camp.com';
 $DB1_user = 'w2c_admin';
 $DB1_pass = '00Helena!';
 $DB1_name = 'where2camp';
 
  try
  {
	  $DB1con = new PDO("mysql:host={$DB1_host};dbname={$DB1_name}",$DB1_user,$DB1_pass); 
	  $DB1con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e1)
  {
	  echo "ERROR : ".$e1->getMessage();
  }
  
 ?><html lang="en" data-bs-theme="dark">
  <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>What2Pack - Update Campout</title>
  <?php 
  
  function generateRandomString($length = 10) {
	  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  
   } ?>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
 
   <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
   <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
  
   <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
   
   
   
	<script type="text/javascript" language="javascript" src=" https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script> 
	<script type="text/javascript" language="javascript" src="  https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script> 
  <link rel="stylesheet" href="https://use.typekit.net/kyj2mgm.css?<?php echo  generateRandomString();?>">
   <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
   <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
   <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="/css/alt.css?<?php echo  generateRandomString();?>">
	  
		   
	  <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>  
		 
		   <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
		 <script>
		   $( document ).ready(function() {
			  $('#description').summernote();
			  $('#camperDetails').summernote();
		   });   
		 
		 </script>
	   
	   <script>
		  function setSite(name, id) {
				$('#locationName').val(name);
				   $('#locationId').val(id); 
			 }

		$(document).ready(function() {

		  
			// DataTable
			var table = $('#mainList').DataTable( {
			responsive: true
			} );
		 
		
		
		} );
	   </script>
	 </head>
	 <body>
		 <?php 
		   $stmtu = $DBcon->prepare("select * from qbranch_units where id = '".$params['id']."' ");
			   $stmtu->execute();
			  
			   if($stmtu->rowCount() > 0)
			   {
				while($rowu=$stmtu->FETCH(PDO::FETCH_ASSOC))
				{
			  $unitName =$rowu['unitName'];
			  ?>
				 
				  <div id="qrcode"  class="d-none d-print-block"></div><div class="H1 d-none d-print-block"><?php print($unitName) ?> Campout Planner</div>
				
				   <?php
					}
				   }
				   else
				   {
					print('<h1> Add Unit</h1><p>This needs to be added, but not an immediate need.</p>');
				   }
				include('inc/header.php'); 
				?>
				
				  <header class="py-3 mb-4 border-bottom">
					<div class="container d-flex flex-wrap justify-content-center">
					  <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
						<image src="/img/what2packBackInv.png" style="width: 3rem;transform: rotate(-35deg)" class="me-4">
						<span class="fs-2 title">Campout Planner for <?php print($unitName) ?> : Update Campout </span>
					  </a>
					  <form class="col-12 col-lg-auto mb-3 mb-lg-0 d-none" role="search">
						<input type="search" id="filter" class="form-control" placeholder="Search..." aria-label="Search" onkeyup="myFunction()">
					  </form>
					</div>
				  </header><form action="/savecampout" method="POST" id="editEvent">
					  <?php
					   $stmtE = $DBcon->prepare("SELECT * FROM qbranch_event where id = '".$params['camp']."' ");
					   $stmtE->execute();
					   ?>
					   <?php
					   if($stmtE->rowCount() > 0)
					   {
						while($rowE=$stmtE->FETCH(PDO::FETCH_ASSOC))
						{
						 ?>
				  <div class="container" id="campout">
				    <div class="card mb-3">
					 <h4 class="card-header">Step Two: Update Campout Details 					<input style="float:right" class="btn btn-primary" type="submit" name="edit" value="Update" form="editEvent">	<a href="https://what2pack.org/planner/<?php print($params['id']); ?>" style="float:right" class="btn btn-outline-secondary me-3">Cancel</a></h4>
					 	<div class="card-body">
						
							 <div class="row-g2">
								 <div class="col-md">
					     	<div class="form-floating mb-3">
						 		<input type="text" class="form-control" name="name" id="name" value="<?php print($rowE['name']); ?>">
						 		<label for="name">Campout Name</label><input type="hidden" name="unit" id="unit" value="<?php print($rowE['unit']); ?>">
								 <input type="hidden" name="id" id="id" value="<?php print($params['camp']); ?>">
					   		</div>
								 </div>
							 </div>
							 <div class="row-g2">
								  <div class="col-md">
							  <div class="form-floating mb-3">
								  <input type="text" class="form-control" name="paymentLink" id="paymentLink" value="<?php print($rowE['paymentLink']); ?>">
								  <label for="paymentLink">Payment Link</label>
								</div>
								  </div>
							  </div>
							   
							   <div class="row g-2 mb-3">
								 <div class="col-md">
								   <div >
									   <label for="dateStart">Start Date</label>
										<input type="text" class="form-control" name="dateStart" id="dateStart" value="<?php print($rowE['dateStart']); ?>">
									   
								   </div>
								 </div>
								 <div class="col-md">
								    <div class="col-md"><div c>
										<label for="dateEnd">End Date</label>
										<input type="text" class="form-control" id="dateEnd" name="dateEnd" value="<?php print($rowE['dateEnd']); ?>">
									
									</div>
								 </div>
							   </div>
							   </div>
							   <div class="row g-1">
								<div class="col-md">
							   <div >
								   <label for="description">Details</label>
								 <textarea class="form-control mb-3" placeholder="Leave a comment here" id="description" name="description" style="height: 200px"><?php print($rowE['description']); ?></textarea>
								 <label for="description">Details</label>
							   </div>
								</div></div>
								<div class="row g-3">
								<div class="col-md-2">
									<div class="form-floating mb-3">
										 <input type="text" class="form-control" id="budget" name="budget" value="<?php print($rowE['budget']); ?>">
										 <label for="budget">Budget Per Person</label>
									   </div>
								</div>
						
								<div class="col-md-4">
									<div class="form-floating mb-3">
										 <input type="text" class="form-control" id="locationName" name="locationName" value="<?php print($rowE['locationName']); ?>">
										 <label for="locationName">Location Name</label>
									   </div>
								</div>
								<div class="col-md-2">
									<div class="form-floating mb-3">
										 <input type="text" class="form-control" id="locationId" name="locationId" value="<?php print($rowE['locationId']); ?>">
										 <label for="locationId">Location ID</label>
									   </div>
								</div>
								<div class="col-md-4">
									<div class="form-floating mb-3">
										 <input type="text" class="form-control" id="locationId" name="nearestHostpital" value="<?php print($rowE['nearestHostpital']); ?>">
										 <label for="locationId">Nearest Hospital</label>
									   </div>
								</div>
								</div>
								<?php
								$youth =$rowE['youth'] ;
								$youthDetails = $rowE['youthDetails'];
									}
								   }
								   else
								   {
									?>
									 <?php
								   }
								   ?>
						 </form>
							   <script>
									  $('#dateStart').datepicker({
										  uiLibrary: 'bootstrap5'
									  });
									  $('#dateEnd').datepicker({
										  uiLibrary: 'bootstrap5'
									  });
								  </script>
								  <button id="showLoc" type="button" class="btn btn-outline-secondary mb-3" onclick="$('#selectLoc').removeClass('d-none'), $('#showLoc').addClass('d-none')">Change Location</button>
								  
								   <div id="selectLoc" class="d-none">
									   <button type="button" class="btn btn-outline-secondary mb-3" onclick="$('#selectLoc').addClass('d-none'), $('#showLoc').removeClass('d-none')">Hide Table</button>
								  <table class="table-sm table-striped dataTable" style="width:100%" id="mainList">
									   <thead>
										<tr>
										  <th class="filter">Name</th><th>Rating</th><th>Miles From Scout Office</th><th class="filter">Address</th>
										  <th class="filter" style="width: 4rem;">Tents</th><th class="filter" style="width: 4rem;">Group</th><th class="filter" style="width: 4rem;">Cabins</th><th class="filter">Water</th><th class="filter" style="width: 4rem;">Toilets</th><th class="filter" style="width: 4rem;" class="filter">Showers</th><th class="filter" style="width: 4rem;">Power</th></tr>
									   </thead>
									   <tbody>
										 <?php
										 $stmt = $DB1con->prepare("SELECT * FROM campsites ORDER BY miles ASC ");
										 $stmt->execute();
										 ?>
										 <?php
										 if($stmt->rowCount() > 0)
										 {
										  while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
										  {
										   ?>
									   <tr>
										 <td><a href="https://where2camp.com/review/?from=list&camp=<?php print($row['id']); ?>" target="_blank"><?php print($row['name']); ?></a>    <?php if(strlen(trim($row['extlink'])) > 0){?>
										  <a href="<?php print($row['extlink']); ?>" target="_blank"><img class="extlink" src="/img/External_link.svg"></a><?php } else { ?>
											<a href="<?php print('https://www.google.com/search?q='.$row['name']); ?>" target="_blank"><img class="extlink" src="/img/External_link.svg"></a>
										  <?php }?> <?php if(strlen(trim($row['affiliation'])) > 0){?><br>(<?php print($row['affiliation']); ?>)<?php } ?><br>
										  <span class="btn btn-sm btn-success mb-2 mt-3" onclick="setSite('<?php print($row['name']); ?>','<?php print($row['id']); ?>')">Select Campsite</span>
									  		</td><td><?php print($row['rating']); ?></td><td><?php print($row['miles']); ?>
									  		
									  		</td>
										  <td><a href="https://maps.google.com/maps?&amp;q=<?php print($row['streetaddr1']); ?> <?php print($row['city']); ?>, <?php print($row['state']); ?> <?php print($row['zip']); ?>" target="_blank"><?php print($row['streetaddr1']); ?></a><br><?php print($row['city']); ?>, <?php print($row['state']); ?> <?php print($row['zip']); ?></td>
										 <td><?php print($row['tent']); ?></td> <td><?php print($row['group']); ?></td> <td><?php print($row['cabin']); ?></td> <td><?php print($row['water']); ?></td> <td><?php print($row['lavatories']); ?></td> <td><?php print($row['showers']); ?></td> <td><?php print($row['electric']); ?></td> 
									   </tr>
									   <?php
										}
									   }
									   else
									   {
										?>
										 <?php
									   }
									   ?>
									   </tbody>
									   <tfoot>
										 <tr>
										   <th >Name</th><th>Rating</th><th>Miles From Scout Office</th><th >Address</th>
										   <th  >Tents</th><th>Group</th><th>Cabins</th><th >Water</th><th>Toilets</th><th>Showers</th><th>Power</th></tr>
										</tfoot>
									 </table></div>
					
						<div class="row">
							<div class="card-group mb-3">
							<?php if($params['id'] == 1){?>
							
								  <div class="card">
								<div class="card-header fs-4">
								 Camper Details
								</div>
								<div class="card-body">
									<div class="form-floating mb-3">
										<input type="text" class="form-control" id="youth" name="youth" value="<?php print($youth); ?>">
										<label for="grubmaster">Cubs and Parents Attending</label>
									  </div>
									  <div >
										  <label for="description">Camper Details</label>
										   <textarea class="form-control mb-3" placeholder="Leave a comment here" id="camperDetails" name="camperDetails" style="height: 150px"><?php print($youthDetails); ?></textarea>
										 </div>
								</div>
								  </div>
						
							<?php } ?>
							<?php 
							   $stmtP = $DBcon->prepare("select * from qbranch_menu where event = '".$params['camp']."' ");
								   $stmtP->execute();
								  
								   if($stmtP->rowCount() > 0)
								   {
									while($rowP=$stmtP->FETCH(PDO::FETCH_ASSOC))
									{
								  ?>
							
								
									 
										  <div class="card">
										<div class="card-header fs-4">
										 <?php print($rowP['patrol']); ?> Patrol
										</div>
										<div class="card-body">
										<div class="btn-group btn-group-sm text-center w-100 mb-2">
										<a href="/planner/<?php print($params['id']); ?>/menu/<?php print($rowP['id']); ?>" type="button" class="btn btn-sm btn-outline-primary" title="Menu"><i class="fa-solid fa-list-ul"></i> Menu</a>
										  <a href="/planner/<?php print($params['id']); ?>/roster/<?php print($rowP['id']); ?>" type="button" class="btn btn-sm btn-outline-primary" title="Roster"><i class="fa-solid fa-clipboard-user"></i> Roster</a></div>
										  
										  <div class="form-floating mb-3">
											<input type="text" readonly class="form-control-plaintext"id="grubmaster" name="grubmaster" value="<?php print($rowP['grubmaster']); ?>">
											<label for="grubmaster">Grubmaster</label>
										  </div>
										  <div class="form-floating mb-3">
											<input type="text" readonly class="form-control-plaintext" id="costPerBudget" name="costPerBudget" value="<?php print($rowP['costPerBudget']); ?>">
											<label for="costPerBudget">Budget Per Scout</label>
										  </div>
										
										 
										</div>
									  </div>
										
								  
								 
								  <?php
									  }
									 }
									 else
									 {}
								  ?>
								
							
									
									
										<div class="card">
											<form action="/savepatrol" method="POST" id="addPatrol">
									  <div class="card-header fs-4">
										Add Patrol
									  </div>
									  <div class="card-body">
										<div class="form-floating mb-3">
											<div class="form-floating">
											  <select class="form-select" id="patrolId" aria-label="patrolId" name="patrolId"> 
												  <option selected>Choose a Patrol</option> 
											<?php 
											   $stmtx = $DBcon->prepare("select distinct patrol, patrolID from qbranch_roster where unit = '".$params['id']."' ");
												   $stmtx->execute();
												  
												   if($stmtx->rowCount() > 0)
												   {
													while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
													{
												  ?>
													 
											  
											  <option value="<?php print($rowx['patrolID']); ?>"><?php print($rowx['patrol']); ?></option>
													
													   <?php
														}
													   }
													   else
													   {}
													?>
													</select>
													  <label for="patrolId">Patrol Name</label>
													  <input type="hidden" name="unit" value="<?php print($params['id']); ?>">
													  <input type="hidden" name="event" value="<?php print($params['camp']); ?>">
													</div>
										</div>
										<div class="form-floating mb-3">
										  <input type="text"  class="form-control" id="grubmaster" name="grubmaster">
										  <label for="grubmaster">Grubmaster</label>
										</div>
										<div class="form-floating mb-3">
										  <input type="text"  class="form-control" id="costPerBudget" name="costPerBudget">
										  <label for="costPerBudget">Budget Per Scout</label>
										</div>
										
										<input style="float:right" class="btn btn-primary" type="submit" name="save" value="Save Patrol" form="addPatrol">	
									  </div></form>
									</div>
									
							
						</div>
						   </div>
					   </div>
					
					</div>
						
											  
					 
				  </div>
				   
				   
				 
	 </body>
</html>