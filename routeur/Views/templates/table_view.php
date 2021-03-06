<form action="<?=BASEURL?>index/create" id="createproduct" method="post">
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

<table id="list">
    <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Vat</th>
        <th>Price_Vat</th>
        <th>Price_Total</th>
    </tr>
    <?php foreach ($product_list as $product): ?>
           <tr>
               <form action="<?=BASEURL?>index/save" method="POST">
                <td>
                    <span  class="editablename"><?= $product->__get('name'); ?></span>
                    <input class="editableNameStyle" type="text" name="editablename" style="display:none " value=""/>
                </td>
                <td>
                    <span  class="editableprice"><?= $product->__get('price'); ?></span>
                    <input class="editablePriceStyle" type="number" name="editableprice" min="0" step="0.01" style="display:none " value=""/>
                </td>
                <td>
                    <span  class="editablequantity"><?= $product->__get('quantity'); ?></span>
                    <input class="editableQuantityStyle" type="number" name="editablequantity" min="0" style="display:none " value=""/>
                </td>
            <td>
                    <span  class="editablevat"><?= $product->__get('vat'); ?></span>
                    <input class="editablevatStyle" type="number" name="editablevat" min="0" style="display:none " value=""/>
                </td>
            <td>
                    <span  class="editablepricevat"><?= $product->__get('price_vat'); ?></span>
            </td>
            <td>
                    <span  class="editablepricetotal"><?= $product->__get('price_total'); ?></span>
            </td>



            <td>
                    <input type="button" class="editValues" value="EDIT">
                    <input name="editpk" type="hidden" value="<?= $product->__get('pk'); ?>">
                    <button class='save' name="save" type='submit' style="display:none ">SAVE</button>

                    <button class='cancel' type='button' style="display:none ">CANCEL</button>
            </td>
               </form>
               <td>
                   <form action="<?=BASEURL?>index/delete" method="POST">
                       <input  type="hidden" name="delpk" value="<?= $product->__get('pk'); ?>">
                       <input type="submit" name="delete" value="DELETE">
                   </form>
               </td>
        </tr>
    <?php endforeach; ?>

    </table>



