<a>
    <button type="button" id="ResUser-btn" >User</button>
</a>
<a>
    <button type="button" id="ResBuild-btn" >Building</button>
</a>

<?php //var_dump($communication_list) ?>

<h1>Communication List</h1>
<table >
    <tr>
        <th>Communication</th>
        <th>Building </th>
    </tr>
    <?php foreach ($communication_list as $communication): ?>
            <tr>
                <td>
                    <span  class="editablecomname"><?= $communication->__get('communication'); ?></span>
                </td>
                <td>
                    <span  class="editablecombuildname"><?= $communication->__get('building_name'); ?></span>
                </td>
            </tr>
    <?php endforeach; ?>
</table>