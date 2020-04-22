<?php
    include 'Constructeur/Product.php';
    include "Manager/ProductManager.php";
    include 'Constructeur/User.php';
    include 'Manager/UserManager.php';
    $product_manager = new ProductManager();
    $user_manager = new UserManager();
    $display = 'list';

    if ( isset($_POST) && isset($_POST['create']) ){
        $product_manager->save($_POST);
        }

    if ( isset($_POST) && isset($_POST['createuser']) ){
        $user_manager->save($_POST);
        }

    if ( isset($_POST) && isset($_POST['delete']) ){
            $product_manager->delete($_POST['delpk']);
        }

    if ( isset($_POST) && isset($_POST['userdelete']) ){
            $user_manager->delete($_POST['delpk']);
        }

    if ( isset($_POST) && isset($_POST['save']) ){
        $product_manager->update($_POST);
    }

    if ( isset($_POST) && isset($_POST['usersave']) ){
        $user_manager->update($_POST);
    }

    $user_list = $user_manager->fetchAll();
    $product_list = $product_manager->fetchAll();
?>
<!DOCTYPE html>
    <html lang="fr">
        <head>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
            <script src="JavaScript/script.js"></script>
            <meta charset="UTF-8">
            <title>Titre</title>
        </head>
        <body>
            <button type="button" id="manager-btn">USER MANAGER</button>
           <form action="index.php" id="search-form" method="get">
                <label for="pk-search">Search : </label>
                <input type="number" name="pk" id="pk-search">
                <input type="submit" name="search" value="SEARCH">
            </form>

        <form action="/DB2/index.php" id="createproduct" method="post">
            <label for="ProducName">Name : </label>
            <input type="text" name="name" >
            <label for="ProductPrice">Price : </label>
            <input type="number" name="price" min="0" step="0.01">
            <label for="ProductQuantity">Quantity : </label>
            <input type="number" name="quantity" min="0">
            <label for="ProductVat">VAT : </label>
            <input type="number" name="vat" min="0">
            <input type="submit" name="create" value="CREATE">
        </form>

        <form action="/DB2/index.php" id="createuser" style="display: none" method="post">
            <label for="username">Username : </label>
            <input type="text" name="username" >
            <label for="password">Password : </label>
            <input type="texte" name="password" >
            <input type="submit" name="createuser" value="ADD USER">
        </form>

        <section id="ajax-rsp">
            <?php if($display == 'one') include 'Views/unique_view.php'; ?>
        </section>

            <?php if($display == 'list') include 'Views/table_view.php'; ?>
    </body>
</html>
