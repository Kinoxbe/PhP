<form action="<?=BASEURL?>user/create" id="createuser" method="post">
    <label for="username">Username : </label>
    <input type="text" name="username" >
    <label for="password">Password : </label>
    <input type="texte" name="password" >
    <input type="submit" name="createuser" value="ADD USER">
</form>

<table id="list" >
    <tr>
        <th>UserName</th>
        <th>Password</th>
    </tr>
    <?php foreach ($user_list as $user): ?>
        <form action="<?=BASEURL?>user/save" method="POST">
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
                    <input type="submit" class="editValues" value="EDIT">
                    <input name="edituserpk" type="hidden" value="<?= $user->__get('pk'); ?>">
                    <button class='save' name="usersave" type='submit' style="display: none">SAVE</button>
        </form>
                    <button class='cancel' type='button' style="display: none" >CANCEL</button>
                </td>

        <form action="<?=BASEURL?>user/delete" method="POST">
                <td>
                    <input type="submit" name="userdelete" value="DELETE">
                    <input name="deluserpk" type="hidden" value="<?= $user->__get('pk'); ?>">
                </td>
         </form>
        </tr>

    <?php endforeach; ?>
</table>