<?php
include('../inc/creds.php');


$connect = new PDO("mysql:host=$DB_host;dbname=$DB_name", $DB_user, $DB_pass);

$recipe_content = array();


$query = "SELECT * 
FROM 
	`tbl_recipe`
LEFT JOIN
	`tbl_category` ON
	`tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` 
WHERE
	`tbl_recipe_id` = ".$_GET['recipe']."
";

$result = $connect->query($query, PDO::FETCH_ASSOC);


foreach($result as $row)
{
	$recipe_content[] = array(
	'tbl_recipe_id'		=>	$row["tbl_recipe_id"],
	'tbl_category_id'	=>	$row["tbl_category_id"],
	'categoryName' 		=> 	$row['category_name'],
	'recipe_image'		=>	$row["recipe_image"],
	'recipe_name'		=>	$row['recipe_name'],
	'recipe_ingredients'	=> 	$row['recipe_ingredients'],
	'recipe_procedure'	=>	$row['recipe_procedure'],
	'recipe_author'		=>	$row['recipe_author'],
	'is_gf'				=>	$row['is_gf'],
	'is_veg'			=> 	$row['is_veg'],
	'is_halalkosher'	=>	$row['is_halalkosher'],
	'has_treenuts'		=>	$row['has_treenuts'],
	'has_lactose'		=>	$row['has_lactose'],
	'has_eggs'			=> 	$row['has_eggs'],	
	);

	
}


$output = array(
	'recipe_data'		=>	$recipe_content
);

echo json_encode($output);
	

?>