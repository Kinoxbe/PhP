<?php if ($product && $product->__get('name')) { ?>
    <h1> <?= $product->__get('name'); ?></h1>
<?php } else { ?>
    <h1>AUCUN PRODUIT</h1>

<?php }
