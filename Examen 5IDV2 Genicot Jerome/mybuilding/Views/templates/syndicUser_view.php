<a>
    <button type="button" id="SynBuild-btn" >Building</button>
</a>
<a>
    <button type="button" id="SynCom-btn" >Communication</button>
</a>

<?php //var_dump($user_list) ?>

<h1>UserAccount Resident</h1>
<table >
        <tr>
            <th>UserName</th>
            <th>Password</th>
            <th>Firstname</th>
            <th>LastName</th>
            <th>Role</th>
            <th>Box</th>
            <th>Mail</th>
            <th>Building</th>
        </tr>
        <?php foreach ($user_list as $user): ?>
            <form id="formsyndic" method="POST">
                <tr>

                    <td>
                        <span  class="editablename"><?= $user->__get('username'); ?></span>
                        <input class="editableNameStyle" type="texte" name="editableusername" style="display:none " />
                    </td>
                    <td>
                        <span  class="editablepassword"><?= $user->__get('password'); ?></span>
                        <input class="editablePasswordStyle" type="text" name="editablepassword" style="display:none "/>
                    </td>
                    <td>
                        <span  class="editablefirstname"><?= $user->__get('firstname'); ?></span>
                        <input class="editableFirstnameStyle" type="text" name="editablepassword" style="display:none " />
                    </td>
                    <td>
                        <span  class="editablelastname"><?= $user->__get('lastname'); ?></span>
                        <input class="editableLastnameStyle" type="text" name="editablelastname" style="display:none " />
                    </td>
                     <td>
                        <span  class="editablerole"><?= $user->__get('role_name'); ?></span>
                        <input class="editableRoleStyle" type="text" name="editablerole" style="display:none " />
                    </td>
                    <td>
                        <span  class="editablebox"><?= $user->__get('box'); ?></span>
                        <input class="editableBoxStyle" type="text" name="editablebox" style="display:none " />
                    </td>
                    <td>
                        <span  class="editablemail"><?= $user->__get('mail'); ?></span>
                        <input class="editableMailStyle" type="text" name="editablemail" style="display:none " />
                    </td>
                    <td>
                        <span  class="editablebuilding"><?= $user->__get('building_name'); ?></span>
                        <input class="editableBuildingStyle" type="text" name="editablebuilding" style="display:none " />
                    </td>
                    <td>
                        <input class="CSRF" type="text" name=="CSRF" style="display: none" value="<?= $_SESSION['CSRF']["Value"] ?>"
                    </td>
                    <td>
                        <span class="edituserpk" style="display: none"><?= $user->__get('pk'); ?></span>
                    </td>
                    <td>
                        <input type="submit" class="editValues" value="EDIT">
                        <input name="deluserpk" type="hidden" value="<?= $user->__get('pk'); ?>">
                        <button class='usersave' name="usersave" type='submit' style="display: none">SAVE</button>
            </form>
            <button class='cancel' type='button' style="display: none" >CANCEL</button>
            </td>

            <form action="<?=BASEURL?>user/delete" method="POST">
                <td>
                    <input type="submit" name="userdelete" value="DELETE">
                    <input name="deluserpk" type="hidden" value="<?= $user->__get('pk'); ?>">
                    <input class="CSRF" type="hidden" name="CSRF" value="<?= $_SESSION['CSRF']["Value"] ?>"
                </td>
            </form>
            </tr>

        <?php endforeach; ?>
    </table>