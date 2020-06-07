<?php

include './Models/DaO/BuildingDaO.php';

class IndexController
{

    function __construct($get,$post,$route)
    {
        $this->view = new IndexPageView();
        $this->dao = new BuildingDaO();



        $this->displayLoginPage();
        
//            var_dump($this);
        }

    //Views

    function displayOne($pk) {
        echo $this->view->displayOne($this->dao->fetch($pk));
    }

    function displayPage() {
        echo $this->view->displayPage($this->dao->fetchall());
    }

    function displayLoginPage() {
        echo $this->view->displayLoginPage($this->dao->fetchBuilding());
    }



    // Methode CRUD

    function delete($delpk) {
        var_dump('DELETE ON', $delpk);
        $this->dao->delete($delpk);
        echo "AUREVOIR";
        header("Location:".BASEURL);
    }

    function edit($editpk) {
        var_dump('Edit');
        $this->dao->update($editpk);
        echo "UPDATE";
        header("Location:".BASEURL);
    }

    function save($data){
        $this->dao->save($data);
        echo "Save";
        header("Location:".BASEURL);
        //        var_dump($data);
    }
}
