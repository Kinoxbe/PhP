<a>
    <button type="button" id="SynUser-btn" >User</button>
</a>
<a>
    <button type="button" id="SynBuild-btn" >Building</button>
</a>

<?php //var_dump($communication_list) ?>

<h1>Communication Manager</h1>
<table >
    <tr>
        <th>Communication</th>
        <th>Building </th>
    </tr>
    <?php foreach ($communication_list as $communication): ?>
        <form id="formsyndic" method="POST">
            <tr>

                <td>
                    <span  class="editablecomname"><?= $communication->__get('communication'); ?></span>
                    <input class="editableComNameStyle" type="text" name="editablecomname" style="display:none " />
                </td>
                <td>
                    <span  class="editablecombuildname"><?= $communication->__get('building_name'); ?></span>
                </td>
                <td>
                    <input class="CSRF" type="text" name="CSRF" style="display: none" value="<?= $_SESSION['CSRF']["Value"] ?>">
                </td>
                <td>
                    <span class="editcompk" style="display: none"><?= $communication->__get('pk'); ?></span>
                </td>
                <td>
                    <input type="submit" class="editValues" value="EDIT">
                    <button class='comsave' name="comsave" type='submit' style="display: none">SAVE</button>
        </form>
        <button class='cancel' type='button' style="display: none" >CANCEL</button>
        </td>

        <form action="<?=BASEURL?>communication/delete" method="POST">
            <td>
                <input type="submit" name="comdelete" value="DELETE">
                <input name="delcomdpk" type="hidden" value="<?= $communication->__get('pk'); ?>">
                <input class="CSRF" type="text" name="CSRF" style="display: none" value="<?= $_SESSION['CSRF']["Value"] ?>">
            </td>
        </form>
        </tr>

    <?php endforeach; ?>
</table>
<br><br><br>
<h2>Communication Creator</h2>

<form action="<?=BASEURL?>communication/create" method="POST">
    <label for="comname"><b>Communication</b></label>
    <br>
    <textarea name="comname" rows="15" cols="50" required>Enter the Communication</textarea>
    <br>
    <label for="sel_building"><b>Building</b></label>
    <select id='sel_building' name="fk_building">
        <?php
        foreach($building_list as $building){
            echo "<option value='".$building->__get('pk_building')."'>".$building->__get('building_name')."</option>";
        }
        ?>
    </select>
    <br>
    <input class="CSRF" type="text" name="CSRF" style="display: none" value="<?= $_SESSION['CSRF']["Value"] ?>">
    <input type='submit' value="CREATE">
</form>