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

    public function calcTotalPrice(){
        $this->totalPrice = 0;
        foreach($this->cart as $recipe){
            $this->totalPrice += $this->dbManager->recipe->calcPrice($recipe['id']); 
        }
    }

    public function calcTotalCalories(){
        $this->totalCalories = 0;
        foreach($this->cart as $recipe){
            $this->totalCalories += $this->dbManager->recipe->calcCalories($recipe['id']);
        }
    }
}

?>