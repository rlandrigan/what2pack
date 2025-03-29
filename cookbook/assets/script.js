// switching section
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// view recipe
function view_recipe(id) {
    $("#viewRecipeModal").modal("show");
   $("#IsGF").hide();
    $("#IsVeg").hide();
    $("#IsHalalKosher").hide();
    $("#HasTreenuts").hide();
    $("#HasLactose").hide();
    $("#HasEggs").hide();

  
    load_rating_data(id);
    
    function load_rating_data(recipe){
    let url_full = 'recipe.php?recipe='+recipe;
      $.ajax({
      url:url_full,
      method:"POST",
      data:{action:'load_data'},
      dataType:"JSON",
      success:function(data)
      {
     // Update the modal content with the fetched data
     $("#viewRecipe").text(data.recipe_data[0].recipe_name);
     $("#viewRecipeName").text(data.recipe_data[0].recipe_name);
     $("#viewAuthorName").text(data.recipe_data[0].recipe_author);
     $("#viewCategoryName").text(data.recipe_data[0].category_name);
     if(data.recipe_data[0].recipe_image == '') {  $("#viewRecipeImage").attr('src', 'uploads/what2packPlateInv.png');} else {
     $("#viewRecipeImage").attr('src', 'uploads/'+data.recipe_data[0].recipe_image);}
     $("#viewRecipeIngredients").html(data.recipe_data[0].recipe_ingredients);
     $("#viewRecipeProcedure").html(data.recipe_data[0].recipe_procedure);
     if(data.recipe_data[0].is_gf!= '') { $("#IsGF").show();}
     if(data.recipe_data[0].is_veg != '') { $("#IsVeg").show();}
     if(data.recipe_data[0].is_halalkosher != '') { $("#IsHalalKosher").show();}
     if(data.recipe_data[0].has_treenuts != '') { $("#HasTreenuts").show();}
     if(data.recipe_data[0].has_lactose != '') { $("#HasLactose").show();}
     if(data.recipe_data[0].has_eggs != '') { $("#HasEggs").show();}
      
     
      }});
    }
 
}

// updating recipe 
function update_recipe(id) {
    $("#udpateGluten").prop( "checked", false );
   $("#udpateVeg").prop( "checked", false );
   $("#udpateKosher").prop( "checked", false );
   $("#udpateNuts").prop( "checked", false );
   $("#udpateDairy").prop( "checked", false );
   $("#udpateEggs").prop( "checked", false );
    $("#updateRecipeModal").modal("show");
$('#updateRecipeIngredients').summernote('reset');
 $('#updateRecipeProcedure').summernote('reset');

    let updateRecipeID = $("#recipeID-" + id).text();
    let updateCategoryName = $("#categoryName-" + id).text();
    let updateRecipeImage = $("#recipeImage-" + id).find('img').attr('src');
    let updateRecipeName = $("#recipeName-" + id).text();
    let updateRecipeIngredients = $("#recipeIngredients-" + id).html();
    let updateRecipeProcedure = $("#recipeProcedure-" + id).html();
    let updateRecipeAuthor = $("#recipeAuthor-" + id).text();
  let IsGF = $("#IsGF-" + id).text();
  let IsVeg = $("#IsVeg-" + id).text();
  let IsHalalKosher = $("#IsHalalKosher-" + id).text();
  let HasTreenuts = $("#HasTreenuts-" + id).text();
  let HasLactose = $("#HasLactose-" + id).text();
  let HasEggs = $("#HasEggs-" + id).text();

    $("#updateRecipeID").val(updateRecipeID);
    $("#updateRecipeCategory option").each(function() {
        let category = $(this).text();
        if (category === updateCategoryName) {
            $(this).prop("selected", true);
            return false;
        }
    });
    $("#updateRecipeName").val(updateRecipeName);
    $("#updateRecipeImage").html(updateRecipeImage);
    if(IsGF != '') { $("#udpateGluten").prop( "checked", true );}
    if(IsVeg != '') { $("#udpateVeg").prop( "checked", true );}
    if(IsHalalKosher != '') { $("#udpateKosher").prop( "checked", true );}
    if(HasTreenuts != '') { $("#udpateNuts").prop( "checked", true );}
    if(HasLactose != '') { $("#udpateDairy").prop( "checked", true );}
    if(HasEggs != '') { $("#udpateEggs").prop( "checked", true );}
    $('#updateRecipeProcedure').summernote({
          disableDragAndDrop: true
        });
     $('#updateRecipeProcedure').summernote('pasteHTML' , updateRecipeProcedure );

    $('#updateRecipeIngredients').summernote({
          disableDragAndDrop: true
        });
        $('#updateRecipeIngredients').summernote('pasteHTML', updateRecipeIngredients);
}

// delete recipe
function delete_recipe(id) {

    if (confirm("Do you confirm to delete this recipe?")) {
        window.location = "endpoint/delete-recipe.php?recipe=" + id
    }
}

// search
function performSearch() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.getElementById("foodListTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        var nameColumn = tr[i].getElementsByTagName("td")[1]; // Column for Recipe Name
        var categoryColumn = tr[i].getElementsByTagName("td")[2]; // Column for Category
        var dietaryColumn = tr[i].getElementsByTagName("td")[3]; // Column for Dietary

        if (nameColumn || categoryColumn) {
            var nameText = nameColumn.textContent || nameColumn.innerText;
            var categoryText = categoryColumn.textContent || categoryColumn.innerText;
            var dietaryText = dietaryColumn.textContent || dietaryColumn.innerText;

            if (nameText.toLowerCase().indexOf(filter) > -1 || categoryText.toLowerCase().indexOf(filter) > -1 || dietaryText.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// Attach an event listener to the search input field
document.getElementById("searchInput").addEventListener("keyup", performSearch);
