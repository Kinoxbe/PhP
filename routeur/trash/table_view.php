<table id="table-list">
    <tr>
        <th>Nom</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Vat</th>
        <th>Price_Vat</th>
        <th>Price_Total</th>
    </tr>
    <?php foreach ($product_list as $product): ?>
    <form action="index_views.php" method="POST" name="edit-form">
        <tr>

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
                    <input type="submit" name="delete" value="DELETE">
                    <input name="delpk" type="hidden" value="<?= $product->__get('pk'); ?>">
            </td>
            <td>
                    <input type="submit" class="editValues" value="EDIT">
                    <input name="editpk" type="hidden" value="<?= $product->__get('pk'); ?>">
                    <button class='save' name="save" type='submit' style="display:none ">SAVE</button>
                    <button class='cancel' type='button' style="display:none ">CANCEL</button>
            </td>

        </tr>
    </form>
    <?php endforeach; ?>

    </table>


<table id="user-list" style="display: none">
    <tr>
        <th>UserName</th>
        <th>Password</th>
    </tr>
    <?php foreach ($user_list as $user): ?>
        <form action="index_views.php" method="POST" name="edit-form">
            <tr>

                <td>
                    <span  class="editablename"><?= $user->__get('username'); ?></span>
                    <input class="editableNameStyle" type="texte" name="editableusername" style="display:none " value=""/>
                </td>
                <td>
                    <span  class="editableprice"><?= $user->__get('password'); ?></span>
                    <input class="editablePriceStyle" type="text" name="editablepassword" style="display:none " value=""/>
                </td>


                <td>
                    <input type="submit" name="userdelete" value="DELETE">
                    <input name="delpk" type="hidden" value="<?= $user->__get('pk'); ?>">
                </td>
                <td>
                    <input type="submit" class="editValues" value="EDIT">
                    <input name="editpk" type="hidden" value="<?= $user->__get('pk'); ?>">
                    <button class='save' name="usersave" type='submit' style="display: none">SAVE</button>
                    <button class='cancel' type='button' style="display: none" >CANCEL</button>
                </td>

            </tr>
        </form>
    <?php endforeach; ?>
</table>


