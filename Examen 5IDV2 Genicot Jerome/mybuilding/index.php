<?php
session_start();

define("BASEURL", "http://localhost/mybuilding/");

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

$now=new DateTime();

if(isset($_SESSION['CSRF']) && isset($_POST['csrf'])) {
    if(strcmp($_SESSION['CSRF']['Value'], $_POST['csrf']) === 0) {
        $now=$now->getTimestamp();
        if(($_SESSION['CSRF']['Time']-$now) < 600) {
            echo "succes les 2 csrf sont égaux je peux delete";
            exit();}else{
            echo "Not good";
            exit();
        }
    }
}


$router = new Routeur($_GET, $_POST, $_SERVER['PHP_SELF'],$_SERVER['REQUEST_URI']);
//var_dump($router);
//$resident = resident;
$dao = new UserDAO();
//var_dump($dao->fetchAll());
//var_dump($dao->assocbuilding());

//if (isset($_COOKIE) && isset($_COOKIE['session_token'])) {
//    var_dump($dao->fetchlogin($resident));
//}

//var_dump($router);

?>
