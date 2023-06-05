<?php

require_once("lib\DB\VER-DAT-DbManager-DO-V1.php");

require_once("lib\Logic\VER-LOG-ShopCart-DO-V1.php");

/// INIT
$dbManager = new dbManager();
$shopCart = new shopCart($dbManager);

$data = $dbManager->recipe->getAllRecipe();

//INICIALIZE VARIABLES FOR DATA CREATION
// $img = 'https://lettuceinfo.org/wp-content/uploads/2020/09/Butter-Leaf-Lettuce.jpg';
// $date = date('Y-m-d H:i:s');

//ADD DATA TO DB
// $dbManager->ingredient->createIngredient("Lettace", $imageData, 10, 50, "The green stuff that comes with your burger", 100);
//$dbManager->user->createUser("Pedro", "bye@demo.com", "test", $imageData);
// KITCHENTYPE: T-type, C-cuisine
// $dbManager->kitchenType->createKitchenType("T", "Spicy");
// $dbManager->recipe->createRecipe(1, 1, 6, $date, "bitterballen", $imageData, 4, "It is said to be so spicy that the only way you wont feel it is by jumping in a pool of milk");
// $dbManager->recipeIngredient->createRecipeIngredient(2, 1, 6);
// RECIPEINFO: R-rating, W-written review, F-favorite, S-step
// $dbManager->recipeInfo->createRecipeInfo("S", 1, 1, $date, 5, "Assemble the burger"); 

//READ DATA FROM DB
// $data = $dbManager->ingredient->getIngredient(3);
// $data = $dbManager->user->getUser(2);
// $data = $dbManager->kitchenType->getKitchenType(4);
// $data = $dbManager->recipe->getRecipe(3);
// $data = $dbManager->recipeIngredient->getRecipeIngredient(2);
// $data = $dbManager->recipeInfo->getRecipeInfo(1);
// var_dump($data);

//UPDATE DATA FROM DB
// $dbManager->ingredient->updateIngredient($data['id'], $data['title'], $data['price'], $data['calories'], $data['quantity'], $data['description'], $img);
// $dbManager->user->updateUser($data['id'], $data['username'], $data['email'], $data['password'], $img );
// $dbManager->kitchenType->updateKitchenType(2, "C", "American");
// $dbManager->recipe->updateRecipe($data['id'], $data['authorID'], $data['kitchenID'], $data['typeID'], $data['creationDate'], $data['title'], $data['people'], $data['description'], $img);
// $dbManager->recipeIngredient->updateRecipeIngredient(1, 1, 1, 2);
// $dbManager->recipeInfo->updateRecipeInfo(1, "R", 1, $data['userID'], $data['creationDate'], 4, "");

//DELETE DATA FROM DB
// $ingredient->deleteIngredient(6);
// $user->deleteUser(4);
// $kitchenType->deleteKitchenType(7);
// $recipe->deleteRecipe(4);
// $recipeIngredient->deleteRecipeIngredient(5);
// $recipeInfo->deleteRecipeInfo(8);
?>