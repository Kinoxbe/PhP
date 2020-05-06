<?php
include '../Constructeur/Product.php';
include "../Manager/ProductManager.php";
include '../Constructeur/User.php';
include '../Manager/UserDAO.php';
$product_manager = new ProductManager();
$user_manager = new UserManager();
$display = 'list';

$user_list = $user_manager->fetchAll();
$product_list = $product_manager->fetchAll();


if ( isset($_POST) && isset($_POST['create']) ){
    $product = $product_manager->save($_POST);
}

//if ( isset($_POST) && isset($_POST['state']) ){
//    if ($_POST['state']=="1") {
//            $display = 'userlist';
//    }
//}

if(isset($_GET) && isset($_GET['pk'])){
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
}


//    $product_list = $product_manager->fetchAll();

if($display == 'one') include '../Views/unique_view.php';
if($display == 'list') include '../Views/table_view.php';
//if($display == 'userlist') include 'UserView.php';


?>





