<?php
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
 

 ?>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>QBranch - Checkin/Checkout</title>
	  <?php 
	  
	  function generateRandomString($length = 10) {
		  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	  
	   }
	   
	   function isAvailable($ItemID=0, $type) {
			  
			  if($type=="box"){
				 $avail = "<label class='form-control noprint'>
					<input type='checkbox' name='checkout[]' value='".$ItemID."'/> &nbsp;Check Out?
				  </label>";
			  } else if($type=="label") {
				$avail = "<b class='avail'>Available</b>";  
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
						  $avail = "<label class='form-control noprint'>
							  <input type='checkbox' name='checkin[]' value='".$rowx['id']."'/> &nbsp;Check In?
							</label>";
					  } else if($type=="label") {
					   $avail = "<b class='out'>Checked Out</b><br><b>".$rowx['checkOutDate']."<br>by: ".$rowx['checkOutName']."</b>"; 
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
		<link rel="stylesheet" href="/css/style.css?<?php echo  generateRandomString();?>">
		<script src="/js/qrcode/qrcode.min.js"></script>
	  </head>
	  <body>
		 
		  
	
		  
	 <?php 
			  $stmt = $DBcon->prepare("SELECT * FROM qbranch_master WHERE labelID = '".$params['id']."'  ORDER BY id ASC ");
			  $stmt->execute();
			  ?>
			  
			  <?php
			 
			  if($stmt->rowCount() > 0)
			  {?>
				  <form action="/checkinout" method="POST" id="form">
				  <hr style="clear:both">
				  <table>
					  <thead>
						 
						  <tr><th width="5%"></th><th width="5%"></th><th width="23%"></th><th width="34%"></th><th width="33%"></th></tr>
						
						  <tr ><th colspan="5"><h1> <a href="/unit/<?php while($rowa=$stmt->FETCH(PDO::FETCH_ASSOC))
						   {print($rowa['unitId'].'">'.$rowa['unitName']); }
						   $stmt->execute();
						   ?></h1></th></tr>
						  <tr><th colspan="3" width="33%">Status</th><th width="34%">Availability</th><th width="33%">Check Out/In</th></tr>
					</thead><tbody>
						  <?php
				  
			   while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
			   {
				   $mainID = $row['id'];
				?>
				
	
			<tr class="top"><td colspan="5"><h1><a href="/edit/<?php print($row['labelID']); ?>"><svg version="1.1" id="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="32px" height="32px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
			<style type="text/css">
				.st0{fill:none;}
			</style>
			<title>edit</title>
			<rect fill="#41adff" x="2" y="26" width="28" height="2"/>
			<path fill="#41adff" d="M25.4,9c0.8-0.8,0.8-2,0-2.8c0,0,0,0,0,0l-3.6-3.6c-0.8-0.8-2-0.8-2.8,0c0,0,0,0,0,0l-15,15V24h6.4L25.4,9z M20.4,4L24,7.6
				l-3,3L17.4,7L20.4,4z M6,22v-3.6l10-10l3.6,3.6l-10,10H6z"/>
			<rect id="_Transparent_Rectangle_" class="st0" width="32" height="32"/>
			</svg></a><?php print($row['name']); ?><span class="badge"><?php print($row['labelID']); ?></span></h1>
			<h3><?php print($row['unitName']); ?></h3>
		<p><?php print($row['description']); ?> <br><?php print($row['notes']); ?> </p>
		<div id="qrcode"  class="print"></div> 
		<script type="text/javascript">
		 var qrcode = new QRCode(document.getElementById("qrcode"), {
			 text:"http://qbranch.scouts13.org/item/<?php print($params['id']); ?>",
		width: 128,
		height: 128,
		 css: "width: 300px",
		 colorDark : "#000000",
		 colorLight : "#ffffff",
		 correctLevel : QRCode.CorrectLevel.H});
		
		 </script>
			</td></tr>
				
				
			<tr class="top"><td colspan="3"><b class="<?php $classVar=explode(' ', $row['label']); print($classVar[0]); ?>"><?php print($row['label']); ?></b></td><td><?php print(isAvailable($row['id'], 'label')); ?></td><td><?php print(isAvailable($row['id'], 'box')); ?><div class="manualCheck"></div></td></tr>
	
	  <?php if($row['type'] == 'container'){?>
		 
		  <?php
			 $stmta = $DBcon->prepare("SELECT * FROM qbranch_master WHERE container = '".$row['id']."' ORDER BY id ASC ");
			 $stmta->execute();
			 ?>
			 <?php
			 if($stmta->rowCount() > 0)
			 { ?>
				
				 <?php
			  while($rowa=$stmta->FETCH(PDO::FETCH_ASSOC))
			  {
			   ?>
			 <tr class="second"><td class="firstbar"><td colspan="4"> <h2><a href="/edit/<?php print($rowa['labelID']); ?>"><svg version="1.1" id="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				  width="32px" height="32px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
			 <style type="text/css">
				 .st0{fill:none;}
			 </style>
			 <title>edit</title>
			 <rect fill="#41adff" x="2" y="26" width="28" height="2"/>
			 <path fill="#41adff" d="M25.4,9c0.8-0.8,0.8-2,0-2.8c0,0,0,0,0,0l-3.6-3.6c-0.8-0.8-2-0.8-2.8,0c0,0,0,0,0,0l-15,15V24h6.4L25.4,9z M20.4,4L24,7.6
				 l-3,3L17.4,7L20.4,4z M6,22v-3.6l10-10l3.6,3.6l-10,10H6z"/>
			 <rect id="_Transparent_Rectangle_" class="st0" width="32" height="32"/>
			 </svg></a><?php print($rowa['name']); ?> <span class="badge"><?php print($rowa['labelID']); ?></span></h2> 
		   
		   <i><?php print($rowa['description']); ?> <br><?php print($rowa['notes']); ?> </i>
		  <tr class="second"><td class="firstbar"></td><td colspan="2"><b class="<?php $classVar=explode(' ', $rowa['label']); print($classVar[0]); ?>"><?php print($rowa['label']); ?></b></td><td><?php print(isAvailable($rowa['id'], 'label')); ?></td><td><?php print(isAvailable($rowa['id'], 'box')); ?><div class="manualCheck"></div></td></tr>
		   
		   <?php
			  $stmtb = $DBcon->prepare("SELECT * FROM qbranch_master WHERE container = '".$rowa['id']."' ORDER BY id ASC ");
			  $stmtb->execute();
			  ?>
			  <?php
			  if($stmtb->rowCount() > 0)
			  { ?>
			
				   <?php
			   while($rowb=$stmtb->FETCH(PDO::FETCH_ASSOC))
			   {
				?>
			<tr class="third"><td class="firstbar"></td><td class="secondbar" ><td ><td colspan="3" ><h3 ><a href="/edit/<?php print($rowb['labelID']); ?>"><svg version="1.1" id="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="32px" height="32px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
			<style type="text/css">
				.st0{fill:none;}
			</style>
			<title>edit</title>
			<rect fill="#41adff" x="2" y="26" width="28" height="2"/>
			<path fill="#41adff" d="M25.4,9c0.8-0.8,0.8-2,0-2.8c0,0,0,0,0,0l-3.6-3.6c-0.8-0.8-2-0.8-2.8,0c0,0,0,0,0,0l-15,15V24h6.4L25.4,9z M20.4,4L24,7.6
				l-3,3L17.4,7L20.4,4z M6,22v-3.6l10-10l3.6,3.6l-10,10H6z"/>
			<rect id="_Transparent_Rectangle_" class="st0" width="32" height="32"/>
			</svg></a><?php print($rowb['name']); ?><span class="badge"><?php print($rowb['labelID']); ?></span></h3><i><?php print($rowb['description']); ?><br><?php print($rowb['notes']); ?></i> </td></tr>
				<tr class="third"><td class="firstbar"></td><td class="secondbar" ><td ><b class="<?php $classVar=explode(' ', $rowb['label']); print($classVar[0]); ?>"><?php print($rowb['label']); ?> </b></td><td><?php print(isAvailable($rowb['id'], 'label')); ?></td><td width="5%"><?php print(isAvailable($rowb['id'], 'box')); ?><div class="manualCheck"></div></td></tr>
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
			</tbody>
			<tfoot class="noprint">
					<tr><td colspan="5">
						  <input type="hidden" name="labelID" value="<?php print($params['id'])?>">
						  <label for="responsibileParty">Responsible Party<input name="responsibleParty" type="text" style="width:20rem"></label>
						  <input name="date" type="hidden" value="<?php print(date('Y-m-d H:i:s'));?>">
						<div style="text-align: center">	<input type="submit" name="save" value="Check Out" form="form"></div>
					  </form><?php
						} else {?>
						</tbody><tfoot>
							  <tr><td colspan="5">
							<input type="hidden" name="labelID" value="<?php print($params['id'])?>">
							<label for="responsibileParty">Responsible Party<input name="responsibleParty" type="text"></label>
							<input name="date" type="hidden" value="<?php print(date('Y-m-d H:i:s'));?>">
						<div style="text-align: center">	<input type="submit" name="update" value="Check In" form="form"></div>
							  </td></tr </tfoot>	
				</table>
			</form>
			
				<?php } }
			 else
			 {
			  ?>
			
		  <h1>Add an Item</h1>
		 <form action="/itemsubmit" method="POST" id="form">
		<label for="name">Name <input type="text" name="name" placeholder="Name" style="width:20em"/></label>
		<label for="name">Label Number<input type="text" name="labelId" value="<?php print($params['id'])?>" style="width:5em"/></label>
		<select name="unit" id="unit" style="clear:both">
			   <optgroup label ="Unit">
				   <option value ="" >Please select a Unit</option>
		   <?php
		
		   $stmta = $DBcon->prepare("SELECT * FROM qbranch_units ORDER BY unitName ASC");
		   $stmta->execute();
		   ?>
		   <?php
		   if($stmta->rowCount() > 0)
		   {
			while($row_ex=$stmta->FETCH(PDO::FETCH_ASSOC))
			{
			 ?>
			   <option value="<?php print($row_ex['id']); ?>"><?php print($row_ex['unitName']); ?></option>
		   <?php
			 }}
			 ?></optgroup>
		   </select>
		<label for="description" style="clear:both; display: block;">Description <textarea name="description" style="width:100%" placeholder="Description"></textarea></label>
		<label for="notes" style="clear:both; display: block;">Notes <textarea name="notes" style="width:100%" placeholder="Notes"></textarea></label>
		<select name="type" id="type" style="float:left; clear:left">
					   <optgroup label ="type">
						   <option value ="item" >Item</option>
						   <option value ="container" >Container</option>
						   </optgroup>
							 </select> 
				 <select name="container" id="container" style="float:left;">
					   <optgroup label ="container">
						   <option  >Container</option>
				   <?php
				 
				   $stmtc = $DBcon->prepare("SELECT * FROM qbranch_inventory WHERE type = 'container'");
				   $stmtc->execute();
				   ?>
				   <?php
				   if($stmtc->rowCount() > 0)
				   {
					while($row_con=$stmtc->FETCH(PDO::FETCH_ASSOC))
					{
					 ?>
					   <option value="<?php print($row_con['id']); ?>"><?php print($row_con['name']); ?></option>
				   <?php
					 }}
					 ?></optgroup>
				   </select>
				   <select name="status" id="status" style="clear:both; display: block;">
							 <optgroup label ="Status">
								 <option value ="" >Please select Status</option>
						 <?php
						 
						 $stmtb = $DBcon->prepare("SELECT * FROM qbranch_status ORDER BY label ASC");
						 $stmtb->execute();
						 ?>
						 <?php
						 if($stmtb->rowCount() > 0)
						 {
						  while($row_st=$stmtb->FETCH(PDO::FETCH_ASSOC))
						  {
						   ?>
							 <option value="<?php print($row_st['id']); ?>"><?php print($row_st['label']); ?></option>
						 <?php
						   }}
						   ?></optgroup>
						 </select> <hr><input type="submit" name="save" value="save" form="form"><hr>
		   <?php
		 } ?>
  </body>
</html>