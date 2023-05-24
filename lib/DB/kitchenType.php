<?php

class kitchenType{
    private $connection; 

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createKitchenType($optionType, $description){
        $sql = "INSERT INTO `kitchenType` (`optionType`, `description`) VALUES ('$optionType', '$description')";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function getKitchenType($kitchenType_id){
        $sql = "select * from `kitchenType` where id = $kitchenType_id;";
        
        $result = mysqli_query($this->connection, $sql);
        $kitchenType = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return($kitchenType);
    }

    public function updateKitchenType($kitchenType_id, $optionType, $description){
        $sql = "UPDATE `kitchenType` 
        SET `optionType` = '$optionType', `description` = '$description'
        WHERE `id` = '$kitchenType_id';";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function deleteKitchenType($kitchenType_id){
        $sql = "DELETE FROM `kitchenType` WHERE `id` = '$kitchenType_id';";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }
}

?>