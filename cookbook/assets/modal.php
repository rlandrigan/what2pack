<!-- CATEGORY MODALS -->

<!-- Breakfast Modal -->          
<div class="modal fade mt-5" id="breakfastModal" tabindex="-1" aria-labelledby="breakfast" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="breakfast"><strong>Breakfast Recipes</strong></h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row modal-body">
            
            <?php 
            
                $stmt = $conn->prepare("SELECT * FROM `tbl_recipe` LEFT JOIN `tbl_category` ON `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` WHERE `category_name` = 'Breakfast' ");
                $stmt->execute();
                
                $result = $stmt->fetchAll();

                foreach ($result as $row) {
                    $recipeID = $row['tbl_recipe_id'];
                    $categoryName = $row['category_name'];
                    $recipeImage = $row['recipe_image'];
                    $recipeName = $row['recipe_name'];
                    ?>
                    <div class="card" style="width:185px; height:200px; margin: 20px">
                        <?php if($recipeImage > 0){ ?>
                        <div class="d-flex justify-content-center align-items-center" style="max-height: 120px;">
                            <img  src="https://qbranch.scouts13.org/cookbook/uploads/<?php echo $recipeImage ?>" class="card-img-top mt-1" alt="Recipe" style="max-width: 120px; max-height: 180px;">
                        </div>
                        <?php } ?>
                        <div class="card-body" onclick="view_recipe('<?php echo $recipeID ?>')" >
                            <h6 class="card-title text-center"><strong><?php echo $recipeName ?></strong></h6>
                        </div>
                    </div>

                    <?php
                }
            ?>

        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Lunch Modal -->
<div class="modal fade mt-5" id="lunchModal" tabindex="-1" aria-labelledby="lunch" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="lunch"><strong>Lunch Recipes</strong></h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row modal-body">
            
            <?php 
            
                $stmt = $conn->prepare("SELECT * FROM `tbl_recipe` LEFT JOIN `tbl_category` ON `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` WHERE `category_name` = 'Lunch' ");
                $stmt->execute();
                
                $result = $stmt->fetchAll();

                foreach ($result as $row) {
                    $recipeID = $row['tbl_recipe_id'];
                    $categoryName = $row['category_name'];
                    $recipeImage = $row['recipe_image'];
                    $recipeName = $row['recipe_name'];
                    ?>

                    <div class="card" style="width:185px; height:200px; margin: 20px">
                        <?php if($recipeImage > 0){ ?>
                        <div class="d-flex justify-content-center align-items-center" style="height: 120px;">
                            <img  src="https://qbranch.scouts13.org/cookbook/uploads/<?php echo $recipeImage ?>" class="card-img-top mt-1" alt="Recipe" style="max-width: 120px; max-height: 180px;">
                        </div>
                        <?php } ?>
                        <div class="card-body" onclick="view_recipe('<?php echo $recipeID ?>')" >
                            <h6 class="card-title text-center"><strong><?php echo $recipeName ?></strong></h6>
                        </div>
                    </div>

                    <?php
                }
            ?>

        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- Dinner Modal -->
    <div class="modal fade mt-5" id="dinnerModal" tabindex="-1" aria-labelledby="dinner" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="dinner"><strong>Dinner Recipes</strong></h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row modal-body">
            
            <?php 
            
                $stmt = $conn->prepare("SELECT * FROM `tbl_recipe` LEFT JOIN `tbl_category` ON `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` WHERE `category_name` = 'Dinner' ");
                $stmt->execute();
                
                $result = $stmt->fetchAll();

                foreach ($result as $row) {
                    $recipeID = $row['tbl_recipe_id'];
                    $categoryName = $row['category_name'];
                    $recipeImage = $row['recipe_image'];
                    $recipeName = $row['recipe_name'];
                    ?>

                    <div class="card" style="width: 185px;; height:200px; margin: 20px">
                        <?php if($recipeImage > 0){ ?>
                        <div class="d-flex justify-content-center align-items-center" style="height: 120px;">
                            <img  src="https://qbranch.scouts13.org/cookbook/uploads/<?php echo $recipeImage ?>" class="card-img-top mt-1" alt="Recipe" style="max-width: 120px; max-height: 180px;">
                        </div>
                        <?php } ?>
                        <div class="card-body" onclick="view_recipe('<?php echo $recipeID ?>')" >
                            <h6 class="card-title text-center"><strong><?php echo $recipeName ?></strong></h6>
                        </div>
                    </div>

                    <?php
                }
            ?>

        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Appetizer Modal -->
<div class="modal fade mt-5" id="appetizerModal" tabindex="-1" aria-labelledby="appetizer" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="appetizer"><strong>Snack Recipes</strong></h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row modal-body">
            
            <?php 
            
                $stmt = $conn->prepare("SELECT * FROM `tbl_recipe` LEFT JOIN `tbl_category` ON `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` WHERE `category_name` = 'Appetizer' ");
                $stmt->execute();
                
                $result = $stmt->fetchAll();

                foreach ($result as $row) {
                    $recipeID = $row['tbl_recipe_id'];
                    $categoryName = $row['category_name'];
                    $recipeImage = $row['recipe_image'];
                    $recipeName = $row['recipe_name'];
                    ?>

                    <div class="card" style="width:200px; height: 185px; margin: 20px">
                       <?php if($recipeImage > 0){ ?>
                        <div class="d-flex justify-content-center align-items-center" style="height: 120px;">
                            <img  src="https://qbranch.scouts13.org/cookbook/uploads/<?php echo $recipeImage ?>" class="card-img-top mt-1" alt="Recipe" style="max-width: 120px; max-height: 180px;">
                        </div>
                        <?php } ?>
                        <div class="card-body" onclick="view_recipe('<?php echo $recipeID ?>')" >
                            <h6 class="card-title text-center"><strong><?php echo $recipeName ?></strong></h6>
                        </div>
                    </div>

                    <?php
                }
            ?>

        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Dessert Modal -->
<div class="modal fade mt-5" id="dessertModal" tabindex="-1" aria-labelledby="dessert" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="dessert"><strong>Dessert Recipes</strong></h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row modal-body">
            
            <?php 
            
                $stmt = $conn->prepare("SELECT * FROM `tbl_recipe` LEFT JOIN `tbl_category` ON `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` WHERE `category_name` = 'Dessert' ");
                $stmt->execute();
                
                $result = $stmt->fetchAll();

                foreach ($result as $row) {
                    $recipeID = $row['tbl_recipe_id'];
                    $categoryName = $row['category_name'];
                    $recipeImage = $row['recipe_image'];
                    $recipeName = $row['recipe_name'];
                    ?>

                    <div class="card" style="width: 185px; height:200px; margin: 20px">
                        <?php if($recipeImage > 0){ ?><div class="d-flex justify-content-center align-items-center" style="height: 120px;">
                            <img  src="https://qbranch.scouts13.org/cookbook/uploads/<?php echo $recipeImage ?>" class="card-img-top mt-1" alt="Recipe" style="max-width: 120px; max-height: 180px;">
                        </div>
                        <?php } ?>
                        <div class="card-body" onclick="view_recipe('<?php echo $recipeID ?>')" >
                            <h6 class="card-title text-center"><strong><?php echo $recipeName ?></strong></h6>
                        </div>
                    </div>

                    <?php
                }
            ?>

        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Fast Food Modal -->
<div class="modal fade mt-5" id="fastFoodModal" tabindex="-1" aria-labelledby="fastFood" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="fastFood"><strong>Fast Food Recipes</strong></h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="row modal-body">
            
            <?php 
            
                $stmt = $conn->prepare("SELECT * FROM `tbl_recipe` LEFT JOIN `tbl_category` ON `tbl_recipe`.`tbl_category_id` = `tbl_category`.`tbl_category_id` WHERE `category_name` = 'Fast Food' ");
                $stmt->execute();
                
                $result = $stmt->fetchAll();

                foreach ($result as $row) {
                    $recipeID = $row['tbl_recipe_id'];
                    $categoryName = $row['category_name'];
                    $recipeImage = $row['recipe_image'];
                    $recipeName = $row['recipe_name'];
                    ?>

                    <div class="card" style="width:185px; height:200px; margin: 20px">
                        <?php if($recipeImage > 0){ ?><div class="d-flex justify-content-center align-items-center" style="height: 120px;">
                            <img  src="https://qbranch.scouts13.org/cookbook/uploads/<?php echo $recipeImage ?>" class="card-img-top mt-1" alt="Recipe" style="max-width: 120px; max-height: 180px;">
                        </div>
                    <?php }?>
                        <div class="card-body" onclick="view_recipe('<?php echo $recipeID ?>')" >
                            <h6 class="card-title text-center"><strong><?php echo $recipeName ?></strong></h6>
                        </div>
                    </div>

                    <?php
                }
            ?>

        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- FOOD LISTS MODALS -->

 <!-- Add Recipe Modal -->
<div class="modal fade mt-5" id="addRecipeModal" tabindex="-1" aria-labelledby="addRecipe" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecipe"><strong>Add Recipe</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="recipeID" action="endpoint/add-recipe.php" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="table" name="table" value="tbl_recipe" hidden>
                    <div class="mb-3" hidden>
                        <label for="recipeID" class="form-label">Recipe ID</label>
                        <input type="text" class="form-control" id="recipeID" name="tbl_recipe_id">
                    </div>
                    <div class="mb-3">
                        <label for="recipeImage" class="form-label">Recipe Image</label>
                        <input type="file" class="form-control" id="recipeImage" name="recipe_image" style="border:none;">
                    </div>
                    <div class="mb-3">
                        <label for="recipeName" class="form-label">Recipe Name</label>
                        <input type="text" class="form-control" id="recipeName" name="recipe_name">
                    </div>
                    <div class="mb-3">
                        <label for="recipeCategory" class="form-label">Category</label>

                        <?php 
                        
                            $stmt = $conn->prepare("SELECT * FROM `tbl_category`");
                            $stmt->execute();

                            $recipe_category = $stmt->fetchAll();

                        ?>

                        <select class="form-control" name="tbl_category_id" id="recipeCategory">

                            <option value="">- select -</option>
                            
                            <?php foreach ($recipe_category as $category) {
                                ?>
                                
                                <option value="<?php echo $category['tbl_category_id']; ?>"><?php echo $category['category_name'] ?></option>
                                
                                <?php    
                            }?>

                        </select>

                    </div>
                    <div>
                        <label for="recipeIngredients" class="form-label">Ingredients</label>
                        <textarea class="form-control" name="recipe_ingredients" id="recipeIngredients" rows="5"></textarea>
                    </div>
                    <div>
                        <label for="recipeProcedure" class="form-label">Procedure</label>
                        <textarea class="form-control" name="recipe_procedure" id="recipeProcedure" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Recipe Modal -->
<div class="modal fade mt-5" id="viewRecipeModal" tabindex="-1" aria-labelledby="viewRecipe" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="viewRecipe"><strong>My Recipe</strong></h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <div class="card">
           
            <div class="row mb-5 p-3 ">
                <div class="col-md-6 text-center">
                    <img src="" id="viewRecipeImage" class="mt-2" alt="Recipe" style="max-height:300px;max-width:90%">
                    <h2 class="card-title text-center"><strong id="viewRecipeName"></strong></h2>
                        <p class="text-muted text-center">Category: <span class="card-subtitle text-muted" id="viewCategoryName"></span><br>
                    Author: <span class="card-subtitle text-muted" id="viewAuthorName"></span></p>
                   
                          <span style="display:block" id="IsGF"><b  style="color:lightgreen">Gluten Free</b> </span>
                       <span style="display:block" id="IsVeg"><b  style="color:lightgreen">Vegetarian</b> </span>
                       <span style="display:block" id="IsHalalKosher"><b  style="color:lightgreen">Halal/Kosher</b> </span>
                       <span style="display:block" id="HasTreenuts"> <i class="fa-solid fa-triangle-exclamation" style="color:orangered"></i> <b  style="color:orangered">Tree Nuts</b></span>
                        <span style="display:block" id="HasLactose"> <i class="fa-solid fa-triangle-exclamation" style="color:orangered"></i> <b  style="color:orangered">Lactose</b></span>
                      <span style="display:block" id="HasEggs" > <i class="fa-solid fa-triangle-exclamation" style="color:orangered"></i> <b style="color:orangered">Eggs</b></span>
                     
                </div>
                <div class="col-md-6">
                    <h5><strong>Ingredients:</strong></h5>
                    <p id="viewRecipeIngredients"></p>
                    <h5><strong>Procedure:</strong></h5>
                    <p id="viewRecipeProcedure"></p>
                </div>
            </div>
        </div>

        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Recipe Modal -->
<div class="modal fade mt-5" id="updateRecipeModal" tabindex="-1" aria-labelledby="updateRecipe" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateRecipe"><strong>Update Recipe</strong></h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="recipeID" action="endpoint/update-recipe.php" method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="updateTable" name="table" value="tbl_recipe" hidden>
                   
                       
                        <input type="hidden" class="form-control" id="updateRecipeID" name="tbl_recipe_id">
                    
                    <div class="mb-3">
                        <label for="updateRecipeImage" class="form-label">Recipe Image</label>
                        <input type="file" class="form-control" id="updateRecipeImage" name="recipe_image" style="border:none;">
                    </div>
                    <div class="mb-3">
                        <label for="updateRecipeName" class="form-label">Recipe Name</label>
                        <input type="text" class="form-control" id="updateRecipeName" name="recipe_name">
                    </div>
                    <div class="mb-3">
                        <label for="updateRecipeAuthor" class="form-label">Recipe Author</label>
                        <input type="text" class="form-control" id="updateRecipeAuthor" name="recipe_author">
                    </div>
                    <div class="mb-3">
                        <label for="updateRecipeCategory" class="form-label">Category</label>

                        <?php 
                        
                            $stmt = $conn->prepare("SELECT * FROM `tbl_category`");
                            $stmt->execute();

                            $recipe_category = $stmt->fetchAll();

                        ?>

                        <select class="form-control" name="tbl_category_id" id="updateRecipeCategory">

                            <option value="">- select -</option>
                            
                            <?php foreach ($recipe_category as $category) {
                                ?>
                                
                                <option value="<?php echo $category['tbl_category_id']; ?>"><?php echo $category['category_name'] ?></option>
                                
                                <?php    
                            }?>

                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="updateRecipeIngredients" class="form-label">Ingredients</label>
                        <textarea  name="recipe_ingredients" id="updateRecipeIngredients" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="updateRecipeProcedure" class="form-label">Procedure</label>
                        <textarea  name="recipe_procedure" id="updateRecipeProcedure" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                         <input type="checkbox" class="form-check-input" name="is_gf" id="udpateGluten" value="yes">
                         <label class="form-check-label" for="udpateGluten">Is Gluten Free?</label>
                    </div>
                    <div class="mb-3">
                         <input type="checkbox" class="form-check-input" name="is_veg" id="udpateVeg" value="yes">
                         <label class="form-check-label" for="udpateVeg">Is Vegetarian?</label>
                    </div>
                    <div class="mb-3">
                         <input type="checkbox" class="form-check-input" name="is_halalkosher" id="udpateKosher" value="yes">
                         <label class="form-check-label" for="udpateKosher">Is Halal/Kosher?</label>
                    </div>
                    <div class="mb-3">
                         <input type="checkbox" class="form-check-input" name="has_treenuts" id="udpateNuts" value="yes">
                         <label class="form-check-label" for="udpateNuts">Has Tree Nuts?</label>
                    </div>
                    <div class="mb-3">
                         <input type="checkbox" class="form-check-input" name="has_lactose" id="udpateDairy" value="yes">
                         <label class="form-check-label" for="udpateDairy">Has Dairy?</label>
                    </div>
                    <div class="mb-3">
                         <input type="checkbox" class="form-check-input" name="has_eggs" id="udpateEggs" value="yes">
                         <label class="form-check-label" for="udpateEggs">Has Eggs?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

