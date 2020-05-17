<?php
//var_dump($user);
if ($user && $user->__get('username')) {
//    var_dump($user->__get('password'));
    $validPassword = password_verify($_POST['userpassword'],$user->__get('password'));
//    var_dump($validPassword);
    if (!$validPassword) {
    ?> <h1>MDP <?php echo($_POST['userpassword']); ?> Incorect pour le USER <?php  echo($_POST['userlogin']); ?> </h1>
    <?php } else { ?>
        <h1> <?= $user->__get('username'); ?> Login Succes</h1>
    <?php } }

else { ?>
    <h1>AUCUN USER <?php echo($_POST['userlogin']); ?> </h1>
<?php } ?>

