<?php 

class IndexPageView {
    private $page;
    private $render;
    private $buffer ;

    
    function __construct() {
        $this->page = false;
        $this->render = false;
    }

//DISPLAY

    function displayPage($product_list) {
        $this->template($product_list);
        return $this->render;
    }

    function displayOne($product) {
        $this->template($product);
        return $this->render;
    }


// TEMPLATE

    function templateSingle($product) {
        return $this->generateOne($product);
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

    function templateMultiple($product_list) {
//        $buffer = $this->generateEmptyFormToutNul();
        $buffer =  $this->generateTable($product_list);
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

    function generateOne($product) {
        ob_start();
        include 'Views/templates/unique_view.php';
        return ob_get_clean();
    }

    function generateTable($product_list) {
        ob_start();
            include 'Views/templates/table_view.php';
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