<?php
require_once("Libraries/Core/Mysql.php");
class CategoriasModel extends Mysql
{
	public $intId;
	public $strNombre;
	public $strDescripcion;
	public $strImgPortada;
	public $intStatus;

	public function __construct()
	{
		parent::__construct();
	}
	
	public function insertCategoria(
		string $nombre,
		string $descripcion,
		string $imgPortada,
		int $status
	) {

		$this->strNombre = $nombre;
		$this->strDescripcion = $descripcion;
		$this->strImgPortada = $imgPortada;
		$this->intStatus = $status;
		$return = 0;

		$sql = "SELECT * FROM categoria WHERE 
					nombre = '{$this->strNombre}' ";
		$request = $this->select_all($sql);

		if (empty($request)) {
			$query_insert = "INSERT INTO categoria(nombre,descripcion,portada,status) 
								  VALUES(?,?,?,?)";
			$arrData = array(
				$this->strNombre,
				$this->strDescripcion,
				$this->strImgPortada,
				$this->intStatus
			);
			$request_insert = $this->insert($query_insert, $arrData);
			$return = 1;
		} else {
			$return = "exist";
		}
		return $return;
	}


	public function selectCategorias()
	{
		//EXTRAE ROLES
		$sql = "SELECT * FROM categoria WHERE status != 0 ";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectCategoria(int $idCategoria)
	{
		$this->intId = $idCategoria;
		$sql = "SELECT * FROM categoria WHERE idcategoria = $this->intId";
		$request = $this->select($sql);
		return $request;
	}

	public function deleteCategoria(int $intIdpersona)
	{
		$this->intId = $intIdpersona;
		$sql = "UPDATE `categoria` SET `status` = ? WHERE idcategoria = $this->intId";
		$arrData = array(0);
		$request = $this->update($sql, $arrData);
		return $request;
	}

	public function updateCategoria(int $idcategoria, string $categoria, string $descripcion, string $portada, int $status){
		$this->intId = $idcategoria;
		$this->strNombre = $categoria;
		$this->strDescripcion = $descripcion;
		$this->strImgPortada = $portada;
		$this->intStatus = $status;

		$sql = "SELECT * FROM categoria WHERE nombre = '{$this->strNombre}' AND idcategoria != $this->intId";
		$request = $this->select_all($sql);

		if(empty($request))
		{
			$sql = "UPDATE categoria SET nombre = ?, descripcion = ?, portada = ?, status = ? WHERE idcategoria = $this->intId ";
			$arrData = array($this->strNombre, 
							 $this->strDescripcion, 
							 $this->strImgPortada, 
							 $this->intStatus);
			$request = $this->update($sql,$arrData);
		}else{
			$request = "exist";
		}
		return $request;			
	}
}
