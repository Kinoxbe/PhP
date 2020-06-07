<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<form id="log-form" method="post">
    <h2>Login</h2>
    <label for="log-uname">Username</label>
    <input type="text" name="userlogin" id="log-uname">

    <label for="log-pwd">Password</label>
    <input type="password" name="userpassword" id="log-pwd">

    <input type="hidden" name="login" value="true">

    <input type="submit">

    <br>
    <br>
    <br>
</form>


<a>
    <button type="button" id="register-btn" >Register</button>
</a>


<form  id="reg-form"  action="<?=BASEURL?>user/create" style="display:none ; align-content: center" method="post">
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="reg-uname"><b>Username</b></label>
        <input type="text" placeholder="Enter your Username" name="username" id="reg-uname" required>
        <br>
        <label for="reg-pwd"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="reg-pwd" required>
        <br>
        <label for="reg-name"><b>LastName</b></label>
        <input type="text" placeholder="Enter your Lastname" name="lastname" id="reg-name" required>
        <br>
        <label for="reg-firstname"><b>FirstName</b></label>
        <input type="text" placeholder="Enter your Firstname" name="firstname" id="reg-firstname" required>
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
        <label for="reg-mail"><b>Box</b></label>
        <input type="number" placeholder="Enter your box number" name="box" id="reg-box" required>
        <br>
        <label for="reg-mail"><b>Email</b></label>
        <input type="email" placeholder="Enter your Email" name="mail" id="reg-mail" required>
            <hr>

        <button type="submit" class="registerbtn" id="regiserbtn">Register</button>
    </div>
</form>

</body>
</html>




