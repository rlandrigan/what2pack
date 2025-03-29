<?php error_reporting(0); ?><html lang="en">
  <head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>QBranch - QR Code generator</title>
		<script src="/js/qrcode/qrcode.min.js"></script>
		<?php
		$url = $_POST['url'];
		 $maincolor = $_POST['mainc'];
		 $seccolor = $_POST['secc'];
		  $codes = $_POST['start'];
		
		  $num = $_POST['num'];?>
		  
		<style>div img {margin-left:auto;margin-right:auto;}
			.qr {width: 390px; height: 390px; font-family: sans-serif; margin:10px auto;text-align: center;   border: 2px solid #000;margin-top:0;paddig-top:0;border-radius:50%;
			}
			input {margin:3px;}
			.form {width: 40%; min-width:350px; margin-left:auto;margin-right:auto;margin-bottom: 5em;background-color: #ccc; border-radius: 20px; padding: 10px; font-family: sans-serif;}
			}
		
		</style>
	  </head>
	  <body style="background-color: #fff">
		 

		 <div class="form"> <form name="codes" action="qrcode.php" method="POST" id="codes">
			 <h2>QBranch QR Code Generator</h2>
			 <p>Use: Input URL, Main and Secondary Colors, starting number and and total number of codes required. 300px x 300px PNGs will be created for each number in sequence. </p>
			  URL: <input name="url" type="text"/><br>
			  Main Color: <input name="mainc" type="text"/><br>
			  Secondary Color: <input name="secc" type="text"/><br>
			  Initial Number: <input name="start" type="text"/><br>
			  Number of Codes: <input name="num" type="text"/><br>
			  <input type="submit" name="save" value="Generate Codes" form="codes"></form></div>
			  <div style="column-count: 5">
	 <?php
	
	
	  $currcode = $codes;
	 
	  while ($currcode < $codes + $num )  {
	  ?>
	  <div class="qr" >
	 <h2 style="font-size: 100px; padding:5px; margin: 10px; border-radius: 5px;background-color: <?php print($seccolor); ?>;color:<?php print($maincolor); ?>;"><?php print($currcode); ?></h2>
		  <div id="qrcode<?php print($currcode); ?>" ></div>
		  <script type="text/javascript">
		   var qrcode = new QRCode(document.getElementById("qrcode<?php print($currcode); ?>"), {
			   text:"<?php print($url.$currcode); $currcode++; ?>",
		  width: 200,
		  height: 200,
		   css: "width: 200px",
		   colorDark : "<?php print($maincolor); ?>",
		   colorLight : "<?php print($seccolor); ?>",
		   correctLevel : QRCode.CorrectLevel.H});
		  
		   </script>
	  </div>
	  <?php 
  	} 
	  ?> 
			  </div>
	   
	   
	   
	   </body></html>