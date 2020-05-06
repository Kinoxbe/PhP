<?php

class IndexController
{
    private $dao;
//    private $daouser;
    private $view;

    function __construct($get,$post,$route)
    {
        $this->dao = new ProductDAO();
//        $var = $this->daouser = new UserDAO();
        $this->view = new IndexPageView();

        //IndexController

//        var_dump('route', $route, 'post', $post);
        if($post && (isset($post['delpk'])) && $route == 'delete') {
//            var_dump($_POST);
            $this->delete($post['delpk']);
            header("Location:".BASEURL); //Only work with SINGLE VIEW
        }

        if($post &&  (isset($post['editpk'])) && $route == 'save') {
            $this->edit($_POST);
        }

        if($post &&  (isset($post['name'])) && $route == 'create') {
//            var_dump($_POST);
            $this->save($_POST);
        }


//        //User controller
//
//        if($post && (isset($post['deluserpk'])) && $route == 'userdelete') {
//            var_dump($_POST);
//            $this->delete($post['deluserpk'],'daouser');
//        }
//
//        if($post &&  (isset($post['edituserpk'])) && $route == 'usersave') {
//            var_dump($_POST);
//            $this->edit($_POST,'daouser');
//        }
//
//        if($post &&  (isset($post['username'])) && $route == 'create') {
////            var_dump($_POST);
//            $this->save($_POST,'daouser');
//        }

        if($get && $get['pk']) {
             $this->displayOne($get['pk'],$get['pk']);
        }

        else {
            $this->displayPage();
        }
    }


    //Views

    function displayOne($pk) {
        echo $this->view->displayOne($this->dao->fetch($pk));
    }

    function displayPage() {
        echo $this->view->displayPage($this->dao->fetchall());
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



//FAIRE MARCHER LE PROGRAMME QUE VOUS AVEZ FAIT AVEC LE ROUTEUR ICI PRESENT

//1 Venir inclure les vues nécessaires dans un dossier views

//2 Inclure vos objets métiers (entities) et DAO dans un dossier models /entities /dao

//3 Vérifier que vos controlleurs instancient correctement vos DAO

//4 Gérer la requête reçue par votre controlleur pour qu'il dispatch cela correctement à la méthode du dao correspondante
//
///*
//Par exemple
///$controller => fetchAll()
///$controller?pk=5 => fetch($pk)
//...
//...
//*/
//
////4bis Améliorer votre classe Controller pour qu'elle dispose d'attributs / méthodes intéressantes (par exemple un attribut DAO qui reprend le nom du DAO correspondant, etc) Ne pas avoir toute la logique dans le __construct
//
//
////5 Inclure correctement les vues correspondantes dans vos méthodes du controlleur
///* Exemple : si on vient sur la route /index => afficher le tableau des produits, donc inclure la table_view */
//
////6 Great success

//7 Amélioration possible : modifier les routes appellées par le formulaire
/* Exemple :
/products/delete => delete l'id recue en post
/products/update => update le product avec les infos recues
*/