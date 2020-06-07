<a>
    <button type="button" id="SynUser-btn" >User</button>
</a>
<a>
    <button type="button" id="SynCom-btn" >Communication</button>
</a>

<?php //var_dump($building_list) ?>

<h1>Building Manager</h1>
<table >
    <tr>
        <th>Building Name</th>
        <th>Adress </th>
    </tr>
    <?php foreach ($building_list as $building): ?>
        <form id="formsyndic" method="POST">
            <tr>

                <td>
                    <span  class="editablebuildname"><?= $building->__get('building_name'); ?></span>
                    <input class="editableBuildNameStyle" type="text" name="editableBuildname" style="display:none " />
                </td>
                <td>
                    <span  class="editablebuildadress"><?= $building->__get('adress'); ?></span>
                    <input class="editableBuildAdressStyle" type="text" name="editablebuildadress" style="display:none "/>
                </td>
                <td>
                    <input class="CSRF" type="text" name="CSRF" style="display: none" value="<?= $_SESSION['CSRF']["Value"] ?>">
                </td>
                <td>
                    <span class="editbuildpk" style="display: none"><?= $building->__get('pk_building'); ?></span>
                </td>
                <td>
                    <input type="submit" class="editValues" value="EDIT">
                    <button class='buildsave' name="usersave" type='submit' style="display: none">SAVE</button>
        </form>
        <button class='cancel' type='button' style="display: none" >CANCEL</button>
        </td>

        <form action="<?=BASEURL?>building/delete" method="POST">
            <td>
                <input type="submit" name="builddelete" value="DELETE">
                <input name="delbuildpk" type="hidden" value="<?= $building->__get('pk_building'); ?>">
                <input class="CSRF" type="text" name="CSRF" style="display: none" value="<?= $_SESSION['CSRF']["Value"] ?>">
            </td>
        </form>
        </tr>

    <?php endforeach; ?>
</table>
<br><br><br>
<h2>Building Creator</h2>

<form action="<?=BASEURL?>building/create" method="POST">
    <label for="buildname"><b>Name</b></label>
    <input type="text" placeholder="Enter the Building name" name="buildname" id="builduname" required>
    <br>
    <label for="buildadress"><b>Adress</b></label>
    <input type="text" placeholder="Enter the Building Adress" name="buildadress" id="buildadress" required>
    <br>
    <input class="CSRF" type="text" name="CSRF" style="display: none" value="<?= $_SESSION['CSRF']["Value"] ?>">
    <input type='submit' value="CREATE">
</form>