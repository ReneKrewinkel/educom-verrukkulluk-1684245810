<?php

class user{
    private $connection; 

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function createUser($username, $email, $password, $img){
        $sql = "INSERT INTO `users` (`username`, `email`, `password`, `picProfile`) VALUES ('$username', '$email', '$password', '$img')";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function getUser($user_id){
        $sql = "select * from `users` where `id` = '$user_id';";
        
        $result = mysqli_query($this->connection, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return($user);
    }

    public function updateUser($user_id, $username, $email, $password, $img){
        $sql = "UPDATE `users` 
        SET `username` = '$username', `email` = '$email', `password` = '$password', `picProfile` = '$img'
        WHERE `id` = '$user_id';";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }

    public function deleteUser($user_id){
        $sql = "DELETE FROM `users` WHERE `id` = '$user_id';";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }
}

?>