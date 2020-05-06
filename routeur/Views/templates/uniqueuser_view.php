<?php if ($user && $user->__get('username')) { ?>
    <h1> <?= $user->__get('username'); ?></h1>
<?php } else { ?>
    <h1>AUCUN USER</h1>

<?php }