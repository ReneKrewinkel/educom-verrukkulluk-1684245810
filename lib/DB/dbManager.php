<?php 

require_once("database.php");
require_once("ingredient.php");
require_once("user.php");
require_once("recipe.php");
require_once("kitchenType.php");
require_once("recipeInfo.php");
require_once("recipeIngredient.php");


class dbManager{
    private $db; 

    public $ingredient;
    public $user;
    public $recipe;
    public $kitchenType;
    public $recipeInfo;
    public $recipeIngredient;

    public function __construct() {
        $this->db = new database();

        $this->ingredient = new ingredient($this->db->getConnection());
        $this->user = new user($this->db->getConnection());
        $this->recipe = new recipe($this->db->getConnection());
        $this->kitchenType = new kitchenType($this->db->getConnection());
        $this->recipeInfo = new recipeInfo($this->db->getConnection());
        $this->recipeIngredient = new recipeIngredient($this->db->getConnection());
    }
}