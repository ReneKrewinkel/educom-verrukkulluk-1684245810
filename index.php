<?php

require_once("lib\DB\VER-DAT-DbManager-DO-V1.php");

require_once("lib\Logic\VER-LOG-ShopCart-DO-V1.php");

/// INIT
$dbManager = new dbManager();
$shopCart = new shopCart($dbManager);



$shopCart->addRecipe($dbManager->recipe->getRecipe(1));
$shopCart->addRecipe($dbManager->recipe->getRecipe(1));


//CALORIES
echo "The calories in the recipe is: "; 
echo $dbManager->recipe->calcCalories(1);

echo "<br>";
echo "The calories in the cart is: ";
$shopCart->calcTotalCalories();

echo "<br><br>";

//PRICE
echo "The price in the recipe is: "; 
echo $dbManager->recipe->calcPrice(1);

echo "<br>";
echo "The price in the cart is: "; 
$shopCart->calcTotalPrice();

echo "<br><br>";

//RATING
echo "The rating pf the recipe: "; 
echo $dbManager->recipe->getRating(1);
var_dump($dbManager->recipeInfo->getRatings(1));

echo "<br><br>";

//REVIEWS 
echo "The reviews of the recipe: "; 
var_dump($dbManager->recipe->getReviews(1));

echo "<br><br>";

//CUISINE
echo "The Cuisine of the recipe: "; 
var_dump($dbManager->recipe->getKitchen(1));

echo "<br><br>";

//TYPE
echo "The Type of the recipe: "; 
var_dump($dbManager->recipe->getType(1));

echo "<br><br>";

//AUHTOR
// echo "The author of the recipe: "; 
// var_dump($dbManager->recipe->getAuthor(1));

// echo "<br><br>";


//INICIALIZE VARIABLES FOR DATA CREATION
// $img = 'https://braisedanddeglazed.com/wp-content/uploads/2020/12/Bitterballen-Second-Edit-6.jpg';
// $imageData = addslashes(file_get_contents($img));
// $date = date('Y-m-d H:i:s');

//ADD DATA TO DB
// $ingredient->createIngredient("Lettace", $imageData, 10, 50, "The green stuff that comes with your burger", 100);
// $user->createUser("Pedro", "bye@demo.com", "test", $imageData);
// KITCHENTYPE: T-type, C-cuisine
// $kitchenType->createKitchenType("T", "Spicy");
// $recipe->createRecipe(1, 1, 6, $date, "bitterballen", $imageData, 4, "It is said to be so spicy that the only way you wont feel it is by jumping in a pool of milk");
// $recipeIngredient->createRecipeIngredient(2, 1, 6);
// RECIPEINFO: R-rating, W-written review, F-favorite, S-step
// $recipeInfo->createRecipeInfo("S", 1, 1, $date, 5, "Assemble the burger"); 

//READ DATA FROM DB
// $data = $ingredient->getIngredient(1);
// $data = $user->getUser(2);
// $data = $kitchenType->getKitchenType(4);
// $data = $recipe->getRecipe(3);
// $data = $recipeIngredient->getRecipeIngredient(2);
// $data = $recipeInfo->getRecipeInfo(1);
// var_dump($data);

//UPDATE DATA FROM DB
// $ingredient->updateIngredient(1, "Tomato", 23.45, 400, 4, "Really red and nice", addslashes($ingredient->getIngredient(1)['picIngredient']));
// $user->updateUser(2, "Pedro", "bye@demo.com", "test", addslashes($user->getUser(2)['picProfile']) );
// $kitchenType->updateKitchenType(2, "C", "American");
// $recipe->updateRecipe(3, 1, 1, 6, $data['creationDate'], "bitterballen", addslashes($data['picFood']), 4, $data['description']);
// $recipeIngredient->updateRecipeIngredient(1, 1, 1, 2);
// $recipeInfo->updateRecipeInfo(1, "R", 1, $data['userID'], $data['creationDate'], 4, "");

//DELETE DATA FROM DB
// $ingredient->deleteIngredient(6);
// $user->deleteUser(4);
// $kitchenType->deleteKitchenType(7);
// $recipe->deleteRecipe(4);
// $recipeIngredient->deleteRecipeIngredient(5);
// $recipeInfo->deleteRecipeInfo(8);
?>