<?php 

require_once("VER-DAT-Database-DO-V1.php");
require_once("VER-DAT-Ingredient-DO-V1.php");
require_once("VER-DAT-User-DO-V1.php");
require_once("VER-DAT-Recipe-DO-V1.php");
require_once("VER-DAT-KitchenType-DO-V1.php");
require_once("VER-DAT-RecipeInfo-DO-V1.php");
require_once("VER-DAT-RecipeIngredient-DO-V1.php");


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
        $this->recipe = new recipe($this->db->getConnection(), $this);
        $this->kitchenType = new kitchenType($this->db->getConnection());
        $this->recipeInfo = new recipeInfo($this->db->getConnection());
        $this->recipeIngredient = new recipeIngredient($this->db->getConnection());
    }
}