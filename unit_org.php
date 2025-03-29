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
<html lang="en">
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
			 $avail = "<label class='noprint'>
				<input type='checkbox' name='checkout[]' value='".$ItemID."'/>
			  </label>";
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
					  $avail = "<label class='noprint'>
						  <input type='checkbox' name='checkin[]' value='".$rowx['id']."'/>
						</label>";
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
   
  
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
	<link rel="stylesheet" href="/css/style.css?<?php echo  generateRandomString();?>">
	<script src="/js/qrcode/qrcode.min.js"></script>
  </head>
  <body>
	  <form action="/checkinout" method="POST" id="form">
	  <?php 
	  $stmtu = $DBcon->prepare("select * from qbranch_units where id = '".$params['id']."' ");
		  $stmtu->execute();
		 
		  if($stmtu->rowCount() > 0)
		  {
		   while($rowu=$stmtu->FETCH(PDO::FETCH_ASSOC))
		   {
		 $unitName =$rowu['unitName'];
		 ?>
		<h1> <?php print($unitName) ?> Full Inventory</h1><button class="noprint" type="button" onclick="checkAll();">Check All</button><button class="noprint" type="button" onclick="unCheckAll();">Uncheck All</button>
		<div id="qrcode"  class="print"></div>
		<div id="signoff" class="print">Taken By:_____________________________________</div>
		<script type="text/javascript">
		 var qrcode = new QRCode(document.getElementById("qrcode"), {
			 text:"http://qbranch.scouts13.org/unit/<?php print($params['id']); ?>",
		width: 128,
		height: 128,
		 css: "width: 300px",
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

	  
 <?php 
		  $stmt = $DBcon->prepare("SELECT * FROM qbranch_master WHERE unitId = '".$params['id']."' and container < 1 ORDER BY labelID ASC ");
		  $stmt->execute();
		  ?>
		  
		  <?php
		 
		  if($stmt->rowCount() > 0)
		  {?>
			  
			  <hr style="clear:both">
			  <table>
				  <thead>
					  
					  <tr><th width="53%">Name</th><th width="18%">Status</th><th width="15%">Avail</th><th width="15%">Out/In</th></tr>
				</thead><tbody>
					  <?php
			  
		   while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
		   {
			   $mainID = $row['id'];
			?>
			

		<tr class="top"><td style="text-align: left"><h3><a href="/edit/<?php print($row['labelID']); ?>"><svg class="noprint" version="1.1" id="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="22px" height="22px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
		<style type="text/css">
			.st0{fill:none;}
		</style>
		<title>edit</title>
		<rect fill="#41adff" x="2" y="26" width="28" height="2"/>
		<path fill="#41adff" d="M25.4,9c0.8-0.8,0.8-2,0-2.8c0,0,0,0,0,0l-3.6-3.6c-0.8-0.8-2-0.8-2.8,0c0,0,0,0,0,0l-15,15V24h6.4L25.4,9z M20.4,4L24,7.6
			l-3,3L17.4,7L20.4,4z M6,22v-3.6l10-10l3.6,3.6l-10,10H6z"/>
		<rect id="_Transparent_Rectangle_" class="st0" width="32" height="32"/>
		</svg></a><?php print($row['name']); ?><a href="/item/<?php print($row['labelID']); ?>" class="badge"><?php print($row['labelID']); ?></a></h3>
	<p><?php print($row['description']); ?></p>
	<p><?php print($row['notes']); ?> </p>
		</td><td><b class="<?php $classVar=explode(' ', $row['label']); print($classVar[0]); ?>"><?php print($row['label']); ?></b></td><td ><?php print(isAvailable($row['id'], 'label')); ?></td><td ><?php print(isAvailable($row['id'], 'box')); ?><div class="manualCheck"></div></td></tr>
			
			
		

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
		 <tr class="second"><td style="text-align: left"><h3><a href="/edit/<?php print($rowa['labelID']); ?>"><svg class="noprint" version="1.1" id="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			  width="22px" height="22px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
		 <style type="text/css">
			 .st0{fill:none;}
		 </style>
		 <title>edit</title>
		 <rect fill="#41adff" x="2" y="26" width="28" height="2"/>
		 <path fill="#41adff" d="M25.4,9c0.8-0.8,0.8-2,0-2.8c0,0,0,0,0,0l-3.6-3.6c-0.8-0.8-2-0.8-2.8,0c0,0,0,0,0,0l-15,15V24h6.4L25.4,9z M20.4,4L24,7.6
			 l-3,3L17.4,7L20.4,4z M6,22v-3.6l10-10l3.6,3.6l-10,10H6z"/>
		 <rect id="_Transparent_Rectangle_" class="st0" width="32" height="32"/>
		 </svg></a><?php print($rowa['name']); ?> <a href="/item/<?php print($rowa['labelID']); ?>" class="badge"><?php print($rowa['labelID']); ?></a></h3> 
	   
	   <i><?php print($rowa['description']); ?> <br><?php print($rowa['notes']); ?> </i></td>
	 <td><b class="<?php $classVar=explode(' ', $rowa['label']); print($classVar[0]); ?>"><?php print($rowa['label']); ?></b></td><td><?php print(isAvailable($rowa['id'], 'label')); ?></td><td><?php print(isAvailable($rowa['id'], 'box')); ?><div class="manualCheck"></div></td></tr>
	   
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
		<tr class="third"><td style="text-align: left"><h3 ><a href="/edit/<?php print($rowb['labelID']); ?>"><svg class="noprint" version="1.1" id="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="22px" height="22px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
		<style type="text/css">
			.st0{fill:none;}
		</style>
		<title>edit</title>
		<rect fill="#41adff" x="2" y="26" width="28" height="2"/>
		<path fill="#41adff" d="M25.4,9c0.8-0.8,0.8-2,0-2.8c0,0,0,0,0,0l-3.6-3.6c-0.8-0.8-2-0.8-2.8,0c0,0,0,0,0,0l-15,15V24h6.4L25.4,9z M20.4,4L24,7.6
			l-3,3L17.4,7L20.4,4z M6,22v-3.6l10-10l3.6,3.6l-10,10H6z"/>
		<rect id="_Transparent_Rectangle_" class="st0" width="32" height="32"/>
		</svg></a><?php print($rowb['name']); ?><span class="badge"><?php print($rowb['labelID']); ?></span></h3><i><?php print($rowb['description']); ?><br><?php print($rowb['notes']); ?></i> </td><td><b class="<?php $classVar=explode(' ', $rowb['label']); print($classVar[0]); ?>"><?php print($rowb['label']); ?> </b></td><td><?php print(isAvailable($rowb['id'], 'label')); ?></td><td width="5%"><?php print(isAvailable($rowb['id'], 'box')); ?><div class="manualCheck"></div></td></tr>
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
		
		<tfoot class="noprint">
				<tr><td colspan="5">
					  <input type="hidden" name="unitID" value="<?php print($params['id'])?>">
					  <label for="responsibileParty">Responsible Party<input name="responsibleParty" type="text" style="width:20rem"></label>
					  <input name="date" type="hidden" value="<?php print(date('Y-m-d H:i:s'));?>">
					<div style="text-align: center">	<input type="submit" name="save" value="Check Out" form="form"></div>
				  </form><?php
					} else {?>
  				  </tbody><tfoot>
						  <tr><td colspan="5">
						<input type="hidden" name="unitID" value="<?php print($params['id'])?>">
						<label for="responsibileParty">Responsible Party<input name="responsibleParty" type="text" style="width:20rem"></label>
						<input name="date" type="hidden" value="<?php print(date('Y-m-d H:i:s'));?>">
					<div style="text-align: center">	<input type="submit" name="update" value="Check In" form="form"></div>
						  </td></tr> </tfoot>	
			</table>
		</form>
		
			<?php } }
		 else
		 {
		  ?>
		   <?php
		 }
		 ?>

  </body>
</html>