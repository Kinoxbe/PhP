<?php
define("BASEURL", "http://localhost/routeur/");

//auto include ce qu on a besoin
spl_autoload_register(function($class) {
    if($class == "Routeur") {
        include "Routeur/Routeur.php";
    } else if (strpos($class, "Controller")) {
        include "Controllers/{$class}.php";
    } else if (strpos($class, "View")) {
        include "Views/{$class}.php";
    } else if (strpos($class, "Behaviour")) {
        include "Models/Dao/{$class}.php";
    } else if (strpos($class, "DAO") || strpos($class, "DAO") === 0) {
        include "Models/Dao/{$class}.php";
    } else {
        include "Models/Entities/{$class}.php";
    }
});

$router = new Routeur($_GET, $_POST, $_SERVER['PHP_SELF'],$_SERVER['REQUEST_URI']);

//$productDAO = new ProductDAO();
//$productDAO->delete(0);
//$productDAO->__set('deleteBehaviour', 'HardDeleteBehaviour');
//$productDAO->delete(0);
//$productDAO->__set('deleteBehaviour', 'SoftDeleteBehaviour');
//$productDAO->delete(0);

//var_dump($router);

?>
