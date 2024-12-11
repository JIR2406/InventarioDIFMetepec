<?php

class AlmacenesModel extends Mysql
{
	private $intIdModulo;
	private $strTitulo;
	private $strDescripcion;
	private $intStatus;
	public function __construct()
	{
		parent::__construct();
	}

	public function insertAlmacen(string $titulo, string $descripcion, string $strTipo, string $strDirecciones)
	{
		$this->strTitulo = $titulo;
		$this->strDescripcion = $descripcion;
		
		$return = 0;

		$sql = "SELECT COUNT(*) AS NA FROM almacen";
		$request = $this->select_all($sql);
		$status = 1;
		$incremento = $request[0]['NA'] + 1;
			$query_insert = "INSERT INTO almacen(idalmacen, nombre,descripcion,tipo,direccion,status) 
								  VALUES(?,?,?,?,?,?)";
			$arrData = array(
				$incremento,
				$this->strTitulo,
				$this->strDescripcion,
				$strTipo,
				$strDirecciones,
				$status
			);
			$request_insert = $this->insert($query_insert, $arrData);

			$return = $request_insert;

			return $return;
	}

	public function selectAlmacenes()
	{

		$sql = "SELECT `idalmacen`, `nombre`, `descripcion`, `tipo`, `direccion`, `status` FROM `almacen` WHERE status = 1";
		$request = $this->select_all($sql);
		return $request;
	}
	public function selectModulo(int $idmodulo)
	{
		$this->intIdModulo = $idmodulo;
		$sql = "SELECT `idmodulo`, `titulo`, `descripcion`, `status` FROM modulo WHERE idmodulo = $this->intIdModulo";
		$request = $this->select($sql);
		return $request;
	}

	public function updateModulo(int $idmodulo, string $titulo, string $descripcion, int $status)
	{

		$this->intIdModulo = $idmodulo;
		$this->strTitulo = $titulo;
		$this->strDescripcion = $descripcion;
		$this->intStatus = $status;

		$sql = "SELECT * FROM modulo WHERE 
					titulo = '{$this->strTitulo}'";
		$request = $this->select_all($sql);

		$sql = "UPDATE modulo SET idmodulo = ?,titulo = ?, descripcion = ?,`status`= ? WHERE idmodulo = $this->intIdModulo";
		$arrData = array(
			$this->intIdModulo,
			$this->strTitulo,
			$this->strDescripcion,
			$this->intStatus
		);
		$request = $this->update($sql, $arrData);
		return $request;
	}
	public function deleteProducto(int $intIdmodulo, string $comentario)
    {
        $intProducto = $intIdmodulo;
        $comentario = $comentario;
        $sql = "UPDATE almacen SET status = ?, observacion= ? WHERE idalmacen = ?";
        $arrData = array(0, $comentario, $intProducto);
        $request = $this->update($sql, $arrData);
        return $request;
    }
}
