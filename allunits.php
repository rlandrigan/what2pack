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
<html lang="en"  data-bs-theme="dark">
  <head>
	  <meta property="og:title" content="Where2Pack">
		<meta property="og:type" content="website">
		<meta property="og:url" content="https://where2pack.org">
		<meta property="og:description" content="Logistics beats clever.">
		<link rel="icon" sizes="any" href="favicon.ico" type="image/x-icon">
		<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
	  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
		<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>What2Pack</title>
  <?php 
  
  function generateRandomString($length = 10) {
	  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  
   }
   function calculateAge($dob) {
	   return floor((time() - strtotime($dob)) / 31556926);
   }
  
   ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="/css/alt.css?<?php echo  generateRandomString();?>">
		 <link rel="stylesheet" href="https://use.typekit.net/kyj2mgm.css">
  </head>
  <body>

	  <div class="container">
	<div class="card my-3">
		<div class="row row-cols-1 row-cols-md-2">
			<div class="col-md-5 text-center">
				
	  <img src="./img/what2packBackInv.png" style="width: 50%;transform: rotate(-35deg);" class="card-img-top me-auto ms-auto mt-4 mb-2" alt="W2P logo">
			</div>
			<div class="col-md-7">
	  <div class="card-body">
		<img src="./img/what2pack.png" style="width: 100%;" class="card-img-top mx-auto p-0" alt="W2P logo">
		<nav >
		<ul class="nav me-auto justify-content-center">
			<li class="nav-item"><a href="https://what2pack.org" class="nav-link link-body-emphasis px-2 active" aria-current="page">Home</a></li>
			<li class="nav-item"><a href="/planner/2" class="nav-link link-body-emphasis px-2">Campouts</a></li>
			<li class="nav-item"><a href="/cookbook" class="nav-link link-body-emphasis px-2">Menus</a></li>
			<li class="nav-item"><a href="https://where2camp.com" target="_blank" class="nav-link link-body-emphasis px-2">Locations</a></li>
			<li class="nav-item"><a href="https://what2pack.org/unit/3" class="nav-link link-body-emphasis px-2">Inventory</a></li>
		  </ul>
		</nav>
		<p class="card-text">What2Pack is the Inventory Management System for the Units 13, located at Trinity United Methodist church and chartered by Midtown Youth Adventures.</p>
		<p class="card-text">What2Pack has several functions:
			<ul><li>Unit Inventories, including the ability in/Check out gear</li>
			<li>Item status - update status and keep track of damaged or missing gear</li>
			<li>Menus/Cookbook - a full cookbook, with allergen/dietary alerts</li>
			<li>Campout Planning - plan trips, generate Trip Reports for Council, add recipes, duty rosters, and packing lists</li>
			</ul>
		</p>
	  </div></div></div>
	</div>
	  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
	
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
			  <div class="card text-center">
				<a  href="planner/<?php print($row['id']); ?>"><img src="./img/<?php print($row['logo']); ?>" class="card-img-top mx-auto" alt="Logo for <?php print($row['unitName']); ?>"></a>
				<div class="card-body">
				  <h5 class="card-title"><?php print($row['unitName']); ?> <span class="badge rounded-pill text-bg-danger"><?php print(calculateAge($row['founded'])); ?></span></h5> 
				  <p class="card-text"><?php print($row['unitdesc']); ?></p>
				  <p class="card-text"><a href="mailto:<?php print($row['leaderEmail']); ?>">Email Unit Leader</a>  </p>
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
	  </div></div>
	    </body>
		<footer class="text-center">Where2Pack is &copy;2024 by Robert Landrigan, and was developed for Troops, Crew, and Pack 13. If you are interested in something similar for your own units, email <a href="mailto:info@scouts13.org">our webmaster</a> for more info. </footer>
</html>