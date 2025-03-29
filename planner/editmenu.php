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
	<title>What2Pack - Menu</title>
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

	<script type="text/javascript" language="javascript" src=" https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script> 
	<script type="text/javascript" language="javascript" src="  https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script> 
  <link rel="stylesheet" href="https://use.typekit.net/kyj2mgm.css">
   <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
   <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
   <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="/css/alt.css?<?php echo  generateRandomString();?>">
	  
		   
	   
	   
	   <script>
		  function setSite(name, id) {
				$('#floatingLocName').val(name);
				   $('#floatingLocID').val(id); 
			 }

		$(document).ready(function() {
//Setup - add a text input to each footer cell
	
		  
			// DataTable
			var table = $('#mainList').DataTable( {
			responsive: true
			} );
		 
			
		
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
			let viewRecipeGF = $("#recipe_" + id +" td span .gf").text();
			let viewRecipeVeg = $("#recipe_" + id +" td span .veg").text();
			let viewRecipeKosher = $("#recipe_" + id +" td span .kosher").text();
			let viewRecipeTreenuts = $("#recipe_" + id +" td span .treenuts").text();
			let viewRecipeLactose = $("#recipe_" + id +" td span .lactose").text();
			// Update the modal content with the fetched data
			$("#viewRecipeName").text(viewRecipeName);
			$("#viewCategoryName").text(viewCategoryName);
			$("#viewRecipeImage").attr('src', viewRecipeImage);
			$("#viewRecipeIngredients").text(viewRecipeIngredients);
			$("#viewRecipeProcedure").text(viewRecipeProcedure);
			$("#viewRecipeGF").text(viewRecipeGF);
			$("#viewRecipeVeg").text(viewRecipeVeg);
			$("#viewRecipeKosher").text(viewRecipeKosher);
			$("#viewRecipeTreenuts").text(viewRecipeTreenuts);
			$("#viewRecipeLactose").text(viewRecipeLactose);
		}
		function add_item(id, name) {
			let newItem = '<span id="menuItem_'+id+'" class="list-group-item list-group-item-action"><span onclick="view_recipe(\''+id+'\')">'+name+'</span><span class="btn btn-sm btn-outline-warning" onclick="remove_item(\''+id+'\');" style="float:right"> - </span></span>'
			$("#menulist_<?php print($params['menu'])?>").append(newItem);
			let menuList = $("#menulist_<?php print($params['menu'])?> .menulist").val();
			if (menuList == '') { 
			 
			$("#menulist_<?php print($params['menu'])?> .menulist").val(id);
			} else {
			$("#menulist_<?php print($params['menu'])?> .menulist").val(menuList+','+id);
			}
		}
		
		var removeValue = function(list, value, separator) {
		  separator = separator || ",";
		  var values = list.split(separator);
		  for(var i = 0 ; i < values.length ; i++) {
			if(values[i] == value) {
			  values.splice(i, 1);
			  return values.join(separator);
			}
		  }
		  return list;
		}
				
		function remove_item(id){
			$('#menuItem_'+id).remove();
			let menuList = $("#menulist_<?php print($params['menu'])?> .menulist").val();
			let newVal = removeValue(menuList, id, ',');
			$("#menulist_<?php print($params['menu'])?> .menulist").val(newVal);
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
						<span class="fs-2 title">Campout Planner for <?php print($unitName) ?> : Add Menu </span>
					  </a>
					  <form class="col-12 col-lg-auto mb-3 mb-lg-0 d-none" role="search">
						<input type="search" id="filter" class="form-control" placeholder="Search..." aria-label="Search" onkeyup="myFunction()">
					  </form>
					</div>
				  </header>
				  <div class="container" id="campout">
					  
				    <div class="card mb-3">
						<form action="/savepatrol" method="post" id="editPatrol">
					 <h4 class="card-header pb-3">Step Three: Edit Menu Details 						<input style="float:right" class="btn btn-primary mb-3" type="submit" name="update" value="Save Menu" form="editPatrol">	<a href="https://what2pack.org/planner/<?php print($params['id']); ?>" style="float:right" class="btn btn-outline-secondary me-3 mb-3">Cancel</a></h4>
					 	<div class="card-body">
						 
						<div class="row">
							
							<div class="col-md-4">
							<?php 
							   $stmtM = $DBcon->prepare("select * from qbranch_menu where id = '".$params['menu']."' ");
								   $stmtM->execute();
								  
								   if($stmtM->rowCount() > 0)
								   {
									while($rowM=$stmtM->FETCH(PDO::FETCH_ASSOC))
									{
								  ?>
									 
								
									<div class="card">
								  <div class="card-header fs-4">
									Edit Patrol
								  </div>
								  <div class="card-body">
									 
									<div class="form-floating mb-3">
										<div class="form-floating">
										  <select class="form-select" id="patrolId"  name="patrolId" aria-label="FloatingPatrol"> 
											  <option >Choose a Patrol</option> 
										<?php 
										   $stmtx = $DBcon->prepare("select distinct patrol, patrolID from qbranch_roster where unit = '".$params['id']."' ");
											   $stmtx->execute();
											  
											   if($stmtx->rowCount() > 0)
											   {
												while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
												{
											  ?>
												 
										  
										  <option <?php if ($rowx['patrolID'] == $rowM['patrolId']) { print('selected'); $patrolName = $rowx['patrol'];}?> value="<?php print($rowx['patrolID']); ?>"><?php print($rowx['patrol']); ?></option>
												
												   <?php
													}
												   }
												   else
												   {}
												?>
												</select>
												  <label for="patrolId">Patrol Name</label>
												</div>
									</div>
									<div class="form-floating mb-3">
									  <input type="text" class="form-control" id="grubmaster" name="grubmaster"value="<?php print($rowM['grubmaster']); ?>">
									  <label for="grubmaster">Grubmaster</label>
									</div>
									<div class="form-floating mb-3">
									  <input type="text" class="form-control" id="costPerBudget" name="costPerBudget" value="<?php print($rowM['costPerBudget']); ?>">
									  <label for="costPerBudget">Budget Per Scout</label>
									</div>
									<div class="form-floating mb-3">
									  <input type="text" class="form-control" id="expenses" name="expenses" value="<?php print($rowM['expenses']); ?>">
									  <label for="expenses">Actual Expenses</label>
									 <input type="hidden" class="form-control" id="id" name="id" value="<?php print($rowM['id']); ?>">
									 <input type="hidden" class="form-control" id="patrolName" name="patrolName" value="<?php print($patrolName); ?>">
									  <input type="hidden" class="form-control" id="unit" name="unit" value="<?php print($rowM['unit']); ?>">
									  <input type="hidden" class="form-control" id="event" name="event" value="<?php print($rowM['event']); ?>">
									</div>
									
								
									<h5>Menu Items</h5>
									<div id="menulist_<?php print($params['menu'])?>" class="list-group list-group-flush">
										<?php 
										if ($rowM['menulist'] != ''){
										   $stmtI = $DBcon->prepare("select * from tbl_recipe where tbl_recipe_id IN (".$rowM['menulist'].")");
											   $stmtI->execute();
											  
											   if($stmtI->rowCount() > 0)
											   {
												while($rowI=$stmtI->FETCH(PDO::FETCH_ASSOC))
												{
											
											  ?>
									<span id="menuItem_<?php print($rowI['tbl_recipe_id']) ?>" class="list-group-item list-group-item-action">
											<span onclick="view_recipe('<?php print($rowI['tbl_recipe_id']) ?>')"><?php print($rowI['recipe_name']) ?></span>
											<span class="btn btn-sm btn-outline-warning" onclick="remove_item('<?php print($rowI['tbl_recipe_id']) ?>');" style="float:right"> - </span>
										</span>
									
										
										<?php
											   }
											  }
											  else
											  {
											
										
											  }}
										   
										   ?>
										   
										   <input class="menulist" type="hidden" value="<?php print($rowM['menulist']); ?>" id="menulist" name="menulist"></form>	
									   </div>
									   <h5 class="mt-3">Prepackaged Food</h5>
									  <textarea class="form-control mb-3" placeholder="Add purchased complete items here - Oreos, Little Debbies, Mountain House backpacking meals" id="purchasedItems" name="purchasedItems" style="height: 400px"><?php print($rowM['purchasedItems']) ?></textarea>
								  </div>
								</div>
								
								<?php
									}
								   }
								   else
								   {}
								?>
							</div>	
						<div class="col-md-8">
							<div id="selectLoc" >
						
							  <table class="table-sm table-striped dataTable " style="width:100%" id="mainList">
								   <thead>
									<tr>
									  <th class="filter" >Recipe Name</th><th  class="filter">Category</th><th  class="filter">Dietary Alerts</th></tr>
								   </thead>
								   <tbody>
									 <?php
									 $stmt = $DBcon->prepare("SELECT * 
									 FROM 
										 `tbl_recipe`
									 LEFT JOIN
										 `tbl_category` ON
										 `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` ");
									 $stmt->execute();
									 ?>
									 <?php
									 if($stmt->rowCount() > 0)
									 {
									  while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
									  {
									   ?>
								   <tr id="recipe_<?php print($row['tbl_recipe_id']); ?>">
									 <td><span class="name" onclick="view_recipe('<?php print($row['tbl_recipe_id']); ?>')"><?php print($row['recipe_name']); ?></span><br>
									  <span class="btn btn-sm btn-outline-primary mb-2 mt-3" onclick="add_item('<?php print($row['tbl_recipe_id']); ?>','<?php print(addslashes($row['recipe_name'])); ?>')">Add To Menu</span>
										  </td><td class="category"><?php print($row['category_name']); ?></td><td> 
										  <span class="d-none rec_image"><?php print($row['recipe_image']); ?></span>
										  <span class="d-none ingredients"><?php print($row['recipe_ingredients']); ?></span>
										  <span class="d-none author"><?php print($row['recipe_author']); ?></span>
										  <span class="d-none procedure"><?php print($row['recipe_procedure']); ?></span>
									
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
										  </td>
									
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
								
								 </table>
								
							 </div>
						
						</div>
						
					   </div>
					
					</div>
						
											  
					 <h4 class="card-footer mb-0">Step Three: Edit Menu Details 						<input style="float:right" class="btn btn-primary mb-3" type="submit" name="update" value="Save Menu" form="editPatrol">	<a href="https://what2pack.org/planner/<?php print($params['id']); ?>" style="float:right" class="btn btn-outline-secondary me-3 mb-3">Cancel</a></h4>
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
							 <div class="row">
								 <div class="col-md-1"></div> 
								<div class="col-md-2">Is GF?<br>
								<span id="viewRecipeGF"></span></div>
								<div class="col-md-2">Is Veg?<br>
									<span id="viewRecipeVeg"></span></div>
								<div class="col-md-2">Is Kosher?<br>
									<span id="viewRecipeKosher"></span></div>
								<div class="col-md-2">Has Treenuts?<br>
									<span id="viewRecipeTreenuts"></span></div>
								<div class="col-md-2">Has Lactose<br>
									<span id="viewRecipeLactose"></span>
								</div>
								<div class="col-md-1"></div> 
							
							 <div class="row text-center mb-5 p-3">
								 <div class="col">
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