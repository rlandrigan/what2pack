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

 ?><html lang="en" data-bs-theme="dark">
  <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>What2Pack - Roster</title>
  <?php 
  
  function generateRandomString($length = 10) {
	  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  
   } ?>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
 
   <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
   <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
  
   <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
   
   
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://use.typekit.net/kyj2mgm.css">
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
		<style>.form-floating label{font-size:1rem;}
			.note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable {height: 200px;}
			
			
		</style>   
	<?php $stmtx = $DBcon->prepare("select * from qbranch_menu where id = '".$params['menu']."'" );
	   $stmtx->execute();
	  
	   if($stmtx->rowCount() > 0)
	   {
		while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
		{
	  $patrolName = $rowx['patrol'];
	  $patrolId = $rowx['patrolId'];
	  $menulist = $rowx['menulist'];
	  $grubmaster = $rowx['grubmaster'];
	  $costper = $rowx['costPerBudget'];
	  $event = $rowx['event'];
	  $activityID= "";
	  $days="1";
	  $fireMarshal="";
	  $scoutsAtt ="0";
			}
		   }
		   else
		   {}
	$stmtq = $DBcon->prepare("select * from qbranch_event where id = '".$event."'" );
	   $stmtq->execute();
	  
	   if($stmtq->rowCount() > 0)
	   {
		while($rowq=$stmtq->FETCH(PDO::FETCH_ASSOC))
		{
	  $eventName = $rowq['name'];
	  $date = $rowq['date'];
	  
			}
		   }
		   else
		   {}	   
		?>   
	   
	   <script>
		  function setSite(name, id) {
				$('#floatingLocName').val(name);
				   $('#floatingLocID').val(id); 
			 }

		$(document).ready(function() {
//Setup - add a text input to each footer cell
		$('#mainList tfoot th').each(function() {
				var title = $(this).text();
				var style = $(this).css('width');
				$(this).html('<input style="width:'+style+'"  class="sm" type="text" placeholder="" />');
			});
		  
			// DataTable
			var table = $('#mainList').DataTable( {
			
			} );
		 
			// Filter event handler
			table.columns().every( function() {
				var that = this;
			
				$('input', this.footer()).on('keyup change', function() {
					if (that.search() !== this.value) {
						that
							.search(this.value)
							.draw();
					}
				});
			});
		
		} );
		
	
		function add_item(id, name) {
			let orgvar = "scout_"+id;
			let clonevar = "scoutlink_"+id;
			let newItem = '<span id="scoutlink_'+id+'" class="list-group-item list-group-item-action mb-2 pb-2" href="" onclick="remove_item(\''+id+'\',\''+name+'\')"><h5>'+name+'<span class="btn btn-outline-warning btn-sm ms-2 d-print-none " style="float:right;">Remove</span><h5></span>'
			$("#attending").append(newItem);
			$("#scout_"+id).hide();
			$('.chooseScout').append('<option class="scoutOpt_'+id+'" value="'+id+'" selected>'+name+'</option>')
			
			let scoutsAtt = $("#scoutsAtt").val();
			if (scoutsAtt == '') { 
			 
			$("#scoutsAtt").val(id);
			} else {
			$("#scoutsAtt").val(scoutsAtt+','+id);
			}
		}
		function remove_item(id,name) {
			
			$("#scoutlink_"+id).remove();
			if ( $("#scout_"+id).length ) { 
				$("#scout_"+id).show();
				
				} else {
				addBlock='<div class="row scout mb-3" id="scout_'+id+'"><div class="col-3"><span onclick="add_item(\''+id+'\',\''+name+'\')" class="btn btn-sm btn-outline-primary me-3">Add</span></div><div class="col-9"><b class="name">'+name+'</b></div></div>';
				
				$('#scoutList').append(addBlock)}
			$('.scoutOpt_'+id).remove();
			let scoutsAtt = $("#scoutsAtt").val();
			scoutsAtt  = scoutsAtt.replace(id+',', "");
		scoutsAtt  = scoutsAtt.replace(','+id, "");
			$("#scoutsAtt").val(scoutsAtt);
		}
	
		function poof(click){
			$('#'+click).click();
		}

		let intialNum = 1000;
		function addToRoster(name){
			intialNum = intialNum+1;
			addBlock='<div class="row scout mb-3" id="scout_'+intialNum+'"><div class="col-3"><span onclick="add_item(\''+intialNum+'\',\''+name+'\')" class="btn btn-sm btn-outline-primary me-3">Add</span></div><div class="col-9"><b class="name">'+name+'</b></div></div>'
			$("#scoutList").append(addBlock);
			$('#addScoutRoster').val('');
		}
		function loadSelects(menu){
			$('.form-select.chooseScout').append(menu);
		}
	
		
		function toggle($toBeHidden, $toBeShown) {
		  $toBeHidden.hide().prop('disabled', true);
		  $toBeShown.show().prop('disabled', false).focus();
		}
		
		function showOptions(inputName) {
		  var $select = $(`select[name=${inputName}]`);
		  toggle($(`input[name=${inputName}]`), $select);
		  $select.val(null);
		}
		
		
		function showCustomInput(inputName) {
		  toggle($(`select[name=${inputName}]`), $(`input[name=${inputName}]`));
		
		}
		
	   $( document ).ready(function() {
		  $('#description').summernote();
		  
		  $('#date').datepicker({
			   uiLibrary: 'bootstrap5'
		   });
	   });    
	
			
			
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
				 
				  <div id="qrcode"  class="d-none d-print-none"></div><div class="H1 d-none d-print-none"><?php print($unitName) ?> Campout Planner</div>
				
				   <?php
					}
				   }
				   else
				   {
					print('<h1> Add Unit</h1><p>This needs to be added, but not an immediate need.</p>');
				   }
				include('inc/header.php'); 

				   $stmtActivity = $DBcon->prepare("select * from qbranch_activity where id = '".$params['event']."'");
					   $stmtActivity->execute();
					  
					   if($stmtActivity->rowCount() > 0)
					   {
						while($rowActivity=$stmtActivity->FETCH(PDO::FETCH_ASSOC))
						{
					$activityID = $rowActivity['id'];
					$scoutsAtt = $rowActivity['scoutsAtt'];
					 $eventId = $rowActivity['event'];
					 $unitId = $rowActivity['unit'];
					 $measure =$rowActivity['measure'];
					 $number=$rowActivity['number'];
					 $date=$rowActivity['date'];
					 $name =$rowActivity['name'];
					 $description =$rowActivity['description'];
					
						  }
						 }
						 else
						 {}
					  ?>
				  <header class="py-3 mb-4 border-bottom d-print-none">
					<div class="container d-flex flex-wrap justify-content-center">
					  <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
					<image src="/img/what2packBackInv.png" style="width: 3rem;transform: rotate(-35deg)" class="me-4">
						<span class="fs-2 title">Campout Planner for <?php print($unitName) ?> : Add Activity </span>
					  </a>
					  <form class="col-12 col-lg-auto mb-3 mb-lg-0 d-none" role="search">
						<input type="search" id="filter" class="form-control" placeholder="Search..." aria-label="Search" onkeyup="myFunction()">
					  </form>
					</div>
				  </header>
				  <div class="container" id="campout">
					<div class="card mb-3 ">
					 <h4 class="card-header d-print-none"><div class="row"><div class="col-md-6">Activity Details and Attendees</div> 					<div class="col-md-6">
						 <?php if($activityID > 0){?>
						 <input style="float:right" class="btn btn-primary mb-3" type="submit" name="update" value="Update Activity" form="addRoster">
						 <?php }else{?>
						 <input style="float:right" class="btn btn-primary mb-3" type="submit" name="save" value="Save Activity" form="addRoster">
						 <?php }?><a href="https://what2pack.org/planner/<?php print($params['id']); ?>" style="float:right" class="btn btn-outline-secondary me-3">Cancel</a></div></div></h4>
						 <div class="card-body">
						 
						<div class="row">
							
							<div class="col-md-4 d-print-none">
								<form id="menu_1">
									<div class="card">
								  <div class="card-header fs-4">
									Add Attendees
								  </div>
								  <div class="card-body" >
									<div id="scoutList">
												<?php 
												 if($activityID > 0 AND $scoutsAtt >0){
												   $stmtx = $DBcon->prepare("select * from qbranch_roster WHERE id NOT IN (".$scoutsAtt.") AND patrolID  = '".$patrolId."' and unit = '".$params['id']."' and active ='Y'");
												   } else {
												   $stmtx = $DBcon->prepare("select * from qbranch_roster where unit = '".$params['id']."' and active ='Y'");
												   }
													   $stmtx->execute();
													  
													   if($stmtx->rowCount() > 0)
													   {
														while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
														{
													  ?>
													 <div class="row scout mb-3" id="scout_<?php print($rowx['id']); ?>">
														 <div class="col-3"><span onclick="add_item('<?php print($rowx['id']); ?>','<?php print($rowx['firstName']); ?> <?php print($rowx['lastI']); ?>')" class="btn btn-sm btn-outline-primary me-3">Add</span>
														</div>
														<div class="col-9">
															<b class="name"><?php print($rowx['firstName']); ?> <?php print($rowx['lastI']); ?></b>
															<i class="position"><?php print($rowx['position']); ?></i>
														</div>
													</div>
														   <?php
															}
														   }
														   else
														   {}
														?>
									</div>
									
										
																
								
								  </div>
								</div>
								</form>	
							</div>	
						<div class="col-md-8 makefull">
						<form action="/saveactivity" method="POST" id="addActivity" >
						 <div class="row">
							  <div class="col-md-6">
								 
								  <div class="card">
									<div class="card-header fs-4">
									  Activity Details
									</div>
									<div class="card-body">
									<div class="row"><div class="col-12">
										<div class="row-g2">
											 <div class="col-md">
												 <div class="form-floating mb-3">
												   <input type="text" class="form-control" name="name" id="name" value="">
												   <label for="paymentLink">Name</label>
												 </div>
											 </div>
										  </div>
										 <div class="form-floating mb-3">
											 
											 <select class="form-control" name="activityType" onchange="if($(this).val()=='customOption')showCustomInput('activityType')">
											<option value="Hiking">Hiking</option>
											   <option value="Biking">Biking</option>
											   <option value="Camping">Camping</option>
											   <option value="Unpowered Watercraft">Unpowered Watercraft</option>
											   <option value="Motor Watercraft">Motor Watercraft</option>
											   <option value="Service">Service</option>
											   <option value="Riding(Animal)">Riding(Animal)</option>
											   <option value="Conservation">Conservation</option>
											   <option value="customOption">[type a custom value]</option>
											   <input name="activityType" class="form-control" style="display:none;" disabled="disabled" onblur="if($(this).val()=='')showOptions('activityType')"></select>
										   <label for="activityType">Activity Type</label>
										   </div>
										</div>
								</div>
									
								<div class="row">
									   <div class="col-6">
										   <div class="form-floating mb-3">
								  <select class="form-select" name="measure" onchange="if($(this).val()=='customOption')showCustomInput('measure')">
									 <option value="Miles">Miles</option>
									 <option value="Hours">Hours</option>
									 <option value="customOption">[type a custom value]</option>
									 <input name="measure" class="form-control" style="display:none;" disabled="disabled" onblur="if($(this).val()=='')showOptions('measure')">
								   </select><label for="measure">Miles/Hours</label></div>
									   </div>
									   <div class="col-6">
										  <div class="form-floating mb-3">
											  <input type="text" class="form-control" name="paymentLink" id="paymentLink" value="">
											  <label for="paymentLink">Amount</label>
											</div>
											  </div>
								   </div>
								   <div class="row-g2">
										 <div class="col-md">
											 <div class="form-floating mb-3">
											   <input type="text" class="form-control" name="paymentLink" id="paymentLink" value="">
											   <label for="paymentLink">Event</label>
											 </div>
										 </div>
									  </div>
								   
								   <div class="row-g2">
										 <div class="col-md">
											 <div >
													<label for="date">Date</label>
													 <input type="text" class="form-control" name="date" id="date" >
													
												</div>
										 </div>
									  </div>
									
									</div>
								  </div>
							  </div>
						  <div class="col-md-6">
							   
								<div class="card ">
								  <div class="card-header fs-4">
									  <?php if($patrolId < '96') {?>
									Scouts Attending 
									<?php } else {?>
										Adults Attending
									<?php } ?>
								  </div>
								  <div class="card-body" id="attending">
									  <?php 
										if($activityID > 0  AND $scoutsAtt >0){
										  
										$stmtx = $DBcon->prepare("select * from qbranch_roster where id in (".$scoutsAtt.") ");
										   $stmtx->execute();
										  
										   if($stmtx->rowCount() > 0)
										   {
											   $selectLoad = "";
											while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
											{if($patrolId < '96') {
												?>
												<span id="scoutlink_<?php print($rowx['id']); ?>" class="list-group-item list-group-item-action mb-2 pb-2" href="" onclick="remove_item('<?php print($rowx['id']); ?>','<?php print($rowx['firstName']); ?> <?php print($rowx['lastI']); ?>')">
													<h5><?php print($rowx['firstName']); ?> <?php print($rowx['lastI']); ?> <i class="position"><?php print($rowx['position']); ?></i><span class="btn btn-outline-warning btn-sm ms-2 d-print-none " style="float:right;">Remove</span></h5>
												</span>
												
												<?php
												}else{
												?>
												<span id="scoutlink_<?php print($rowx['id']); ?>" class="list-group-item list-group-item-action mb-2 pb-2" href="" onclick="remove_item('<?php print($rowx['id']); ?>','<?php print($rowx['firstName']); ?> <?php print($rowx['lastName']); ?> <?php print($rowx['BSAId']); ?>')">
													<h5><?php print($rowx['firstName']); ?> <?php print($rowx['lastName']); ?> <?php print($rowx['BSAId']); ?><span class="btn btn-outline-warning btn-sm ms-2 d-print-none " style="float:right;">Remove</span></h5>
												</span>
												
												<?php	
												}
												$selectLoad = $selectLoad.'<option value="'.$rowx['id'].'" >'.$rowx['firstName'].' '.$rowx['lastI'].'</option>';
											
											
											}
										}?>
									<script>$( document ).ready(function() {
										  loadSelects('<?php print($selectLoad); ?>');
									  });</script>
									<?php }
										  ?>
										  
												  <input type="hidden" name="scoutsAtt" id="scoutsAtt" value="<?php print($scoutsAtt); ?>" />
								  </div>
								</div>
							</div>
						  </div>
							<div class="card mt-3">
							<div class="card-header fs-4">
							  Description
							</div>
							<div class="card-body">
							 <div class="row">
								 <div class="col-md-12">
									  <textarea class="form-control mb-3" placeholder="Activity Desction Here" id="description" name="description" style="height: 200px"></textarea>
									 
								</div>
							</div>
							</div></div>
							  </div>
							 
						</div>
					   </div>
					<h4 class="card-footer d-print-none mb-0"><div class="row"><div class="col-md-6">Activity Details and Attendees</div> 					<div class="col-md-6">
					 <?php if($activityID > 0){?>
					 <input style="float:right" class="btn btn-primary mb-3" type="submit" name="update" value="Update Activity" form="addRoster">
					 <?php }else{?>
					 <input style="float:right" class="btn btn-primary mb-3" type="submit" name="save" value="Save Activity" form="addRoster">
					 <?php }?><a href="https://what2pack.org/planner/<?php print($params['id']); ?>" style="float:right" class="btn btn-outline-secondary me-3">Cancel</a></div></div></h4>
					</div>
						
											  
							</form>
				  </div>
	 
	 </body>
</html>