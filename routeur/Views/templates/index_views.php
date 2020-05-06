<!DOCTYPE html>
<html lang="fr">
<head>
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>-->
<!--    <script src="Script/script.js"></script>-->
    <meta charset="UTF-8">
    <title>Titre</title>
</head>
<body>
<a href="<?=BASEURL?>user">
<button type="button" id="manager-btn" >USER MANAGER</button>
</a>
<a href="<?=BASEURL?>">
<button type="button" id="manager2-btn" >PRODUCT MANAGER</button>
</a>

<form action="/routeur/" id="search-form" method="get">
    <label for="pk-search">Search : </label>
    <input type="number" name="pk" id="pk-search">
    <input type="submit" value="SEARCH">
</form>

<!--<form action="/routeur/index/create" id="createproduct" method="post">-->
<!--    <label for="ProducName">Name : </label>-->
<!--    <input type="text" name="name" >-->
<!--    <label for="ProductPrice">Price : </label>-->
<!--    <input type="number" name="price" min="0" step="0.01">-->
<!--    <label for="ProductQuantity">Quantity : </label>-->
<!--    <input type="number" name="quantity" min="0">-->
<!--    <label for="ProductVat">VAT : </label>-->
<!--    <input type="number" name="vat" min="0">-->
<!--    <input type="submit" name="create" value="CREATE">-->
<!--</form>-->

<!--<form action="/routeur/index/create" id="createuser" style="display: none" method="post">-->
<!--    <label for="username">Username : </label>-->
<!--    <input type="text" name="username" >-->
<!--    <label for="password">Password : </label>-->
<!--    <input type="texte" name="password" >-->
<!--    <input type="submit" name="createuser" value="ADD USER">-->
<!--</form>-->

</body>
</html>

