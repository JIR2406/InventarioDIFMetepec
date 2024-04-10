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

	public function insertModulo(string $titulo, string $descripcion, int $status)
	{
		$this->strTitulo = $titulo;
		$this->strDescripcion = $descripcion;
		$this->intStatus = $status;
		$return = 0;

		$sql = "SELECT * FROM modulo WHERE 
					titulo = '{$this->strTitulo}'";
		$request = $this->select_all($sql);
		if (!empty($request) == 0) {
			$query_insert = "INSERT INTO modulo(titulo,descripcion,status) 
								  VALUES(?,?,?)";
			$arrData = array(
				$this->strTitulo,
				$this->strDescripcion,
				$this->intStatus
			);
			$request_insert = $this->insert($query_insert, $arrData);
			$return = $request_insert;
		} else {
			$return = "exist";
		}
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
	public function deleteModulo(int $intIdmodulo)
	{
		$this->intIdModulo = $intIdmodulo;
		$sql = "UPDATE modulo SET status = ? WHERE idmodulo = ?";
		$arrData = array(0, $this->intIdModulo);
		$request = $this->update($sql, $arrData);
		return $request;
	}
}
