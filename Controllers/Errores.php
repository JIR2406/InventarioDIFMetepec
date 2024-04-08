<?php
require_once("Libraries/Core/Controllers.php");
require_once("Views/Error/error.php");
class Errores extends Controllers{

    public function __construct(){
        parent::__construct();

    }
    
    public function notFound(){
        $this->views->getView($this,"error");
    }
}
?>