<?php
session_start();
include('inc/creds.php');
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
	  
		<style>.form-floating label{font-size:1rem;}</style>   
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
	  $dutyID= "";
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
	  $dateStart = $rowq['dateStart'];
	  
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
		
		// view recipe
		function view_recipe(id) {
			$("#viewRecipeModal").modal("show");
		
			let viewRecipeName = $("#recipe_" + id +" td .name").text();
			let viewCategoryName = $("#recipe_" + id +" td.category").text();
			let viewRecipeImage = "/cookbook/uploads/"+$("#recipe_" + id +" td .rec_image").text();
			let viewRecipeIngredients = $("#recipe_" + id +" td .ingredients").text();
			let viewRecipeProcedure = $("#recipe_" + id +" td .procedure").text();
			let viewRecipeAuthor = $("#recipe_" + id +" td .author").text();

		
			// Update the modal content with the fetched data
			$("#viewRecipeName").text(viewRecipeName);
			$("#viewCategoryName").text(viewCategoryName);
			$("#viewRecipeImage").attr('src', viewRecipeImage);
			$("#viewRecipeIngredients").text(viewRecipeIngredients);
			$("#viewRecipeProcedure").text(viewRecipeProcedure);
		}
		function add_item(id, name) {
			let orgvar = "scout_"+id;
			let clonevar = "scoutlink_"+id;
			let newItem = '<span id="scoutlink_'+id+'" class="list-group-item list-group-item-action mb-2 pb-2" href="" onclick="remove_item(\''+id+'\',\''+name+'\')"><h5>'+name+'<span class="btn btn-outline-warning btn-sm ms-2 d-print-none " style="float:right;">Remove</span><h5></span>'
			$("#attending").append(newItem);
			$("#scout_"+id).hide();
			$('.chooseScout').append('<option class="scoutOpt_'+id+'" value="'+id+'">'+name+'</option>')
			
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
		function buildRoster(num) {
			var date = new Date('<?php print($dateStart)?>');
			$('#total_days').val(num);
			
			for (let step = 1; step < 10; step++) {
				$('#day_'+step).remove();
			}
			
			for (let step = 1; step < num; step++) {
				
				$('#day_0').clone().prop('id', 'day_').appendTo('#days');
				$("#day_").find("[id]").add("#day_").each(function() {
					this.id = this.id + step;
				})
				$("#day_"+step).find("[name]").add("#day_"+step).each(function() {
					this.name = this.name + step;
				})
				$('#segmentday_'+step).val(step);
				$("#day_"+step+" .row").show();
				$("#day_"+step+" div div .hideRow").show();
				$("#day_"+step+" div div .showRow").hide();
				$("#day_"+step+" div div .updatefield").remove();
				$("#day_"+step).find("select").prop("disabled", false);
				// Add ten days to specified date
				date.setDate(date.getDate() + 1);
				$("#day_"+step+" .card .card-header .date").text(new Date(date).toLocaleDateString('en-us', { weekday:"long", year:"numeric", month:"short", day:"numeric"}) );
			}
			
		}
		function poof(click){
			$('#'+click).click();
		}
		function removeMeal(ele){
			$(ele).parent().next('.row').hide()
			$(ele).next('.showRow').show();
			$(ele).hide();
			$(ele).parent().next('.row').find('select').prop("disabled", true);
		}
		function showMeal(ele){
			$(ele).parent().next('.row').show();
			$(ele).prev('.hideRow').show();
			$(ele).hide();
			$(ele).parent().next('.row').find('select').prop("disabled", false);
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
		function setOptions(meal,day){
			
			if(day == 0){
				day = '';
			}
			valSet = $('#headCook_'+meal+day+'val').val();
			$('#headCook_'+meal+day +' option[value='+$('#headCook_'+meal+day+'val').val()+']').prop('selected', true);
			$('#asstCook_'+meal+day +' option[value='+$('#asstCook_'+meal+day+'val').val()+']').prop('selected', true);
			$('#leadKp_'+meal+day +' option[value='+$('#leadKp_'+meal+day+'val').val()+']').prop('selected', true);
			$('#kp_'+meal+day +' option[value='+$('#kp_'+meal+day+'val').val()+']').prop('selected', true);
			$('#trash_'+meal+day +' option[value='+$('#trash_'+meal+day+'val').val()+']').prop('selected', true);
			$('#water_'+meal+day +' option[value='+$('#water_'+meal+day+'val').val()+']').prop('selected', true);
		}
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

				   $stmtDuty = $DBcon->prepare("select * from qbranch_duty where menuId = '".$params['menu']."'");
					   $stmtDuty->execute();
					  
					   if($stmtDuty->rowCount() > 0)
					   {
						while($rowDuty=$stmtDuty->FETCH(PDO::FETCH_ASSOC))
						{
					$dutyID = $rowDuty['id'];
					$scoutsAtt = $rowDuty['scoutsAtt'];
					 $eventId = $rowDuty['eventId'];
					 $grubmaster = $rowDuty['grubmaster'];
					 $days =$rowDuty['days'];
					 $SPL=$rowDuty['SPL'];
					 $ASPL=$rowDuty['ASPL'];
					 $fireMarshal =$rowDuty['fireMarshal'];
					 $Qmaster =$rowDuty['Qmaster'];
					
						  }
						 }
						 else
						 {}
					  ?>
				  <header class="py-3 mb-4 border-bottom d-print-none">
					<div class="container d-flex flex-wrap justify-content-center">
					  <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
					<image src="/img/what2packBackInv.png" style="width: 3rem;transform: rotate(-35deg)" class="me-4">
						<span class="fs-2 title">Campout Planner for <?php print($unitName) ?> : Add Roster </span>
					  </a>
					  <form class="col-12 col-lg-auto mb-3 mb-lg-0 d-none" role="search">
						<input type="search" id="filter" class="form-control" placeholder="Search..." aria-label="Search" onkeyup="myFunction()">
					  </form>
					</div>
				  </header>
				  <div class="container" id="campout">
					<div class="card mb-3 ">
					 <h4 class="card-header d-print-none"><div class="row"><div class="col-md-6">Step Four: Duty Roster</div> 					<div class="col-md-6">
						 <?php if($dutyID > 0){?>
						 <input style="float:right" class="btn btn-primary mb-3" type="submit" name="update" value="Update Roster" form="addRoster">
						 <?php }else{?>
						 <input style="float:right" class="btn btn-primary mb-3" type="submit" name="save" value="Save Roster" form="addRoster">
						 <?php }?><a href="https://what2pack.org/planner/<?php print($params['id']); ?>" style="float:right" class="btn btn-outline-secondary me-3">Cancel</a></div></div></h4>
						 <div class="card-body">
						 
						<div class="row">
							
							<div class="col-md-4 d-print-none">
								<form id="menu_1">
									<div class="card">
								  <div class="card-header fs-4">
									Add To Roster
								  </div>
								  <div class="card-body" >
									<div id="scoutList">
										<h5><?php print($patrolName); ?> Patrol</h5>
												<?php 
												 if($dutyID > 0 AND $scoutsAtt >0){
												   $stmtx = $DBcon->prepare("select * from qbranch_roster WHERE id NOT IN (".$scoutsAtt.") AND patrolID  = '".$patrolId."' and unit = '".$params['id']."' and active ='Y'");
												   } else {
												   $stmtx = $DBcon->prepare("select * from qbranch_roster where patrolID = '".$patrolId."' and unit = '".$params['id']."' and active ='Y'");
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
									<?php if($patrolId < '96') {?>
									<div class="form-floating mb-3">
									   <select class="form-select" id="addScout" name="addScout" aria-label="Add Scout"> 
									<?php 
										$stmtx = $DBcon->prepare("select * from qbranch_roster where unit = '".$params['id']."' AND id NOT IN (".$scoutsAtt.") AND patrolID  != '".$patrolId."' and active ='Y'");
										   $stmtx->execute();
										  
										   if($stmtx->rowCount() > 0)
										   {
											   $selectLoad = "";
											while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
											{?>
												<option value="<?php print($rowx['id']);?>"><?php print($rowx['firstName']);?> <?php print($rowx['lastI']);?></option>
											<?php }
										}?>
										</select>
								  	  		<label for="addScout">Add Scout</label>
										</div>
										<span style="float:right;" class="btn btn-primary btn-sm" onclick="add_item($('#addScout').val(), $('#addScout option:selected').text())">Add to Roster</span>
												<?php } ?>							
									
								  </div>
								</div>
								</form>	
							</div>	
						<div class="col-md-8 makefull">
						<form action="/saveroster" method="POST" id="addRoster" >
							<div class="row ">
								<div class="col-12 header text-center"><input type="hidden" name="dutyId" id="dutyId" value="<?php print($dutyID); ?> " /><input type="hidden" name="total_days" id="total_days" value="<?php print($days); ?> " /><input type="hidden" name="eventId" id="eventId" value="<?php print($event); ?>" /><input type="hidden" name="menuId" id="menuId" value="<?php print($params['menu'])?>"" /><input type="hidden" name="unit" id="unit" value="<?php print($params['id'])?>" />
									<h3><?php print($patrolName); ?> Duty Roster for <?php print($eventName); ?></h3>
									<div class="btn-toolbar mx-auto d-print-none" role="toolbar" aria-label="Toolbar with button groups">
									  <div class="btn-group mx-auto mb-3" role="group" aria-label="First group">
										<button type="button" class="btn btn-secondary" onclick="buildRoster(1)">1 Day</button>
										<button type="button" class="btn btn-secondary" onclick="buildRoster(2)">2 Days</button>
										<button type="button" class="btn btn-secondary" onclick="buildRoster(3)">3 Days</button>
										<button type="button" class="btn btn-secondary" onclick="buildRoster(4)">4 Days</button>
									  </div>
									  <div class="btn-group mx-auto mb-3" role="group" aria-label="Second group">
										<button type="button" class="btn btn-secondary" onclick="buildRoster(4)">Winter Camp</button>
										<button type="button" class="btn btn-secondary" onclick="buildRoster(7)">Summer Camp</button>
									  </div>
									</div>
								</div>	
						
							 
							 </div> <div class="row mt-3">
							  <div class="col-md-6">
								 
								  <div class="card">
									<div class="card-header fs-4">
									  Troop Roles
									</div>
									<div class="card-body">
									  <?php 
									  if($dutyID > 0){
										?>
										<div class="form-floating mb-3">
											<input type="text" class="form-control" id="SPL" name="SPL" value="<?php print($SPL); ?>">
											<label for="SPL">Senior Patrol Leader</label>
										  </div>
										<?php  
									  } else {
										 $stmtx = $DBcon->prepare("select * from qbranch_roster where unit = '".$params['id']."' AND position = 'Senior Patrol Leader' and active ='Y'");
											 $stmtx->execute();
											
											 if($stmtx->rowCount() > 0)
											 {
											  while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
											  {
											?>
									  <div class="form-floating mb-3">
										<input type="text" class="form-control" id="SPL" name="SPL" value="<?php print($rowx['firstName']); ?> <?php print($rowx['lastI']); ?>">
										<label for="SPL">Senior Patrol Leader</label>
									  </div>
									  <?php
										  }
										 }
										 else
										 {}
									 }
									  ?>
									 <?php 
									   if($dutyID > 0){
										 ?>
										 <div class="form-floating mb-3">
											 <input type="text" class="form-control" id="ASPL" name="ASPL" value="<?php print($ASPL); ?>">
											 <label for="SPL">Asst. Senior Patrol Leader</label>
										   </div>
										 <?php  
									   } else {
									   $stmtx = $DBcon->prepare("select * from qbranch_roster where unit = '".$params['id']."' AND position = 'Assistant Senior Patrol Leader' and active ='Y'");
										   $stmtx->execute();
										  
										   if($stmtx->rowCount() > 0)
										   {
											while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
											{
										  ?>
									  <div class="form-floating mb-3">
										<input type="text" class="form-control" id="ASPL" name="ASPL" value="<?php print($rowx['firstName']); ?> <?php print($rowx['lastI']); ?>">
										<label for="ASPL">Asst. Senior Patrol Leader</label>
									  </div>
									  <?php
											}
										   }
										
									   }
										?>
									 <?php 
									   if($dutyID > 0){
										 ?>
										 <div class="form-floating mb-3">
											 <input type="text" class="form-control" id="Qmaster" name="Qmaster" value="<?php print($Qmaster); ?>">
											 <label for="SPL">Quartermaster</label>
										   </div>
										 <?php  
									   } else {
									   $stmtx = $DBcon->prepare("select * from qbranch_roster where unit = '".$params['id']."' AND position = 'Quartermaster' and active ='Y'");
										   $stmtx->execute();
										  
										   if($stmtx->rowCount() > 0)
										   {
											while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
											{
										  ?>
									  <div class="form-floating mb-3">
										  <input type="text" class="form-control" id="Qmaster" name="Qmaster" value="<?php print($rowx['firstName']); ?> <?php print($rowx['lastI']); ?>">
										  <label for="Qmaster">Quartermaster</label>
										</div>
										<?php
											  }
											}
										}
									
										  ?>
									
									  <div class="form-floating mb-3">
										<input type="text" class="form-control" id="fireMarshal" name="fireMarshal" value="<?php print($fireMarshal);?>">
										<label for="fireMarshal">Fire Marshal</label>
									  </div>
									
									</div>
								  </div>
							  </div>
						  <div class="col-md-6">
							   
								<div class="card">
								  <div class="card-header fs-4">
									  <?php if($patrolId < '96') {?>
									Scouts Attending 
									<?php } else {?>
										Adults Attending
									<?php } ?>
								  </div>
								  <div class="card-body" id="attending">
									  <?php 
										if($dutyID > 0  AND $scoutsAtt >0){
										  
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
							 <h4 class="mt-3 row">Patrol Grubmaster</h4>
							 <div class="row">
								 <div class="col-md-12"><div class="form-floating mb-3">
									  <input type="text" class="form-control" id="grubmaster" name="grubmaster" value="<?php print($grubmaster);?>">
									  <label for="floating10">Grubmaster</label>
									</div>
								</div>
							</div>
							<div id="days">
							<div id="day_0" style="page-break-inside:avoid;">
								 <div class="card" >
									 <div class="card-header"><input type="hidden" value="0" name="segmentday_" id="segmentday_">
										<h4 class="mt-3 date"><?php
										$date = date_create($dateStart);
										echo date_format($date, 'l\, M d\, Y');
										?></h4>
									   </div>
									 
									 <div class="card-title fs-4 p-2">Breakfast	 <?php
										  $stmtx = $DBcon->prepare("select * from qbranch_rosterdetail where dutyId = '".$dutyID."' AND day = '0' AND meal = 'Breakfast' ");
											 $stmtx->execute();
											
											 if($stmtx->rowCount() > 0)
											 {
											  while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
											  {
											?>
											<input class="updateField" type="hidden" id="headCook_bval" name="headCook_bval" value="<?php print($rowx['headCook']); ?>">
											<input class="updateField" type="hidden" id="asstCook_bval" name="asstCook_bval" value="<?php print($rowx['asstCook']); ?>">
											<input class="updateField" type="hidden" id="leadKp_bval" name="leadKp_bval" value="<?php print($rowx['leadKP']); ?>">
											<input class="updateField" type="hidden" id="kp_bval" name="kp_bval" value="<?php print($rowx['kp']); ?>">
											<input class="updateField" type="hidden" id="water_bval" name="water_bval" value="<?php print($rowx['water']); ?>">
											<input class="updateField" type="hidden" id="trash_bval" name="trash_bval" value="<?php print($rowx['trash']); ?>">
											<input class="updateField" type="hidden" value="<?php print($rowx['id']); ?>" id="rowId_b" name="rowId_b">
										<?php 
										   }} else {
										   ?>
										   <script>$( document ).ready(function() {
											   poof('remRow_B');
										   });</script>
										   <?php 	
										   }
										   ?>
												<script>$( document ).ready(function() {
													setOptions('b','0');
															});</script>
										 <span id="remRow_B" style="float:right;" class="btn btn-sm btn-outline-danger mt-2 me-2 hideRow" onclick="removeMeal(this)">Remove</span>
										  <span style="float:right; display: none;" class="btn btn-sm btn-outline-primary mt-2 me-2 showRow" onclick="showMeal(this)">Add</span></div>
									
									 <div class="row g-1">
									 <div class="col-md-4">
									 <div class="card" >
									
									   <ul class="list-group list-group-flush">
										 <li class="list-group-item bg-body-secondary">Cooks</li>
										 <li class="list-group-item">
											<div class="form-floating mb-3">
											   <select class="form-select chooseScout" id="headCook_b" name="headCook_b" aria-label="Head Cook"> 
												   <option value="0" selected>Ghost Scout</option>
												</select>
												  <label for="headCook">Head Cook</label>
											</div>											   
										 </li>
										 <li class="list-group-item">
											 <div class="form-floating mb-3">
												<select class="form-select chooseScout" id="asstCook_b" name="asstCook_b" aria-label="Asst. Cook"> 
													<option value="0" selected>Ghost Scout</option>
												 </select>
												   <label for="headCook">Asst. Cook</label>
											 </div>
										 </li>
									   </ul>
									 </div>
										 
								 </div>
								 <div class="col-md-4">
									  <div class="card" >
										<ul class="list-group list-group-flush">
										  <li class="list-group-item bg-body-secondary">KP</li>
										<li class="list-group-item">
											<div class="form-floating mb-3">
											   <select class="form-select chooseScout" id="leadKp_b" name="leadKp_b" aria-label="Lead KP"> 
												   <option value="0" selected>Ghost Scout</option>
												</select>
												  <label for="leadKp">Lead KP</label>
											</div>											   
										 </li>
										 <li class="list-group-item">
											 <div class="form-floating mb-3">
												<select class="form-select chooseScout" id="kp_b" name="kp_b" aria-label="KP"> 
													<option value="0" selected>Ghost Scout</option>
												 </select>
												   <label for="kp">KP</label>
											 </div>
										 </li>
										</ul>
									  </div>
										  
								  </div>
								  <div class="col-md-4">
										<div class="card" >
										  <ul class="list-group list-group-flush">
											<li class="list-group-item bg-body-secondary">Water/Trash</li>
											<li class="list-group-item">
												 <div class="form-floating mb-3">
												 <div class="form-floating">
												   <select class="form-select chooseScout" id="trash_b" name="trash_b" aria-label="Trash"> 
													   <option value="0" selected>Ghost Scout</option>
													</select>
													  <label for="trash">Trash</label>
												</div>											   
											 </li>
											 <li class="list-group-item">
												 <div class="form-floating mb-3">
													<select class="form-select chooseScout" id="water_b" name="water_b" aria-label="Water"> 
														<option value="0" selected>Ghost Scout</option>
													 </select>
													   <label for="water">Water</label>
												 </div>
											 </li>
										  </ul>
										</div>
											
									</div>
							 </div>
							 <div class="card-title fs-4 p-2" >Lunch <?php
								   $stmtx = $DBcon->prepare("select * from qbranch_rosterdetail where dutyId = '".$dutyID."' AND day = '0' AND meal = 'Lunch' ");
									  $stmtx->execute();
									 
									  if($stmtx->rowCount() > 0)
									  {
									   while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
									   {
									 ?>
									 <input class="updateField" type="hidden" id="headCook_lval" name="headCook_lval" value="<?php print($rowx['headCook']); ?>">
									 <input class="updateField" type="hidden" id="asstCook_lval" name="asstCook_lval" value="<?php print($rowx['asstCook']); ?>">
									 <input class="updateField" type="hidden" id="leadKp_lval" name="leadKp_lval" value="<?php print($rowx['leadKP']); ?>">
									 <input class="updateField" type="hidden" id="kp_lval" name="kp_lval" value="<?php print($rowx['kp']); ?>">
									 <input class="updateField" type="hidden" id="water_lval" name="water_lval" value="<?php print($rowx['water']); ?>">
									 <input class="updateField" type="hidden" id="trash_lval" name="trash_lval" value="<?php print($rowx['trash']); ?>">
									 <input class="updateField" type="hidden" value="<?php print($rowx['id']); ?>" id="rowId_l" name="rowId_l">
									 <?php 
										 }} else {
										 ?>
										 <script>$( document ).ready(function() {
											 poof('remRow_L');
										 });</script>
										 <?php 	
										 }
										 ?>
										 <script>$( document ).ready(function() {
										 setOptions('l','0');
												 });</script>
							 <span id="remRow_L" style="float:right;" class="btn btn-sm btn-outline-danger mt-2 me-2 hideRow" onclick="removeMeal(this)">Remove</span>
							 <span style="float:right; display: none;" class="btn btn-sm btn-outline-primary mt-2 me-2 showRow" onclick="showMeal(this)">Add</span>
							 </div>
									  <div class="row g-1">
									  <div class="col-md-4">
									  <div class="card" >
										<ul class="list-group list-group-flush">
										  <li class="list-group-item bg-body-secondary">Cooks</li>
										  <li class="list-group-item">
											  <div class="form-floating mb-3">
												<select class="form-select chooseScout" id="headCook_l" name="headCook_l" aria-label="Head Cook"> 
													<option value="0" selected>Ghost Scout</option>
												 </select>
												   <label for="headCook_l">Head Cook</label>
											 </div>										   
										  </li>
										  <li class="list-group-item">
											  <div class="form-floating mb-3">
												 <select class="form-select chooseScout" id="asstCook_l" name="asstCook_l" aria-label="Asst. Cook"> 
													 <option value="0" selected>Ghost Scout</option>
												  </select>
													<label for="asstCook_l">Asst. Cook</label>
											  </div>
										  </li>
										</ul>
									  </div>
										  
								  </div>
								  <div class="col-md-4">
									   <div class="card" >
										 <ul class="list-group list-group-flush">
										   <li class="list-group-item bg-body-secondary">KP</li>
										 <li class="list-group-item">
											  <div class="form-floating mb-3">
												<select class="form-select chooseScout" id="leadKp_l" name="leadKp_l" aria-label="Lead KP"> 
													<option value="0" selected>Ghost Scout</option>
												 </select>
												   <label for="leadKp_l">Lead KP</label>
											 </div>											   
										  </li>
										  <li class="list-group-item">
											  <div class="form-floating mb-3">
												 <select class="form-select chooseScout" id="kp_l" name="kp_l" aria-label="KP"> 
													 <option value="0" selected>Ghost Scout</option>
												  </select>
													<label for="kp_l">KP</label>
											  </div>
										  </li>
										 </ul>
									   </div>
										   
								   </div>
								   <div class="col-md-4">
										 <div class="card" >
										   <ul class="list-group list-group-flush">
											 <li class="list-group-item bg-body-secondary">Water/Trash</li>
											 <li class="list-group-item">
												  <div class="form-floating mb-3">
													<select class="form-select chooseScout" id="trash_l" name="trash_l" aria-label="Trash"> 
														<option value="0" selected>Ghost Scout</option>
													 </select>
													   <label for="trash_l">Trash</label>
												 </div>											   
											  </li>
											  <li class="list-group-item">
												  <div class="form-floating mb-3">
													 <select class="form-select chooseScout" id="water_l" name="water_l" aria-label="Water"> 
														 <option value="0" selected>Ghost Scout</option>
													  </select>
														<label for="water_l">Water</label>
												  </div>
											  </li>
										   </ul>
										 </div>
											 
									 </div>
							  </div>
							  <div class="card-title fs-4 p-2" >Dinner<?php
									 $stmtx = $DBcon->prepare("select * from qbranch_rosterdetail where dutyId = '".$dutyID."' AND day = '0' AND meal = 'Lunch' ");
										$stmtx->execute();
									   
										if($stmtx->rowCount() > 0)
										{
										 while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
										 {
									   ?>
									   <input class="updateField" type="hidden" id="headCook_dval" name="headCook_dval" value="<?php print($rowx['headCook']); ?>">
									   <input class="updateField" type="hidden" id="asstCook_dval" name="asstCook_dval" value="<?php print($rowx['asstCook']); ?>">
									   <input class="updateField" type="hidden" id="leadKp_dval" name="leadKp_dval" value="<?php print($rowx['leadKP']); ?>">
									   <input class="updateField" type="hidden" id="kp_dval" name="kp_dval" value="<?php print($rowx['kp']); ?>">
									   <input class="updateField" type="hidden" id="water_dval" name="water_dval" value="<?php print($rowx['water']); ?>">
									   <input class="updateField" type="hidden" id="trash_dval" name="trash_dval" value="<?php print($rowx['trash']); ?>">
									   <input class="updateField" type="hidden" value="<?php print($rowx['id']); ?>" id="rowId_d" name="rowId_d">
									   
									   <?php 
										   }} else {
										   ?>
										   <script>$( document ).ready(function() {
											   poof('remRow_D');
										   });</script>
										   <?php 	
										   }
										   ?>
										   <script>$( document ).ready(function() {
										   setOptions('d','0');
												   });</script>
							
								  <span id="remRow_D" style="float:right;" class="btn btn-sm btn-outline-danger mt-2 me-2 hideRow" onclick="removeMeal(this)">Remove</span>
								   <span style="float:right; display: none;" class="btn btn-sm btn-outline-primary mt-2 me-2 showRow" onclick="showMeal(this)">Add</span>
							  </div>
									   <div class="row g-1">
									   <div class="col-md-4">
									   <div class="card" >
										 <ul class="list-group list-group-flush">
										   <li class="list-group-item bg-body-secondary">Cooks</li>
										   <li class="list-group-item">
											   <div class="form-floating mb-3">
												 <select class="form-select chooseScout" id="headCook_d" name="headCook_d" aria-label="Head Cook"> 
													 <option value="0" selected>Ghost Scout</option>
												  </select>
													<label for="headCook_d">Head Cook</label>
											  </div>											   
										   </li>
										   <li class="list-group-item">
											   <div class="form-floating mb-3">
												  <select class="form-select chooseScout" id="asstCook_d" name="asstCook_d" aria-label="Asst. Cook"> 
													  <option value="0" selected>Ghost Scout</option>
												   </select>
													 <label for="asstCook_d">Asst. Cook</label>
											   </div>
										   </li>
										 </ul>
									   </div>
										   
								   </div>
								   <div class="col-md-4">
										<div class="card" >
										  <ul class="list-group list-group-flush">
											<li class="list-group-item bg-body-secondary">KP</li>
										  <li class="list-group-item">
											   <div class="form-floating mb-3">
												 <select class="form-select chooseScout" id="leadKp_d" name="leadKp_d" aria-label="Lead KP"> 
													 <option value="0" selected>Ghost Scout</option>
												  </select>
													<label for="leadKp_d">Lead KP</label>
											  </div>											   
										   </li>
										   <li class="list-group-item">
											   <div class="form-floating mb-3">
												  <select class="form-select chooseScout" id="kp_d" name="kp_d" aria-label="KP"> 
													  <option value="0" selected>Ghost Scout</option>
												   </select>
													 <label for="kp_d">KP</label>
											   </div>
										   </li>
										  </ul>
										</div>
											
									</div>
									<div class="col-md-4">
										  <div class="card" >
											<ul class="list-group list-group-flush">
											  <li class="list-group-item bg-body-secondary">Water/Trash</li>
											  <li class="list-group-item">
												   <div class="form-floating mb-3">
													 <select class="form-select chooseScout" id="trash_d" name="trash_d" aria-label="Trash"> 
														 <option value="0" selected>Ghost Scout</option>
													  </select>
														<label for="trash_d">Trash</label>
												  </div>											   
											   </li>
											   <li class="list-group-item">
												   <div class="form-floating mb-3">
													<div class="form-floating">
													  <select class="form-select chooseScout" id="water_d" name="water_d" aria-label="Water"> 
														  <option value="0" selected>Ghost Scout</option>
													   </select>
														 <label for="water_d">Water</label>
												   </div>
											   </li>
											</ul>
										  </div>
											  
									  </div>
							   </div>
							 </div>
							 
							 
							  </div>	
							<?php
							$i = 1 ; 
							while ($i <= $days-1) {?>	
							<div id="day_<?php print($i); ?>" style="page-break-inside:avoid;page-break-after:always">
								 <div class="card" >
									 <div class="card-header"><input type="hidden" value="<?php print($i); ?>" name="segmentday_<?php print($i); ?>" id="segmentday_<?php print($i); ?>">
										<h4 class="mt-3 date"><?php
										$date = date_create($dateStart);
										$date->add(new DateInterval('P'.$i.'D'));
										echo date_format($date, 'l\, M d\, Y');
										?></h4>
									   </div>
									 
									 <div class="card-title fs-4 p-2">Breakfast	 <?php
										  $stmtx1 = $DBcon->prepare("select * from qbranch_rosterdetail where dutyId = '".$dutyID."' AND day = '".$i."' AND meal = 'Breakfast' ");
											 $stmtx1->execute();
											
											 if($stmtx1->rowCount() > 0)
											 {
											  while($rowx1=$stmtx1->FETCH(PDO::FETCH_ASSOC))
											  {
											?>
											<input class="updateField" type="hidden" id="headCook_b<?php print($i); ?>val" name="headCook_b<?php print($i); ?>val" value="<?php print($rowx1['headCook']); ?>">
											<input class="updateField" type="hidden" id="asstCook_b<?php print($i); ?>val" name="asstCook_b<?php print($i); ?>val" value="<?php print($rowx1['asstCook']); ?>">
											<input class="updateField" type="hidden" id="leadKp_b<?php print($i); ?>val" name="leadKp_b<?php print($i); ?>val" value="<?php print($rowx1['leadKP']); ?>">
											<input class="updateField" type="hidden" id="kp_b<?php print($i); ?>val" name="kp_b<?php print($i); ?>val" value="<?php print($rowx1['kp']); ?>">
											<input class="updateField" type="hidden" id="water_b<?php print($i); ?>val" name="water_b<?php print($i); ?>val" value="<?php print($rowx1['water']); ?>">
											<input class="updateField" type="hidden" id="trash_b<?php print($i); ?>val" name="trash_b<?php print($i); ?>val" value="<?php print($rowx1['trash']); ?>">
											<input class="updateField" type="hidden" value="<?php print($rowx1['id']); ?>" id="rowId_b<?php print($i); ?>" name="rowId_b<?php print($i); ?>">
											<?php 
												}} else {
												?>
												<script>$( document ).ready(function() {
													poof('remRow_B<?php print($i); ?>');
												});</script>
												<?php 	
												}
												?>
												<script>$( document ).ready(function() {
													setOptions('b','<?php print($i); ?>');
															});</script>
										 <span id="remRow_B<?php print($i); ?>" style="float:right;" class="btn btn-sm btn-outline-danger mt-2 me-2 hideRow" onclick="removeMeal(this)">Remove</span>
										  <span style="float:right; display: none;" class="btn btn-sm btn-outline-primary mt-2 me-2 showRow" onclick="showMeal(this)">Add</span></div>
									
									 <div class="row g-1">
									 <div class="col-md-4">
									 <div class="card" >
									
									   <ul class="list-group list-group-flush">
										 <li class="list-group-item bg-body-secondary">Cooks</li>
										 <li class="list-group-item">
											<div class="form-floating mb-3">
											   <select class="form-select chooseScout" id="headCook_b<?php print($i); ?>" name="headCook_b<?php print($i); ?>" aria-label="Head Cook"> 
												   <option value="0" selected>Ghost Scout</option>
												</select>
												  <label for="headCook">Head Cook</label>
											</div>											   
										 </li>
										 <li class="list-group-item">
											 <div class="form-floating mb-3">
												<select class="form-select chooseScout" id="asstCook_b<?php print($i); ?>" name="asstCook_b<?php print($i); ?>" aria-label="Asst. Cook"> 
													<option value="0" selected>Ghost Scout</option>
												 </select>
												   <label for="headCook">Asst. Cook</label>
											 </div>
										 </li>
									   </ul>
									 </div>
										 
								 </div>
								 <div class="col-md-4">
									  <div class="card" >
										<ul class="list-group list-group-flush">
										  <li class="list-group-item bg-body-secondary">KP</li>
										<li class="list-group-item">
											<div class="form-floating mb-3">
											   <select class="form-select chooseScout" id="leadKp_b<?php print($i); ?>" name="leadKp_b<?php print($i); ?>" aria-label="Lead KP"> 
												   <option value="0" selected>Ghost Scout</option>
												</select>
												  <label for="leadKp">Lead KP</label>
											</div>											   
										 </li>
										 <li class="list-group-item">
											 <div class="form-floating mb-3">
												<select class="form-select chooseScout" id="kp_b<?php print($i); ?>" name="kp_b<?php print($i); ?>" aria-label="KP"> 
													<option value="0" selected>Ghost Scout</option>
												 </select>
												   <label for="kp">KP</label>
											 </div>
										 </li>
										</ul>
									  </div>
										  
								  </div>
								  <div class="col-md-4">
										<div class="card" >
										  <ul class="list-group list-group-flush">
											<li class="list-group-item bg-body-secondary">Water/Trash</li>
											<li class="list-group-item">
												 <div class="form-floating mb-3">
												 <div class="form-floating">
												   <select class="form-select chooseScout" id="trash_b<?php print($i); ?>" name="trash_b<?php print($i); ?>" aria-label="Trash"> 
													   <option value="0" selected>Ghost Scout</option>
													</select>
													  <label for="trash">Trash</label>
												</div>											   
											 </li>
											 <li class="list-group-item">
												 <div class="form-floating mb-3">
													<select class="form-select chooseScout" id="water_b<?php print($i); ?>" name="water_b<?php print($i); ?>" aria-label="Water"> 
														<option value="0" selected>Ghost Scout</option>
													 </select>
													   <label for="water">Water</label>
												 </div>
											 </li>
										  </ul>
										</div>
											
									</div>
							 </div>
							 <div class="card-title fs-4 p-2" >Lunch <?php
								   $stmtx2 = $DBcon->prepare("select * from qbranch_rosterdetail where dutyId = '".$dutyID."' AND day = '".$i."' AND meal = 'Lunch' ");
									  $stmtx2->execute();
									 
									  if($stmtx2->rowCount() > 0)
									  {
									   while($rowx2=$stmtx2->FETCH(PDO::FETCH_ASSOC))
									   {
									 ?>
									 <input class="updateField" type="hidden" id="headCook_l<?php print($i); ?>val" name="headCook_l<?php print($i); ?>val" value="<?php print($rowx2['headCook']); ?>">
									 <input class="updateField" type="hidden" id="asstCook_l<?php print($i); ?>val" name="asstCook_l<?php print($i); ?>val" value="<?php print($rowx2['asstCook']); ?>">
									 <input class="updateField" type="hidden" id="leadKp_l<?php print($i); ?>val" name="leadKp_l<?php print($i); ?>val" value="<?php print($rowx2['leadKP']); ?>">
									 <input class="updateField" type="hidden" id="kp_l<?php print($i); ?>val" name="kp_l<?php print($i); ?>val" value="<?php print($rowx2['kp']); ?>">
									 <input class="updateField" type="hidden" id="water_l<?php print($i); ?>val" name="water_l<?php print($i); ?>val" value="<?php print($rowx2['water']); ?>">
									 <input class="updateField" type="hidden" id="trash_l<?php print($i); ?>val" name="trash_l<?php print($i); ?>val" value="<?php print($rowx2['trash']); ?>">
									 <input class="updateField" type="hidden" value="<?php print($rowx2['id']); ?>" id="rowId_l<?php print($i); ?>" name="rowId_l<?php print($i); ?>">
									 <?php 
										 }} else {
										 ?>
										 <script>$( document ).ready(function() {
											 console.log('lunch');
											 poof('remRow_L<?php print($i); ?>');
										 });</script>
										 <?php 	
										 }
										 ?>
										 <script>$( document ).ready(function() {
										 setOptions('l','<?php print($i); ?>');
												 });</script>
							 <span id="remRow_L<?php print($i); ?>" style="float:right;" class="btn btn-sm btn-outline-danger mt-2 me-2 hideRow" onclick="removeMeal(this)">Remove</span>
							 <span style="float:right; display: none;" class="btn btn-sm btn-outline-primary mt-2 me-2 showRow" onclick="showMeal(this)">Add</span>
							 </div>
									  <div class="row g-1">
									  <div class="col-md-4">
									  <div class="card" >
										<ul class="list-group list-group-flush">
										  <li class="list-group-item bg-body-secondary">Cooks</li>
										  <li class="list-group-item">
											  <div class="form-floating mb-3">
												<select class="form-select chooseScout" id="headCook_l<?php print($i); ?>" name="headCook_l<?php print($i); ?>" aria-label="Head Cook"> 
													<option value="0" selected>Ghost Scout</option>
												 </select>
												   <label for="headCook_l">Head Cook</label>
											 </div>										   
										  </li>
										  <li class="list-group-item">
											  <div class="form-floating mb-3">
												 <select class="form-select chooseScout" id="asstCook_l<?php print($i); ?>" name="asstCook_l<?php print($i); ?>" aria-label="Asst. Cook"> 
													 <option value="0" selected>Ghost Scout</option>
												  </select>
													<label for="asstCook_l">Asst. Cook</label>
											  </div>
										  </li>
										</ul>
									  </div>
										  
								  </div>
								  <div class="col-md-4">
									   <div class="card" >
										 <ul class="list-group list-group-flush">
										   <li class="list-group-item bg-body-secondary">KP</li>
										 <li class="list-group-item">
											  <div class="form-floating mb-3">
												<select class="form-select chooseScout" id="leadKp_l<?php print($i); ?>" name="leadKp_l<?php print($i); ?>" aria-label="Lead KP"> 
													<option value="0" selected>Ghost Scout</option>
												 </select>
												   <label for="leadKp_l">Lead KP</label>
											 </div>											   
										  </li>
										  <li class="list-group-item">
											  <div class="form-floating mb-3">
												 <select class="form-select chooseScout" id="kp_l<?php print($i); ?>" name="kp_l<?php print($i); ?>" aria-label="KP"> 
													 <option value="0" selected>Ghost Scout</option>
												  </select>
													<label for="kp_l">KP</label>
											  </div>
										  </li>
										 </ul>
									   </div>
										   
								   </div>
								   <div class="col-md-4">
										 <div class="card" >
										   <ul class="list-group list-group-flush">
											 <li class="list-group-item bg-body-secondary">Water/Trash</li>
											 <li class="list-group-item">
												  <div class="form-floating mb-3">
													<select class="form-select chooseScout" id="trash_l<?php print($i); ?>" name="trash_l<?php print($i); ?>" aria-label="Trash"> 
														<option value="0" selected>Ghost Scout</option>
													 </select>
													   <label for="trash_l">Trash</label>
												 </div>											   
											  </li>
											  <li class="list-group-item">
												  <div class="form-floating mb-3">
													 <select class="form-select chooseScout" id="water_l<?php print($i); ?>" name="water_l<?php print($i); ?>" aria-label="Water"> 
														 <option value="0" selected>Ghost Scout</option>
													  </select>
														<label for="water_l">Water</label>
												  </div>
											  </li>
										   </ul>
										 </div>
											 
									 </div>
							  </div>
							  <div class="card-title fs-4 p-2" >Dinner<?php
									 $stmtx3 = $DBcon->prepare("select * from qbranch_rosterdetail where dutyId = '".$dutyID."' AND day = '".$i."' AND meal = 'Dinner' ");
										$stmtx3->execute();
									   
										if($stmtx3->rowCount() > 0)
										{
											
											?><script>console.log(<?php print($stmtx3->rowCount());?> )</script><?php
										 while($rowx3=$stmtx3->FETCH(PDO::FETCH_ASSOC))
										 {
									   ?>
									   <input class="updateField" type="hidden" id="headCook_d<?php print($i); ?>val" name="headCook_d<?php print($i); ?>val" value="<?php print($rowx3['headCook']); ?>">
									   <input class="updateField" type="hidden" id="asstCook_d<?php print($i); ?>val" name="asstCook_d<?php print($i); ?>val" value="<?php print($rowx3['asstCook']); ?>">
									   <input class="updateField" type="hidden" id="leadKp_d<?php print($i); ?>val" name="leadKp_d<?php print($i); ?>val" value="<?php print($rowx3['leadKP']); ?>">
									   <input class="updateField" type="hidden" id="kp_d<?php print($i); ?>val" name="kp_d<?php print($i); ?>val" value="<?php print($rowx3['kp']); ?>">
									   <input class="updateField" type="hidden" id="water_d<?php print($i); ?>val" name="water_d<?php print($i); ?>val" value="<?php print($rowx3['water']); ?>">
									   <input class="updateField" type="hidden" id="trash_d<?php print($i); ?>val" name="trash_d<?php print($i); ?>val" value="<?php print($rowx3['trash']); ?>">
									   <input class="updateField" type="hidden" value="<?php print($rowx3['id']); ?>" id="rowId_d<?php print($i); ?>" name="rowId_d<?php print($i); ?>">
									   <script>$( document ).ready(function() {
											  console.log('dinner2_<?php print($dutyID); ?>');
										  setOptions('d','<?php print($i); ?>');
												  });</script>
									   <?php 
										   }} else {
										   ?>
										   <script>$( document ).ready(function() {
											   console.log('dinner');
											   poof('remRow_D<?php print($i); ?>');
										   });</script>
										   <?php 	
										   }
										   ?>
										   
							
								  <span id="remRow_D<?php print($i); ?>" style="float:right;" class="btn btn-sm btn-outline-danger mt-2 me-2 hideRow" onclick="removeMeal(this)">Remove</span>
								   <span style="float:right; display: none;" class="btn btn-sm btn-outline-primary mt-2 me-2 showRow" onclick="showMeal(this)">Add</span>
							  </div>
									   <div class="row g-1">
									   <div class="col-md-4">
									   <div class="card" >
										 <ul class="list-group list-group-flush">
										   <li class="list-group-item bg-body-secondary">Cooks</li>
										   <li class="list-group-item">
											   <div class="form-floating mb-3">
												 <select class="form-select chooseScout" id="headCook_d<?php print($i); ?>" name="headCook_d<?php print($i); ?>" aria-label="Head Cook"> 
													 <option value="0" selected>Ghost Scout</option>
												  </select>
													<label for="headCook_d">Head Cook</label>
											  </div>											   
										   </li>
										   <li class="list-group-item">
											   <div class="form-floating mb-3">
												  <select class="form-select chooseScout" id="asstCook_d<?php print($i); ?>" name="asstCook_d<?php print($i); ?>" aria-label="Asst. Cook"> 
													  <option value="0" selected>Ghost Scout</option>
												   </select>
													 <label for="asstCook_d">Asst. Cook</label>
											   </div>
										   </li>
										 </ul>
									   </div>
										   
								   </div>
								   <div class="col-md-4">
										<div class="card" >
										  <ul class="list-group list-group-flush">
											<li class="list-group-item bg-body-secondary">KP</li>
										  <li class="list-group-item">
											   <div class="form-floating mb-3">
												 <select class="form-select chooseScout" id="leadKp_d<?php print($i); ?>" name="leadKp_d<?php print($i); ?>" aria-label="Lead KP"> 
													 <option value="0" selected>Ghost Scout</option>
												  </select>
													<label for="leadKp_d">Lead KP</label>
											  </div>											   
										   </li>
										   <li class="list-group-item">
											   <div class="form-floating mb-3">
												  <select class="form-select chooseScout" id="kp_d<?php print($i); ?>" name="kp_d<?php print($i); ?>" aria-label="KP"> 
													  <option value="0" selected>Ghost Scout</option>
												   </select>
													 <label for="kp_d">KP</label>
											   </div>
										   </li>
										  </ul>
										</div>
											
									</div>
									<div class="col-md-4">
										  <div class="card" >
											<ul class="list-group list-group-flush">
											  <li class="list-group-item bg-body-secondary">Water/Trash</li>
											  <li class="list-group-item">
												   <div class="form-floating mb-3">
													 <select class="form-select chooseScout" id="trash_d<?php print($i); ?>" name="trash_d<?php print($i); ?>" aria-label="Trash"> 
														 <option value="0" selected>Ghost Scout</option>
													  </select>
														<label for="trash_d">Trash</label>
												  </div>											   
											   </li>
											   <li class="list-group-item">
												   <div class="form-floating mb-3">
													<div class="form-floating">
													  <select class="form-select chooseScout" id="water_d<?php print($i); ?>" name="water_d<?php print($i); ?>" aria-label="Water"> 
														  <option value="0" selected>Ghost Scout</option>
													   </select>
														 <label for="water_d">Water</label>
												   </div>
											   </li>
											</ul>
										  </div>
											  
									  </div>
							   </div>
							 </div>
							 
							 
							  </div>
							  <?php $i++;} ?>
							  </div>
							  </div>
							 
						</div>
					   </div>
					<h4 class="card-footer d-print-none mb-0"><div class="row"><div class="col-md-6">Step Four: Duty Roster</div> 					<div class="col-md-6">
					 <?php if($dutyID > 0){?>
					 <input style="float:right" class="btn btn-primary mb-3" type="submit" name="update" value="Update Roster" form="addRoster">
					 <?php }else{?>
					 <input style="float:right" class="btn btn-primary mb-3" type="submit" name="save" value="Save Roster" form="addRoster">
					 <?php }?><a href="https://what2pack.org/planner/<?php print($params['id']); ?>" style="float:right" class="btn btn-outline-secondary me-3">Cancel</a></div></div></h4>
					</div>
						
											  
							</form>
				  </div>
	 <div class="container">
		<div style="page-break-inside:avoid;"></div> 
		 <?php 
			$stmtM = $DBcon->prepare("SELECT * 
				 FROM 
					 `tbl_recipe`
				 LEFT JOIN
					 `tbl_category` ON
					 `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id`  where `tbl_recipe_id` IN (".$menulist.") ");
				$stmtM->execute();
			   
				if($stmtM->rowCount() > 0)
				{
				 while($row=$stmtM->FETCH(PDO::FETCH_ASSOC))
				 {
					
			   ?><div class="card mb-3">
				   <div class="card-body">
					<h5 class="card-title name" onclick="view_recipe('<?php print($row['tbl_recipe_id']); ?>')"><?php print($row['recipe_name']); ?></h5>
				<div class="card-text"><b><?php print($row['category_name']); ?></b><br>
				<b>Author:</b><p><span class=" author"><?php print($row['recipe_author']); ?></span></p>
				<?php if($row['is_gf'] == 'yes'){ ?>
					   <span style="display:block"><b class="gf" style="color:lightgreen">Gluten Free</b> </span>
					<?php } ?>
					<?php if($row['is_veg'] == 'yes'){ ?>
					   <span style="display:block"><b class="veg" style="color:lightgreen">Vegetarian</b> </span>
					<?php } ?>
					<?php if($row['is_halalkosher'] == 'yes'){ ?>
					   <span style="display:block"><b class="kosher" style="color:lightgreen">Halal/Kosher</b> </span>
					<?php } ?>
					<?php if($row['has_treenuts'] == 'yes'){ ?>
					   <span style="display:block"> <i class="fa-solid fa-triangle-exclamation" style="color:orangered"></i> <b class="treenuts" style="color:orangered">Tree Nuts</b></span>
					<?php } ?>
				   <?php if($row['has_lactose'] == 'yes'){ ?>
					  <span style="display:block"> <i class="fa-solid fa-triangle-exclamation" style="color:orangered"></i> <b class="lactose" style="color:orangered">Lactose</b></span>
				   <?php } ?>
				   <?php if($row['has_eggs']== 'yes'){ ?>
					  <span style="display:block"> <i class="fa-solid fa-triangle-exclamation" style="color:orangered"></i> <b class="eggs" style="color:orangered">Eggs</b></span>
				   <?php } ?>
				<div class="row"><div class="col-md-4">
					 <h6>Ingredients:</h6><p><span class=" ingredients"><?php print($row['recipe_ingredients']); ?></span></p></div>
					 <div class="col-md-4">
					 <h6>Procedure:</h6><p> <span class=" procedure"><?php print($row['recipe_procedure']); ?></span></p>
					  </div>
					 <div class="col-md-4"><img src="https://what2pack.org/cookbook/uploads/<?php echo $row['recipe_image']?>" style="width:90%;"/></div>
				 
				 </div>
					
				
				</div></div></div>
			   <?php }}?>
	 </div>
				   
				 <div class="modal fade mt-5" id="viewRecipeModal" tabindex="-1" aria-labelledby="viewRecipe" aria-hidden="true">
					 <div class="modal-dialog modal-xl">
						 <div class="modal-content">
						 <div class="modal-header">
							 <h5 class="modal-title" id="viewRecipe"><strong id="viewRecipeName">My Recipe</strong></h5>
							  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						 </div>
						 <div class="modal-body">
				 
						 <div class="card">
							 <div class="d-flex justify-content-center align-items-center">
								 <img src="" id="viewRecipeImage" class="card-img-top mt-2" alt="Recipe" style="max-width: 300px">
							 </div>
							 <div class="card-body text-center">
								 <p class="text-muted">Category: <span class="card-subtitle text-muted" id="viewCategoryName"></span></p>
								 <span class="btn btn-sm btn-success mb-2 mt-3" onclick="">Add To Menu</span>
							 </div>
							 <div class="row text-center mb-5 p-3">
								 <div class="col md-6">
									 <h5><strong>Ingredients:</strong></h5>
									 <p id="viewRecipeIngredients"></p>
								 </div>
								 <div class="col">
									 <h5><strong>Procedure:</strong></h5>
									 <p id="viewRecipeProcedure"></p>
								 </div>
							 </div>
						 </div>
				 
						 </div>
							 <div class="modal-footer">
								 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							 </div>
						 </div>
					 </div>
				 </div>
	 </body>
</html>