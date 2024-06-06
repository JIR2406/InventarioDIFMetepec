<?php

class UsuariosModel extends Mysql
{
	private $intIdUsuario;
	private $strIdentificacion;
	private $strNombre;
	private $strApellido;
	private $intTelefono;
	private $strEmail;
	private $strPassword;
	private $strToken;
	private $intTipoId;
	private $intStatus;
	private $strNit;
	private $strNomFiscal;
	private $strDirFiscal;
	private $strCfdi;
	public function __construct()
	{
		parent::__construct();
	}

	public function insertUsuario(string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, int $status)
	{

		$this->strIdentificacion = $identificacion;
		$this->strNombre = $nombre;
		$this->strApellido = $apellido;
		$this->intTelefono = $telefono;
		$this->strEmail = $email;
		$this->strPassword = $password;
		$this->intTipoId = $tipoid;
		$this->intStatus = $status;
		$return = 0;

		$sql = "SELECT * FROM persona WHERE 
					email_user = '{$this->strEmail}' or indentificacion = '{$this->strIdentificacion}' ";
		$request = $this->select_all($sql);

		if (empty($request)) {
			$query_insert = "INSERT INTO persona(indentificacion,nombres,apellidos,telefono,email_user,password,rolid,status) 
								  VALUES(?,?,?,?,?,?,?,?)";
			$arrData = array(
				$this->strIdentificacion,
				$this->strNombre,
				$this->strApellido,
				$this->intTelefono,
				$this->strEmail,
				$this->strPassword,
				$this->intTipoId,
				$this->intStatus
			);
			$request_insert = $this->insert($query_insert, $arrData);
			$return = $request_insert;
		} else {
			$return = "exist";
		}
		return $return;
	}

	public function selectUsuarios()
	{
		$admin = "";
		if ($_SESSION['idUser'] != 22) {
			$admin = "and p.idpersona !=22";
		}
		$sql = "SELECT p.idpersona,p.indentificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.status,p.idalmacen,r.nombrerol 
					FROM persona p 
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.status != 0 " . $admin;
		$request = $this->select_all($sql);
		return $request;
	}
	public function selectUsuario(int $idpersona)
	{
		$this->intIdUsuario = $idpersona;
		$sql = "SELECT p.idpersona,p.indentificacion,p.nombres,p.apellidos,p.telefono,p.email_user,p.idalmacen,r.idrol,r.nombrerol,p.status, DATE_FORMAT(p.datecreated, '%d-%m-%Y') as fechaRegistro 
					FROM persona p
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.idpersona = $this->intIdUsuario ";
		$request = $this->select($sql);
		return $request;
	}

	public function updateUsuario(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, int $status)
	{

		$this->intIdUsuario = $idUsuario;
		$this->strIdentificacion = $identificacion;
		$this->strNombre = $nombre;
		$this->strApellido = $apellido;
		$this->intTelefono = $telefono;
		$this->strEmail = $email;
		$this->strPassword = $password;
		$this->intTipoId = $tipoid;
		$this->intStatus = $status;

		$sql = "SELECT * FROM persona WHERE (email_user = '{$this->strEmail}' AND idpersona != $this->intIdUsuario)
										  OR (indentificacion = '{$this->strIdentificacion}' AND idpersona != $this->intIdUsuario) ";
		$request = $this->select_all($sql);

		if (empty($request)) {
			if ($this->strPassword != "") {
				$sql = "UPDATE persona SET indentificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, password=?, rolid=?, status=? 
							WHERE idpersona = $this->intIdUsuario ";
				$arrData = array(
					$this->strIdentificacion,
					$this->strNombre,
					$this->strApellido,
					$this->intTelefono,
					$this->strEmail,
					$this->strPassword,
					$this->intTipoId,
					$this->intStatus
				);
			} else {
				$sql = "UPDATE persona SET indentificacion=?, nombres=?, apellidos=?, telefono=?, email_user=?, rolid=?, status=? 
							WHERE idpersona = $this->intIdUsuario ";
				$arrData = array(
					$this->strIdentificacion,
					$this->strNombre,
					$this->strApellido,
					$this->intTelefono,
					$this->strEmail,
					$this->intTipoId,
					$this->intStatus
				);
			}
			$request = $this->update($sql, $arrData);
		} else {
			$request = "exist";
		}
		return $request;
	}
	public function deleteUsuario(int $intIdpersona)
	{
		$this->intIdUsuario = $intIdpersona;
		$sql = "UPDATE persona SET status = ? WHERE idpersona = $this->intIdUsuario";
		$arrData = array(0);
		$request = $this->update($sql, $arrData);
		return $request;
	}

	public function updatePerfil(int $id, string $identificacion, string $nombre, string $apellido, int $telefono, string $password)
	{
		$this->intIdUsuario = $id;
		$this->strIdentificacion = $identificacion;
		$this->strNombre = $nombre;
		$this->strApellido = $apellido;
		$this->intTelefono = $telefono;
		$this->strPassword = $password;

		if ($this->strPassword != "") {
			$sql = "UPDATE persona SET 	indentificacion = ?, nombres = ?, apellidos = ?, telefono = ?, password = ? WHERE idpersona = $this->intIdUsuario";
			$arrData = array(
				$this->strIdentificacion,
				$this->strNombre,
				$this->strApellido,
				$this->intTelefono,
				$this->strPassword
			);
		} else {
			$sql = "UPDATE persona SET 	indentificacion = ?, nombres = ?, apellidos = ?, telefono = ? WHERE idpersona = $this->intIdUsuario";
			$arrData = array(
				$this->strIdentificacion,
				$this->strNombre,
				$this->strApellido,
				$this->intTelefono
			);
		}
		$request = $this->update($sql, $arrData);
		return $request;
	}
	public function updateDataFiscal(int $id, string $nit, string $nomFiscal, string $dirFiscal, string $cfdi)
	{
		$this->intIdUsuario = $id;
		$this->strNit = $nit;
		$this->strNomFiscal = $nomFiscal;
		$this->strDirFiscal = $dirFiscal;
		$this->strCfdi = $cfdi;

		$sql = "UPDATE persona SET rfc=?, nombrefical=?, direccionfiscal=?, cfdi=? WHERE idpersona = $this->intIdUsuario";
		$arrData = array(
			$this->strNit,
			$this->strNomFiscal,
			$this->strDirFiscal,
			$this->strCfdi
		);
		$request = $this->update($sql, $arrData);
		return $request;
	}
}
