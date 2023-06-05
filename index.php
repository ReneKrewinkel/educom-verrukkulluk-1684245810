<?php
//// Allereerst zorgen dat de "Autoloader" uit vendor opgenomen wordt:
//// First of all make sure that the "Autoloader" is included from vendor:
require_once("./vendor/autoload.php");

/// Twig koppelen:
/// Link twig:
$loader = new \Twig\Loader\FilesystemLoader("./templates");
/// VOOR PRODUCTIE:
/// FOR PRODUCTION:
/// $twig = new \Twig\Environment($loader), ["cache" => "./cache/cc"]);

/// VOOR DEVELOPMENT:
/// FOR DEVELOPMENT:
$twig = new \Twig\Environment($loader, ["debug" => true ]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

/******************************/

/// Next step, iets met je data doen. Ophalen of zo
/// Next step, something to do with your data. Pick up or something
require_once("lib/DB/VER-DAT-DbManager-DO-V1.php");
$dbManager = new dbManager();
$data = $dbManager->recipe->getAllRecipe();


/*
URL:
http://localhost/index.php?recipe_id=4&action=detail
*/

$recipe_id = isset($_GET["recipeID"]) ? $_GET["recipeID"] : "1";
$action = isset($_GET["action"]) ? $_GET["action"] : "detail";


switch($action) {

    case "homepage": {
        $data = $dbManager->recipe->getAllRecipe();
        $template = 'homepage.html.twig';
        $title = "homepage";
        break;
    }

    case "detail": {
        $data = $dbManager->recipe->getRecipe($recipe_id);
        $template = 'detail.html.twig';
        $title = "detail pagina";
        break;
    }

    /// etc

}


/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
/// The code below should ideally be written in a layout class or something similar
/// Load correct template, in this case "homepage"
$template = $twig->load($template);


/// En tonen die handel!
/// And show that trade!
echo $template->render(["title" => $title, "data" => $data]);
