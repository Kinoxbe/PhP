<?php


class UserPageView {
    private $page ;
    private $render;


    function __construct() {
        $this->page = false;
        $this->render = false;
    }

//DISPLAY

    function displayPage($user_list) {
        $this->template($user_list);
        return $this->render;
    }

    function displayOne($user) {
        $this->template($user);
        return $this->render;
    }


// TEMPLATE

    function templateSingle($user) {
        return $this->generateOne($user);
    }

    function template($data) {
        $this->page = $this->generateHeader();
        $this->page .=$this->generateIndex();
        if(is_array($data)) {
            $this->page .= $this->templateMultiple($data);
        } else {
            $this->page .= $this->templateSingle($data);
        }
        $this->page .= $this->generateFooter();
        $this->render = $this->generateShell();
    }

    function templateMultiple($user_list) {
//        $buffer = $this->generateEmptyFormToutNul();
        $buffer =  $this->generateTable($user_list);
        return $buffer;
    }




// GENERATE

    function generateEmptyFormToutNul() {
        ob_start();
        include 'Views/templates/formtoutnul.php';
        return ob_get_clean();
    }

    function generateShell() {
        ob_start();
        include 'Views/templates/shell.php';
        return ob_get_clean();
    }

    function generateIndex(){
        ob_start();
        include 'Views/templates/index_views.php';
        return ob_get_clean();
    }

    function generateOne($user) {
        ob_start();
        include 'Views/templates/login.php';
        return ob_get_clean();
    }

    function generateTable($user_list) {
        ob_start();
        include 'Views/templates/user_view.php';
        return ob_get_clean();
    }

    function generateHeader() {
        ob_start();
        include 'Views/templates/header.php';
        return ob_get_clean();
    }

    function generateFooter() {
        ob_start();
        include 'Views/templates/footer.php';
        return ob_get_clean();
    }

    function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}