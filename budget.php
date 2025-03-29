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
 <html>
	<head>
		<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
			<title>QBranch - Unit Inventory</title>
		  <?php 
		  
		  function generateRandomString($length = 10) {
			  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
		  
		   }
		   
		  
		   ?>
		   
		 
		   
		 
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
			 ?>
			 <h1 class="noprint"> <?php print($unitName) ?> Annual Budget</h1>
				
				 <div id="qrcode"  class="d-none d-print-block"></div><div class="H1 d-none d-print-block"><?php print($unitName) ?> Annual Budget</div>
				 <script type="text/javascript">
				  var qrcode = new QRCode(document.getElementById("qrcode"), {
					  text:"http://qbranch.scouts13.org/budget/<?php print($params['id']); ?>",
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
		<table class="table">
			<tr><th colspan="2">Unit Annual Operating Budget for <input type="text" value="<?php echo date("Y"); ?>"/></th><th>Annual Cost Per Person</th><th># of Scouts/ Adults</th><th>Total Unit Cost</th></tr>
			<tr><td colspan="5">PROGRAM EXPENSES:</td></tr>
			<tr><td>Youth registration fees</td><td>Total youth @ $66 ea.</td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td></tr>
			<tr><td>Adult registration fees</td><td>Total adults @ $42 ea</td><td></td><td></td><td></td></tr>
			<tr><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td></td><td></td><td></td><td></td><td></td></tr>
		</table>
	</body>
</html>