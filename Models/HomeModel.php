<?php
require_once("Libraries/Core/Mysql.php");
class HomeModel extends Mysql
{
    public function __construct(){
        parent::__construct();
    }

    public function selectCategorias(){
        {
            //EXTRAE ROLES
            $sql = "SELECT nombre,descripcion,portada FROM categoria WHERE status != 0 ";
            $request = $this->select_all($sql);
            return $request;
        }
    }
}
?>