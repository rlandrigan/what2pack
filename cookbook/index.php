<?php 
include('conn/conn.php'); 

 function generateRandomString($length = 10) {
      return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  
   }
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What2Pack: Recipes(What2Cook?:)</title>

    <!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
     
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
 
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
 <link rel="stylesheet" href="https://use.typekit.net/kyj2mgm.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="/css/alt.css?<?php echo  generateRandomString();?>">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
   <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
  
   <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
   
   
   
  <script type="text/javascript" language="javascript" src=" https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script> 
  <script type="text/javascript" language="javascript" src="  https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script> 
   <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
</head>
<body><?php
include('assets/modal.php'); 
  include('../inc/header.php'); 
?>
 <script>
$(document).ready(function() {

  
  // DataTable
  var table = $('#foodListTable').DataTable( {
  responsive: true
  } );
 


} );
 </script>
 <header class="py-3 mb-2 border-bottom">
 <div class="container d-flex flex-wrap justify-content-center">
   <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
   <image src="/img/what2packBackInv.png" style="width: 3rem;transform: rotate(-35deg)" class="me-4">
   <span class="fs-2 title">Units 13 Cookbook</span>
   </a>
 </div>
 </header>
<div class="container mb-3">
        <!-- Category Area -->
        <section id="food">
        <div class="card card-food-list m-1 border-0">
                    <div class="row gx-2">
                        <div class="col-md-2 mb-1">
                            <div class="card" data-bs-toggle="modal" data-bs-target="#breakfastModal">
                                <img src="image/breakfast.jpg" class="card-img-top" alt="..." style="width:100%">
                                <div class="card-body">
                                    <h6 class="card-title text-center"><strong>Breakfast</strong></h6>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-md-2 mb-1">
                            <div class="card" data-bs-toggle="modal" data-bs-target="#lunchModal">
                                <img src="image/lunch.jpg" class="card-img-top" alt="..." style="width:100%">
                                <div class="card-body">
                                    <h6 class="card-title text-center"><strong>Lunch</strong></h6>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-md-2 mb-1">
                            <div class="card"  data-bs-toggle="modal" data-bs-target="#dinnerModal">
                                <img src="image/dinner.jpg" class="card-img-top" alt="..." style="width:100%">
                                <div class="card-body">
                                    <h6 class="card-title text-center"><strong>Dinner</strong></h6>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-md-2 mb-1">
                            <div class="card" data-bs-toggle="modal" data-bs-target="#appetizerModal">
                                <img src="image/appetizer.jpg" class="card-img-top" alt="..." sstyle="width:100%">
                                <div class="card-body">
                                    <h6 class="card-title text-center"><strong>Snacks</strong></h6>
                                </div>
                            </div>
                        </div>
                
                        <div class="col-md-2 mb-1">
                            <div class="card" data-bs-toggle="modal" data-bs-target="#dessertModal">
                                <img src="image/dessert.jpg" class="card-img-top" alt="..." style="width:100%">
                                <div class="card-body">
                                    <h6 class="card-title text-center"><strong>Dessert</strong></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-1 ">
                            <div class="card border-0" data-bs-toggle="modal" data-bs-target="#dessertModal">
                                <div class="card-body">
                                    <button type="button" class="btn btn-add-food btn-secondary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#addRecipeModal"><i class="fa-solid fa-file-circle-plus"></i> Add Recipe</button><br><br>
                                         <a href="allRecipies.php" target="_blank" class="btn btn-add-food btn-secondary btn-sm w-100"><i class="fa-solid fa-book"></i> Cookbook</a>              
                                </div>
                            </div>
                        </div>
                        
                    </div>   
            <div class="card mt-1 p-2">
            <table id="foodListTable" class="table table-responsive mt-3 w-100" style="text-align:center;">
                <thead>
                    <tr>
                    <th scope="col" style="width: 30%;">Recipe Name</th>
                    <th scope="col" style="width: 10%;">Category</th>
                    <th scope="col" style="width: 20%;">Image</th>
                    <th scope="col" style="width: 20%;">Dietary</th>
                    <th scope="col" style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    
                    $stmt = $conn->prepare("
                        SELECT * 
                        FROM 
                            `tbl_recipe`
                        LEFT JOIN
                            `tbl_category` ON
                            `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` 
                        ");
                    $stmt->execute();

                    $result = $stmt->fetchAll();

                    foreach ($result as $row) {
                        $recipeID = $row['tbl_recipe_id'];
                        $categoryID = $row['tbl_category_id'];
                        $authorName = $row['recipe_author'];
                        $categoryName = $row['category_name'];
                        if($row['recipe_image'] != ''){
                        $recipeImage = $row['recipe_image'];} else {
                          $recipeImage = 'what2packPlateInv.png';
                        }
                        $recipeName = $row['recipe_name'];
                        $recipeIngredients = $row['recipe_ingredients'];
                        $recipeProcedure = $row['recipe_procedure'];
                        $IsGF= $row['is_gf'];
                        $IsVeg= $row['is_veg'];
                        $IsHalalkosher= $row['is_halalkosher'];
                        $HasTreenuts= $row['has_treenuts'];
                        $HasLactose= $row['has_lactose'];
                        $HasEggs= $row['has_eggs'];
                        ?>

                        <tr>
                            <td id="recipeName-<?= $recipeID ?>"><?php echo $recipeName ?></td>
                            <td id="categoryName-<?= $recipeID ?>"><?php echo $categoryName ?></td>
                            <td id="recipeImage-<?= $recipeID ?>"><img src="https://what2pack.org/cookbook/uploads/<?php echo $recipeImage ?>" style="width:100px;"/></td>
                            <td id="categoryDiet-<?= $recipeID ?>">
                           <?php if($IsGF == 'yes'){ ?>
                              <span style="display:block"><b id="IsGF-<?= $recipeID ?>" style="color:lightgreen">Gluten Free</b> </span>
                           <?php } ?>
                           <?php if($IsVeg == 'yes'){ ?>
                              <span style="display:block"><b id="IsVeg-<?= $recipeID ?>" style="color:lightgreen">Vegetarian</b> </span>
                           <?php } ?>
                           <?php if($IsHalalkosher == 'yes'){ ?>
                              <span style="display:block"><b id="IsHalalKosher-<?= $recipeID ?>" style="color:lightgreen">Halal/Kosher</b> </span>
                           <?php } ?>
                           <?php if($HasTreenuts == 'yes'){ ?>
                              <span style="display:block"> <i class="fa-solid fa-triangle-exclamation" style="color:orangered"></i> <b id="HasTreenuts-<?= $recipeID ?>" style="color:orangered">Tree Nuts</b></span>
                           <?php } ?>
                          <?php if($HasLactose == 'yes'){ ?>
                             <span style="display:block"> <i class="fa-solid fa-triangle-exclamation" style="color:orangered"></i> <b id="HasLactose-<?= $recipeID ?>" style="color:orangered">Lactose</b></span>
                          <?php } ?>
                          <?php if($HasEggs == 'yes'){ ?>
                             <span style="display:block"> <i class="fa-solid fa-triangle-exclamation" style="color:orangered"></i> <b id="HasEggs-<?= $recipeID ?>" style="color:orangered">Eggs</b></span>
                          <?php } ?>
                         
                           <span id="authorName-<?= $recipeID ?>" hidden><?php echo $authorName ?></span>
                            <span id="recipeIngredients-<?= $recipeID ?>" hidden><?php echo $recipeIngredients ?></span> 
                            <span id="recipeProcedure-<?= $recipeID ?>" hidden><?php echo $recipeProcedure ?></span>
                           <span id="recipeID-<?= $recipeID ?>" hidden><?php echo $recipeID ?></span>
                           </td>
                            <td>
                                <button type="button" onclick="view_recipe('<?php echo $recipeID ?>')" title="View"><i class="fa-solid fa-list p-1"></i></button>
                                <button type="button" onclick="update_recipe('<?php echo $recipeID ?>')" title="Edit"><i class="fa-solid fa-pencil p-1"></i></button>
                                <button type="button" onclick="delete_recipe('<?php echo $recipeID ?>')" title="Delete"><i class="fa-solid fa-trash p-1"></i></button>
                                <button type="button" onclick="window.open('allRecipies.php?recipe=<?php echo $recipeID ?>', '_blank')" title="Print"><i class="fa-solid fa-print p-1"></i></button>
                            </td>
                        </tr>

                        <?php
                    }
                    ?>
                    
                </tbody>
            </table>
            </div>
        </div>
        </section>
    <script src="assets/script.js"></script>

    <script>
      $( document ).ready(function() {
         $('#recipeProcedure').summernote();
         $('#recipeIngredients').summernote();
      });   
 
    </script>
</div>
</body>
</html>