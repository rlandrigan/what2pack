<?php
 session_start();
include('../inc/creds.php');
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
	<title>What2Pack - Cookbook</title>
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
   <link rel="stylesheet" href="../css/alt.css?<?php echo  generateRandomString();?>">
	  
		<style>.form-floating label{font-size:1rem;}</style>   
	 
	   
	 
	 </head>
	 <body>
		 <?php
		 if(isset($_GET['recipe'])){
		 } else { ?>
		 <div class="container">
			 <div class="card my-3">
				 <div class="row ">
				
					 <div class="col">
			   <div class="card-body">
				 <h1 class="card-title">Scouts 13 Cookbook!</h1>
				 <p class="card-text">This is the full list of recipes available at qbranch.scouts13.org/cookbook,an online cookbook for Pack, Troops, and Crew 13. </p>
				
			   </div></div></div>
			 </div>
			   <div class="row  g-4">
			 
		  <?php 
	
				   $stmt = $DBcon->prepare("SELECT * FROM qbranch_units ORDER BY id ASC ");
				   $stmt->execute();
			 
				   ?>
				   
				   <?php
				  
				   if($stmt->rowCount() > 0)
				   {
					while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
					{
					   
					 ?>
					 <div class="col">
					   <div class="card">
						 <img style="filter: drop-shadow(0px 0px 10px #000);"src="../img/<?php print($row['logo']); ?>" class="card-img-top mx-auto" alt="Logo for <?php print($row['unitName']); ?>">
						 <div class="card-body">
						   <h5 class="card-title"><?php print($row['unitName']); ?> </h5> 
						 </div>
					   </div>
					 </div>
				 <?php
				   }
				  }
				  else
				  {
				   ?>
					<?php
				  }
				  ?>
				  <h3>Coal-Temperature Conversion Chart</h3>
				   <table style="width:100%" class="table table-striped" data-bs-theme="light">
					   <tr><td>Oven Size</td><td>Briquettes</td><td>325&deg;F</td><td>350&deg;F</td><td>375&deg;F</td><td>400&deg;F</td><td>425&deg;F</td><td>450&deg;F</td></tr>
							
					   <tr><td rowspan="3">10"</td><td>Total</td><td>19</td><td>21</td><td>23</td><td>25</td><td>27</td><td>29</td></tr>
						<tr><td>On Lid</td><td>13</td><td>14</td><td>16</td><td>17</td><td>18</td><td>19</td></tr>
						<tr><td>Underneath</td><td>6</td><td>7</td><td>7</td><td>8</td><td>9</td><td>10</td></tr>	
						<tr><td rowspan="3">12"</td><td>Total</td><td>23</td><td>25</td><td>27</td><td>29</td><td>31</td><td>33</td></tr>
						 <tr><td>On Lid</td><td>16</td><td>17</td><td>18</td><td>19</td><td>21</td><td>22</td></tr>
						 <tr><td>Underneath</td><td>7</td><td>8</td><td>9</td><td>10</td><td>10</td><td>11</td></tr>	
						 <tr><td rowspan="3">14"</td><td>Total</td><td>30</td><td>32</td><td>34</td><td>36</td><td>38</td><td>40</td></tr>
						  <tr><td>On Lid</td><td>20</td><td>21</td><td>22</td><td>24</td><td>25</td><td>26</td></tr>
						  <tr><td>Underneath</td><td>10</td><td>11</td><td>12</td><td>12</td><td>13</td><td>14</td></tr>	
						  <tr><td rowspan="3">16"</td><td>Total</td><td>37</td><td>39</td><td>41</td><td>43</td><td>45</td><td>47</td></tr>
						   <tr><td>On Lid</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td></tr>
						   <tr><td>Underneath</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td></tr>				  
				   </table>
			   </div></div>
			   <?php }?>
			   <div class="container">
	<div style="page-break-inside:avoid;"></div> 
	 <?php 
	if(isset($_GET['recipe'])){
		 $stmtM = $DBcon->prepare("SELECT * 
		  FROM 
			  `tbl_recipe`
		  LEFT JOIN
			  `tbl_category` ON
			  `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id`  
			  WHERE
		  		`tbl_recipe_id` = ".$_GET['recipe']."
			  order by `category_name` ASC,`recipe_name` ASC ");
	 } else {
		$stmtM = $DBcon->prepare("SELECT * 
			 FROM 
				 `tbl_recipe`
			 LEFT JOIN
				 `tbl_category` ON
				 `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id`  order by `category_name` ASC,`recipe_name` ASC ");
			 }
			$stmtM->execute();
		   $catName ="";
			if($stmtM->rowCount() > 0)
			{
			 while($row=$stmtM->FETCH(PDO::FETCH_ASSOC))
			 {
				if($catName == $row['category_name']){$print = 'noPrint' ;} else { $print = 'print';}
				$catName= $row['category_name'];
		   if($print == 'print'){
		   ?>
		   <h2 style="page-break-before: always; "><?php print($catName); ?></h2>
		   <?php }?>
		   <div class="card mb-3">
			   <div class="card-body">
				<h5 class="card-title name" onclick="view_recipe('<?php print($row['tbl_recipe_id']); ?>')"><?php print($row['recipe_name']); ?></h5>
			<div class="card-text"><div class="row"><div class="col-md-4">
				<?php if(empty($row['recipe_image'])){ ?>
				 <?php } else {?>
					<img src="https://what2pack.org/cookbook/uploads/<?php echo $row['recipe_image']?>" style="width:90%;"/>
									 
					 <?php } ?>
				<h5><?php print($row['category_name']); ?></h5><br>
			<b>Author:</b><p><span class="author"><?php echo($row['recipe_author']); ?></span></p>
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
			   <?php } ?></div>
			<div class="col-md-8">
				 <h6>Ingredients:</h6><p><span class=" ingredients"><?php print($row['recipe_ingredients']); ?></span></p>
				 <h6>Procedure:</h6><p> <span class=" procedure"><?php print($row['recipe_procedure']); ?></span></p>
				  </div>
				
			 
			 </div>
				
			
			</div></div></div>
		   <?php }}?>
 </div>
 </body>
 </html>