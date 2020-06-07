<?php


class CommunicationPageView {
    private $page;
    private $render;


    function __construct() {
        $this->page = false;
        $this->render = false;
    }

//DISPLAY

    function displayPage($communication_list,$building_list) {
        $this->template($communication_list,$building_list);
        return $this->render;
    }

//    function displayOne($communication,$building_list) {
//        $this->template($communication,$building_list);
//        return $this->render;
//    }

    function displayResidentPage($communication_list,$building_list) {
        $this->templateResident($communication_list,$building_list);
        return $this->render;
    }

// TEMPLATE

    function template($data,$building_list) {
        $this->page = $this->generateHeader();
//        $this->page .=$this->generateIndex();
        if(is_array($data)) {
            $this->page .= $this->templateMultiple($data,$building_list);
        }
//        else {
//            $this->page .= $this->templateSingle($data);
//        }
        $this->page .= $this->generateFooter();
        $this->render = $this->generateShell();
    }

    function templateMultiple($communication_list,$building_list) {
//        $buffer = $this->generateEmptyFormToutNul();
        $buffer =  $this->generateTable($communication_list,$building_list);
        return $buffer;
    }

    function templateResident($communication_list) {
        $this->page = $this->generateHeader();
        $this->page .= $this->generateResident($communication_list);
        $this->page .= $this->generateFooter();
        $this->render = $this->generateShell();
    }


// GENERATE

    function generateShell() {
        ob_start();
        include 'Views/templates/shell.php';
        return ob_get_clean();
    }

    function generateResident($communication_list) {
        ob_start();
        include 'Views/templates/residentCommunication_view.php';
        return ob_get_clean();
    }

    function generateTable($communication_list,$building_list) {
        ob_start();
        include 'Views/templates/syndicCommunication_view.php';
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