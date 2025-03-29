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

 ?>
<html lang="en" data-bs-theme="dark">
  <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>QBranch - Unit Inventory</title>
  <?php 
  
  function generateRandomString($length = 10) {
	  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  
   }
   function isAvailable($ItemID=0, $type) {
		  
		  if($type=="box"){
			
			  $avail = '<div class="noprint form-check checkbox-slider--a checkbox-slider-md"><label><input type="checkbox" name="checkout[]"  id="btn-check'.$ItemID.'"  value="'.$ItemID.'" ><span></span></label></div>';
			  
			  
		  } else if($type=="label") {
			$avail = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
			<g clip-path="url(#clip0_12_1051)">
			<path d="M10 1.25C5.16751 1.25 1.25 5.16751 1.25 10C1.25 14.8325 5.16751 18.75 10 18.75C14.8325 18.75 18.75 14.8325 18.75 10C18.75 7.67936 17.8281 5.45376 16.1872 3.81282C14.5462 2.17187 12.3206 1.25 10 1.25ZM8.75 13.4943L5.625 10.3693L6.61912 9.375L8.75 11.5057L13.3813 6.875L14.3786 7.86619L8.75 13.4943Z" fill="#24A148"/>
			</g>
			<defs>
			<clipPath id="clip0_12_1051">
			<rect width="20" height="20" fill="white"/>
			</clipPath>
			</defs>
			</svg>';  
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
				$avail = '<div class="noprint form-check checkbox-slider--aa checkbox-slider-md"><label><input type="checkbox" name="checkin[]"  id="btn-check'.$rowx['id'].'" value="'.$rowx['id'].'" ><span></span></label></div>';
				  } else if($type=="label") {
				  $avail = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 20 20" version="1.1">
						 <title>misuse</title>
						 <g id="Structure" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							 <g id="misuse">
								 <rect id="_Transparent_Rectangle_" x="0" y="0" width="20" height="20"/>
								 <path d="M10,1.25 C5.1875,1.25 1.25,5.1875 1.25,10 C1.25,14.8125 5.1875,18.75 10,18.75 C14.8125,18.75 18.75,14.8125 18.75,10 C18.75,5.1875 14.8125,1.25 10,1.25 Z M13.375,14.375 L10,11 L6.625,14.375 L5.625,13.375 L9,10 L5.625,6.625 L6.625,5.625 L10,9 L13.375,5.625 L14.375,6.625 L11,10 L14.375,13.375 L13.375,14.375 Z" id="Shape" fill="#DA1E28" fill-rule="nonzero"/>
								 <polygon id="inner-path" fill-opacity="0" fill="#000000" fill-rule="nonzero" opacity="0" points="13.375 14.375 10 11 6.625 14.375 5.625 13.375 9 10 5.625 6.625 6.625 5.625 10 9 13.375 5.625 14.375 6.625 11 10 14.375 13.375"/>
							 </g>
						 </g>
					 </svg>'; 
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
   <style>div.inv_item div div ul { column-count: 2};</style>
   <script>function checkAll() {
		  var arrMarkMail = document.getElementsByName("checkout[]");
		  var arrMarkMailin = document.getElementsByName("checkin[]");
		  for (var i = 0; i < arrMarkMail.length; i++) {
			 arrMarkMail[i].checked = true;
		  }
		  for (var i = 0; i < arrMarkMailin.length; i++) {
			   arrMarkMailin[i].checked = true;
			}
		  
	   }
   function unCheckAll() {
   var arrMarkMail = document.getElementsByName("checkout[]");
   var arrMarkMailin = document.getElementsByName("checkin[]");
   for (var i = 0; i < arrMarkMail.length; i++) {
	  arrMarkMail[i].checked = false;
   }
  for (var i = 0; i < arrMarkMailin.length; i++) {
	  arrMarkMailin[i].checked = false;
   }}
   </script>
   <script>
	   function myFunction() {
		   var input, filter, cards, cardContainer, h5, title, i;
		   input = document.getElementById("filter");
		   filter = input.value.toUpperCase();
		   cardContainer = document.getElementById("inv_all");
		   cards = cardContainer.getElementsByClassName("inv_item");
		   for (i = 0; i < cards.length; i++) {
			 
			   title = cards[i].querySelector("span.inv_name");
			   
			   if (title.innerText.toUpperCase().indexOf(filter) > -1) {
				   cards[i].style.display = "";
			   } else {
				   cards[i].style.display = "none";
			   }
		   }
	   }
	  </script>
   
 <link rel="stylesheet" href="https://use.typekit.net/kyj2mgm.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://use.typekit.net/kyj2mgm.css?<?php echo  generateRandomString();?>">
<link rel="stylesheet" href="/css/alt.css?<?php echo  generateRandomString();?>">
	<link rel="stylesheet" href="/css/titatoggle-dist.css?<?php echo  generateRandomString();?>">
		
	<script src="/js/qrcode/qrcode.min.js"></script>
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
		   include('inc/header.php'); 
		   ?>
	  
		 <header class="py-3 mb-4 border-bottom d-print-none">
		   <div class="container d-flex flex-wrap justify-content-center">
			 <span class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
			  <image src="/img/what2packBackInv.png" style="width: 3rem;transform: rotate(-35deg)" class="me-4">
			   <span class="fs-2 title">Full Inventory for <?php print($unitName) ?>
			 
		<?php	 if($params['id'] == '1'){
				 
				 ?> <a href="https://what2pack.org/unit/2" class="smTitle" style="font-size: 1rem!important;color:#fff">(Switch Unit)</a>
			 <?php }elseif ($params['id'] == '2'){
			 
			 ?> <a href="https://what2pack.org/unit/3" class="smTitle" style="font-size: 1rem!important;color:#fff">(Switch Unit)</a>
			 
			<?php }elseif ($params['id'] == '3'){
			 
			 ?> <a href="https://what2pack.org/unit/4" class="smTitle" style="font-size: 1rem!important;color:#fff">(Switch Unit)</a>
			 
			 <?php }elseif ($params['id'] == '4'){
			  
			  ?> <a href="https://what2pack.org/unit/1" class="smTitle" style="font-size: 1rem!important;color:#fff">(Switch Unit)</a>
			  
			  <?php }?></span></span>
			 <form class="col-12 col-lg-auto mb-3 mb-lg-0" role="search">
			   <input type="search" id="filter" class="form-control" placeholder="Search..." aria-label="Search" onkeyup="myFunction()">
			 </form>
		   </div>
		 </header>
	  <div class="card secondary m-3 mx-auto" style="max-width:70rem" >
		  <div class="card-body p-0">
	  <div class="card-header tertiary">
	  <form action="/checkinout" method="POST" id="form">
	
		 <script>
			 // Create our shared stylesheet:
			 const sheet = new CSSStyleSheet();
			 sheet.replaceSync('.badge {background-color: <? print($rowu['badgeColor']);?>;} .badge:hover { color: <? print($rowu['badgeColor']);?>; background-color:#fff;}');
			 
			 // Apply the stylesheet to a document:
			 document.adoptedStyleSheets = [sheet];
		 </script>
		 
		<div class="row text-center"><div class="col"><button class="d-print-none btn btn-sm btn-secondary" type="button" onclick="checkAll();">Check All</button></div><div class="col"><button class="btn-outline-secondary btn btn-sm d-print-none" type="button" onclick="unCheckAll();">Uncheck All</button></div></div>
		<div class="row"><div class="col-12">
		<div id="qrcode"  class="d-none d-print-block"></div><div class="H1 d-none d-print-block"><?php print($unitName) ?> Full Inventory</div>
		<div id="signoff" class="d-none d-print-block">Recorded By:__________________________</div>
		<script type="text/javascript">
		 var qrcode = new QRCode(document.getElementById("qrcode"), {
			 text:"http://what2pack.org/unit/<?php print($params['id']); ?>",
		width: 90,
		height: 90,
		 css: "width: 90px",
		 colorDark : "#000000",
		 colorLight : "#ffffff",
		 correctLevel : QRCode.CorrectLevel.H});
		
		 </script>
		 <?php
		  }
		 }
		 else
		 {
		  print('<h1> Add Unit</h1><p>This needs to be added, but not an immediate need.</p>');
		 }
	  
	  ?>
		</div></div>
	<?php 
		$stmtxx = $DBcon->prepare("SELECT max(labelID) as Maxlabel FROM qbranch_master WHERE unitId = '".$params['id']."' ");
		$stmtxx->execute();
		$puppy = 0;
	   
		if($stmtxx->rowCount() > 0)
		{
			
		 while($rowxx=$stmtxx->FETCH(PDO::FETCH_ASSOC))
		 {
		$puppy = $rowxx['Maxlabel'];
	}
	 } else {
		 
	}
		
	$puppy = $puppy+1;
	 
	 ?>
	 <div class="row text-center"><div class="col"><a class="d-print-none btn btn-sm btn-outline-success" type="button" href="https://what2pack.org/item/<?php echo($puppy); ?>">Add New Item</a></div></div>
	 <?php
		  $stmt = $DBcon->prepare("SELECT * FROM qbranch_master WHERE unitId = '".$params['id']."' and container < 1 ORDER BY labelID ASC ");
		  $stmt->execute();
		  ?>
		  
		  <?php
		 
		  if($stmt->rowCount() > 0)
		  {?>
			  
			 </div>
			   <div class="container" id="inv_all">
			
					  <?php
			  
		   while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
		   {
			   $mainID = $row['id'];
			?>
<div class="inv_item"><span class="inv_name d-none"><?php print($row['name']); ?></span>
		<div class="row">
			<div class="col-9 pt-2">
				<h4><a class="ms-1" href="/item/<?php print($row['labelID']); ?>"><span class="badge  rounded-pill"><?php print($row['labelID']); ?></span></a> <a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/edit/<?php print($row['labelID']); ?>"><?php print($row['name']); ?></a></h4>
			</div>
			<div class="col-3"><div class="manualCheck"></div></div>
		</div>
		
	<?php if (!empty($row['description'] )) { ?>	<div class="row pb-2">
			<div class="col-8">
<?php if (!empty($row['description'])) { print('<p>'.$row['description']); }?>
<?php if (!empty($row['notes'])) { print('<br/>'.$row['notes']);} ?> 
			</div>
			<div class="col-4"><b class="noprint <?php $classVar=explode(' ', $row['label']); print($classVar[0]); ?>"><?php print($row['label']); ?></b>
				<?php print(isAvailable($row['id'], 'box')); ?>
			</div>
		</div>
</div>
			<?php }?>
		

  <?php if($row['type'] == 'container'){?>
	 
	  <?php
		 $stmta = $DBcon->prepare("SELECT * FROM qbranch_master WHERE container = '".$row['id']."' ORDER BY labelID ASC ");
		 $stmta->execute();
		 ?>
		 <?php
		 if($stmta->rowCount() > 0)
		 { ?>
			
			 <?php
		  while($rowa=$stmta->FETCH(PDO::FETCH_ASSOC))
		  {
		   ?>
		   <div class="inv_item"><span class="inv_name d-none"><?php print($rowa['name']); ?></span>
		<div class="row bg-body-secondary py-2 border-top border-white border-opacity-25">
			<div class="col-9 ps-3">
				<h4><a class="ms-1" href="/item/<?php print($rowa['labelID']); ?>" ><span class="badge  rounded-pill"><?php print($rowa['labelID']); ?></span></a> <a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/edit/<?php print($rowa['labelID']); ?>"><?php print($rowa['name']); ?></a></h4>
			</div>
			<div class="col-3"><div class="manualCheck"></div></div>
		</div>
	   <div class="row bg-body-secondary pb-2">
		   <div class="col-8 ps-3">
			  <?php if (!empty($rowa['description'])) { print('<p><i>'.$rowa['description'].'</i>'); }?>
			  <?php if (!empty($rowa['notes'])) { print('<br/><i>'.$rowa['notes'].'</i>');} ?> 
		   </div>
		   <div class="col-4">
			   <b class="noprint <?php $classVar=explode(' ', $rowa['label']); print($classVar[0]); ?>"><?php print($rowa['label']); ?></b><br/>
		   		<?php print(isAvailable($rowa['id'], 'box')); ?>
			</div>
	   </div>
		   </div>
	   <?php
		  $stmtb = $DBcon->prepare("SELECT * FROM qbranch_master WHERE container = '".$rowa['id']."' ORDER BY labelID ASC ");
		  $stmtb->execute();
		  ?>
		  <?php
		  if($stmtb->rowCount() > 0)
		  { ?>
		
			   <?php
		   while($rowb=$stmtb->FETCH(PDO::FETCH_ASSOC))
		   {
			?>
			<div class="inv_item"><span class="inv_name d-none"><?php print($rowb['name']); ?></span>
		<div class="row bg-body-tertiary py-2 border-top border-white border-opacity-25">
			<div class="col-9 ps-4"><h4><a class="ms-1" href="/item/<?php print($rowb['labelID']); ?>" ><span class="badge  rounded-pill"><?php print($rowb['labelID']); ?></span></a> <a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/edit/<?php print($rowb['labelID']); ?>"><?php print($rowb['name']); ?></a></h4>
			</div>
			<div class="col-3"><div class="manualCheck"></div></div>
		</div>
		<div class="row bg-body-tertiary pb-2">
			<div class="col-8 ps-4">
				<?php if (!empty($rowb['description'])) { print('<p><i>'.$rowb['description'].'</i>'); }?>
				  <?php if (!empty($rowb['notes'])) { print('<br/><i>'.$rowb['notes'].'</i>');} ?> 
			</div>
			<div class="col-4">
			<b class="noprint <?php $classVar=explode(' ', $rowb['label']); print($classVar[0]); ?>"><?php print($rowb['label']); ?> </b><br>
			<?php print(isAvailable($rowb['id'], 'box')); ?>
			</div>
			</div>
			</div>
		<?php
		  }
			   } else {

		 }
		
		 }
		}
		else
		{
		}
		?>
	  
  <?php } 
		  }
		  
		  if(isAvailable($mainID,'status')== 'y'){?>
		
		<div class="row py-2 d-print-none">
				
					  <input type="hidden" name="unitID" value="<?php print($params['id'])?>">
					
					  <input name="date" type="hidden" value="<?php print(date('Y-m-d H:i:s'));?>">
					  <div class="input-group mb-3">
						 <span class="input-group-text" id="inputGroup-sizing-default">Responsible Party</span>
						 <input type="text" name="responsibleParty" placeholder="Name" class="form-control"/></div>
						 <div class="input-group mb-3">
						 <span class="input-group-text" id="inputGroup-sizing-default">Select Campout</span>
						 <select class="form-select" id="checklistID" name="checklistID" aria-label="Select Campout"> 
						  <?php 
							  $stmtx = $DBcon->prepare("select * from qbranch_event where unit = '".$params['id']."' ");
								 $stmtx->execute();
								
								 if($stmtx->rowCount() > 0)
								 {
									 $selectLoad = "";
								  while($rowx=$stmtx->FETCH(PDO::FETCH_ASSOC))
								  {?>
									  <option value="<?php print($rowx['id']);?>"><?php print($rowx['name']);?></option>
								  <?php }
							  }?>
							  </select></div>
					  
					<div style="text-align: center">	<input class="btn btn-success" type="submit" name="save" value="Check Out" form="form"></div></div>
					
				  </form><?php
					} else {?>
  				
						  <div class="row py-2 d-print-none">
						<input type="hidden" name="unitID" value="<?php print($params['id'])?>">
						<div class="input-group mb-3">
						 <span class="input-group-text" id="inputGroup-sizing-default">Responsible Party</span>
						 <input type="text" name="responsibleParty" placeholder="Name" class="form-control"/></div>
						<input name="date" type="hidden" value="<?php print(date('Y-m-d H:i:s'));?>">
					<div style="text-align: center">	<input class="btn btn-success" type="submit" name="update" value="Check In" form="form"></div>
						  </div>
		</form>
			   
			<?php } }
		 else
		 {
		  ?>
		   <?php
		 }
		 ?></div>
		<div class="card-footer"><img src="../img/what2packBackInv.png" class="mx-auto d-block" style="width: 3em;transform: rotate(-35deg);">
			</div>
</div>
  </body>
</html>