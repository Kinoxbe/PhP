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

<form action="<?=BASEURL?>user/login" method="post">
    <label for="userlogin">Login : </label>
    <input type="text" name="userlogin">
    <label for="userpassword">Password : </label>
    <input type="password" name="userpassword">
    <input type="submit" value="Login">
</form>

</body>
</html>

<!--//1 faire en sorte que notre UserDAO quand il enregistre un nouvel utilisateur, il hash son pass
grâce à password_hash et le stock en DB-->
<!---->
<!--//2 Créer un mini formulaire de login-->
<!---->
<!--//3 Au login, vérifier que le mdp est correct grâce à password verify-->

<!--?php-->
<!--$test = 'password1';-->
<!--var_dump('md5', md5($test));-->
<!--$hash = password_hash($test, PASSWORD_DEFAULT);-->
<!--var_dump('hash', $hash);-->
<!---->
<!--var_dump('verify', password_verify($test, $hash));-->
<!--//1 : regarde le hash et il en déduit l'algo utilisé et le sel utilisé-->
<!---->
<!--//2: faire passer le $test dans la meme "boite noire" que ce que le hash a subi-->
<!---->
<!--//3 : il vérifie si les 2 "hash" sont bien les meme-->
<!---->
<!---->
<!--?>-->

