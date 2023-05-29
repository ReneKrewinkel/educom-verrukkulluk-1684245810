<?php

/*
RECIPEINFO TYPES:
(1) R - rating
(2) W - written review
(3) F - favorites
(4) S - steps
*/

class recipeInfo{
    private $connection; 

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createRecipeInfo($optionType, $recipe_id, $user_id, $date, $quantity,  $description){
        if($optionType == "R" || $optionType == "W" || $optionType == "F" || $optionType == "S"){
            $sql = "INSERT INTO `recipeInfo` (`optionType`, `recipeID`, `userID`, `creationDate`, `quantity`, `description`) VALUES ('$optionType', '$recipe_id', '$user_id', '$date', '$quantity', '$description')";
        }else{
            return false;
        }

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function getRecipeInfo($recipeInfo_id){
        $sql = "select * from `recipeInfo` where id = $recipeInfo_id;";
        
        $result = mysqli_query($this->connection, $sql);
        $recipeInfo = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return($recipeInfo);
    }

    public function updateRecipeInfo($recipeInfo_id, $optionType, $recipe_id, $user_id, $date, $quantity,  $description){
        if($optionType == "R"){
            $sql = "UPDATE `recipeInfo` 
        SET `optionType` = '$optionType', `recipeID` = '$recipe_id', `creationDate` = '$date', `quantity` = '$quantity'
        WHERE `id` = '$recipeInfo_id';";
        }else if($optionType == "W"){
            $sql = "UPDATE `recipeInfo` 
        SET `optionType` = '$optionType', `recipeID` = '$recipe_id', `userID` = '$user_id', `creationDate` = '$date', `quantity` = '$quantity', `description` = '$description'
        WHERE `id` = '$recipeInfo_id';";
        }else if($optionType == "F"){
            $sql = "UPDATE `recipeInfo` 
        SET `optionType` = '$optionType', `recipeID` = '$recipe_id', `userID` = '$user_id'
        WHERE `id` = '$recipeInfo_id';";
        }else if($optionType == "S"){
            $sql = "UPDATE `recipeInfo` 
        SET `optionType` = '$optionType', `recipeID` = '$recipe_id', `quantity` = '$quantity', `description` = '$description'
        WHERE `id` = '$recipeInfo_id';";
        }else{
            return false;
        }

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function deleteRecipeInfo($recipeInfo_id){
        $sql = "DELETE FROM `recipeInfo` WHERE `id` = '$recipeInfo_id';";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function getReviews($recipe_id){
        $sql = "select * from `recipeinfo` where `recipeID` = '$recipe_id' and `optionType` = 'W';"; 

        $result = mysqli_query($this->connection, $sql);
        for($i = 0; $allReviews[$i] = mysqli_fetch_assoc($result); $i++);
        array_pop($allReviews);
        
        return($allReviews);
    }

    public function getRatings($recipe_id){
        $sql = "select * from `recipeinfo` where `recipeID` = '$recipe_id' and (`optionType` = 'W' or `optionType` = 'R');"; 

        $result = mysqli_query($this->connection, $sql);
        for($i = 0; $allRatings[$i] = mysqli_fetch_assoc($result); $i++);
        array_pop($allRatings);
        
        return($allRatings);
    }

    public function getSteps($recipe_id){
        $sql = "select * from `recipeinfo` where `recipeID` = '$recipe_id' and `optionType` = 'S';"; 

        $result = mysqli_query($this->connection, $sql);
        for($i = 0; $allSteps[$i] = mysqli_fetch_assoc($result); $i++);
        array_pop($allSteps);
        
        return($allSteps);
    }

    public function getFavorites($recipe_id){
        $sql = "select * from `recipeinfo` where `recipeID` = '$recipe_id' and `optionType` = 'F';"; 

        $result = mysqli_query($this->connection, $sql);
        for($i = 0; $allSteps[$i] = mysqli_fetch_assoc($result); $i++);
        array_pop($allSteps);
        
        return($allSteps);
    }
}

?>