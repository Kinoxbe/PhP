<?php
session_start();

include '../../Models/DaO/DAO.php';
include '../../Models/DaO/DeleteBehaviour.php';
include '../../Models/DaO/HardDeleteBehaviour.php';
include '../../Models/DaO/SoftDeleteBehaviour.php';
include '../../Models/DaO/UserDAO.php';
include '../../Models/DaO/BuildingDaO.php';
include '../../Models/DaO/CommunicationDaO.php';
include '../../Models/Entities/Building.php';
include '../../Models/Entities/User.php';
include '../../Models/Entities/Communication.php';


$userdao = new UserDAO();
$builddao = new BuildingDAO();
$comdao = new CommunicationDaO();

$now=new DateTime();

if(isset($_SESSION['CSRF']) && isset($_POST['CSRF'])) {
    if(strcmp($_SESSION['CSRF']['Value'], $_POST['CSRF']) === 0) {
        $now=$now->getTimestamp();

        if (isset($_POST) && isset($_POST['edituserpk'])){
            var_dump($_POST);
            unset($_POST['CSRF']);
            $userdao->update($_POST);
        }

        else if (isset($_POST) && isset($_POST['editbuildpk'])){
            var_dump($_POST);
            unset($_POST['CSRF']);
            $builddao->update($_POST);
        }

        else if (isset($_POST) && isset($_POST['editcompk'])){
            var_dump($_POST);
            unset($_POST['CSRF']);
            $comdao->update($_POST);
        }
    }
}

?>





