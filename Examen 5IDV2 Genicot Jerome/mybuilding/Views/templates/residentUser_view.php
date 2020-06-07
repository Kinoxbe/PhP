<a>
    <button type="button" id="ResBuild-btn" >Building</button>
</a>
<a>
    <button type="button" id="ResCom-btn" >Communication</button>
</a>


<h1>Resident List</h1>
<table >
    <tr>
        <th>UserName</th>
        <th>Password</th>
        <th>Firstname</th>
        <th>LastName</th>
        <th>Box</th>
        <th>Mail</th>
        <th>Building</th>
    </tr>
    <?php foreach ($user_list as $user): ?>
    <tr>
                <td>
                    <span  class="editablename"><?= $user->__get('username'); ?></span>
                </td>
                <td>
                    <span  class="editablepassword"><?= $user->__get('password'); ?></span>
                </td>
                <td>
                    <span  class="editablefirstname"><?= $user->__get('firstname'); ?></span>
                </td>
                <td>
                    <span  class="editablelastname"><?= $user->__get('lastname'); ?></span>
                </td>
                 <td>
                     <span  class="editablebox"><?= $user->__get('box'); ?></span>
                 </td>
                <td>
                    <span  class="editablemail"><?= $user->__get('mail'); ?></span>
                </td>
                <td>
                    <span  class="editablebuilding"><?= $user->__get('building_name'); ?></span>
                </td>
    </tr>
    <?php endforeach; ?>
</table>
