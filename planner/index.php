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
	<title>What2Pack - Campout Planner</title>
  <?php 
  
  function generateRandomString($length = 10) {
	  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  
   } ?>
   <link rel="stylesheet" href="https://use.typekit.net/kyj2mgm.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="/css/alt.css?<?php echo  generateRandomString();?>">
	   <link rel="stylesheet" href="../css/titatoggle-dist.css?<?php echo  generateRandomString();?>">
		   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	   <script src="/js/qrcode/qrcode.min.js"></script>
	   
	   <script>
		function myFunction() {
			var input, filter, cards, cardContainer, h5, title, i;
			input = document.getElementById("filter");
			filter = input.value.toUpperCase();
			cardContainer = document.getElementById("campout");
			cards = cardContainer.getElementsByClassName("card");
			for (i = 0; i < cards.length; i++) {
				title = cards[i].querySelector(".card-header");
				if (title.innerText.toUpperCase().indexOf(filter) > -1) {
					cards[i].style.display = "";
				} else {
					cards[i].style.display = "none";
				}
			}
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
					  <span  class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
						<image src="/img/what2packBackInv.png" style="width: 3rem;transform: rotate(-35deg)" class="me-4">
						<span class="fs-2 title">Campout Planner for <?php print($unitName); 
						
						if($params['id'] == '2'){
						
						?> <a href="https://what2pack.org/planner/3" class="smTitle" style="font-size: 1rem!important;color:#fff">(Switch Unit)</a>
					<?php }else{
					
					?> <a href="https://what2pack.org/planner/2" class="smTitle" style="font-size: 1rem!important;color:#fff">(Switch Unit)</a>
					
					<?php }?>
					</span></span>
					 
					  <form class="col-12 col-lg-auto mb-3 mb-lg-0" role="search">
						<input type="search" id="filter" class="form-control" placeholder="Search..." aria-label="Search" onkeyup="myFunction()">
					  </form>
					</div>
				  </header>
				  
				  <div class="container h4 text-center">
					  <div id="qrcode"  class="d-none d-print-block"></div><div class="H1 d-none d-print-block"><?php print($unitName) ?> Campout Planner</div>
					  <script type="text/javascript">
					   var qrcode = new QRCode(document.getElementById("qrcode"), {
						   text:"http://what2pack.org/planner/<?php print($params['id']); ?>",
					  width: 128,
					  height: 128,
					   css: "width: 300px",
					   colorDark : "#000000",
					   colorLight : "#ffffff",
					   correctLevel : QRCode.CorrectLevel.H});
					  
					   </script>
					  <a type="button" href="/planner/<?php print($params['id']); ?>/add" class="btn btn-success mb-3"><i class="fa-solid fa-tents"></i>  Add New Campout</a>
				  </div>
				 <div class="container" id="campout">
					 <?php 
						$stmtu = $DBcon->prepare("select * from qbranch_event where unit = '".$params['id']."' and STR_TO_DATE(dateStart, '%m/%e/%Y') >= CURDATE() order by dateStart");
							$stmtu->execute();
						   
							if($stmtu->rowCount() > 0)
							{
							 while($rowu=$stmtu->FETCH(PDO::FETCH_ASSOC))
							 {
						 
						   ?>
				   <div class="card mb-3" id="Camp_#<?php print($rowu['id']) ?>"><a name="<?php print($rowu['id']) ?>"></a>
					 <h4 class="card-header"><?php print($rowu['name']) ?> 
					 <?php
					 if($rowu['cancelled'] == 'Y') {
						 ?> <span style="float:right" class="badge text-bg-danger">Canceled</span><?php
					 } else {
					 
					 $date = new DateTime($rowu['dateStart']);
					 $now = new DateTime();
					 
					 if($date < $now) {
					?> <span style="float:right" class="badge text-bg-info">Completed</span><?php
					 } else {?><span style="float:right" class="badge text-bg-warning">Upcoming</span>
				 <?php }} ?></h4>
					 <div class="card-body pt-1">
						 <div class="rom p-0 m-0">
							<div class="btn-group btn-group-sm text-center w-100 mb-2">
								<a href="/planner/<?php print($params['id']); ?>/edit/<?php print($rowu['id']) ?>" class="btn btn-outline-secondary btn-sm" title="Edit"><i class="fa-solid fa-pen"></i> Edit</a>  <a type="button" href="/planner/<?php print($params['id']); ?>/print/<?php print($rowu['id']) ?>" class="btn btn-outline-secondary btn-sm" target="_blank" title="Print" ><i class="fa-solid fa-print"></i> Print</a>
							
								  <?php 
								   $stmty = $DBcon->prepare("select * from qbranch_checklist_items where checklistID = '".$rowu['id']."' and checkInDate is NULL");
									   $stmty->execute();
									   if($stmty->rowCount() > 0)
									   {?> 
										   <a type="button" href="/packinglist/<?php print($params['id']); ?>/<?php print($rowu['id']) ?>" class="btn btn-outline-secondary btn-sm" target="_blank" title="Packing List"><i class="fa-solid fa-list-check"></i> View Packing List</a>
									 <?php   } else { ?>
								  <a type="button" href="/unit/<?php print($params['id']); ?>" class="btn btn-outline-secondary btn-sm" style="padding: .1rem .75rem .1rem .75rem" target="_blank" title="Create Packing List"><i class="fa-solid fa-list-check"></i> <b style="font-size:.8rem;">Create Packing List</b></a>
								 <?php } ?>
							</div>
						 </div> 
					   <h5 class="card-title"><?php print($rowu['dateStart']) ?> through <?php print($rowu['dateEnd']) ?></h5>
					   <p><span class="badge text-bg-secondary"><span id="youth<?php print($rowu['id']) ?>"></span> Youth, <span id="adults<?php print($rowu['id']) ?>"></span> Adults Attending</span></p>
					   <p class="card-text"><a href="https://where2camp.com/review/?from=list&camp=<?php print($rowu['locationId']) ?> "><?php print($rowu['locationName']) ?>  <i class="fa-solid fa-arrow-up-right-from-square"></i></a></p>
					   <p><b>Nearest Hospital:</b> <?php print($rowu['nearestHostpital']) ?></p>
					   <p><?php print($rowu['description']) ?>  </p>
					   <p><b>Cost:</b> $<?php print($rowu['budget']) ?> <b>Payment Link:</b> <?php 
						   if($rowu['paymentLink']!=''){?>
							   
						   <a href="<?php print($rowu['paymentLink']);?>" target="new"><?php print($rowu['paymentLink']);?> <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
					  <?php } else { ?> 
					   
					   <a href="https://scouts13.org/troop-13b-boys/troop-13b-trading-post/">https://scouts13.org/troop-13b-boys/troop-13b-trading-post/ <i class="fa-solid fa-arrow-up-right-from-square"></i></a></p>
					   <?php } ?> <div class="card-group mb-3">
						   <?php if($rowu['unit'] == 1){?>
						
								 <div class="card">
							   <div class="card-header h4">
								Camper Details
							   </div>
							   <div class="card-body">
								  
									   <p><b>Cubs and Parents Attending: </b> <span class="youthCount<?php print($rowu['id']) ?>"><?php print($rowu['youth']); ?></span></p>
										 <h5>Camper Details</h5>
										 <p><?php print($rowu['youthDetails']); ?></p>
										</div>
							   </div>
								 
						 
						   <?php } ?>
						   
						   
						   <?php 
						   $stmtP = $DBcon->prepare("select * from qbranch_menu where event = '".$rowu['id']."' order by patrolId asc");
							   $stmtP->execute();
							  
							   if($stmtP->rowCount() > 0)
							   {
								while($rowP=$stmtP->FETCH(PDO::FETCH_ASSOC))
								{
							
							  ?>
						   <div class="card">
						<div class="h4 card-header"><?php print($rowP['patrol']) ?> Patrol </div>
						<div class="card-body pt-1">
							<div class="btn-group btn-group-sm text-center w-100 mb-2">
							<a href="/planner/<?php print($params['id']); ?>/menu/<?php print($rowP['id']); ?>" type="button" class="btn btn-sm btn-outline-primary" title="Menu"><i class="fa-solid fa-list-ul"></i> Menu</a>
							  <a href="/planner/<?php print($params['id']); ?>/roster/<?php print($rowP['id']); ?>" type="button" class="btn btn-sm btn-outline-primary" title="Roster"><i class="fa-solid fa-clipboard-user"></i> Roster</a></div>
							<p><b>Budget Per Scout: $<?php print($rowP['costPerBudget']) ?></b></p>
							
							<?php 
							   $stmtK = $DBcon->prepare("select * from qbranch_duty where menuId = '".$rowP['id']."' ");
								   $stmtK->execute();
								  
								   if($stmtK->rowCount() > 0)
								   {
									while($rowK=$stmtK->FETCH(PDO::FETCH_ASSOC))
									{
								if($rowK['scoutsAtt'] > 0){
									
									$scouts = explode(',',$rowK['scoutsAtt']);
									 if($rowP['patrolId']< '96') {
									 ?> 
									 <p><b>Planned Attending: </b> <span class="youthCount<?php print($rowu['id']) ?>"><?php echo(count($scouts)-1)?></span></p>
									 <?php } else { ?>
										 <p><b>Planned Attending: </b> <span class="adultCount<?php print($rowu['id']) ?>"><?php echo(count($scouts)-1)?></span></p>
										 <?php } ?>
									  <div class="list-group list-group-flush"> <?php
							   $stmtM = $DBcon->prepare("select * from qbranch_roster where id IN (".$rowK['scoutsAtt'].")");
								   $stmtM->execute();
								  
								   if($stmtM->rowCount() > 0)
								   {
									while($rowM=$stmtM->FETCH(PDO::FETCH_ASSOC))
									{
								if($rowP['patrolId']< '96') {
								  ?>
							<span class="list-group-item list-group-item-action" href=""><?php print($rowM['firstName']) ?> <?php print($rowM['lastI']) ?> <i class="position"><?php print($rowM['position']); ?></i></span>
							<?php } else {?>
								<ul class="list-group list-group-horizontal"><li class="list-group-item col-6"><?php print($rowM['firstName']) ?> <?php print($rowM['lastName']) ?><br>(<?php print($rowM['BSAId']) ?>)</li> <li class="list-group-item col-6"><?php print($rowM['yptDate']) ?></li></ul>
															
						<?php	}
								   }
								  }
								  else
								  {
								
							
								  }}else {
										?> <p><b>Planned Attending: </b> <span class="youthCount<?php print($rowu['id']) ?> adultCount<?php print($rowu['id']) ?>">0</span></p>
										  <div class="list-group list-group-flush"> <?php
										
									}
							   }
								 }
								 else
								 {
							   
							   
								 }
							   ?></div>
						
							<div class="list-group list-group-flush">
								<?php 
								if($rowP['menulist'] != '0' ){ 
									echo("<p><b>Menu: </b></p>");
								   $stmtM = $DBcon->prepare("select * from tbl_recipe where tbl_recipe_id IN (".$rowP['menulist'].")");
									   $stmtM->execute();
									  
									   if($stmtM->rowCount() > 0)
									   {
										while($rowM=$stmtM->FETCH(PDO::FETCH_ASSOC))
										{
									
									  ?>
								<span class="list-group-item list-group-item-action"><?php print($rowM['recipe_name']) ?></span>
								<?php
									   }
									  }
									  else
									  {
									
								
									  }
								   }
								   ?>
								   <span class="list-group-item list-group-item-action"><?php print($rowP['purchasedItems']) ?></span>
							</div>
							
						</div>
						</div>
				
					<?php
						   }
						  }
						  else
						  {
						  }
					   ?>
					</div>				  
					 </div>
				   </div>
				   <script>
				   const sum<?php print($rowu['id']) ?> = [...document.querySelectorAll('span.youthCount<?php print($rowu['id']) ?>')].reduce((r, e) => {
					 return r + parseInt(e.textContent.replace(',', ''))
				   }, 0)
				 			
				   document.getElementById("youth<?php print($rowu['id']) ?>").appendChild( document.createTextNode(sum<?php print($rowu['id']) ?>) );
				   
				   const sumA<?php print($rowu['id']) ?> = [...document.querySelectorAll('span.adultCount<?php print($rowu['id']) ?>')].reduce((r, e) => {
					 return r + parseInt(e.textContent.replace(',', ''))
				   }, 0)
				   document.getElementById("adults<?php print($rowu['id']) ?>").textContent = sumA<?php print($rowu['id']) ?>;
				   </script>
				   <?php
					   }
					  }
					  else
					  {
					print('No Campouts! How Sad!');
				
					  }
				   
				   ?>
				 
				 </div>
				 <div class="container" id="campout_past">
					  <?php 
						 $stmtu = $DBcon->prepare("select * from qbranch_event where unit = '".$params['id']."' and STR_TO_DATE(dateStart, '%m/%e/%Y') <= CURDATE() order by dateStart desc");
							 $stmtu->execute();
							
							 if($stmtu->rowCount() > 0)
							 {
							  while($rowu=$stmtu->FETCH(PDO::FETCH_ASSOC))
							  {
						  
							?>
						<div class="card mb-3" id="Camp_#<?php print($rowu['id']) ?>"><a name="<?php print($rowu['id']) ?>"></a>
						
					  <h4 class="card-header"><?php print($rowu['name']); 
					  
					   if($rowu['cancelled'] == 'Y') {
						   ?> <span style="float:right" class="badge text-bg-danger">Canceled</span><?php
					   } else {
					$date = new DateTime($rowu['dateStart']);
					  $now = new DateTime();
					  
					  if($date < $now) {
					 ?> <span style="float:right" class="badge text-bg-info">Completed</span><?php
					  } else {?><span style="float:right" class="badge text-bg-warning">Upcoming</span>
				  <?php } }?></h4>
					  <div class="card-body pt-1">
					   <div class="rom p-0 m-0">
						  <div class="btn-group btn-group-sm text-center w-100 mb-2">
							  <a href="/planner/<?php print($params['id']); ?>/edit/<?php print($rowu['id']) ?>" class="btn btn-outline-secondary btn-sm" title="Edit"><i class="fa-solid fa-pen"></i> Edit</a>  <a type="button" href="/planner/<?php print($params['id']); ?>/print/<?php print($rowu['id']) ?>" class="btn btn-outline-secondary btn-sm" target="_blank" title="Print" ><i class="fa-solid fa-print"></i> Print</a>
							  <a href="/planner/<?php print($params['id']); ?>/activity" type="button" class="btn btn-outline-secondary btn-sm"  title="Activities" ><i class="fa-solid fa-mountain-sun"></i> Add Activities</a>
							  
							 <?php 
							  $stmty = $DBcon->prepare("select * from qbranch_checklist_items where checklistID = '".$rowu['id']."' and checkInDate is NULL");
								  $stmty->execute();
								  if($stmty->rowCount() > 0)
								  { ?> 
									  <a type="button" href="/packinglist/<?php print($params['id']); ?>/<?php print($rowu['id']) ?>" class="btn btn-outline-secondary btn-sm" target="_blank" title="Packing List"><i class="fa-solid fa-list-check"></i></a>
								<?php   } else { }?>
						  </div>
						<h5 class="card-title"><?php print($rowu['dateStart']) ?> through <?php print($rowu['dateEnd']) ?> </h5>
						<p><span class="badge text-bg-secondary"><span id="youth<?php print($rowu['id']) ?>"></span> Youth, <span id="adults<?php print($rowu['id']) ?>"></span> Adults Attending</span></p>
						<p class="card-text"><a href="https://where2camp.com/review/?from=list&camp=<?php print($rowu['locationId']) ?> "><?php print($rowu['locationName']) ?>  <img class="extlink" src="/img/External_link.svg"></a></p>
						<p><b>Nearest Hospital:</b> <?php print($rowu['nearestHostpital']) ?></p>
						<p><?php print($rowu['description']) ?>  </p>
						<p><b>Cost:</b> $<?php print($rowu['budget']) ?> <b>Payment Link:</b> <?php 
							if($rowu['paymentLink']!=''){?>
								
							<a href="<?php print($rowu['paymentLink']);?>" target="new"><?php print($rowu['paymentLink']);?></a>
					   <?php } else { ?> 
						
						<a href="https://scouts13.org/troop-13b-boys/troop-13b-trading-post/">https://scouts13.org/troop-13b-boys/troop-13b-trading-post/</a></p>
						<?php } ?> <div class="card-group mb-3">
							<?php 
							$stmtP = $DBcon->prepare("select * from qbranch_menu where event = '".$rowu['id']."' order by patrolId asc");
								$stmtP->execute();
							   
								if($stmtP->rowCount() > 0)
								{
								 while($rowP=$stmtP->FETCH(PDO::FETCH_ASSOC))
								 {
							 
							   ?>
							<div class="card">
						 <h4 class="card-header"><?php print($rowP['patrol']) ?> Patrol <span style="float:right" class="btn btn-secondary d-none">Print</span></h4>
						 <div class="card-body">
							 <p><b>Budget Per Scout: $<?php print($rowP['costPerBudget']) ?></b></p>
						
							 <?php 
								$stmtK = $DBcon->prepare("select * from qbranch_duty where menuId = '".$rowP['id']."' ");
									$stmtK->execute();
								   
									if($stmtK->rowCount() > 0)
									{
									 while($rowK=$stmtK->FETCH(PDO::FETCH_ASSOC))
									 {
								 if($rowK['scoutsAtt'] > 0){
									 $scouts = explode(',',$rowK['scoutsAtt']);
									 ?> 
								<?php	if($rowP['patrolId']< '96') {
									 ?> 
									 <p><b>Planned Attending: </b> <span class="youthCount<?php print($rowu['id']) ?>"><?php echo(count($scouts)-1)?></span></p>
									 <?php } else { ?>
										 <p><b>Planned Attending: </b> <span class="adultCount<?php print($rowu['id']) ?>"><?php echo(count($scouts)-1)?></span></p>
										 <?php } ?>
									  <div class="list-group list-group-flush">
									 
									 <?php
								$stmtM = $DBcon->prepare("select * from qbranch_roster where id IN (".$rowK['scoutsAtt'].")");
									$stmtM->execute();
								   
									if($stmtM->rowCount() > 0)
									{
									 while($rowM=$stmtM->FETCH(PDO::FETCH_ASSOC))
									{if($rowP['patrolId']< '96') {
											  ?>
										<span class="list-group-item list-group-item-action" href=""><?php print($rowM['firstName']) ?> <?php print($rowM['lastI']) ?></span>
										<?php } else {?>
											<ul class="list-group list-group-horizontal"><li class="list-group-item col-6"><?php print($rowM['firstName']) ?> <?php print($rowM['lastName']) ?><br>(<?php print($rowM['BSAId']) ?>)</li> <li class="list-group-item col-6"><?php print($rowM['yptDate']) ?></li></ul>
																		
									<?php	}
											   }
											  }
											  else
											  {
											
										
											  }} else {
												  ?> <p><b>Planned Attending: </b> 0</p>
													<div class="list-group list-group-flush"> <?php
												  
											  }
										   }
											 }
											 else
											 {
										   
										   
											 }
										   ?></div>
							 <div class="list-group list-group-flush">
								 <?php 
								 if($rowP['menulist'] != '0' ){
									 echo("<p><b>Menu: </b></p>");
									$stmtM = $DBcon->prepare("select * from tbl_recipe where tbl_recipe_id IN (".$rowP['menulist'].")");
										$stmtM->execute();
									   
										if($stmtM->rowCount() > 0)
										{
										 while($rowM=$stmtM->FETCH(PDO::FETCH_ASSOC))
										 {
									 
									   ?>
								 <span class="list-group-item list-group-item-action"><?php print($rowM['recipe_name']) ?></span>
								 <?php
										}
									   }
									   else
									   {
									 
								 
									   }
									}
									?>
									<span class="list-group-item list-group-item-action"><?php print($rowP['purchasedItems']) ?></span>
							 </div>
						 </div>
						 </div>
					
					 <?php
							}
						   }
						   else
						   {
					 
					 
						   }
						
						?>
					 </div>
							</div>		   
					  </div>
					</div>
					<script>
					   const sum<?php print($rowu['id']) ?> = [...document.querySelectorAll('span.youthCount<?php print($rowu['id']) ?>')].reduce((r, e) => {
						 return r + parseInt(e.textContent.replace(',', ''))
					   }, 0)
								 
					   document.getElementById("youth<?php print($rowu['id']) ?>").appendChild( document.createTextNode(sum<?php print($rowu['id']) ?>) );
					   
					   const sumA<?php print($rowu['id']) ?> = [...document.querySelectorAll('span.adultCount<?php print($rowu['id']) ?>')].reduce((r, e) => {
						 return r + parseInt(e.textContent.replace(',', ''))
					   }, 0)
					   document.getElementById("adults<?php print($rowu['id']) ?>").textContent = sumA<?php print($rowu['id']) ?>;
					   </script>
					<?php
						}
					   }
					   else
					   {
					 
					   }
					
					?>
				  
				  </div>
				 
				  
				  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
					<div class="offcanvas-header">
					  <h5 class="offcanvas-title" id="offcanvasRightLabel">Add Activities</h5>
					  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
				
						<div class="container m-0" id="campout">
							<form>
							 <div class="row-g2">
									 <div class="col-md">
								 <select class="form-select form-select-sm" aria-label="Small select example">
								   <option selected>Activity Type</option>
								   <option value="Hiking">Hiking</option>
								   <option value="Biking">Biking</option>
								   <option value="Camping">Camping</option>
								   <option value="Unpowered Watercraft">Unpowered Watercraft</option>
								   <option value="Motor Watercraft">Motor Watercraft</option>
								   <option value="Service">Service</option>
								   <option value="Riding(Animal)">Riding(Animal)</option>
								   <option value="Conservation">Conservation</option>
								   <option value="Other">Other</option>
								 </select>
									 </div>
							 </div>
								 <div class="row-g2">
									   <div class="col-md">
								  <select class="form-select form-select-sm" aria-label="Small select example">
									 <option selected>Activity Type</option>
									 <option value="Miles">Miles</option>
									 <option value="Hours">Hours</option>
								   </select>
									   </div>
									   <div class="col-md">
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
										  <div class="form-floating mb-3">
											 <input type="text" class="form-control" name="paymentLink" id="paymentLink" value="">
											 <label for="paymentLink">Date</label>
										   </div>
									  </div>
								   </div>
								   <div class="row-g2">
										 <div class="col-md">
											 <div >
													<label for="dateStart">Date</label>
													 <input type="text" class="form-control" name="date" id="date" >
													
												</div>
										 </div>
									  </div>
									  <div class="row-g2">
									   <div class="col-md">
									  
									  <label for="description">Details</label>
									   <textarea class="form-control mb-3" placeholder="Leave a comment here" id="description" name="description" style="height: 200px"></textarea>
									  </div>
										</div>
										</form>
							 </div>
						
						 
					
					</div>
				  </div>
	 </body>
	 <script>
		 var camp = 'Camp_'+window.location.hash;
			 
				 document.getElementById(camp).style.backgroundColor ='rgb(7, 51, 7)';
			 
			</script>
</html>