<?php


class UserController
{
    private $daouser;
    private $view;

    function __construct($get, $post, $route)
    {
        $this->daouser = new UserDAO();
        $this->view = new UserPageView();

        //User controller

        if ($post && (isset($post['deluserpk'])) && $route == 'delete') {
            var_dump($_POST);
            $this->delete($post['deluserpk']);
        }


        if ($post && (isset($post['edituserpk'])) && $route == 'save') {
            var_dump($_POST);
            $this->edit($_POST);
        }


        if ($post && (isset($post['username'])) && $route == 'create') {
            var_dump($_POST);
            $this->save($_POST);
        }


        if ($get && $get['pk']) {
            $this->displayOne($get['pk']);
        } else {
            $this->displayPage();
        }

    }


    function delete($delpk)
    {
        var_dump('DELETE ON', $delpk);
        $this->daouser->delete($delpk);
        header("Location:" . BASEURL . "user");
        echo "AUREVOIR";
    }

    function edit($editpk)
    {
        var_dump('Edit');
        $this->daouser->update($editpk);
        header("Location:" . BASEURL . "user");
        echo "UPDATE";
    }

    function save($data)
    {
        $this->daouser->save($data);
        header("Location:" . BASEURL . "user");
        echo "Save";
        //        var_dump($data);
    }


    //display

    function displayOne($pk)
    {
        echo $this->view->displayOne($this->daouser->fetch($pk));
    }

    function displayPage()
    {
        echo $this->view->displayPage($this->daouser->fetchall());
    }


}

