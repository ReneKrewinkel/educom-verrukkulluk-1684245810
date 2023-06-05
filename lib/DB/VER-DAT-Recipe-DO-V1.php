<?php

class Recipe{
    private $connection; 

    private $dbManager;

    public function __construct($connection, $dbManager) {
        $this->connection = $connection;
        $this->dbManager = $dbManager;
    }

    public function createRecipe($author_id, $kitchen_id, $type_id, $date, $title, $people, $description,  $img){
        $sql = "INSERT INTO `recipes` (`authorID`, `kitchenID`, `typeID`, `creationDate`, `title`, `people`, `description`, `picFood`) VALUES ('$author_id', '$kitchen_id', '$type_id', '$date', '$title', '$people', '$description', '$img')";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function getRecipe($recipe_id){
        $sql = "select * from `recipes` where id = '$recipe_id';";
        
        $result = mysqli_query($this->connection, $sql);
        $recipe = mysqli_fetch_array($result, MYSQLI_ASSOC);

        //GET INGREDIENTS
        $ingredientIDs = $this->dbManager->recipeIngredient->getAllIngredients($recipe['id']);
        $ingredients = array();
        foreach($ingredientIDs as $ingredient_id){
            array_push($ingredients, $this->dbManager->ingredient->getIngredient($ingredient_id['ingredientID']));
        }

        //GET PRICE 
        $recipe['price'] = round($this->calcPrice($recipe['id']), 2); 

        //GET CALORIES
        $recipe['calories'] = round($this->calcCalories($recipe['id']), 0);

        //GET RATING
        $recipe['rating'] = round($this->getRating($recipe['id']), 1);

        //GET AUTHOR
        $recipe['author'] = $this->dbManager->user->getUser($recipe['authorID']);

        //GET STEPS
        $recipe['steps'] = $this->getSteps($recipe['id']);

        //GET KITCHEN 
        $recipe['kitchen'] = "hello";

        //GET TYPE
        $recipe['type'] = "world";

        //GET REVIEWS
        $recipe['reviews'] = $this->getReviews($recipe['id']);

        return($recipe);
    }

    public function getAllRecipe(){
       //GET ALL RECIPES
        $sql = "select * from `recipes`;";
        
        $result = mysqli_query($this->connection, $sql);
        for($i = 0; $allRecipes[$i] = mysqli_fetch_assoc($result); $i++);
        array_pop($allRecipes);

        for($i = 0; $i< count($allRecipes); $i++){

            //GET INGREDIENTS
            $ingredientIDs = $this->dbManager->recipeIngredient->getAllIngredients($allRecipes[$i]['id']);
            $ingredients = array();
            foreach($ingredientIDs as $ingredient_id){
                array_push($ingredients, $this->dbManager->ingredient->getIngredient($ingredient_id['ingredientID']));
            }
            $allRecipes[$i]['ingredients'] = $ingredients;

            //GET PRICE 
            $allRecipes[$i]['price'] = round($this->calcPrice($allRecipes[$i]['id']), 2); 

            //GET CALORIES
            $allRecipes[$i]['calories'] = round($this->calcCalories($allRecipes[$i]['id']), 0);

            //GET RATING
            $allRecipes[$i]['rating'] = round($this->getRating($allRecipes[$i]['id']), 1);
        }


        return($allRecipes);
    }

    public function updateRecipe($recipe_id, $author_id, $kitchen_id, $type_id, $date, $title, $people, $description, $img){
        $sql = "UPDATE `recipes` 
        SET `authorID` = '$author_id', `kitchenID` = '$kitchen_id', `typeID` = '$type_id', `creationDate` = '$date', `title` = '$title', `people` = '$people', `description` = '$description', `picFood` = '$img'
        WHERE `id` = '$recipe_id';";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function deleteRecipe($recipe_id){
        $sql = "DELETE FROM `recipes` WHERE `id` = '$recipe_id';";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function calcPrice($recipe_id){
        $price = 0;
    
        $ingredients = $this->dbManager->recipeIngredient->getAllIngredients($recipe_id);
        
        //LOOP THROUGH INGREDIENTS IN RECIPE
        foreach($ingredients as $ingredient){
            $stats = $this->dbManager->ingredient->getIngredient($ingredient['ingredientID']);
            
            //RATIO = QUANTITY OF USED INGRIDIENT / QUANTITY OF BASE INGREDIENT
            //PRICE += RATIO * BASE PRICE INGREDIENT
            $price += ($ingredient['quantity'] / $stats['quantity']) * $stats['price'];
        }

        return $price;
    }

    public function calcCalories($recipe_id){
        $calories = 0;
        
        $ingredients = $this->dbManager->recipeIngredient->getAllIngredients($recipe_id);
        
        //LOOP THROUGH INGREDIENTS IN RECIPE
        foreach($ingredients as $ingredient){
            $stats = $this->dbManager->ingredient->getIngredient($ingredient['ingredientID']);
            
            //RATIO = QUANTITY OF USED INGRIDIENT / QUANTITY OF BASE INGREDIENT
            //CALORIES += RATIO * BASE CALORIES INGREDIENT
            $calories += ($ingredient['quantity'] / $stats['quantity']) * $stats['calories'];
        }
        return $calories;
    }

    //REMINDER: BOTH RATING AND REVIEW
    public function getRating($recipe_id){
        $totalRating = 0; 
        $counter = 0; 

        $ratings = $this->dbManager->recipeInfo->getRatings($recipe_id);

        foreach($ratings as $rating){
            $totalRating += $rating['quantity'];
            $counter++;
        }

        if($counter > 0){
            return $totalRating / $counter;
        }

        return 0;
    }

    public function getAuthor($recipe_id){
        $recipe = $this->getRecipe($recipe_id);

        return $this->dbManager->user->getUser($recipe['authorID']);
    }

    public function getKitchen($recipe_id){
        $recipe = $this->getRecipe($recipe_id);
        return $this->dbManager->kitchenType->getKitchenType($recipe['kitchenID']);
    }

    public function getType($recipe_id){
        $recipe = $this->getRecipe($recipe_id);
        return $this->dbManager->kitchenType->getKitchenType($recipe['typeID']);
    }

    public function determineFavorite($recipe_id, $user_id){
        $favorites = $this->dbManager->recipeinfo->getFavorites($recipe_id);

        foreach($favorites as $favorite){
            if($favorite['userID'] == $user_id){
                return true;
            }
        }

        return false;
    }

    //MADE THE FUNCTIONS IN THERE CLASSES SINCE THEY ARE DOING QUERIES 
    public function getIngredients($recipe_id){
        return $this->dbManager->recipeIngredient->getAllIngredients($recipe_id);
    }

    public function getReviews($recipe_id){
        return $this->dbManager->recipeInfo->getReviews($recipe_id);
    }

    public function getSteps($recipe_id){
        return $this->dbManager->recipeInfo->getSteps($recipe_id);
    }
}

?>