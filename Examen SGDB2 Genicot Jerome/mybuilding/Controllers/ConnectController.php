<?php


class ConnectController
{
    private $daouser;
    private $view;

    function __construct($get, $post, $route)
    {
        $now=new DateTime();

        $this->daouser = new UserDAO();
        $this->view = new UserPageView();


        if ($post && (isset($post['username'])) && isset($post['password'])) {
            $result = $this->daouser->verify($post['username'], $post['password']);
//            var_dump($post);
            if($result != false){
    //             var_dump('connected');
                    $_SESSION['CSRF']['Time']=$now;
                    $_SESSION['CSRF']['Value']=bin2hex(random_bytes(16));
                    $_SESSION['CSRF']['Role']=$result->__get('fk_roles');
                    echo json_encode(['connection'=>true,'role'=>$result->__get('fk_roles')]);
               }
           else
               echo json_encode(['connection'=>false]);
        }

        if ($route=="disconnect") {
            session_destroy();
            header('Location:'.BASEURL);
        }

    }
}