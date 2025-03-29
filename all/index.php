<?php
require_once 'admin/connect_db.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>QBranch - Inventory the Proper Way</title>
	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
	<link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
	<script src="../js/extra.js"></script>
	<table> 
		<thead> 
			<tr> 
				<th>Name</th> <th>Description</th> <th>Notes</th> <th>Status</th> <th>Unit</th><th>Availability</th>
			</tr> 
		</thead> 
		<tbody>
			<?php
			echo'hello';
			?><?php
			   $stmt = $DBcon->prepare("SELECT * FROM qbranch_master WHERE container IS NULL ORDER BY id ASC ");
			   $stmt->execute();
			   ?>
			   <?php
			   if($stmt->rowCount() > 0)
			   {
				while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
				{
				 ?>
			 <tr> <td><?php print($row['name']); ?> </td> <td><?php print($row['description']); ?> </td> <td><?php print($row['notes']); ?> </td>  <td><?php print($row['unitName']); ?> </td> <td><?php print($row['label']); ?> </td> <td><?php is_null($row['checklist']) ? print_r("Available\n") : print_r("Checked Out\n");?> </td></tr> 
			
			<?php
			   $stmta = $DBcon->prepare("SELECT * FROM qbranch_master WHERE container = '".$row['id']."' ORDER BY id ASC ");
			   $stmta->execute();
			   ?>
			   <?php
			   if($stmta->rowCount() > 0)
			   {
				while($rowa=$stmta->FETCH(PDO::FETCH_ASSOC))
				{
				 ?>
			 <tr> <td style="padding-left:2em;"><?php print($rowa['name']); ?> </td> <td><?php print($rowa['description']); ?> </td> <td><?php print($rowa['notes']); ?> </td>  <td><?php print($rowa['unitName']); ?> </td> <td><?php print($rowa['label']); ?> </td> <td><?php is_null($rowa['checklist']) ? print_r("Available\n") : print_r("Checked Out\n");?> </td></tr> 
			 
			 <?php
				$stmtb = $DBcon->prepare("SELECT * FROM qbranch_master WHERE container = '".$rowa['id']."' ORDER BY id ASC ");
				$stmtb->execute();
				?>
				<?php
				if($stmtb->rowCount() > 0)
				{
				 while($rowb=$stmtb->FETCH(PDO::FETCH_ASSOC))
				 {
				  ?>
			  <tr> <td style="padding-left:4em;"><?php print($rowb['name']); ?> </td> <td><?php print($rowb['description']); ?> </td> <td><?php print($rowb['notes']); ?> </td>  <td><?php print($rowb['unitName']); ?> </td> <td><?php print($rowb['label']); ?> </td> <td><?php is_null($rowb['checklist']) ? print_r("Available\n") : print_r("Checked Out\n");?> </td></tr> 
			  <?php
				}
			   }
			   else
			   {
				?>
				 <?php
			   }
			   ?>
			 <?php
			   }
			  }
			  else
			  {
			   ?>
				<?php
			  }
			  ?>
			
			
			
			
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
	
  </body>
</html>