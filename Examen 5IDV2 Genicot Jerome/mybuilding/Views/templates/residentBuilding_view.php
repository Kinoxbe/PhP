<a>
    <button type="button" id="ResUser-btn" >User</button>
</a>
<a>
    <button type="button" id="ResCom-btn" >Communication</button>
</a>



<h1>Building List</h1>
<table >
    <tr>
        <th>Building Name</th>
        <th>Adress </th>
    </tr>
    <?php foreach ($building_list as $building): ?>
            <tr>
                <td>
                    <span  class="editablebuildname"><?= $building->__get('building_name'); ?></span>
                </td>
                <td>
                    <span  class="editablebuildadress"><?= $building->__get('adress'); ?></span>
                </td>
        </tr>
    <?php endforeach; ?>
</table>
