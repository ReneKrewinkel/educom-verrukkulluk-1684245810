<?php

class Recipe{
    private $connection; 

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createRecipe($author_id, $kitchen_id, $type_id, $date, $title, $img, $people, $description){
        $sql = "INSERT INTO `recipes` (`authorID`, `kitchenID`, `typeID`, `creationDate`, `title`, `picFood`, `people`, `description`) VALUES ('$author_id', '$kitchen_id', '$type_id', '$date', '$title', '$img', '$people', '$description')";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function getRecipe($recipe_id){
        $sql = "select * from `recipes` where id = $recipe_id;";
        
        $result = mysqli_query($this->connection, $sql);
        $recipe = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return($recipe);
    }

    public function updateRecipe($recipe_id, $author_id, $kitchen_id, $type_id, $date, $title, $img, $people, $description){
        $sql = "UPDATE `recipes` 
        SET `authorID` = '$author_id', `kitchenID` = '$kitchen_id', `typeID` = '$type_id', `creationDate` = '$date', `title` = '$title', `picFood` = '$img', `people` = '$people', `description` = '$description'
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
}

?>