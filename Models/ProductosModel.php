<?php
require_once("Libraries/Core/Mysql.php");
class ProductosModel extends Mysql
{
    private $intIdProducto;

    private $strImagen;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertImage(int $idproducto, string $imagen){
        $this->intIdProducto = $idproducto;
        $this->strImagen = $imagen;
        $query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
        $arrData = array($this->intIdProducto,
                        $this->strImagen);
        $request_insert = $this->insert($query_insert,$arrData);
        return $request_insert;
    }

    public function selectImages(int $idproducto){
        $this->intIdProducto = $idproducto;
        $sql = "SELECT productoid,img
                FROM imagen
                WHERE productoid = $this->intIdProducto";
        $request = $this->select_all($sql);
        return $request;
    }

    public function deleteImage(int $idproducto, string $imagen){
        $this->intIdProducto = $idproducto;
        $this->strImagen = $imagen;
        $query  = "DELETE FROM imagen 
                    WHERE productoid = $this->intIdProducto 
                    AND img = '{$this->strImagen}'";
        $request_delete = $this->delete($query);
        return $request_delete;
    }
}
