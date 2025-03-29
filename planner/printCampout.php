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
	<title>What2Pack - Campout Details</title>
  <?php 
  
  function generateRandomString($length = 10) {
	  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  
   } ?>
   <link rel="stylesheet" href="https://use.typekit.net/kyj2mgm.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="/css/alt.css?<?php echo  generateRandomString();?>">
	   <link rel="stylesheet" href="../css/titatoggle-dist.css?<?php echo  generateRandomString();?>">
		   
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
	 <body data-bs-theme="light">
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
				$menulist = '0';
				$stmtx = $DBcon->prepare("select * from qbranch_menu where event = '".$params['event']."'" );
				   $stmtx->execute();
				  
				   if($stmtx->rowCount() > 0)
				   {
					while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
					{
			
				  $menulist =  $menulist.','.$rowx['menulist'];
				  
						}
					   }
					   else
					   {}
				?>
			<header class="py-3 mb-4 border-bottom ">
				<div class="container d-flex flex-wrap justify-content-center">
				  <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
					<image src="/img/what2packBackInv.png" style="width: 3rem;transform: rotate(-35deg)" class="me-4">
					<span class="fs-2 title">Trip Report and Shopping List for <?php print($unitName) ?></span>
				  </a>
				 
				</div>
			  </header>
									
				 <div class="container" id="campout">
					 <?php 
						$stmtu = $DBcon->prepare("select * from qbranch_event where id = '".$params['event']."' ");
							$stmtu->execute();
						   
							if($stmtu->rowCount() > 0)
							{
							 while($rowu=$stmtu->FETCH(PDO::FETCH_ASSOC))
							 {
						 
						   ?>
				   <div class="card mb-3">
					 <h4 class="card-header"><?php print($rowu['name']) ?></h4>
					 <div class="card-body">
					   <h5 class="card-title"><?php print($rowu['dateStart']) ?> through <?php print($rowu['dateEnd']) ?> </h5>
					   <p class="card-text"><a href="https://where2camp.com/review/?from=list&camp=<?php print($rowu['locationId']) ?> "><?php print($rowu['locationName']) ?>  <img class="extlink" src="/img/External_link.svg"></a></p>
					   <p><b>Youth Attending:</b> <span id="youth"></span> <b>Adults Attending:</b> <span id="adults"></span></p>								  
					   <p><b>Nearest Hospital:</b> <?php print($rowu['nearestHostpital']) ?></p>
					   <p><b>Details:</b><br><?php print($rowu['description']) ?>  </p>
					   <p><b>Cost:</b> $<?php print($rowu['budget']) ?> <b>Payment Link:</b> <?php 
						   if($rowu['paymentLink']!=''){?>
							   
						   <a href="<?php print($rowu['paymentLink']);?>" target="new"><?php print($rowu['paymentLink']);?></a>
					  <?php } else { ?> 
					   
					   <a href="https://scouts13.org/troop-13b-boys/troop-13b-trading-post/">https://scouts13.org/troop-13b-boys/troop-13b-trading-post/</a></p>
					   <?php } ?> <div class="card-group mb-3">
						   
						   <?php if($rowu['unit'] == 1){?>
						   
									<div class="card">
								  <div class="card-header h4">
								   Camper Details
								  </div>
								  <div class="card-body">
									 
										  <p><b>Cubs and Parents Attending: </b> <span class="youthCount"><?php print($rowu['youth']); ?></span></p>
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
						<h4 class="card-header"><?php print($rowP['patrol']) ?> Patrol <span style="float:right" class="btn btn-secondary d-none">Print</span></h4>
						<div class="card-body">
							<p><b>Budget Per Scout: $<?php print($rowP['costPerBudget']) ?></b></p>
						
							<div class="list-group list-group-flush">
							<?php 
							   $stmtK = $DBcon->prepare("select * from qbranch_duty where menuId = '".$rowP['id']."' ");
								   $stmtK->execute();
								  
								   if($stmtK->rowCount() > 0)
								   {
									  
									while($rowK=$stmtK->FETCH(PDO::FETCH_ASSOC))
									{
										$scouts = explode(',',$rowK['scoutsAtt']);
										  if($rowP['patrolId']< '96') {
											?>
										   <p><b>Planned Attending: </b> <span class="youthCount"><?php echo(count($scouts)-1)?></span></p>	
										   <?php } else {?>
										   <p><b>Planned Attending: </b> <span class="adultCount"><?php echo(count($scouts)-1)?></span></p>
										   <?php }
								if($rowK['scoutsAtt'] > 0){
							   $stmtM = $DBcon->prepare("select * from qbranch_roster where id IN (".$rowK['scoutsAtt'].")");
								   $stmtM->execute();
								  
								   if($stmtM->rowCount() > 0)
								   {
									while($rowM=$stmtM->FETCH(PDO::FETCH_ASSOC))
									{
										
								if($rowP['patrolId']< '96') {
								  ?>
								<span class="list-group-item list-group-item-action" href=""><?php print($rowM['firstName']) ?> <?php print($rowM['lastI']) ?></span>
							<?php } else {?>
								<ul class="list-group list-group-horizontal"><li class="list-group-item col-12"><?php print($rowM['firstName']) ?> <?php print($rowM['lastName']) ?><br>(<?php print($rowM['BSAId']) ?>) <br> YPT: <?php print($rowM['yptDate']) ?></li></ul>
															
						<?php	}
								   }
								  }
								  else
								  {
								
							
								  }}
							   }
								 }
								 else
								 {
							   
							   
								 }
							   ?></div>
							<p><b>Menu: </b></p>
							<div class="list-group list-group-flush">
								<?php 
								if($rowP['menulist'] != ''){
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
				   <?php
					   }
					  }
					  else
					  {
					print('No Campouts! How Sad!');
				
					  }
				   
				   ?>
				 
				 </div>
				 <script>
					const sum = [...document.querySelectorAll('span.youthCount')].reduce((r, e) => {
					  return r + parseInt(e.textContent.replace(',', ''))
					}, 0)
							  
					document.getElementById("youth").appendChild( document.createTextNode(sum) );
					
					const sumA = [...document.querySelectorAll('span.adultCount<?php print($rowu['id']) ?>')].reduce((r, e) => {
					  return r + parseInt(e.textContent.replace(',', ''))
					}, 0)
					document.getElementById("adults").textContent = sumA;
					</script>
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
								  <div class="col-md-4">
									<?php  if($row['recipe_image'] != ''){
									  $recipeImage = $row['recipe_image'];} else {
										$recipeImage = 'what2packPlateInv.png';
									  }?>
									  <img src="https://what2pack.org/cookbook/uploads/<?php print($recipeImage)?>" style="width:90%;filter: drop-shadow(0px 0px 6px #999)"/></div>
							  
							  </div>
								 
							 
							 </div></div></div>
							<?php }}?>
				  </div>
	 </body>
</html>