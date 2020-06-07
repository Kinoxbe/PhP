<?php

include './Models/DaO/BuildingDaO.php';

class BuildingController
{
    private $dao;
    private $view;

    function __construct($get, $post, $route)
    {
        $this->dao = new BuildingDaO();
        $this->view = new BuildingPageView();


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
                if ($_SESSION['CSRF']['Role'] == '2') {
                    $this->displayResident();
//                    var_dump($_SESSION);
                } else {
                    header("location:javascript://history.go(-1)");
                }
                //            var_dump($this);
            }


            if ($post && (isset($post['buildname'])) && $route == 'create' && strcmp($_SESSION['CSRF']['Value'], $post['CSRF']) === 0) {
                var_dump($_POST);
                $this->save($_POST);
            }

            if ($post && (isset($post['delbuildpk'])) && $route == 'delete' && strcmp($_SESSION['CSRF']['Value'], $post['CSRF']) === 0) {
                var_dump($_POST);
                $this->delete($post['delbuildpk']);

            }
            else if (!$_SESSION['CSRF']) {
                header('Location:' . BASEURL);
            }
        }
    }


    function delete($delpk)
    {
        var_dump('DELETE ON', $delpk);
        $this->dao->delete($delpk);
        header("location:".BASEURL."building/syndic");

    }


    function save($data)
    {
        $this->dao->save($data);
        header("location:".BASEURL."building/syndic");
        echo "Save";
//        var_dump($data);
    }

    function displayPage()
    {
        echo $this->view->displayPage($this->dao->fetchBuilding());
    }

    function displayResident()
    {
        echo $this->view->displayResidentPage($this->dao->fetchBuilding());
    }

}