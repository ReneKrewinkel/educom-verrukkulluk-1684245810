<?php 

class shopCart{
    private $cart;
    private $totalPrice;
    private $totalCalories;

    private $dbManager;

    public function __construct($dbManager) {
        $this->cart = array();
        $this->totalPrice = 0;
        $this->totalCalories = 0;
        $this->dbManager = $dbManager;
    }

    public function addRecipe($recipe){
        array_push($this->cart, $recipe);
    }

    public function removeRecipe($recipe){
        //FIND INDEX OF RECIPE
        $counter = 0;
        $key = null;
        foreach($this->cart as $item){
            if($item['id'] == $recipe['id']){
                $key = $counter;
            }
            $counter++;
        }

        //REMOVE RECIPE
        if(!is_null($key)){
            array_splice($this->cart, $key, 1);
        }
    }

    public function calculatePrice(){
        $this->totalPrice = 0;
        foreach($this->cart as $recipe){
            //GET ARRAY WITH INGREDIENTS USED
            $ingredients = $this->dbManager->recipeIngredient->getAllIngredients($recipe['id']);
            
            //LOOP THROUGH INGREDIENTS IN RECIPE
            foreach($ingredients as $ingredient){
                $stats = $this->dbManager->ingredient->getIngredient($ingredient['ingredientID']);
                
                //RATIO = QUANTITY OF USED INGRIDIENT / QUANTITY OF BASE INGREDIENT
                //PRICE += RATIO * BASE PRICE INGREDIENT
                $this->totalPrice += ($ingredient['quantity'] / $stats['quantity']) * $stats['price'];
            }
        }
    }

    public function calculateCalories(){
        $this->totalCalories = 0;
        foreach($this->cart as $recipe){
            //GET ARRAY WITH INGREDIENTS USED
            $ingredients = $this->dbManager->recipeIngredient->getAllIngredients($recipe['id']);
            
            //LOOP THROUGH INGREDIENTS IN RECIPE
            foreach($ingredients as $ingredient){
                $stats = $this->dbManager->ingredient->getIngredient($ingredient['ingredientID']);
                
                //RATIO = QUANTITY OF USED INGRIDIENT / QUANTITY OF BASE INGREDIENT
                //CALORIES += RATIO * BASE CALORIES INGREDIENT
                $this->totalCalories += ($ingredient['quantity'] / $stats['quantity']) * $stats['calories'];
            }
        }
    }
}

?>