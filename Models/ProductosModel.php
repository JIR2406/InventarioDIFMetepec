<?php
require_once("Libraries/Core/Mysql.php");
class ProductosModel extends Mysql
{
    private $intProducto;
    private $strTitulo;
    private $strDescripcion;
    private $intStatus;
    private $categoria;
    private $unidades;
    private $almacen;
    private $comentario;

    public function __construct()
    {
        parent::__construct();
    }


    public function selectProductos($idalmacen)
    {
        $sql = "
        SELECT idproducto, pr.nombre, pr.descripcion, ct.nombre categoriaid, unidades, al.nombre as idalmacen, pr.status
        FROM producto pr JOIN almacen al ON pr.idalmacen = al.idalmacen
        JOIN categoria ct on pr.categoriaid = ct.idcategoria
        WHERE pr.status != 0 AND pr.idalmacen = ".$idalmacen;
        $request = $this->select_all($sql);
        return $request;
    }
    public function insertProducto(string $titulo, string $descripcion, int $categoria, string $unidades, int $almacen, int $status)
    {
        $this->strTitulo = $titulo;
        $this->strDescripcion = $descripcion;
        $this->categoria = $categoria;
        $this->unidades = $unidades;
        $this->almacen = $almacen;
        $this->intStatus = $status;

        $query_insert = "INSERT INTO producto(nombre, descripcion, categoriaid, unidades, idalmacen, status)
						VALUES(?,?,?,?,?,?)";
        $arrData = array(
            $this->strTitulo,
            $this->strDescripcion,
            $this->categoria,
            $this->unidades,
            $this->almacen,
            $this->intStatus
        );
        $request_insert = $this->insert($query_insert, $arrData);
        $return = $request_insert;
        return $return;
    }

    public function deleteProducto(int $intIdmodulo, string $comentario)
    {
        $this->intProducto = $intIdmodulo;
        $this->comentario = $comentario;
        $sql = "UPDATE producto SET status = ?, observacion= ? WHERE idproducto = ?";
        $arrData = array(0, $this->comentario, $this->intProducto);
        $request = $this->update($sql, $arrData);
        return $request;
    }

    public function updateProducto(int $id,int $cantidad){
        $sql = "UPDATE producto SET unidades=? WHERE idproducto = ?";
        $arrData = array($this->$cantidad, $this->intProducto);
        $request = $this->update($sql, $arrData);
        return $request;

    }
}
