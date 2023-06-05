<?php

class recipeIngredient{
    private $connection; 

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createRecipeIngredient($recipe_id, $ingredient_id, $quantity){
        $sql = "INSERT INTO `recipeIngredient` (`recipeID`, `ingredientID`, `quantity`) VALUES ('$recipe_id', '$ingredient_id', '$quantity')";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function getRecipeIngredient($recipeIngredient_id){
        $sql = "select * from `recipeIngredient` where id = $recipeIngredient_id;";
        
        $result = mysqli_query($this->connection, $sql);
        $recipeIngredient = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return($recipeIngredient);
    }

    public function getAllIngredients($recipe_id){
        $sql = "select * from `recipeIngredient` where `recipeID` = '$recipe_id';";
        
        $result = mysqli_query($this->connection, $sql);
        for($i = 0; $allIngredients[$i] = mysqli_fetch_assoc($result); $i++) ;
        array_pop($allIngredients);
        
        return($allIngredients);
    }

    public function updateRecipeIngredient($recipeIngredient_id, $recipe_id, $ingredient_id, $quantity){
        $sql = "UPDATE `recipeIngredient` 
        SET `recipeID` = '$recipe_id', `ingredientID` = '$ingredient_id', `quantity` = '$quantity'
        WHERE `id` = '$recipeIngredient_id';";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function deleteRecipeIngredient($recipeIngredient_id){
        $sql = "DELETE FROM `recipeIngredient` WHERE `id` = '$recipeIngredient_id';";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }
}

?>