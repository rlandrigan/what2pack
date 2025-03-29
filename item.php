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
	<title>QBranch - Item Inventory for Tag <?php echo($params['id']);?></title>
  <?php 
  
  function generateRandomString($length = 10) {
	  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  
   }
   function isAvailable($ItemID=0, $type) {
		  
		  if($type=="box"){
			
			  $avail = '<div class="noprint form-check checkbox-slider--a checkbox-slider-md"><label><input type="checkbox" name="checkout[]"  id="btn-check'.$ItemID.'"  value="'.$ItemID.'" ><span class="noprint"></span></label></div>';
			  
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
						
						
						$avail = '<div class="noprint form-check checkbox-slider--aa checkbox-slider-md"><label><input type="checkbox" name="checkin[]"  id="btn-check'.$rowx['id'].'"  value="'.$rowx['id'].'" ><span></span></label></div>';
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
						  <input type='hidden' name='checkin[]' value='".$rowx['id']."'/> 
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
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://use.typekit.net/kyj2mgm.css?<?php echo  generateRandomString();?>">
<link rel="stylesheet" href="/css/alt.css?<?php echo  generateRandomString();?>">
	<script src="/js/qrcode/qrcode.min.js"></script>
	<link rel="stylesheet" href="/css/titatoggle-dist.css?<?php echo  generateRandomString();?>">
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
  </head>
  <body>
	  <?php 
	  $stmt = $DBcon->prepare("SELECT * FROM qbranch_master WHERE labelId = '".$params['id']."' ");
	  $stmt->execute();
	  ?>
	  
	  <?php
	  
	  if($stmt->rowCount() > 0)
	  {

		 include('inc/header.php'); 
		while($rowid=$stmt->FETCH(PDO::FETCH_ASSOC))
			{ $unitName = $rowid['unitName'];?>
		 <header class="py-3 mb-4 border-bottom">
			<div class="container d-flex flex-wrap justify-content-center">
			  <span class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none title fs-2">
			   <image src="/img/what2packBackInv.png" style="width: 2rem;transform: rotate(-35deg)" class="me-3">
			<a class="link-light" href="/unit/<? print($rowid['unitId']);?>"><?php echo($rowid['unitName']);?></a> : Record for Tag <?php print($params['id']); ?></span></div></header>
	  <div class="card secondary m-3 mx-auto" style="max-width:70rem" >
		  <div class="card-body p-0">
	  <div class="card-header tertiary">
	  <form action="/checkinout" method="POST" id="form">

			<script>
				// Create our shared stylesheet:
				const sheet = new CSSStyleSheet();
				sheet.replaceSync('.badge {background-color: <? print($rowid['badgeColor']);?>;} .badge:hover { color:<? print($rowid['badgeColor']);?>; background-color:#fff;}');
				
				// Apply the stylesheet to a document:
				document.adoptedStyleSheets = [sheet];
			</script>
			
		<?php }
		   $stmt->execute();
		   ?>
		   
		   
	<div class="row text-center"><div class="col"><button class="d-print-none btn btn-sm btn-secondary" type="button" onclick="checkAll();">Check All</button></div><div class="col"><button class="btn-outline-secondary btn btn-sm d-print-none" type="button" onclick="unCheckAll();">Uncheck All</button></div></div>
		<div id="qrcode"  class="d-none d-print-block"></div>
		<div id="signoff" class="d-none d-print-block"><b class="h2"><?php print($unitName);?></b> <br>Recorded By:__________________________</div>
		<script type="text/javascript">
		 var qrcode = new QRCode(document.getElementById("qrcode"), {
			 text:"http://what2pack.org/item/<?php print($params['id']); ?>",
		width: 128,
		height: 128,
		 css: "width: 300px",
		 colorDark : "#000000",
		 colorLight : "#ffffff",
		 correctLevel : QRCode.CorrectLevel.H});
		
		 </script>
	

	  

			  
			 </div>
			   <div class="container">
			
					  <?php
			  
		   while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
		   {
			   $mainID = $row['id'];
			?>
			

		<div class="row">
			<div class="col-12 pt-2">
				<h4><a class="ms-1" href="/item/<?php print($row['labelID']); ?>"><span class="badge  rounded-pill "><?php print($row['labelID']); ?></span></a> <a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/edit/<?php print($row['labelID']); ?>"><?php print($row['name']); ?></a></h4>
			</div>
		</div>
		
		<div class="row pb-2">
			<div class="col-8">
				<p><?php print($row['description']); ?><br/>
				<?php print($row['notes']); ?> </p>
			</div>
			<div class="col-4"><b class="noprint <?php $classVar=explode(' ', $row['label']); print($classVar[0]); ?>"><?php print($row['label']); ?></b>
				<?php print(isAvailable($row['id'], 'box')); ?>

				<div class="manualCheck"></div>
			</div>
		</div>
			
		

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
		<div class="row bg-body-secondary py-2 border-top border-white border-opacity-25">
			<div class="col-12 ps-3">
				<h4><a class="ms-1" href="/item/<?php print($rowa['labelID']); ?>" ><span class="badge  rounded-pill"><?php print($rowa['labelID']); ?></span></a> <a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/edit/<?php print($rowa['labelID']); ?>"><?php print($rowa['name']); ?></a></h4>
			</div>
		</div>
	   <div class="row bg-body-secondary pb-2">
		   <div class="col-8 ps-3">
			   <i><?php print($rowa['description']); ?> <br><?php print($rowa['notes']); ?> </i>
		   </div>
		   <div class="col-4">
			   <b class="noprint <?php $classVar=explode(' ', $rowa['label']); print($classVar[0]); ?>"><?php print($rowa['label']); ?></b>
				   <?php print(isAvailable($rowa['id'], 'box')); ?><div class="manualCheck"></div>
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
		<div class="row bg-body-tertiary py-2 border-top border-white border-opacity-25">
			<div class="col-12 ps-4"><h4><a class="ms-1" href="/item/<?php print($rowb['labelID']); ?>" ><span class="badge  rounded-pill "><?php print($rowb['labelID']); ?></span></a> <a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/edit/<?php print($rowb['labelID']); ?>"><?php print($rowb['name']); ?></a></h4>
			</div>
		</div>
		<div class="row bg-body-tertiary pb-2">
			<div class="col-8 ps-4">
				<i><?php print($rowb['description']); ?><br><?php print($rowb['notes']); ?></i> 
			</div>
			<div class="col-4">
			<b class="noprint <?php $classVar=explode(' ', $rowb['label']); print($classVar[0]); ?>"><?php print($rowb['label']); ?> </b>

			<?php print(isAvailable($rowb['id'], 'box')); ?><div class="manualCheck"></div>
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
				
					  <input type="hidden" name="labelID" value="<?php print($params['id'])?>">
					
					  <input name="date" type="hidden" value="<?php print(date('Y-m-d H:i:s'));?>">
					  <div class="input-group mb-3">
						 <span class="input-group-text" id="inputGroup-sizing-default">Responsible Party</span>
						 <input type="text" name="responsibleParty" placeholder="Name" class="form-control"/></div>
					  
					<div style="text-align: center">	<input class="btn btn-success" type="submit" name="save" value="Update" form="form"></div></div>
				  </form><?php
					} else {?>
				  
						  <div class="row py-2 d-print-none">
						<input type="hidden" name="labelID" value="<?php print($params['id'])?>">
						<div class="input-group mb-3">
						 <span class="input-group-text" id="inputGroup-sizing-default">Responsible Party</span>
						 <input type="text" name="responsibleParty" placeholder="Name" class="form-control"/></div>
						<input name="date" type="hidden" value="<?php print(date('Y-m-d H:i:s'));?>">
					<div style="text-align: center">	<input class="btn btn-success" type="submit" name="update" value="Update" form="form"></div>
						  </div>
		</form>
			   
			<?php } }
		 else
		 {
		  ?>
		  <script>
			  window.location.replace("https://what2pack.org/edit/<?php print($params['id']); ?>")</script>
		   <?php
		 }
		 ?></div>
		 <div class="card-footer"><img src="../img/what2packBackInv.png" class="mx-auto d-block" style="width: 3em;transform: rotate(-35deg);">
			</div>
</div>
  </body>
</html>