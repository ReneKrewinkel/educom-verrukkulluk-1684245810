<?php

class ingredient {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createIngredient($title, $img, $price, $calories, $description, $quantity){
        $sql = "INSERT INTO `ingredients` (`title`, `picIngredient`, `price`, `calories`, `description`, `quantity`) VALUES ('$title', '$img', '$price', '$calories', '$description', '$quantity')";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }
        
        return false;
    }
  
    public function getIngredient($ingredient_id) {

        $sql = "select * from `ingredients` where id = $ingredient_id;";
        
        $result = mysqli_query($this->connection, $sql);
        $ingredient = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return($ingredient);
    }

    public function updateIngredient($ingredient_id, $title, $price, $calories, $quantity, $description, $img){
        $sql = "UPDATE `ingredients` 
        SET `title` = '$title', `picIngredient` = '$img', `price` = '$price', `calories` = '$calories', `quantity` = '$quantity', `description` = '$description'
        WHERE `id` = '$ingredient_id';";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function deleteIngredient($ingredient_id){
        $sql = "DELETE FROM `ingredients` WHERE id= $ingredient_id";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }
}
?>