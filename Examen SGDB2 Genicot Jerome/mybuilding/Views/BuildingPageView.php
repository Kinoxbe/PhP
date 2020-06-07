<?php


class BuildingPageView {
    private $page ;
    private $render;


    function __construct() {
        $this->page = false;
        $this->render = false;
    }

//DISPLAY

    function displayPage($building_list) {
        $this->template($building_list);
        return $this->render;
    }


    function displayResidentPage($building_list) {
        $this->templateResident($building_list);
        return $this->render;
    }

// TEMPLATE


//    function templateSingle($user) {
//        return $this->generateOne($user);
//    }

    function template($data) {
        $this->page = $this->generateHeader();
//        $this->page .=$this->generateIndex();
        if(is_array($data)) {
            $this->page .= $this->templateMultiple($data);
        }
//        else {
//            $this->page .= $this->templateSingle($data);
//        }
        $this->page .= $this->generateFooter();
        $this->render = $this->generateShell();
    }

    function templateMultiple($building_list) {
//        $buffer = $this->generateEmptyFormToutNul();
        $buffer =  $this->generateTable($building_list);
        return $buffer;
    }

    function templateResident($building_list) {
        $this->page = $this->generateHeader();
        $this->page .= $this->generateResident($building_list);
        $this->page .= $this->generateFooter();
        $this->render = $this->generateShell();
    }


// GENERATE

    function generateShell() {
        ob_start();
        include 'Views/templates/shell.php';
        return ob_get_clean();
    }

//    function generateIndex(){
//        ob_start();
//        include 'Views/templates/index_views.php';
//        return ob_get_clean();
//    }

//    function generateOne($user) {
//        ob_start();
//        include 'Views/templates/unique_view.php';
//        return ob_get_clean();
//    }

    function generateResident($building_list) {
        ob_start();
        include 'Views/templates/residentBuilding_view.php';
        return ob_get_clean();
    }

    function generateTable($building_list) {
        ob_start();
        include 'Views/templates/syndicBuilding_view.php';
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