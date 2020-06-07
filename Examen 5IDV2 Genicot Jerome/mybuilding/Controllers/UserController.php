<?php


class UserController
{
    private $daouser;
    private $view;

    function __construct($get, $post, $route)
    {
        $this->daouser = new UserDAO();
        $this->view = new UserPageView();

        if ($post && (isset($post['username'])) && $route == 'create') {
            $this->save($_POST);
            echo ('User creation Awaiting a few Second');
            header( "refresh:3 ;url=".BASEURL );
        }

//        if(isset($_SESSION['CSRF']) && isset($_POST['csrf'])) {
        else if (isset($_SESSION['CSRF'])) {
//            if(strcmp($_SESSION['CSRF']['Value'], $_POST['csrf']) === 0) {
            //User controller

            if ($route == 'syndic') {
                if($_SESSION['CSRF']['Role']=='1' ){
                    $this->displayPage();}
                else {header("location:javascript://history.go(-1)");}
                //            var_dump($this);
            }

            if ($route == 'resident') {
                if($_SESSION['CSRF']['Role']=='2' ){
//                    var_dump($_SESSION);
                    $this->displayResident(); }
                else {header("location:javascript://history.go(-1)");}
                //            var_dump($this);
            }

//            var_dump($_SESSION['CSRF']['Value']);
//            var_dump($post);

            if ($post && (isset($post['deluserpk'])) && $route == 'delete' &&  strcmp($_SESSION['CSRF']['Value'], $post['CSRF']) === 0) {
                var_dump($post);
                $this->delete($post['deluserpk']);
            }
            }

//else
//{
//header('Location:'.BASEURL);
//}
    }




    function delete($delpk)
    {
        var_dump('DELETE ON', $delpk);
        $this->daouser->delete($delpk);
        header("location:".BASEURL."user/syndic");
        echo "AUREVOIR";
    }

    function save($data)
    {
        $this->daouser->save($data);
//        header("location:".BASEURL);
//        echo "Save";
//        var_dump($data);
    }


    //display

    function displaylogin($username){
        echo $this->view->displayPage($this->daouser->fetchlogin($username));
    }

    function displayOne($pk)
    {
        echo $this->view->displayOne($this->daouser->fetch($pk));
    }

    function displayPage()
    {
        echo $this->view->displayPage($this->daouser->assocbuilding());
    }

    function displayResident()
    {
        echo $this->view->displayResidentPage($this->daouser->assocbuilding());
    }


}

