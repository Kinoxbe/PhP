<?php
include './Models/DaO/CommunicationDaO.php';
include './Models/DaO/BuildingDaO.php';


class CommunicationController
{
    private $view;
    private $comdao;


    function __construct($get, $post, $route)
    {
        $this->comdao = new CommunicationDaO();
        $this->builddao = new BuildingDaO();
        $this->view = new CommunicationPageView();


        if (isset($_SESSION['CSRF'])) {

//    var_dump($post);

            if ($route == 'syndic') {
                if ($_SESSION['CSRF']['Role'] == '1') {
                    $this->displayPage();
                } else {
                    header("location:javascript://history.go(-1)");
                }
                //            var_dump($this);
            }


            if ($route == 'resident') {
                if ($_SESSION['CSRF']['Role'] == '2' or $_SESSION['CSRF']['Role'] == '1') {
                    $this->displayResident();
//                    var_dump($_SESSION);
                } else {
                    header("location:javascript://history.go(-1)");
                }
                //            var_dump($this);
            }


            if ($post && (isset($post['comname'])) && $route == 'create' && strcmp($_SESSION['CSRF']['Value'], $post['CSRF']) === 0) {
                var_dump($_POST);
                $this->save($_POST);
            }

            if ($post && (isset($post['delcomdpk'])) && $route == 'delete' && strcmp($_SESSION['CSRF']['Value'], $post['CSRF']) === 0) {
                var_dump($_POST);
                $this->delete($post['delcomdpk']);

            }
            else if (!$_SESSION['CSRF']) {
                header('Location:' . BASEURL);
            }
        }
    }


    function delete($delpk)
    {
        var_dump('DELETE ON', $delpk);
        $this->comdao->delete($delpk);
        header("location:".BASEURL."communication/syndic");
    }


    function save($data)
    {
        $this->comdao->save($data);
        header("location:".BASEURL."communication/syndic");
        echo "Save";
        var_dump($data);
    }

    function displayPage()
    {
        echo $this->view->displayPage($this->comdao->combuilding(),$this->builddao->fetchBuilding());
    }

    function displayResident()
    {
        echo $this->view->displayResidentPage($this->comdao->combuilding(),$this->builddao->fetchBuilding());
    }

}