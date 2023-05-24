<?php 

// Aanpassen naar je eigen omgeving
define("USER", "root");
define("PASSWORD", "raco1026");
define("DATABASE", "delivery");
define("HOST", "localhost");

class database {

    private $connection;

    

    public function __construct() {
       $this->connection = mysqli_connect(HOST,                                          
                                         USER, 
                                         PASSWORD,
                                         DATABASE );
    }

    public function getConnection() {
        return($this->connection);
    }

    public function createTables(){
        $sql = "
        DROP TABLE Users;
        DROP TABLE KitchenType;
        DROP TABLE Ingredients;
        DROP TABLE Recipes;
        DROP TABLE RecipeInfo;
        DROP TABLE RecipeIngredient;

        CREATE TABLE Users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL,
            password VARCHAR(50) NOT NULL,
            picProfile LONGBLOB
        );

        CREATE TABLE KitchenType(
            id INT AUTO_INCREMENT PRIMARY KEY,
            optionType VARCHAR(1) NOT NULL,
            description VARCHAR(100) NOT NULL
        );

        CREATE TABLE Ingredients(
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(50) NOT NULL,
            picIngredient LONGBLOB NOT NULL,
            price FLOAT(7,2) NOT NULL,
            calories INT NOT NULL,
            description VARCHAR(150) NOT NULL,
            quantity VARCHAR(50) NOT NULL
        );

        CREATE TABLE Recipes(
            id INT AUTO_INCREMENT PRIMARY KEY,
            authorID INT NOT NULL,
            kitchenID INT NOT NULL,
            typeID INT NOT NULL,
            creationDate DATE NOT NULL,
            title VARCHAR(50) NOT NULL,
            picFood LONGBLOB NOT NULL, 
            people INT NOT NULL,
            description VARCHAR(200) NOT NULL,
            FOREIGN KEY (authorID) REFERENCES Users(id),
            FOREIGN KEY (kitchenID) REFERENCES KitchenType(id),
            FOREIGN KEY (typeID) REFERENCES KitchenType(id)
        );

        CREATE TABLE RecipeInfo(
            id INT AUTO_INCREMENT PRIMARY KEY,
            optionType VARCHAR(1) NOT NULL,
            recipeID INT NOT NULL,
            userID INT,
            creationDate DATE, 
            quantity INT,
            description VARCHAR(150),
            FOREIGN KEY (recipeID) REFERENCES Recipes(id),
            FOREIGN KEY (userID) REFERENCES Users(id)
        );

        CREATE TABLE RecipeIngredient(
            id INT AUTO_INCREMENT PRIMARY KEY,
            recipeID INT NOT NULL,
            ingredientID INT NOT NULL,
            quantity VARCHAR(50),
            FOREIGN KEY (recipeID) REFERENCES Recipes(id),
            FOREIGN KEY (ingredientID) REFERENCES Ingredients(id)
        );
        ";

        $query = mysqli_query($this->connection, $sql);

        if($query){
            return true;
        }

        return false;
    }
}
?>