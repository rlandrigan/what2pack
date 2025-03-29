<?php
require_once('protect.php');

require_once 'connect_db.php';
?>



<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Add Inventory</title>
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body style="max-width:80vw">
	<form action="server.php" method="POST" id="form">
<table > 
	<thead> 
		<tr> 
			<th>Name</th> <th>Description</th> <th>Notes</th> <th>Type</th><th>Parent</th><th>Unit</th> <th>Status</th><th>Availability</th>
		</tr> 
	</thead> 
	<tbody>
		<tr> <td> <input type="text" name="name" placeholder="Name"/> </td> <td> <textarea name="description" style="width:100%" placeholder="Description"></textarea></td> <td> <textarea name="notes" style="width:100%" placeholder="Notes"></textarea></td>  
		<td><select name="type" id="type">
			  <optgroup label ="type">
				  <option value ="item" >Item</option>
				  <option value ="container" >Container</option>
				  </optgroup>
					</select></td>
		<td> 
		<select name="container" id="container">
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
		  </select></td>
		<td> 
			<select name="unit" id="unit">
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
			  </select></td><td><select name="status" id="status">
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
				</select> </td> <td><input type="submit" name="save" value="save" form="form"></td></tr> 
		<?php
		   $stmt = $DBcon->prepare("SELECT * FROM qbranch_master ORDER BY id ASC ");
		   $stmt->execute();
		   ?>
		   <?php
		   if($stmt->rowCount() > 0)
		   {
			while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
			{
			 ?>
		 <tr> <td><?php print($row['name']); ?> </td> <td><?php print($row['description']); ?> </td> <td><?php print($row['notes']); ?> </td>  <td><?php print($row['type']); ?> </td> <td><?php print($row['container']); ?> </td> <td><?php print($row['unitName']); ?> </td> <td><?php print($row['label']); ?> </td> <td><?php is_null($row['checklist']) ? print_r("Available\n") : print_r("Checked Out\n");?> </td></tr> 
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
 </table></form>
</body>
</html>